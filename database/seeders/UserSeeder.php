<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
        // Create Admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('Admin@123'),
            'email_verified_at' => now(),
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);
        $admin->assignRole('admin');
        
        // Create statistics for admin
        UserStatistic::create([
            'user_id' => $admin->id,
            'login_count' => 1,
            'last_login_at' => now(),
        ]);

        // Create Author user
        $author = User::create([
            'name' => 'Author User',
            'email' => 'author@example.com',
            'password' => Hash::make('Author@123'),
            'email_verified_at' => now(),
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);
        $author->assignRole('author');
        
        // Create author profile
        Author::create([
            'user_id' => $author->id,
            'bio' => 'Professional content creator with expertise in digital marketing and SEO optimization.',
            'website' => 'https://author-example.com',
            'social_media' => json_encode([
                'twitter' => 'https://twitter.com/authorexample',
                'linkedin' => 'https://linkedin.com/in/authorexample',
            ]),
            'status' => 'active',
        ]);
        
        // Create statistics for author
        UserStatistic::create([
            'user_id' => $author->id,
            'login_count' => 1,
            'last_login_at' => now(),
        ]);

        // Create Visitor user
        $visitor = User::create([
            'name' => 'Visitor User',
            'email' => 'visitor@example.com',
            'password' => Hash::make('Visitor@123'),
            'email_verified_at' => now(),
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);
        $visitor->assignRole('visitor');
        
        // Create visitor profile
        Visitor::create([
            'ip_address' => fake()->ipv4(),
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            'country' => 'US',
            'city' => 'New York',
            'browser' => 'Chrome',
            'os' => 'Windows',
            'device_type' => 'desktop',
            'utm_source' => 'direct',
            'is_unique' => true,
            'last_activity_at' => now(),
        ]);
        
        // Create statistics for visitor
        UserStatistic::create([
            'user_id' => $visitor->id,
            'login_count' => 1,
            'last_login_at' => now(),
        ]);
        
        // Create additional users with 'user' role for testing
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name' => "Test User {$i}",
                'email' => "user{$i}@example.com",
                'password' => Hash::make('Password@123'),
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]);
            $user->assignRole('user');
            
            // Create statistics for test users
            UserStatistic::create([
                'user_id' => $user->id,
                'login_count' => rand(1, 10),
                'last_login_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
} 