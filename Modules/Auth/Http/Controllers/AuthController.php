<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    /**
     * Register a new user
     * 
     * @param Request $request
     * @return JsonResponse
     */
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