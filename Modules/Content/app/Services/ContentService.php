<?php

namespace Modules\Content\app\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Modules\Content\app\Models\Post;
use Modules\Content\app\Models\Category;
use Modules\Content\app\Models\Tag;
use Modules\Content\app\Models\Seo;

class ContentService
{
    /**
     * Get post statistics
     * 
     * @return array
     */
    public function getPostStats(): array
    {
        return Cache::remember('content_post_stats', 3600, function () {
            $totalPosts = Post::count();
            $publishedPosts = Post::where('status', 'published')->count();
            $draftPosts = Post::where('status', 'draft')->count();
            $mostViewedPost = Post::orderBy('view_count', 'desc')->first();
            
            return [
                'total' => $totalPosts,
                'published' => $publishedPosts,
                'drafts' => $draftPosts,
                'most_viewed' => $mostViewedPost ? [
                    'id' => $mostViewedPost->id,
                    'title' => $mostViewedPost->title,
                    'views' => $mostViewedPost->view_count
                ] : null
            ];
        });
    }
    
    /**
     * Get category statistics
     * 
     * @return array
     */
    public function getCategoryStats(): array
    {
        return Cache::remember('content_category_stats', 3600, function () {
            $totalCategories = Category::count();
            $rootCategories = Category::whereNull('parent_id')->count();
            $categoriesWithChildren = Category::has('children')->count();
            $mostUsedCategory = Category::withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->first();
            
            return [
                'total' => $totalCategories,
                'root' => $rootCategories,
                'with_children' => $categoriesWithChildren,
                'most_used' => $mostUsedCategory ? [
                    'id' => $mostUsedCategory->id,
                    'title' => $mostUsedCategory->title,
                    'posts_count' => $mostUsedCategory->posts_count
                ] : null
            ];
        });
    }
    
    /**
     * Get tag statistics
     * 
     * @return array
     */
    public function getTagStats(): array
    {
        return Cache::remember('content_tag_stats', 3600, function () {
            $totalTags = Tag::count();
            $mostUsedTag = Tag::withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->first();
            
            return [
                'total' => $totalTags,
                'most_used' => $mostUsedTag ? [
                    'id' => $mostUsedTag->id,
                    'name' => $mostUsedTag->name,
                    'posts_count' => $mostUsedTag->posts_count
                ] : null
            ];
        });
    }
    
    /**
     * Increment view count for a post
     * 
     * @param int $postId
     * @return bool
     */
    public function incrementPostViews(int $postId): bool
    {
        $post = Post::find($postId);
        
        if (!$post) {
            return false;
        }
        
        $post->increment('view_count');
        
        return true;
    }
    
    /**
     * Clear content cache
     * 
     * @return void
     */
    public function clearContentCache(): void
    {
        Cache::forget('content_post_stats');
        Cache::forget('content_category_stats');
        Cache::forget('content_tag_stats');
    }
    
    /**
     * Create or update SEO metadata for a content entity
     * 
     * @param string $type
     * @param int $contentId
     * @param array $data
     * @return Seo
     */
    public function updateSeoMetadata(string $type, int $contentId, array $data): Seo
    {
        $seo = Seo::firstOrNew([
            'seoable_type' => $type,
            'seoable_id' => $contentId
        ]);
        
        $seo->fill($data);
        $seo->save();
        
        return $seo;
    }
    
    /**
     * Generate a unique slug for a post or category
     * 
     * @param string $title
     * @param string $model
     * @param int|null $excludeId
     * @return string
     */
    public function generateUniqueSlug(string $title, string $model, ?int $excludeId = null): string
    {
        $slug = \Str::slug($title);
        $originalSlug = $slug;
        $count = 0;
        
        // Check if model is valid
        if (!in_array($model, ['Post', 'Category'])) {
            throw new \InvalidArgumentException('Invalid model specified');
        }
        
        // Get the full model class name
        $modelClass = "Modules\\Content\\app\\Models\\{$model}";
        
        // Build query
        $query = $modelClass::where('slug', $slug);
        
        // Exclude the current entity if ID is provided
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        
        // Check if slug exists
        while ($query->exists()) {
            $count++;
            $slug = $originalSlug . '-' . $count;
            $query = $modelClass::where('slug', $slug);
            
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }
        
        return $slug;
    }
} 