<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Users', description: 'API endpoints for user management')]
class UserController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return JsonResponse
     */
    #[OA\Get(
        path: '/api/v1/users',
        summary: 'Get all users',
        description: 'Returns a list of all users',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Response(
        response: 200,
        description: 'List of users',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'data', type: 'array', items: new OA\Items(
                    properties: [
                        new OA\Property(property: 'id', type: 'integer'),
                        new OA\Property(property: 'name', type: 'string'),
                        new OA\Property(property: 'email', type: 'string'),
                        new OA\Property(property: 'roles', type: 'array', items: new OA\Items(type: 'object'))
                    ],
                    type: 'object'
                ))
            ]
        )
    )]
    public function index(): JsonResponse
    {
        $users = User::with('roles')->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $users,
        ]);
    }

    /**
     * Store a newly created user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    #[OA\Post(
        path: '/api/v1/users',
        summary: 'Create a new user',
        description: 'Creates a new user and returns it',
        security: [['bearerAuth' => []]]
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'John Doe'),
                new OA\Property(property: 'email', type: 'string', format: 'email', example: 'john@example.com'),
                new OA\Property(property: 'password', type: 'string', format: 'password', example: 'password123'),
                new OA\Property(property: 'password_confirmation', type: 'string', format: 'password', example: 'password123'),
                new OA\Property(property: 'roles', type: 'array', items: new OA\Items(type: 'string', example: 'admin'))
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'User created successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'message', type: 'string', example: 'User created successfully'),
                new OA\Property(property: 'data', type: 'object')
            ]
        )
    )]
    #[OA\Response(
        response: 422,
        description: 'Validation error',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'message', type: 'string', example: 'The email has already been taken'),
                new OA\Property(property: 'errors', type: 'object')
            ]
        )
    )]
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->has('roles')) {
            $user->assignRole($request->roles);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'data' => $user->load('roles'),
        ], 201);
    }

    /**
     * Display the specified user.
     *
     * @param int $id
     * @return JsonResponse
     */
    #[OA\Get(
        path: '/api/v1/users/{id}',
        summary: 'Get a specific user',
        description: 'Returns a specific user by ID',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        required: true,
        description: 'The user ID',
        schema: new OA\Schema(type: 'integer')
    )]
    #[OA\Response(
        response: 200,
        description: 'User details',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'data', type: 'object')
            ]
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'User not found'
    )]
    public function show($id): JsonResponse
    {
        $user = User::with('roles', 'permissions')->findOrFail($id);
        
        return response()->json([
            'status' => 'success',
            'data' => $user,
        ]);
    }

    /**
     * Update the specified user.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    #[OA\Put(
        path: '/api/v1/users/{id}',
        summary: 'Update a user',
        description: 'Updates a user and returns it',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        required: true,
        description: 'The user ID',
        schema: new OA\Schema(type: 'integer')
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'John Doe'),
                new OA\Property(property: 'email', type: 'string', format: 'email', example: 'john@example.com'),
                new OA\Property(property: 'password', type: 'string', format: 'password', example: 'newpassword123', nullable: true),
                new OA\Property(property: 'password_confirmation', type: 'string', format: 'password', example: 'newpassword123', nullable: true),
                new OA\Property(property: 'roles', type: 'array', items: new OA\Items(type: 'string', example: 'admin'))
            ]
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'User updated successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'message', type: 'string', example: 'User updated successfully'),
                new OA\Property(property: 'data', type: 'object')
            ]
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'User not found'
    )]
    #[OA\Response(
        response: 422,
        description: 'Validation error',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'message', type: 'string', example: 'The email has already been taken'),
                new OA\Property(property: 'errors', type: 'object')
            ]
        )
    )]
    public function update(Request $request, $id): JsonResponse
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully',
            'data' => $user->load('roles'),
        ]);
    }

    /**
     * Remove the specified user.
     *
     * @param int $id
     * @return JsonResponse
     */
    #[OA\Delete(
        path: '/api/v1/users/{id}',
        summary: 'Delete a user',
        description: 'Deletes a user',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        required: true,
        description: 'The user ID',
        schema: new OA\Schema(type: 'integer')
    )]
    #[OA\Response(
        response: 200,
        description: 'User deleted successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'message', type: 'string', example: 'User deleted successfully')
            ]
        )
    )]
    #[OA\Response(
        response: 422,
        description: 'Cannot delete your own account',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'error'),
                new OA\Property(property: 'message', type: 'string', example: 'Cannot delete your own account')
            ]
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'User not found'
    )]
    public function destroy($id): JsonResponse
    {
        $user = User::findOrFail($id);
        
        // Don't allow deletion of the user making the request
        if (auth()->id() == $id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot delete your own account',
            ], 422);
        }
        
        $user->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully',
        ]);
    }
} 