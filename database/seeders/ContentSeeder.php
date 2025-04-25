<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Content\app\Models\Post;
use Modules\Content\app\Models\Tag;
use Modules\Content\app\Models\Category;
use App\Models\User;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create tags
        $tags = [
            ['name' => 'Laravel', 'slug' => 'laravel'],
            ['name' => 'PHP', 'slug' => 'php'],
            ['name' => 'JavaScript', 'slug' => 'javascript'],
            ['name' => 'Vue.js', 'slug' => 'vuejs'],
            ['name' => 'React', 'slug' => 'react'],
            ['name' => 'HTML', 'slug' => 'html'],
            ['name' => 'CSS', 'slug' => 'css'],
            ['name' => 'API', 'slug' => 'api'],
            ['name' => 'Database', 'slug' => 'database'],
            ['name' => 'MySQL', 'slug' => 'mysql'],
            ['name' => 'Security', 'slug' => 'security'],
            ['name' => 'Performance', 'slug' => 'performance'],
            ['name' => 'Mobile', 'slug' => 'mobile'],
            ['name' => 'iOS', 'slug' => 'ios'],
            ['name' => 'Android', 'slug' => 'android'],
            ['name' => 'Career', 'slug' => 'career'],
            ['name' => 'Productivity', 'slug' => 'productivity'],
            ['name' => 'Marketing', 'slug' => 'marketing'],
            ['name' => 'SEO', 'slug' => 'seo'],
            ['name' => 'Analytics', 'slug' => 'analytics'],
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(['slug' => $tag['slug']], $tag);
        }

        // Get sample data for posts
        $admin = User::where('email', 'admin@example.com')->first();
        $author = User::where('email', 'author@example.com')->first();
        $categories = Category::all();
        $tags = Tag::all();
        $statuses = ['published', 'draft', 'scheduled'];

        // Create sample posts
        for ($i = 1; $i <= 20; $i++) {
            $user = rand(0, 1) === 0 ? $admin : $author;
            $category = $categories->random();
            $status = $statuses[array_rand($statuses)];
            $publishDate = $status === 'scheduled' ? now()->addDays(rand(1, 10)) : now()->subDays(rand(1, 30));
            
            $post = Post::create([
                'title' => "Sample Post #{$i}: " . fake()->sentence(),
                'slug' => "sample-post-{$i}-" . fake()->slug(3),
                'content' => $this->generateSampleContent(),
                'excerpt' => fake()->paragraph(),
                'featured_image' => "https://picsum.photos/id/" . rand(1, 1000) . "/800/600",
                'user_id' => $user->id,
                'category_id' => $category->id,
                'status' => $status,
                'published_at' => $publishDate,
                'created_at' => $publishDate->subDays(rand(1, 5)),
                'updated_at' => $publishDate->subDays(rand(0, 2)),
                'views' => rand(0, 1000),
                'likes' => rand(0, 200),
                'is_featured' => rand(0, 5) === 0, // 1 in 5 chance to be featured
            ]);
            
            // Attach random tags (between 2 and 5 tags)
            $randomTags = $tags->random(rand(2, 5));
            $post->tags()->attach($randomTags->pluck('id')->toArray());
        }
    }
    
    /**
     * Generate sample content for posts
     */
    private function generateSampleContent(): string
    {
        $paragraphs = fake()->paragraphs(rand(5, 10));
        $content = "";
        
        // Add a heading at the beginning
        $content .= "# " . fake()->sentence() . "\n\n";
        
        // Add paragraphs with some formatting
        foreach ($paragraphs as $index => $paragraph) {
            $content .= $paragraph . "\n\n";
            
            // Add a subheading after every 2-3 paragraphs
            if (($index + 1) % rand(2, 3) === 0) {
                $content .= "## " . fake()->sentence() . "\n\n";
            }
            
            // Add a list or a code block occasionally
            if (($index + 1) % 3 === 0) {
                if (rand(0, 1) === 0) {
                    // Add a list
                    $content .= "- " . fake()->sentence() . "\n";
                    $content .= "- " . fake()->sentence() . "\n";
                    $content .= "- " . fake()->sentence() . "\n\n";
                } else {
                    // Add a code block
                    $content .= "```php\n";
                    $content .= "function example() {\n";
                    $content .= "    return 'This is a sample code block';\n";
                    $content .= "}\n";
                    $content .= "```\n\n";
                }
            }
        }
        
        // Add a quote somewhere in the middle
        $middleIndex = floor(count($paragraphs) / 2);
        $quoteContent = "> " . fake()->sentence() . "\n\n";
        $content = substr_replace($content, $quoteContent, strpos($content, "\n\n", strpos($content, "\n\n") * $middleIndex), 0);
        
        return $content;
    }
} 