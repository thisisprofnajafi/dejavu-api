<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of roles.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $roles = Role::with('permissions')->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $roles
        ]);
    }

    /**
     * Store a newly created role.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'guard_name' => 'nullable|string|default:web',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        DB::beginTransaction();
        
        try {
            $guardName = $request->input('guard_name', 'web');
            
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => $guardName
            ]);
            
            // Assign permissions if provided
            if ($request->has('permissions') && is_array($request->permissions)) {
                $role->syncPermissions($request->permissions);
            }
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Role created successfully',
                'data' => $role->load('permissions')
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create role: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified role.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $role = Role::with('permissions')->findOrFail($id);
        
        return response()->json([
            'status' => 'success',
            'data' => $role
        ]);
    }

    /**
     * Update the specified role.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $role = Role::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,'.$id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        DB::beginTransaction();
        
        try {
            $role->update([
                'name' => $request->name
            ]);
            
            // Sync permissions if provided
            if ($request->has('permissions')) {
                $role->syncPermissions($request->permissions);
            }
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Role updated successfully',
                'data' => $role->fresh()->load('permissions')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update role: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified role.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $role = Role::findOrFail($id);
        
        // Check if role is a default one
        if (in_array($role->name, ['admin', 'author', 'visitor'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot delete default roles'
            ], 422);
        }
        
        DB::beginTransaction();
        
        try {
            // Detach all users and permissions
            $role->users()->detach();
            $role->permissions()->detach();
            
            // Delete the role
            $role->delete();
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Role deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete role: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * List all permissions.
     *
     * @return JsonResponse
     */
    public function permissions(): JsonResponse
    {
        $permissions = Permission::all();
        
        return response()->json([
            'status' => 'success',
            'data' => $permissions
        ]);
    }
    
    /**
     * Assign permissions to a role.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function assignPermissions(Request $request, $id): JsonResponse
    {
        $role = Role::findOrFail($id);
        
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name'
        ]);
        
        DB::beginTransaction();
        
        try {
            $role->syncPermissions($request->permissions);
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Permissions assigned successfully',
                'data' => $role->fresh()->load('permissions')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to assign permissions: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Create a new permission.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function createPermission(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'guard_name' => 'nullable|string|default:web'
        ]);
        
        DB::beginTransaction();
        
        try {
            $guardName = $request->input('guard_name', 'web');
            
            $permission = Permission::create([
                'name' => $request->name,
                'guard_name' => $guardName
            ]);
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Permission created successfully',
                'data' => $permission
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create permission: ' . $e->getMessage()
            ], 500);
        }
    }
} 