<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return JsonResponse
     */
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