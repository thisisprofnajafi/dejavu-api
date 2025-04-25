<?php

return [
    'name' => 'Auth',
    
    /*
    |--------------------------------------------------------------------------
    | Authentication Settings
    |--------------------------------------------------------------------------
    */
    'auth' => [
        // Token expiration in minutes
        'token_expiration' => env('AUTH_TOKEN_EXPIRATION', 60 * 24 * 7), // 1 week
        
        // Password reset token expiration in minutes
        'password_reset_expiration' => env('AUTH_PASSWORD_RESET_EXPIRATION', 60), // 1 hour
        
        // Default user role
        'default_role' => 'user',
        
        // Enable email verification
        'email_verification_enabled' => env('AUTH_EMAIL_VERIFICATION', false),
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Referral Code Settings
    |--------------------------------------------------------------------------
    */
    'referral' => [
        // Length of the referral code
        'code_length' => env('REFERRAL_CODE_LENGTH', 12),
        
        // Characters to use in referral code
        'code_characters' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789',
    ],
];
