<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    /**
     * Get dashboard statistics
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        // Count users by role
        $usersByRole = [];
        $roles = Role::all();
        
        foreach ($roles as $role) {
            $usersByRole[$role->name] = User::role($role->name)->count();
        }
        
        // Total users
        $totalUsers = User::count();
        
        // Get latest registered users
        $latestUsers = User::with('roles')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return response()->json([
            'status' => 'success',
            'data' => [
                'statistics' => [
                    'total_users' => $totalUsers,
                    'users_by_role' => $usersByRole,
                ],
                'latest_users' => $latestUsers
            ]
        ]);
    }
} 