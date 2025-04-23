<?php

namespace Modules\Role\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\JsonResponse;

class PermissionController extends Controller
{
    /**
     * Display a listing of permissions.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $permissions = Permission::all();
        
        return response()->json([
            'status' => 'success',
            'data' => $permissions,
        ]);
    }

    /**
     * Store a newly created permission.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);

        $permission = Permission::create(['name' => $request->name]);

        return response()->json([
            'status' => 'success',
            'message' => 'Permission created successfully',
            'data' => $permission,
        ], 201);
    }

    /**
     * Display the specified permission.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $permission = Permission::findOrFail($id);
        
        return response()->json([
            'status' => 'success',
            'data' => $permission,
        ]);
    }

    /**
     * Update the specified permission.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $permission = Permission::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $id,
        ]);

        $permission->update(['name' => $request->name]);

        return response()->json([
            'status' => 'success',
            'message' => 'Permission updated successfully',
            'data' => $permission,
        ]);
    }

    /**
     * Remove the specified permission.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $permission = Permission::findOrFail($id);
        
        // Check if this permission is assigned to any roles
        if ($permission->roles()->count() > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot delete permission assigned to roles',
            ], 422);
        }
        
        $permission->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Permission deleted successfully',
        ]);
    }
} 