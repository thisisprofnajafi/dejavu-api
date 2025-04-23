<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = User::query();
        
        // Filter by role
        if ($request->has('role')) {
            $query->role($request->role);
        }
        
        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        // Search by name or email
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }
        
        $users = $query->with('roles')
            ->orderBy($request->input('order_by', 'created_at'), $request->input('order', 'desc'))
            ->paginate($request->input('per_page', 15));
        
        return response()->json([
            'status' => 'success',
            'data' => $users
        ]);
    }

    /**
     * Store a newly created user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Password::defaults()],
            'status' => 'required|in:active,inactive',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name',
        ]);

        DB::beginTransaction();
        
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => $request->status
            ]);
            
            // Assign roles if provided
            if ($request->has('roles') && is_array($request->roles)) {
                $user->assignRole($request->roles);
            }
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'data' => $user->load('roles')
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified user.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $user = User::with(['roles', 'permissions'])->findOrFail($id);
        
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    /**
     * Update the specified user.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => ['nullable', Password::defaults()],
            'status' => 'required|in:active,inactive',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name',
        ]);

        DB::beginTransaction();
        
        try {
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'status' => $request->status
            ];
            
            // Only update password if provided
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }
            
            $user->update($userData);
            
            // Sync roles if provided
            if ($request->has('roles')) {
                $user->syncRoles($request->roles);
            }
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully',
                'data' => $user->fresh()->load(['roles', 'permissions'])
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified user.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        if ($id == auth()->id()) {
            return response()->json([
                'status' => 'error',
                'message' => 'You cannot delete your own account'
            ], 422);
        }
        
        $user = User::findOrFail($id);
        
        DB::beginTransaction();
        
        try {
            // Remove all roles and permissions
            $user->roles()->detach();
            $user->permissions()->detach();
            
            // Delete the user
            $user->delete();
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'User deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete user: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Assign roles to a user.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function assignRoles(Request $request, $id): JsonResponse
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ]);
        
        DB::beginTransaction();
        
        try {
            $user->syncRoles($request->roles);
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Roles assigned successfully',
                'data' => $user->fresh()->load('roles')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to assign roles: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Assign direct permissions to a user.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function assignPermissions(Request $request, $id): JsonResponse
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name',
        ]);
        
        DB::beginTransaction();
        
        try {
            $user->syncPermissions($request->permissions);
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Permissions assigned successfully',
                'data' => $user->fresh()->load('permissions')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to assign permissions: ' . $e->getMessage()
            ], 500);
        }
    }
} 