<?php

namespace Modules\Role\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;

class UserRoleController extends Controller
{
    /**
     * Assign roles to a user.
     *
     * @param Request $request
     * @param int $userId
     * @return JsonResponse
     */
    public function assignRoles(Request $request, $userId): JsonResponse
    {
        $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ]);

        $user = User::findOrFail($userId);
        
        $user->syncRoles($request->roles);

        return response()->json([
            'status' => 'success',
            'message' => 'Roles assigned successfully',
            'data' => [
                'user' => $user,
                'roles' => $user->roles,
            ],
        ]);
    }

    /**
     * Get roles for a user.
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function getUserRoles($userId): JsonResponse
    {
        $user = User::with('roles')->findOrFail($userId);
        
        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => $user,
                'roles' => $user->roles,
            ],
        ]);
    }

    /**
     * Get users by role.
     *
     * @param int $roleId
     * @return JsonResponse
     */
    public function getUsersByRole($roleId): JsonResponse
    {
        $role = Role::findOrFail($roleId);
        $users = User::role($role->name)->get();
        
        return response()->json([
            'status' => 'success',
            'data' => [
                'role' => $role,
                'users' => $users,
            ],
        ]);
    }

    /**
     * Remove a role from a user.
     *
     * @param Request $request
     * @param int $userId
     * @return JsonResponse
     */
    public function removeRole(Request $request, $userId): JsonResponse
    {
        $request->validate([
            'role' => 'required|string|exists:roles,name',
        ]);

        $user = User::findOrFail($userId);
        $role = $request->role;
        
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Role removed successfully',
                'data' => [
                    'user' => $user,
                    'roles' => $user->roles,
                ],
            ]);
        }
        
        return response()->json([
            'status' => 'error',
            'message' => 'User does not have this role',
        ], 422);
    }
} 