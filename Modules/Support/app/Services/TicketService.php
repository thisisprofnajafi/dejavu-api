<?php

namespace Modules\Support\app\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Support\app\Models\Ticket;
use Modules\Support\app\Models\TicketResponse;
use Modules\Support\app\Models\TicketAttachment;
use Modules\Support\app\Mail\TicketCreated;
use Modules\Support\app\Mail\TicketUpdated;
use Modules\Support\app\Mail\TicketResponded;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class TicketService
{
    /**
     * Get tickets with pagination and filtering.
     *
     * @param int|null $userId
     * @param int $perPage
     * @param string|null $status
     * @param string|null $priority
     * @param int|null $departmentId
     * @param string|null $search
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getTickets($userId = null, $perPage = 15, $status = null, $priority = null, $departmentId = null, $search = null)
    {
        $query = Ticket::with(['user', 'department']);
        
        // Filter by user if provided (for non-admin users)
        if ($userId) {
            $query->where('user_id', $userId);
        }
        
        // Filter by status if provided
        if ($status) {
            $query->where('status', $status);
        }
        
        // Filter by priority if provided
        if ($priority) {
            $query->where('priority', $priority);
        }
        
        // Filter by department if provided
        if ($departmentId) {
            $query->where('department_id', $departmentId);
        }
        
        // Filter by search term if provided
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                  ->orWhere('ticket_number', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        return $query->orderBy('updated_at', 'desc')->paginate($perPage);
    }

    /**
     * Get a specific ticket with its responses and attachments.
     *
     * @param int $id
     * @return Ticket
     */
    public function getTicket($id)
    {
        return Ticket::with(['user', 'department', 'responses.attachments', 'responses.user'])
            ->findOrFail($id);
    }

    /**
     * Create a new ticket.
     *
     * @param int $userId
     * @param array $data
     * @return Ticket
     */
    public function createTicket($userId, array $data)
    {
        DB::beginTransaction();
        
        try {
            // Generate ticket number
            $ticketNumber = $this->generateTicketNumber();
            
            // Create ticket
            $ticket = Ticket::create([
                'user_id' => $userId,
                'department_id' => $data['department_id'],
                'ticket_number' => $ticketNumber,
                'subject' => $data['subject'],
                'content' => $data['content'],
                'priority' => $data['priority'] ?? 'medium',
                'status' => 'open',
            ]);
            
            // Handle attachments if present
            if (isset($data['attachments']) && !empty($data['attachments'])) {
                $this->handleAttachments($ticket, $data['attachments']);
            }
            
            // Send notification emails
            $this->sendTicketCreatedNotifications($ticket);
            
            DB::commit();
            
            return $ticket->load(['user', 'department', 'responses.attachments']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update an existing ticket.
     *
     * @param int $id
     * @param int $userId
     * @param bool $isAdmin
     * @param array $data
     * @return Ticket
     */
    public function updateTicket($id, $userId, $isAdmin, array $data)
    {
        $ticket = Ticket::findOrFail($id);
        
        // Check if user is authorized to update the ticket
        if (!$isAdmin && $ticket->user_id !== $userId) {
            throw new \Exception('You are not authorized to update this ticket');
        }
        
        DB::beginTransaction();
        
        try {
            // Update ticket fields
            $updateData = [];
            
            if (isset($data['subject'])) {
                $updateData['subject'] = $data['subject'];
            }
            
            if (isset($data['content'])) {
                $updateData['content'] = $data['content'];
            }
            
            if ($isAdmin && isset($data['priority'])) {
                $updateData['priority'] = $data['priority'];
            }
            
            if ($isAdmin && isset($data['department_id'])) {
                $updateData['department_id'] = $data['department_id'];
            }
            
            if (!empty($updateData)) {
                $ticket->update($updateData);
            }
            
            DB::commit();
            
            return $ticket->fresh(['user', 'department', 'responses.attachments']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Change the status of a ticket.
     *
     * @param int $id
     * @param int $userId
     * @param bool $isAdmin
     * @param string $status
     * @return Ticket
     */
    public function changeTicketStatus($id, $userId, $isAdmin, $status)
    {
        $ticket = Ticket::findOrFail($id);
        
        // Check if user is authorized to change the ticket status
        if (!$isAdmin && $ticket->user_id !== $userId) {
            throw new \Exception('You are not authorized to change this ticket status');
        }
        
        // If user is not admin, they can only close their own tickets
        if (!$isAdmin && $status !== 'closed') {
            throw new \Exception('You can only close tickets, not change to other statuses');
        }
        
        $ticket->status = $status;
        $ticket->save();
        
        // Send notification email about status change
        if ($ticket->wasChanged('status')) {
            $this->sendTicketUpdatedNotifications($ticket);
        }
        
        return $ticket->fresh(['user', 'department']);
    }

    /**
     * Add a response to a ticket.
     *
     * @param int $ticketId
     * @param int $userId
     * @param bool $isAdmin
     * @param string $message
     * @param array $attachments
     * @return TicketResponse
     */
    public function addTicketResponse($ticketId, $userId, $isAdmin, $message, array $attachments = [])
    {
        $ticket = Ticket::findOrFail($ticketId);
        
        // Check if user is authorized to respond to the ticket
        if (!$isAdmin && $ticket->user_id !== $userId) {
            throw new \Exception('You are not authorized to respond to this ticket');
        }
        
        DB::beginTransaction();
        
        try {
            // Create ticket response
            $response = TicketResponse::create([
                'ticket_id' => $ticketId,
                'user_id' => $userId,
                'message' => $message,
                'is_from_admin' => $isAdmin,
            ]);
            
            // Handle attachments if present
            if (!empty($attachments)) {
                foreach ($attachments as $attachment) {
                    $path = $attachment->store('ticket-attachments/' . $ticket->ticket_number);
                    
                    TicketAttachment::create([
                        'ticket_response_id' => $response->id,
                        'filename' => $attachment->getClientOriginalName(),
                        'file_path' => $path,
                        'file_size' => $attachment->getSize(),
                        'mime_type' => $attachment->getMimeType(),
                    ]);
                }
            }
            
            // Update ticket status if admin responded (move to in progress)
            if ($isAdmin && $ticket->status === 'open') {
                $ticket->status = 'in_progress';
                $ticket->save();
            }
            
            // Update ticket's updated_at timestamp
            $ticket->touch();
            
            // Send notification email about the response
            $this->sendTicketRespondedNotifications($ticket, $response);
            
            DB::commit();
            
            return $response->load(['user', 'attachments']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Download a ticket attachment.
     *
     * @param TicketAttachment $attachment
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadAttachment(TicketAttachment $attachment)
    {
        return Storage::download(
            $attachment->file_path,
            $attachment->filename,
            ['Content-Type' => $attachment->mime_type]
        );
    }

    /**
     * Generate a unique ticket number.
     *
     * @return string
     */
    private function generateTicketNumber()
    {
        $prefix = 'TKT-';
        $timestamp = now()->format('Ymd');
        $random = Str::upper(Str::random(4));
        
        return $prefix . $timestamp . '-' . $random;
    }

    /**
     * Handle ticket attachments.
     *
     * @param Ticket $ticket
     * @param array $attachments
     * @return void
     */
    private function handleAttachments(Ticket $ticket, array $attachments)
    {
        // Create initial response for the ticket
        $response = TicketResponse::create([
            'ticket_id' => $ticket->id,
            'user_id' => $ticket->user_id,
            'message' => $ticket->content,
            'is_from_admin' => false,
        ]);
        
        // Process attachments
        foreach ($attachments as $attachment) {
            $path = $attachment->store('ticket-attachments/' . $ticket->ticket_number);
            
            TicketAttachment::create([
                'ticket_response_id' => $response->id,
                'filename' => $attachment->getClientOriginalName(),
                'file_path' => $path,
                'file_size' => $attachment->getSize(),
                'mime_type' => $attachment->getMimeType(),
            ]);
        }
    }

    /**
     * Send notification emails when a ticket is created.
     *
     * @param Ticket $ticket
     * @return void
     */
    private function sendTicketCreatedNotifications(Ticket $ticket)
    {
        // Send to department
        if ($ticket->department && $ticket->department->email) {
            Mail::to($ticket->department->email)
                ->send(new TicketCreated($ticket));
        }
        
        // Send confirmation to user
        if ($ticket->user && $ticket->user->email) {
            Mail::to($ticket->user->email)
                ->send(new TicketCreated($ticket, true));
        }
    }

    /**
     * Send notification emails when a ticket status is updated.
     *
     * @param Ticket $ticket
     * @return void
     */
    private function sendTicketUpdatedNotifications(Ticket $ticket)
    {
        // Send to user
        if ($ticket->user && $ticket->user->email) {
            Mail::to($ticket->user->email)
                ->send(new TicketUpdated($ticket));
        }
    }

    /**
     * Send notification emails when a ticket is responded to.
     *
     * @param Ticket $ticket
     * @param TicketResponse $response
     * @return void
     */
    private function sendTicketRespondedNotifications(Ticket $ticket, TicketResponse $response)
    {
        // If response is from admin, notify user
        if ($response->is_from_admin) {
            if ($ticket->user && $ticket->user->email) {
                Mail::to($ticket->user->email)
                    ->send(new TicketResponded($ticket, $response));
            }
        } 
        // If response is from user, notify department
        else {
            if ($ticket->department && $ticket->department->email) {
                Mail::to($ticket->department->email)
                    ->send(new TicketResponded($ticket, $response));
            }
        }
    }
} 