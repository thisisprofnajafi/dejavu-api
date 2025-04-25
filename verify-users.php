<?php
/**
 * Verification script for users and roles
 * 
 * This script verifies that the seeders have created the required users
 * with their appropriate roles in the system:
 * - Admin: admin@example.com / Admin@123
 * - Author: author@example.com / Author@123
 * - Visitor: visitor@example.com / Visitor@123
 * 
 * Run with: php verify-users.php
 */

require 'vendor/autoload.php';

// Initialize Laravel application
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Check admin user
$admin = \App\Models\User::where('email', 'admin@example.com')->first();
echo "Admin user exists: " . ($admin ? "Yes\n" : "No\n");
if ($admin) {
    echo "Admin roles: " . implode(', ', $admin->roles->pluck('name')->toArray()) . "\n";
}

// Check author user
$author = \App\Models\User::where('email', 'author@example.com')->first();
echo "Author user exists: " . ($author ? "Yes\n" : "No\n");
if ($author) {
    echo "Author roles: " . implode(', ', $author->roles->pluck('name')->toArray()) . "\n";
}

// Check visitor user
$visitor = \App\Models\User::where('email', 'visitor@example.com')->first();
echo "Visitor user exists: " . ($visitor ? "Yes\n" : "No\n");
if ($visitor) {
    echo "Visitor roles: " . implode(', ', $visitor->roles->pluck('name')->toArray()) . "\n";
}

// Check total users
$userCount = \App\Models\User::count();
echo "Total users: " . $userCount . "\n";

// Check total roles
$roleCount = \Spatie\Permission\Models\Role::count();
echo "Total roles: " . $roleCount . "\n";
echo "Roles: " . implode(', ', \Spatie\Permission\Models\Role::pluck('name')->toArray()) . "\n"; 