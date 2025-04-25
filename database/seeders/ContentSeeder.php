<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting Content Seeder...');

        // Check if the tables exist before trying to seed
        if (!Schema::hasTable('tags') || !Schema::hasTable('posts') || !Schema::hasTable('categories')) {
            $this->command->info('Skipping ContentSeeder: Required tables do not exist.');
            return;
        }

        // First, check the actual columns in the posts table
        $postsColumns = Schema::getColumnListing('posts');
        $this->command->info('Available columns in posts table: ' . implode(', ', $postsColumns));

        // Create tags
        $this->seedTags();

        // Create posts if we have necessary data
        $this->seedPosts($postsColumns);
        
        $this->command->info('Content seeded successfully!');
    }

    /**
     * Seed tags data
     */
    private function seedTags()
    {
        // Create tags
        $tags = [
            ['name' => 'لاراول', 'slug' => 'laravel'],
            ['name' => 'پی‌اچ‌پی', 'slug' => 'php'],
            ['name' => 'جاوااسکریپت', 'slug' => 'javascript'],
            ['name' => 'ویو جی‌اس', 'slug' => 'vuejs'],
            ['name' => 'ری‌اکت', 'slug' => 'react'],
        ];

        // Use DB facade instead of model directly
        foreach ($tags as $tag) {
            $data = $tag;
            if (!array_key_exists('created_at', $data)) {
                $data['created_at'] = now();
            }
            if (!array_key_exists('updated_at', $data)) {
                $data['updated_at'] = now();
            }
            
            DB::table('tags')->updateOrInsert(
                ['slug' => $tag['slug']], 
                $data
            );
        }
        
        $this->command->info('Tags seeded successfully.');
    }

    /**
     * Seed posts data
     */
    private function seedPosts($postsColumns)
    {
        // Get admin and author users
        $admin = User::where('email', 'admin@example.com')->first();
        $author = User::where('email', 'author@example.com')->first();
        
        if (!$admin && !$author) {
            $this->command->info('Skipping post creation: No admin or author user found.');
            return;
        }

        $userId = $admin ? $admin->id : ($author ? $author->id : null);
        if (!$userId) {
            $this->command->info('Skipping post creation: No valid user ID found.');
            return;
        }

        // Get categories
        $categories = DB::table('categories')->get();
        if ($categories->isEmpty()) {
            $this->command->info('Skipping post creation: No categories found.');
            return;
        }

        // Get tags
        $tags = DB::table('tags')->get();
        
        // Create basic post data with only columns that exist in the table
        for ($i = 1; $i <= 3; $i++) {
            $category = $categories->random();
            
            // Create base post data
            $post = [
                'title' => "پست نمونه #{$i}: " . fake()->sentence(6),
                'slug' => "sample-post-{$i}-" . now()->timestamp,
                'content' => $this->generateSampleContent(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
            // Add user_id if column exists
            if (in_array('user_id', $postsColumns)) {
                $post['user_id'] = $userId;
            }
            
            // Add category_id if column exists
            if (in_array('category_id', $postsColumns)) {
                $post['category_id'] = $category->id;
            }
            
            // Add status if column exists
            if (in_array('status', $postsColumns)) {
                $post['status'] = 'published';
            }
            
            try {
                // Insert post
                $postId = DB::table('posts')->insertGetId($post);
                $this->command->info("Created post #{$i} with ID: {$postId}");
                
                // Add post-tag relationships if the post_tag table exists
                if (Schema::hasTable('post_tag') && !$tags->isEmpty()) {
                    $tagCount = min(2, $tags->count());
                    $randomTags = $tags->random($tagCount);
                    
                    foreach ($randomTags as $tag) {
                        DB::table('post_tag')->insert([
                            'post_id' => $postId,
                            'tag_id' => $tag->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                    
                    $this->command->info("Added tags to post #{$i}");
                }
            } catch (\Exception $e) {
                $this->command->error("Error creating post #{$i}: " . $e->getMessage());
            }
        }
    }
    
    /**
     * Generate sample content for posts
     */
    private function generateSampleContent(): string
    {
        $paragraphs = fake()->paragraphs(2);
        $content = "";
        
        // Add a heading at the beginning
        $content .= "# " . fake()->sentence() . "\n\n";
        
        // Add paragraphs with some formatting
        foreach ($paragraphs as $paragraph) {
            $content .= $paragraph . "\n\n";
        }
        
        // Add a quote
        $content .= "> " . fake()->sentence() . "\n\n";
        
        return $content;
    }
} 