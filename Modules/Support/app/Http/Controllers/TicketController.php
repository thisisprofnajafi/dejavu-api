<?php

namespace Modules\Support\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Support\app\Http\Requests\StoreTicketRequest;
use Modules\Support\app\Http\Requests\UpdateTicketRequest;
use Modules\Support\app\Services\TicketService;
use Modules\Support\app\Models\Ticket;
use Modules\Support\app\Models\TicketAttachment;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of tickets.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 15);
        $status = $request->input('status');
        $priority = $request->input('priority');
        $departmentId = $request->input('department_id');
        $search = $request->input('search');
        
        // Admin can see all tickets, regular users see only their own
        $userId = Auth::user()->hasRole('admin') ? null : Auth::id();
        
        $tickets = $this->ticketService->getTickets(
            $userId,
            $perPage,
            $status,
            $priority,
            $departmentId,
            $search
        );
        
        return response()->json([
            'success' => true,
            'data' => $tickets
        ]);
    }

    /**
     * Store a newly created ticket.
     *
     * @param StoreTicketRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        try {
            $ticket = $this->ticketService->createTicket(
                Auth::id(),
                $request->validated()
            );
            
            return response()->json([
                'success' => true,
                'message' => 'تیکت با موفقیت ایجاد شد',
                'data' => $ticket
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در ایجاد تیکت: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified ticket.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = $this->ticketService->getTicket($id);
        
        // Check if user is authorized to view this ticket
        if (!Auth::user()->hasRole('admin') && $ticket->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'شما مجاز به مشاهده این تیکت نیستید'
            ], Response::HTTP_FORBIDDEN);
        }
        
        return response()->json([
            'success' => true,
            'data' => $ticket
        ]);
    }

    /**
     * Update the specified ticket.
     *
     * @param UpdateTicketRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, $id)
    {
        try {
            $ticket = $this->ticketService->updateTicket(
                $id,
                Auth::id(),
                Auth::user()->hasRole('admin'),
                $request->validated()
            );
            
            return response()->json([
                'success' => true,
                'message' => 'تیکت با موفقیت به‌روزرسانی شد',
                'data' => $ticket
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در به‌روزرسانی تیکت: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Change ticket status.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:open,in_progress,resolved,closed'
        ]);
        
        try {
            $ticket = $this->ticketService->changeTicketStatus(
                $id,
                Auth::id(),
                Auth::user()->hasRole('admin'),
                $request->status
            );
            
            return response()->json([
                'success' => true,
                'message' => 'وضعیت تیکت با موفقیت به‌روزرسانی شد',
                'data' => $ticket
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در به‌روزرسانی وضعیت تیکت: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Add a response to a ticket.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function addResponse(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
            'attachments.*' => 'nullable|file|max:10240'
        ]);
        
        try {
            $response = $this->ticketService->addTicketResponse(
                $id,
                Auth::id(),
                Auth::user()->hasRole('admin'),
                $request->message,
                $request->file('attachments') ?? []
            );
            
            return response()->json([
                'success' => true,
                'message' => 'پاسخ با موفقیت اضافه شد',
                'data' => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در افزودن پاسخ: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Download an attachment.
     *
     * @param int $attachmentId
     * @return \Illuminate\Http\Response
     */
    public function downloadAttachment($attachmentId)
    {
        try {
            $attachment = TicketAttachment::findOrFail($attachmentId);
            $ticket = $attachment->ticketResponse->ticket;
            
            // Check if user is authorized to download this attachment
            if (!Auth::user()->hasRole('admin') && $ticket->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'شما مجاز به دانلود این پیوست نیستید'
                ], Response::HTTP_FORBIDDEN);
            }
            
            return $this->ticketService->downloadAttachment($attachment);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در دانلود پیوست: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
} 