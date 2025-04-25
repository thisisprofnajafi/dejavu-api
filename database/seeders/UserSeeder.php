<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Modules\User\Models\UserStatistic;
use Modules\Author\Models\Author;
use Modules\Visitor\Models\Visitor;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting User Seeder...');

        // Check if the users table exists before trying to seed
        if (!Schema::hasTable('users')) {
            $this->command->info('Skipping UserSeeder: Users table does not exist.');
            return;
        }

        // Get column listing from users table
        $userColumns = Schema::getColumnListing('users');
        $this->command->info('Available columns in users table: ' . implode(', ', $userColumns));

        // Create admin user
        $this->createAdminUser($userColumns);
        
        // Create author user
        $this->createAuthorUser($userColumns);
        
        // Create visitor user
        $this->createVisitorUser($userColumns);
        
        $this->command->info('User data seeded successfully!');
    }
    
    /**
     * Create admin user
     */
    private function createAdminUser($columns)
    {
        // Base admin data
        $admin = [
            'name' => 'مدیر سایت',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        // Add additional fields if they exist
        if (in_array('is_admin', $columns)) {
            $admin['is_admin'] = true;
        }
        
        if (in_array('role', $columns)) {
            $admin['role'] = 'admin';
        }
        
        if (in_array('username', $columns)) {
            $admin['username'] = 'admin';
        }
        
        if (in_array('status', $columns)) {
            $admin['status'] = 'active';
        }
        
        if (in_array('email_verified_at', $columns)) {
            $admin['email_verified_at'] = now();
        }
        
        try {
            // Insert or update admin user
            DB::table('users')->updateOrInsert(
                ['email' => $admin['email']],
                $admin
            );
            $this->command->info('Admin user created or updated successfully.');
        } catch (\Exception $e) {
            $this->command->error('Error creating admin user: ' . $e->getMessage());
        }
    }
    
    /**
     * Create author user
     */
    private function createAuthorUser($columns)
    {
        // Base author data
        $author = [
            'name' => 'نویسنده',
            'email' => 'author@example.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        // Add additional fields if they exist
        if (in_array('is_admin', $columns)) {
            $author['is_admin'] = false;
        }
        
        if (in_array('role', $columns)) {
            $author['role'] = 'author';
        }
        
        if (in_array('username', $columns)) {
            $author['username'] = 'author';
        }
        
        if (in_array('status', $columns)) {
            $author['status'] = 'active';
        }
        
        if (in_array('email_verified_at', $columns)) {
            $author['email_verified_at'] = now();
        }
        
        try {
            // Insert or update author user
            DB::table('users')->updateOrInsert(
                ['email' => $author['email']],
                $author
            );
            $this->command->info('Author user created or updated successfully.');
        } catch (\Exception $e) {
            $this->command->error('Error creating author user: ' . $e->getMessage());
        }
    }
    
    /**
     * Create visitor user
     */
    private function createVisitorUser($columns)
    {
        // Base visitor data
        $visitor = [
            'name' => 'بازدیدکننده',
            'email' => 'visitor@example.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        // Add additional fields if they exist
        if (in_array('is_admin', $columns)) {
            $visitor['is_admin'] = false;
        }
        
        if (in_array('role', $columns)) {
            $visitor['role'] = 'visitor';
        }
        
        if (in_array('username', $columns)) {
            $visitor['username'] = 'visitor';
        }
        
        if (in_array('status', $columns)) {
            $visitor['status'] = 'active';
        }
        
        if (in_array('email_verified_at', $columns)) {
            $visitor['email_verified_at'] = now();
        }
        
        try {
            // Insert or update visitor user
            DB::table('users')->updateOrInsert(
                ['email' => $visitor['email']],
                $visitor
            );
            $this->command->info('Visitor user created or updated successfully.');
        } catch (\Exception $e) {
            $this->command->error('Error creating visitor user: ' . $e->getMessage());
        }
    }
} 