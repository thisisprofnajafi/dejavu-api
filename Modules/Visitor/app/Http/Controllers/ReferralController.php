<?php

namespace Modules\Visitor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Visitor\Services\ReferralService;
use Modules\Visitor\Models\Visitor;

class ReferralController extends Controller
{
    protected $referralService;

    public function __construct(ReferralService $referralService)
    {
        $this->referralService = $referralService;
        $this->middleware('auth:sanctum');
        $this->middleware('role:visitor');
    }

    /**
     * Get the authenticated visitor's referral code
     * 
     * @return \Illuminate\Http\Response
     */
    public function getReferralCode()
    {
        $visitor = Auth::user()->visitor;
        
        if (!$visitor) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor profile not found'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => [
                'referral_code' => $visitor->referral_code
            ]
        ]);
    }

    /**
     * Generate a new referral code for the visitor
     * 
     * @return \Illuminate\Http\Response
     */
    public function generateReferralCode()
    {
        $visitor = Auth::user()->visitor;
        
        if (!$visitor) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor profile not found'
            ], 404);
        }
        
        $newCode = $this->referralService->generateNewReferralCode($visitor->id);
        
        return response()->json([
            'success' => true,
            'message' => 'New referral code generated successfully',
            'data' => [
                'referral_code' => $newCode
            ]
        ]);
    }

    /**
     * Get referral stats for the authenticated visitor
     * 
     * @return \Illuminate\Http\Response
     */
    public function getReferralStats()
    {
        $visitor = Auth::user()->visitor;
        
        if (!$visitor) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor profile not found'
            ], 404);
        }
        
        $stats = $this->referralService->getReferralStats($visitor->id);
        
        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }

    /**
     * Get a list of users referred by this visitor
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getReferredUsers(Request $request)
    {
        $visitor = Auth::user()->visitor;
        
        if (!$visitor) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor profile not found'
            ], 404);
        }
        
        $perPage = $request->input('per_page', 15);
        $users = $this->referralService->getReferredUsers($visitor->id, $perPage);
        
        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }
} 