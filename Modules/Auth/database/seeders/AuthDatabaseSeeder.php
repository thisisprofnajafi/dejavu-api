<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Models\User;
use Spatie\Permission\Models\Role;

class AuthDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createRoles();
        $this->createUsers();
    }

    /**
     * Create initial roles
     */
    private function createRoles(): void
    {
        // Create roles if they don't exist
        $roles = ['admin', 'author', 'visitor', 'user', 'customer'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }
    }

    /**
     * Create initial users
     */
    private function createUsers(): void
    {
        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('Admin@123'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');

        // Create author user
        $author = User::firstOrCreate(
            ['email' => 'author@example.com'],
            [
                'name' => 'Author User',
                'password' => Hash::make('Author@123'),
                'email_verified_at' => now(),
            ]
        );
        $author->assignRole('author');

        // Create visitor user
        $visitor = User::firstOrCreate(
            ['email' => 'visitor@example.com'],
            [
                'name' => 'Visitor User',
                'password' => Hash::make('Visitor@123'),
                'email_verified_at' => now(),
                'referral_code' => $this->generateReferralCode(),
            ]
        );
        $visitor->assignRole('visitor');
    }

    /**
     * Generate a random referral code
     */
    private function generateReferralCode(): string
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $code = '';
        
        for ($i = 0; $i < 12; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        return $code;
    }
}
