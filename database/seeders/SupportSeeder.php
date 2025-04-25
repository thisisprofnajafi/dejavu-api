<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class SupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting Support Seeder...');

        // Check if the categories table exists before trying to seed
        if (!Schema::hasTable('categories')) {
            $this->command->info('Skipping SupportSeeder: Categories table does not exist.');
            return;
        }

        // Get column listing from categories table
        $categoryColumns = Schema::getColumnListing('categories');
        $this->command->info('Available columns in categories table: ' . implode(', ', $categoryColumns));

        // Seed categories
        $this->seedCategories($categoryColumns);
        
        $this->command->info('Support data seeded successfully!');
    }
    
    /**
     * Seed categories data
     */
    private function seedCategories($columns)
    {
        // Default categories to seed
        $categories = [
            ['name' => 'لاراول', 'slug' => 'laravel'],
            ['name' => 'پی‌اچ‌پی', 'slug' => 'php'],
            ['name' => 'جاوااسکریپت', 'slug' => 'javascript'],
            ['name' => 'وب', 'slug' => 'web'],
            ['name' => 'موبایل', 'slug' => 'mobile'],
        ];

        foreach ($categories as $category) {
            // Base data
            $data = [
                'name' => $category['name'],
                'slug' => $category['slug'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
            // Add description if column exists
            if (in_array('description', $columns)) {
                $data['description'] = 'توضیحات مربوط به دسته ' . $category['name'];
            }
            
            // Add icon if column exists
            if (in_array('icon', $columns)) {
                $data['icon'] = 'default-icon';
            }
            
            // Add status if column exists
            if (in_array('status', $columns)) {
                $data['status'] = 'active';
            }
            
            try {
                // Insert or update category
                DB::table('categories')->updateOrInsert(
                    ['slug' => $category['slug']],
                    $data
                );
                $this->command->info("Created or updated category: {$category['name']}");
            } catch (\Exception $e) {
                $this->command->error("Error creating category {$category['name']}: " . $e->getMessage());
            }
        }
    }
} 