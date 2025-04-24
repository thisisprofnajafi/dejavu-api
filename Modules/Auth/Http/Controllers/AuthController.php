<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Module Auth', description: 'API endpoints for authentication in modules')]
class AuthController extends Controller
{
    /**
     * Register a new user
     * 
     * @param Request $request
     * @return JsonResponse
     */
    #[OA\Post(
        path: '/api/v1/auth/register',
        summary: 'Register a new user',
        description: 'Creates a new user account and returns an authentication token'
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'John Doe'),
                new OA\Property(property: 'email', type: 'string', format: 'email', example: 'user@example.com'),
                new OA\Property(property: 'password', type: 'string', format: 'password', example: 'Password123!'),
                new OA\Property(property: 'password_confirmation', type: 'string', format: 'password', example: 'Password123!')
            ]
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'User registered successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'message', type: 'string', example: 'User registered successfully'),
                new OA\Property(property: 'user', type: 'object'),
                new OA\Property(property: 'token', type: 'string', example: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUz...')
            ]
        )
    )]
    #[OA\Response(
        response: 422,
        description: 'Validation error',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'message', type: 'string', example: 'The email has already been taken.'),
                new OA\Property(property: 'errors', type: 'object')
            ]
        )
    )]
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign default role
        $role = Role::firstOrCreate(['name' => 'visitor']);
        $user->assignRole($role);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
        ]);
    }

    /**
     * Login a user
     * 
     * @param Request $request
     * @return JsonResponse
     */
    #[OA\Post(
        path: '/api/v1/auth/login',
        summary: 'Login a user',
        description: 'Authenticates a user and returns a token'
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'email', type: 'string', format: 'email', example: 'user@example.com'),
                new OA\Property(property: 'password', type: 'string', format: 'password', example: 'Password123!')
            ]
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Login successful',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'message', type: 'string', example: 'User logged in successfully'),
                new OA\Property(property: 'user', type: 'object'),
                new OA\Property(property: 'token', type: 'string', example: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUz...')
            ]
        )
    )]
    #[OA\Response(
        response: 401,
        description: 'Invalid credentials',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'error'),
                new OA\Property(property: 'message', type: 'string', example: 'Invalid login credentials')
            ]
        )
    )]
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid login credentials',
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'User logged in successfully',
            'user' => $user,
            'token' => $token,
        ]);
    }

    /**
     * Logout a user
     * 
     * @param Request $request
     * @return JsonResponse
     */
    #[OA\Post(
        path: '/api/v1/auth/logout',
        summary: 'Logout a user',
        description: 'Revokes the current user\'s access token',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Response(
        response: 200,
        description: 'Logout successful',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'message', type: 'string', example: 'User logged out successfully')
            ]
        )
    )]
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User logged out successfully',
        ]);
    }

    /**
     * Get user profile
     * 
     * @param Request $request
     * @return JsonResponse
     */
    #[OA\Get(
        path: '/api/v1/auth/profile',
        summary: 'Get user profile',
        description: 'Returns the authenticated user\'s profile with roles and permissions',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Response(
        response: 200,
        description: 'User profile retrieved successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'user', type: 'object'),
                new OA\Property(property: 'roles', type: 'array', items: new OA\Items(type: 'object')),
                new OA\Property(property: 'permissions', type: 'array', items: new OA\Items(type: 'object'))
            ]
        )
    )]
    public function profile(Request $request): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'user' => $request->user(),
            'roles' => $request->user()->roles,
            'permissions' => $request->user()->getAllPermissions(),
        ]);
    }
} 