<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Modules\Admin\Models\Ticket;
use Modules\Admin\Models\TicketComment;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    /**
     * Display a listing of tickets.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Ticket::query();
        
        // Filter by status
        if ($request->has('status')) {
            $query->status($request->status);
        }
        
        // Filter by priority
        if ($request->has('priority')) {
            $query->priority($request->priority);
        }
        
        // Filter by category
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }
        
        // Filter by user
        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        
        // Filter by assigned user
        if ($request->has('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }
        
        // Search by subject or description
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('subject', 'like', '%'.$request->search.'%')
                  ->orWhere('description', 'like', '%'.$request->search.'%');
            });
        }
        
        // Include related data
        if ($request->has('with')) {
            $with = explode(',', $request->with);
            $allowedRelations = ['user', 'assignedTo', 'comments'];
            $relations = array_intersect($allowedRelations, $with);
            if (!empty($relations)) {
                $query->with($relations);
            }
        }
        
        $tickets = $query->orderBy($request->input('order_by', 'created_at'), $request->input('order', 'desc'))
            ->paginate($request->input('per_page', 15));
        
        return response()->json([
            'status' => 'success',
            'data' => $tickets
        ]);
    }

    /**
     * Store a newly created ticket.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => ['required', Rule::in([
                Ticket::PRIORITY_LOW,
                Ticket::PRIORITY_MEDIUM,
                Ticket::PRIORITY_HIGH,
                Ticket::PRIORITY_CRITICAL
            ])],
            'category' => 'nullable|string|max:255',
            'assigned_to' => 'nullable|exists:users,id'
        ]);

        DB::beginTransaction();
        
        try {
            $ticket = Ticket::create([
                'subject' => $request->subject,
                'description' => $request->description,
                'status' => Ticket::STATUS_OPEN,
                'priority' => $request->priority,
                'user_id' => Auth::id(),
                'assigned_to' => $request->assigned_to,
                'category' => $request->category
            ]);
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Ticket created successfully',
                'data' => $ticket->load(['user', 'assignedTo'])
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create ticket: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified ticket.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $ticket = Ticket::with(['user', 'assignedTo', 'comments.user'])->findOrFail($id);
        
        return response()->json([
            'status' => 'success',
            'data' => $ticket
        ]);
    }

    /**
     * Update the specified ticket.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $ticket = Ticket::findOrFail($id);
        
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => ['required', Rule::in([
                Ticket::STATUS_OPEN,
                Ticket::STATUS_IN_PROGRESS,
                Ticket::STATUS_RESOLVED,
                Ticket::STATUS_CLOSED
            ])],
            'priority' => ['required', Rule::in([
                Ticket::PRIORITY_LOW,
                Ticket::PRIORITY_MEDIUM,
                Ticket::PRIORITY_HIGH,
                Ticket::PRIORITY_CRITICAL
            ])],
            'category' => 'nullable|string|max:255',
            'assigned_to' => 'nullable|exists:users,id'
        ]);

        DB::beginTransaction();
        
        try {
            $oldStatus = $ticket->status;
            $newStatus = $request->status;
            
            $ticketData = [
                'subject' => $request->subject,
                'description' => $request->description,
                'status' => $newStatus,
                'priority' => $request->priority,
                'category' => $request->category,
                'assigned_to' => $request->assigned_to
            ];
            
            // If status is being changed to closed, set closed_at timestamp
            if ($oldStatus !== Ticket::STATUS_CLOSED && $newStatus === Ticket::STATUS_CLOSED) {
                $ticketData['closed_at'] = now();
            }
            
            // If status is being changed from closed, clear closed_at timestamp
            if ($oldStatus === Ticket::STATUS_CLOSED && $newStatus !== Ticket::STATUS_CLOSED) {
                $ticketData['closed_at'] = null;
            }
            
            $ticket->update($ticketData);
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Ticket updated successfully',
                'data' => $ticket->fresh()->load(['user', 'assignedTo'])
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update ticket: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified ticket.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $ticket = Ticket::findOrFail($id);
        
        DB::beginTransaction();
        
        try {
            $ticket->delete();
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Ticket deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete ticket: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Add a comment to a ticket.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function addComment(Request $request, $id): JsonResponse
    {
        $ticket = Ticket::findOrFail($id);
        
        $request->validate([
            'content' => 'required|string',
            'is_internal' => 'boolean'
        ]);
        
        DB::beginTransaction();
        
        try {
            $comment = new TicketComment([
                'content' => $request->content,
                'is_internal' => $request->boolean('is_internal', false),
                'user_id' => Auth::id()
            ]);
            
            $ticket->comments()->save($comment);
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Comment added successfully',
                'data' => $comment->fresh()->load('user')
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add comment: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get comments for a ticket.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function getComments(Request $request, $id): JsonResponse
    {
        $ticket = Ticket::findOrFail($id);
        
        $query = $ticket->comments()->with('user');
        
        // Filter by internal/public
        if ($request->has('is_internal')) {
            $query->where('is_internal', $request->boolean('is_internal'));
        }
        
        $comments = $query->orderBy('created_at', 'desc')
            ->paginate($request->input('per_page', 15));
        
        return response()->json([
            'status' => 'success',
            'data' => $comments
        ]);
    }
    
    /**
     * Update ticket status.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateStatus(Request $request, $id): JsonResponse
    {
        $ticket = Ticket::findOrFail($id);
        
        $request->validate([
            'status' => ['required', Rule::in([
                Ticket::STATUS_OPEN,
                Ticket::STATUS_IN_PROGRESS,
                Ticket::STATUS_RESOLVED,
                Ticket::STATUS_CLOSED
            ])]
        ]);
        
        DB::beginTransaction();
        
        try {
            $oldStatus = $ticket->status;
            $newStatus = $request->status;
            
            $updateData = ['status' => $newStatus];
            
            // If status is being changed to closed, set closed_at timestamp
            if ($oldStatus !== Ticket::STATUS_CLOSED && $newStatus === Ticket::STATUS_CLOSED) {
                $updateData['closed_at'] = now();
            }
            
            // If status is being changed from closed, clear closed_at timestamp
            if ($oldStatus === Ticket::STATUS_CLOSED && $newStatus !== Ticket::STATUS_CLOSED) {
                $updateData['closed_at'] = null;
            }
            
            $ticket->update($updateData);
            
            // Optionally add a system comment about the status change
            if ($request->has('add_comment') && $request->boolean('add_comment')) {
                $comment = new TicketComment([
                    'content' => "Ticket status changed from {$oldStatus} to {$newStatus}",
                    'is_internal' => true,
                    'user_id' => Auth::id()
                ]);
                
                $ticket->comments()->save($comment);
            }
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Ticket status updated successfully',
                'data' => $ticket->fresh()
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update ticket status: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Assign ticket to a user.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function assignTicket(Request $request, $id): JsonResponse
    {
        $ticket = Ticket::findOrFail($id);
        
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);
        
        DB::beginTransaction();
        
        try {
            $previousAssignee = $ticket->assigned_to;
            $newAssignee = $request->user_id;
            
            $ticket->update(['assigned_to' => $newAssignee]);
            
            // Optionally add a system comment about the assignment
            if ($request->has('add_comment') && $request->boolean('add_comment')) {
                $comment = new TicketComment([
                    'content' => "Ticket assigned to a new user",
                    'is_internal' => true,
                    'user_id' => Auth::id()
                ]);
                
                $ticket->comments()->save($comment);
            }
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Ticket assigned successfully',
                'data' => $ticket->fresh()->load('assignedTo')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to assign ticket: ' . $e->getMessage()
            ], 500);
        }
    }
} 