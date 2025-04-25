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
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'کاربر مدیر',
                'password' => Hash::make('Admin@123'),
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]
        );
        $admin->assignRole('admin');
        
        // Create statistics for admin if not exists
        UserStatistic::firstOrCreate(
            ['user_id' => $admin->id],
            [
                'login_count' => 1,
                'last_login_at' => now(),
            ]
        );

        // Create Author user
        $author = User::firstOrCreate(
            ['email' => 'author@example.com'],
            [
                'name' => 'کاربر نویسنده',
                'password' => Hash::make('Author@123'),
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]
        );
        $author->assignRole('author');
        
        // Create author profile if not exists
        Author::firstOrCreate(
            ['user_id' => $author->id],
            [
                'bio' => 'تولید کننده محتوای حرفه‌ای با تخصص در بازاریابی دیجیتال و بهینه‌سازی سئو.',
                'website' => 'https://author-example.com',
                'social_media' => json_encode([
                    'twitter' => 'https://twitter.com/authorexample',
                    'linkedin' => 'https://linkedin.com/in/authorexample',
                ]),
                'status' => 'active',
            ]
        );
        
        // Create statistics for author if not exists
        UserStatistic::firstOrCreate(
            ['user_id' => $author->id],
            [
                'login_count' => 1,
                'last_login_at' => now(),
            ]
        );

        // Create Visitor user
        $visitor = User::firstOrCreate(
            ['email' => 'visitor@example.com'],
            [
                'name' => 'کاربر بازدیدکننده',
                'password' => Hash::make('Visitor@123'),
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]
        );
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
            $user = User::firstOrCreate(
                ['email' => "user{$i}@example.com"],
                [
                    'name' => "کاربر آزمایشی {$i}",
                    'password' => Hash::make('Password@123'),
                    'email_verified_at' => now(),
                    'remember_token' => \Illuminate\Support\Str::random(10),
                ]
            );
            $user->assignRole('user');
            
            // Create statistics for test users if not exists
            UserStatistic::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'login_count' => rand(1, 10),
                    'last_login_at' => now()->subDays(rand(1, 30)),
                ]
            );
        }
    }
} 