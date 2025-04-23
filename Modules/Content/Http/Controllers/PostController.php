<?php

namespace Modules\Content\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Content\Models\Post;
use Modules\Content\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of posts.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Post::query();
        
        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by category
        if ($request->has('category_id')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id', $request->category_id);
            });
        }
        
        // Filter by author
        if ($request->has('author_id')) {
            $query->where('user_id', $request->author_id);
        }
        
        // Filter by published status
        if ($request->has('published')) {
            if ($request->published) {
                $query->published();
            } else {
                $query->draft();
            }
        }
        
        // Search by title or content
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                  ->orWhere('content', 'like', '%'.$request->search.'%');
            });
        }
        
        // Date range filter
        if ($request->has('from_date')) {
            $query->whereDate('published_at', '>=', $request->from_date);
        }
        
        if ($request->has('to_date')) {
            $query->whereDate('published_at', '<=', $request->to_date);
        }
        
        $posts = $query->with(['author', 'categories'])
            ->orderBy($request->input('order_by', 'published_at'), $request->input('order', 'desc'))
            ->paginate($request->input('per_page', 15));
        
        return response()->json([
            'status' => 'success',
            'data' => $posts
        ]);
    }

    /**
     * Store a newly created post.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'featured_image' => 'nullable|string'
        ]);

        DB::beginTransaction();
        
        try {
            $post = Post::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'excerpt' => $request->excerpt ?? Str::limit(strip_tags($request->content), 160),
                'status' => $request->status,
                'published_at' => $request->status == 'published' ? ($request->published_at ?? now()) : null,
                'user_id' => Auth::id(),
                'featured_image' => $request->featured_image
            ]);
            
            // Attach categories
            if ($request->has('categories') && is_array($request->categories)) {
                $post->categories()->attach($request->categories);
            }
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Post created successfully',
                'data' => $post->load(['author', 'categories'])
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create post: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified post.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $post = Post::with(['author', 'categories'])->findOrFail($id);
        
        return response()->json([
            'status' => 'success',
            'data' => $post
        ]);
    }

    /**
     * Update the specified post.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $post = Post::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'featured_image' => 'nullable|string'
        ]);

        DB::beginTransaction();
        
        try {
            $post->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'excerpt' => $request->excerpt ?? $post->excerpt,
                'status' => $request->status,
                'published_at' => $request->status == 'published' ? ($request->published_at ?? $post->published_at ?? now()) : null,
                'featured_image' => $request->featured_image
            ]);
            
            // Sync categories if provided
            if ($request->has('categories')) {
                $post->categories()->sync($request->categories);
            }
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Post updated successfully',
                'data' => $post->fresh()->load(['author', 'categories'])
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update post: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified post.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $post = Post::findOrFail($id);
        
        DB::beginTransaction();
        
        try {
            // Detach all categories
            $post->categories()->detach();
            
            // Delete the post
            $post->delete();
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Post deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete post: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Display a post by its slug.
     *
     * @param string $slug
     * @return JsonResponse
     */
    public function bySlug($slug): JsonResponse
    {
        $post = Post::where('slug', $slug)
            ->with(['author', 'categories'])
            ->firstOrFail();
        
        return response()->json([
            'status' => 'success',
            'data' => $post
        ]);
    }
    
    /**
     * Return related posts based on categories.
     *
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function related($id, Request $request): JsonResponse
    {
        $post = Post::findOrFail($id);
        
        $limit = $request->input('limit', 5);
        
        // Get category ids of the current post
        $categoryIds = $post->categories->pluck('id')->toArray();
        
        // Find posts with similar categories, excluding current post
        $relatedPosts = Post::where('id', '!=', $post->id)
            ->whereHas('categories', function($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            })
            ->published()
            ->with(['author', 'categories'])
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $relatedPosts
        ]);
    }
} 