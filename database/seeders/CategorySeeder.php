<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Modules\Content\app\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting Category Seeder...');

        // Check if the categories table exists
        if (!Schema::hasTable('categories')) {
            $this->command->info('Skipping CategorySeeder: Categories table does not exist.');
            return;
        }

        $categories = [
            [
                'title' => 'Technology',
                'slug' => 'technology',
                'description' => 'Latest technology news, trends and innovations',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Web Development',
                'slug' => 'web-development',
                'description' => 'Web development technologies, frameworks and best practices',
                'parent_id' => 1, // Technology
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Mobile Development',
                'slug' => 'mobile-development',
                'description' => 'Mobile app development for iOS and Android platforms',
                'parent_id' => 1, // Technology
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Business',
                'slug' => 'business',
                'description' => 'Business strategies, entrepreneurship and management',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Marketing',
                'slug' => 'marketing',
                'description' => 'Digital marketing strategies and techniques',
                'parent_id' => 4, // Business
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Finance',
                'slug' => 'finance',
                'description' => 'Financial advice, investing and money management',
                'parent_id' => 4, // Business
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Lifestyle',
                'slug' => 'lifestyle',
                'description' => 'Health, wellness, travel and personal development',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Health & Fitness',
                'slug' => 'health-fitness',
                'description' => 'Health tips, fitness routines and wellness advice',
                'parent_id' => 7, // Lifestyle
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Travel',
                'slug' => 'travel',
                'description' => 'Travel destinations, tips and experiences',
                'parent_id' => 7, // Lifestyle
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Education',
                'slug' => 'education',
                'description' => 'Learning resources, educational technology and academic advice',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($categories as $category) {
            try {
                Category::firstOrCreate(['slug' => $category['slug']], $category);
                $this->command->info("Created or updated category: {$category['title']}");
            } catch (\Exception $e) {
                $this->command->error("Error creating category {$category['title']}: " . $e->getMessage());
            }
        }

        $this->command->info('Categories seeded successfully!');
    }
} 