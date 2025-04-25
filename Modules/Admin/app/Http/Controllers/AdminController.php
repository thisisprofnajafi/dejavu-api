<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Models\AdminDashboard;
use Modules\Admin\Models\AdminActivity;
use Modules\Admin\Services\AdminDashboardService;
use Modules\User\Models\User;

class AdminController extends Controller
{
    protected $dashboardService;

    public function __construct(AdminDashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
        $this->middleware('can:access admin panel');
    }

    /**
     * Display the admin dashboard
     */
    public function index(Request $request)
    {
        // Get user dashboard or default if none exists
        $user = auth()->user();
        $dashboard = $this->dashboardService->getUserDashboard($user->id);
        
        // Get summary statistics
        $userCount = User::count();
        $adminCount = User::role('admin')->count();
        $recentActivities = AdminActivity::with('user')->latest()->limit(10)->get();
        
        // Log admin login activity
        AdminActivity::logLogin();
        
        return view('admin::dashboard', compact('dashboard', 'userCount', 'adminCount', 'recentActivities'));
    }

    /**
     * Get admin dashboard widgets data
     */
    public function dashboardData(Request $request)
    {
        $data = $this->dashboardService->getDashboardData($request->all());
        
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Save a custom dashboard layout
     */
    public function saveDashboard(Request $request)
    {
        $user = auth()->user();
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'is_default' => 'boolean',
            'layout' => 'array',
            'widgets' => 'array',
        ]);
        
        $dashboard = $this->dashboardService->saveDashboard($user->id, $data);
        
        return response()->json([
            'success' => true,
            'data' => $dashboard
        ]);
    }

    /**
     * Delete a dashboard
     */
    public function deleteDashboard(Request $request, $id)
    {
        $user = auth()->user();
        $result = $this->dashboardService->deleteDashboard($user->id, $id);
        
        return response()->json([
            'success' => $result,
            'message' => $result ? 'Dashboard deleted successfully' : 'Unable to delete dashboard',
        ]);
    }

    /**
     * Get system information
     */
    public function systemInfo()
    {
        $data = $this->dashboardService->getSystemInfo();
        
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
