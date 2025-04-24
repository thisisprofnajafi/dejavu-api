<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get roles
        $adminRole = Role::where('name', 'admin')->first();
        $authorRole = Role::where('name', 'author')->first();
        $visitorRole = Role::where('name', 'visitor')->first();

        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'status' => 'active'
            ]
        );
        $admin->assignRole($adminRole);

        // Create author user
        $author = User::firstOrCreate(
            ['email' => 'author@example.com'],
            [
                'name' => 'Author User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'status' => 'active'
            ]
        );
        $author->assignRole($authorRole);

        // Create visitor user
        $visitor = User::firstOrCreate(
            ['email' => 'visitor@example.com'],
            [
                'name' => 'Visitor User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'status' => 'active'
            ]
        );
        $visitor->assignRole($visitorRole);
    }
} 