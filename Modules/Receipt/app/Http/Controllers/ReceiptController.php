<?php

namespace Modules\Receipt\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Receipt\app\Http\Requests\StoreReceiptRequest;
use Modules\Receipt\app\Http\Requests\UpdateReceiptRequest;
use Modules\Receipt\app\Models\Receipt;
use Modules\Receipt\app\Models\ReceiptItem;
use Modules\Receipt\app\Services\ReceiptService;

class ReceiptController extends Controller
{
    protected ReceiptService $receiptService;

    public function __construct(ReceiptService $receiptService)
    {
        $this->receiptService = $receiptService;
        $this->middleware('can:receipt.view')->only(['index', 'show']);
        $this->middleware('can:receipt.create')->only(['store']);
        $this->middleware('can:receipt.edit')->only(['update']);
        $this->middleware('can:receipt.delete')->only(['destroy']);
        $this->middleware('can:visitor.receipts.view')->only(['visitorReceipts']);
        $this->middleware('can:visitor.commissions.view')->only(['commissionSummary']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', config('receipt.pagination.per_page', 15));
        $status = $request->input('status');
        $visitorId = $request->input('visitor_id');
        $userId = $request->input('user_id');
        $search = $request->input('search');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        
        $receiptsQuery = Receipt::with(['user', 'visitor', 'items']);
        
        // Filter by status if provided
        if ($status) {
            $receiptsQuery->status($status);
        }
        
        // Filter by visitor if provided
        if ($visitorId) {
            $receiptsQuery->forVisitor($visitorId);
        }
        
        // Filter by user if provided
        if ($userId) {
            $receiptsQuery->forUser($userId);
        }
        
        // Filter by date range if provided
        if ($fromDate) {
            $receiptsQuery->where('created_at', '>=', $fromDate);
        }
        
        if ($toDate) {
            $receiptsQuery->where('created_at', '<=', $toDate);
        }
        
        // Filter by search term if provided
        if ($search) {
            $receiptsQuery->where(function ($query) use ($search) {
                $query->where('receipt_number', 'like', "%{$search}%")
                    ->orWhere('notes', 'like', "%{$search}%");
            });
        }
        
        // If user is not admin, only show their own receipts or receipts they referred
        if (!Auth::user()->hasRole('admin')) {
            $query = $receiptsQuery->where(function($query) {
                $query->where('user_id', Auth::id());
                
                // If user is a visitor, also include receipts they referred
                if (Auth::user()->hasRole('visitor')) {
                    $query->orWhere('visitor_id', Auth::user()->visitor->id);
                }
            });
        }
        
        $receipts = $receiptsQuery->orderBy('created_at', 'desc')->paginate($perPage);
        
        return response()->json([
            'success' => true,
            'data' => $receipts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Receipt\app\Http\Requests\StoreReceiptRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReceiptRequest $request)
    {
        try {
            $receipt = $this->receiptService->createReceipt($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Receipt created successfully',
                'data' => $receipt->load(['user', 'visitor', 'items'])
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create receipt: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Receipt\app\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        // Check if user is authorized to view this receipt
        if (!Auth::user()->hasRole('admin') && 
            $receipt->user_id !== Auth::id() && 
            (!Auth::user()->hasRole('visitor') || $receipt->visitor_id !== Auth::user()->visitor->id)) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to view this receipt'
            ], Response::HTTP_FORBIDDEN);
        }
        
        return response()->json([
            'success' => true,
            'data' => $receipt->load(['user', 'visitor', 'items'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Receipt\app\Http\Requests\UpdateReceiptRequest  $request
     * @param  \Modules\Receipt\app\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReceiptRequest $request, Receipt $receipt)
    {
        try {
            $updatedReceipt = $this->receiptService->updateReceipt($receipt, $request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Receipt updated successfully',
                'data' => $updatedReceipt->load(['user', 'visitor', 'items'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update receipt: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Receipt\app\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
        try {
            $receipt->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Receipt deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete receipt: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get receipts for the authenticated visitor.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function visitorReceipts(Request $request)
    {
        if (!Auth::user()->hasRole('visitor')) {
            return response()->json([
                'success' => false,
                'message' => 'You must be a visitor to access this endpoint'
            ], Response::HTTP_FORBIDDEN);
        }
        
        $perPage = $request->input('per_page', config('receipt.pagination.per_page', 15));
        $status = $request->input('status');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        
        $receiptsQuery = Receipt::with(['user', 'items'])
            ->where('visitor_id', Auth::user()->visitor->id);
        
        // Filter by status if provided
        if ($status) {
            $receiptsQuery->status($status);
        }
        
        // Filter by date range if provided
        if ($fromDate) {
            $receiptsQuery->where('created_at', '>=', $fromDate);
        }
        
        if ($toDate) {
            $receiptsQuery->where('created_at', '<=', $toDate);
        }
        
        $receipts = $receiptsQuery->orderBy('created_at', 'desc')->paginate($perPage);
        
        return response()->json([
            'success' => true,
            'data' => $receipts
        ]);
    }

    /**
     * Get commission summary for the authenticated visitor.
     *
     * @return \Illuminate\Http\Response
     */
    public function commissionSummary()
    {
        if (!Auth::user()->hasRole('visitor')) {
            return response()->json([
                'success' => false,
                'message' => 'You must be a visitor to access this endpoint'
            ], Response::HTTP_FORBIDDEN);
        }
        
        $visitor = Auth::user()->visitor;
        
        // Get total paid receipts count and amount
        $paidReceipts = Receipt::where('visitor_id', $visitor->id)
            ->where('payment_status', config('receipt.statuses.paid'))
            ->get();
        
        $totalPaidCount = $paidReceipts->count();
        $totalPaidAmount = $paidReceipts->sum('total_amount');
        $totalCommission = 0;
        
        foreach ($paidReceipts as $receipt) {
            $totalCommission += $receipt->commission_amount;
        }
        
        // Get customers referred count
        $customersCount = Receipt::where('visitor_id', $visitor->id)
            ->distinct('user_id')
            ->count('user_id');
        
        return response()->json([
            'success' => true,
            'data' => [
                'total_paid_receipts' => $totalPaidCount,
                'total_paid_amount' => $totalPaidAmount,
                'total_commission' => $totalCommission,
                'customers_referred' => $customersCount,
                'commission_rate' => $visitor->commission_rate ?? 0.05, // Default 5% if not set
            ]
        ]);
    }
} 