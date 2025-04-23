<?php

namespace Modules\Role\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\JsonResponse;

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
            'data' => $roles,
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
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Role created successfully',
            'data' => $role->load('permissions'),
        ], 201);
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
            'data' => $role,
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
            'name' => 'required|string|unique:roles,name,' . $id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role->update(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Role updated successfully',
            'data' => $role->load('permissions'),
        ]);
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
        
        // Don't allow deletion of core roles
        if (in_array($role->name, ['admin', 'author', 'visitor'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot delete core role',
            ], 422);
        }
        
        $role->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Role deleted successfully',
        ]);
    }
} 