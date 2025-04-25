<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Content\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Latest technology news, trends and innovations',
                'parent_id' => null,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'description' => 'Web development technologies, frameworks and best practices',
                'parent_id' => 1, // Technology
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mobile Development',
                'slug' => 'mobile-development',
                'description' => 'Mobile app development for iOS and Android platforms',
                'parent_id' => 1, // Technology
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Business strategies, entrepreneurship and management',
                'parent_id' => null,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Marketing',
                'slug' => 'marketing',
                'description' => 'Digital marketing strategies and techniques',
                'parent_id' => 4, // Business
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Finance',
                'slug' => 'finance',
                'description' => 'Financial advice, investing and money management',
                'parent_id' => 4, // Business
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'description' => 'Health, wellness, travel and personal development',
                'parent_id' => null,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Health & Fitness',
                'slug' => 'health-fitness',
                'description' => 'Health tips, fitness routines and wellness advice',
                'parent_id' => 7, // Lifestyle
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Travel',
                'slug' => 'travel',
                'description' => 'Travel destinations, tips and experiences',
                'parent_id' => 7, // Lifestyle
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Education',
                'slug' => 'education',
                'description' => 'Learning resources, educational technology and academic advice',
                'parent_id' => null,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
} 