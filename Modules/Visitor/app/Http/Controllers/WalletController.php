<?php

namespace Modules\Visitor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Visitor\Http\Requests\WithdrawRequest;
use Modules\Visitor\Services\WalletService;
use Modules\Visitor\Models\Wallet;
use Modules\Visitor\Models\WalletTransaction;

class WalletController extends Controller
{
    protected $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
        $this->middleware('auth:sanctum');
        $this->middleware('role:visitor');
    }

    /**
     * Get wallet information for the authenticated visitor
     * 
     * @return \Illuminate\Http\Response
     */
    public function getWallet()
    {
        $visitor = Auth::user()->visitor;
        
        if (!$visitor) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor profile not found'
            ], 404);
        }
        
        $wallet = $this->walletService->getWallet($visitor->id);
        
        return response()->json([
            'success' => true,
            'data' => $wallet
        ]);
    }

    /**
     * Get wallet transaction history
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getTransactions(Request $request)
    {
        $visitor = Auth::user()->visitor;
        
        if (!$visitor) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor profile not found'
            ], 404);
        }
        
        $perPage = $request->input('per_page', 15);
        $type = $request->input('type'); // credit, debit
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        
        $transactions = $this->walletService->getTransactions(
            $visitor->wallet->id,
            $perPage,
            $type,
            $dateFrom,
            $dateTo
        );
        
        return response()->json([
            'success' => true,
            'data' => $transactions
        ]);
    }

    /**
     * Request a withdrawal from the wallet
     * 
     * @param WithdrawRequest $request
     * @return \Illuminate\Http\Response
     */
    public function withdraw(WithdrawRequest $request)
    {
        $visitor = Auth::user()->visitor;
        
        if (!$visitor) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor profile not found'
            ], 404);
        }
        
        try {
            DB::beginTransaction();
            
            $result = $this->walletService->processWithdrawal(
                $visitor->id,
                $request->validated()
            );
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Withdrawal request submitted successfully',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get withdrawal history
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getWithdrawals(Request $request)
    {
        $visitor = Auth::user()->visitor;
        
        if (!$visitor) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor profile not found'
            ], 404);
        }
        
        $perPage = $request->input('per_page', 15);
        $status = $request->input('status'); // pending, approved, rejected
        
        $withdrawals = $this->walletService->getWithdrawals(
            $visitor->id,
            $perPage,
            $status
        );
        
        return response()->json([
            'success' => true,
            'data' => $withdrawals
        ]);
    }
} 