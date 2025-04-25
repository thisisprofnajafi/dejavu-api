<?php

namespace Modules\Role\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Role\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the permissions.
     */
    public function index()
    {
        $permissions = Permission::all();
        
        return response()->json([
            'success' => true,
            'data' => [
                'permissions' => $permissions
            ]
        ]);
    }

    /**
     * Store a newly created permission in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $permission = Permission::create(['name' => $request->name]);

            return response()->json([
                'success' => true,
                'data' => [
                    'permission' => $permission
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create permission: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified permission.
     */
    public function show($id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json([
                'success' => false,
                'message' => 'Permission not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'permission' => $permission
            ]
        ]);
    }

    /**
     * Update the specified permission in storage.
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json([
                'success' => false,
                'message' => 'Permission not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:permissions,name,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $permission->name = $request->name;
            $permission->save();

            return response()->json([
                'success' => true,
                'data' => [
                    'permission' => $permission
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update permission: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified permission from storage.
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json([
                'success' => false,
                'message' => 'Permission not found'
            ], 404);
        }

        // Check if the permission is one of the protected system permissions
        $systemPermissions = [
            'create users', 'edit users', 'delete users', 'view users',
            'create roles', 'edit roles', 'delete roles', 'view roles',
            'create permissions', 'edit permissions', 'delete permissions', 'view permissions'
        ];
        
        if (in_array($permission->name, $systemPermissions)) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete system permission'
            ], 403);
        }

        try {
            $permission->delete();

            return response()->json([
                'success' => true,
                'message' => 'Permission deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete permission: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get roles with specific permission.
     */
    public function getRoles($id)
    {
        $permission = Permission::with('roles')->find($id);

        if (!$permission) {
            return response()->json([
                'success' => false,
                'message' => 'Permission not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'permission' => $permission,
                'roles' => $permission->roles
            ]
        ]);
    }
} 