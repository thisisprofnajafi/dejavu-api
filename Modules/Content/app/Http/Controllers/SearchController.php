<?php

namespace Modules\Content\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Content\app\Models\Post;
use Modules\Content\app\Models\Category;
use Modules\Content\app\Models\Tag;

class SearchController extends Controller
{
    /**
     * Search across all content types
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:2|max:255',
            'type' => 'nullable|string|in:all,posts,categories,tags',
            'limit' => 'nullable|integer|min:1|max:50',
        ]);
        
        $query = $request->input('query');
        $type = $request->input('type', 'all');
        $limit = $request->input('limit', 10);
        
        // Initialize response data array
        $data = [];
        
        // Search posts if type is 'all' or 'posts'
        if ($type === 'all' || $type === 'posts') {
            $posts = Post::where('status', 'published')
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('content', 'like', "%{$query}%")
                      ->orWhere('excerpt', 'like', "%{$query}%");
                })
                ->with(['category', 'tags'])
                ->limit($limit)
                ->get();
            
            $data['posts'] = $posts;
        }
        
        // Search categories if type is 'all' or 'categories'
        if ($type === 'all' || $type === 'categories') {
            $categories = Category::where('title', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->limit($limit)
                ->get();
            
            $data['categories'] = $categories;
        }
        
        // Search tags if type is 'all' or 'tags'
        if ($type === 'all' || $type === 'tags') {
            $tags = Tag::where('name', 'like', "%{$query}%")
                ->limit($limit)
                ->get();
            
            $data['tags'] = $tags;
        }
        
        return response()->json([
            'success' => true,
            'query' => $query,
            'data' => $data
        ]);
    }
    
    /**
     * Get popular content
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function popular(Request $request)
    {
        $limit = $request->input('limit', 5);
        
        // Get most viewed posts
        $posts = Post::where('status', 'published')
            ->orderBy('view_count', 'desc')
            ->limit($limit)
            ->with(['category', 'tags'])
            ->get();
        
        // Get most used categories
        $categories = Category::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->limit($limit)
            ->get();
        
        // Get most used tags
        $tags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->limit($limit)
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => [
                'posts' => $posts,
                'categories' => $categories,
                'tags' => $tags
            ]
        ]);
    }
    
    /**
     * Get related content based on a post
     * 
     * @param Request $request
     * @param int $postId
     * @return \Illuminate\Http\Response
     */
    public function related(Request $request, $postId)
    {
        $limit = $request->input('limit', 4);
        
        $post = Post::findOrFail($postId);
        
        // Get related posts based on same category and tags
        $relatedPosts = Post::where('id', '!=', $postId)
            ->where('status', 'published')
            ->where(function ($query) use ($post) {
                // Same category
                $query->where('category_id', $post->category_id);
                
                // Or has same tags
                if ($post->tags->isNotEmpty()) {
                    $tagIds = $post->tags->pluck('id')->toArray();
                    $query->orWhereHas('tags', function ($q) use ($tagIds) {
                        $q->whereIn('tags.id', $tagIds);
                    });
                }
            })
            ->with(['category', 'tags'])
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $relatedPosts
        ]);
    }
} 