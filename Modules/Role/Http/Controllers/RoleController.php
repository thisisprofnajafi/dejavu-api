<?php

namespace Modules\Role\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Roles', description: 'API endpoints for role management')]
class RoleController extends Controller
{
    /**
     * Display a listing of roles.
     *
     * @return JsonResponse
     */
    #[OA\Get(
        path: '/api/v1/roles',
        summary: 'Get all roles',
        description: 'Returns a list of all roles with their permissions',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Response(
        response: 200,
        description: 'List of roles',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'data', type: 'array', items: new OA\Items(
                    properties: [
                        new OA\Property(property: 'id', type: 'integer'),
                        new OA\Property(property: 'name', type: 'string'),
                        new OA\Property(property: 'permissions', type: 'array', items: new OA\Items(type: 'object'))
                    ],
                    type: 'object'
                ))
            ]
        )
    )]
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
    #[OA\Post(
        path: '/api/v1/roles',
        summary: 'Create a new role',
        description: 'Creates a new role with permissions',
        security: [['bearerAuth' => []]]
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'editor'),
                new OA\Property(property: 'permissions', type: 'array', items: new OA\Items(type: 'string', example: 'edit articles'))
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'Role created successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'message', type: 'string', example: 'Role created successfully'),
                new OA\Property(property: 'data', type: 'object')
            ]
        )
    )]
    #[OA\Response(
        response: 422,
        description: 'Validation error',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'message', type: 'string', example: 'The name has already been taken'),
                new OA\Property(property: 'errors', type: 'object')
            ]
        )
    )]
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
    #[OA\Get(
        path: '/api/v1/roles/{id}',
        summary: 'Get a specific role',
        description: 'Returns a specific role by ID with its permissions',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        required: true,
        description: 'The role ID',
        schema: new OA\Schema(type: 'integer')
    )]
    #[OA\Response(
        response: 200,
        description: 'Role details',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'data', type: 'object')
            ]
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'Role not found'
    )]
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
    #[OA\Put(
        path: '/api/v1/roles/{id}',
        summary: 'Update a role',
        description: 'Updates a role and its permissions',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        required: true,
        description: 'The role ID',
        schema: new OA\Schema(type: 'integer')
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'editor'),
                new OA\Property(property: 'permissions', type: 'array', items: new OA\Items(type: 'string', example: 'edit articles'))
            ]
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Role updated successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'message', type: 'string', example: 'Role updated successfully'),
                new OA\Property(property: 'data', type: 'object')
            ]
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'Role not found'
    )]
    #[OA\Response(
        response: 422,
        description: 'Validation error',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'message', type: 'string', example: 'The name has already been taken'),
                new OA\Property(property: 'errors', type: 'object')
            ]
        )
    )]
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
    #[OA\Delete(
        path: '/api/v1/roles/{id}',
        summary: 'Delete a role',
        description: 'Deletes a role',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        required: true,
        description: 'The role ID',
        schema: new OA\Schema(type: 'integer')
    )]
    #[OA\Response(
        response: 200,
        description: 'Role deleted successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'message', type: 'string', example: 'Role deleted successfully')
            ]
        )
    )]
    #[OA\Response(
        response: 422,
        description: 'Cannot delete core role',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'error'),
                new OA\Property(property: 'message', type: 'string', example: 'Cannot delete core role')
            ]
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'Role not found'
    )]
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