<?php

namespace Modules\Auth\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Auth\Models\User;

class AuthService
{
    /**
     * Register a new user
     * 
     * @param array $data
     * @return User
     */
    public function register(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'referral_code' => $data['referral_code'] ?? null,
        ]);

        // Assign default role
        $user->assignRole(config('auth.default_role', 'user'));

        return $user;
    }

    /**
     * Generate a token for the user
     * 
     * @param User $user
     * @param string $tokenName
     * @return string
     */
    public function createToken(User $user, string $tokenName = 'auth_token'): string
    {
        // Delete existing tokens
        $user->tokens()->delete();

        // Create new token
        return $user->createToken($tokenName)->plainTextToken;
    }

    /**
     * Generate a unique referral code
     * 
     * @return string
     */
    public function generateReferralCode(): string
    {
        $codeLength = config('auth.referral.code_length', 12);
        $characters = config('auth.referral.code_characters', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        
        do {
            $code = '';
            for ($i = 0; $i < $codeLength; $i++) {
                $code .= $characters[rand(0, strlen($characters) - 1)];
            }
            
            // Check if code already exists
            $exists = User::where('referral_code', $code)->exists();
        } while ($exists);
        
        return $code;
    }

    /**
     * Check if a user has a specific role
     * 
     * @param User $user
     * @param string|array $roles
     * @return bool
     */
    public function hasRole(User $user, $roles): bool
    {
        return $user->hasRole($roles);
    }
} 