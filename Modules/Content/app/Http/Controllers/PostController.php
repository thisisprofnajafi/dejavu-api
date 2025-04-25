<?php

namespace Modules\Content\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Content\app\Http\Requests\StorePostRequest;
use Modules\Content\app\Http\Requests\UpdatePostRequest;
use Modules\Content\app\Models\Post;
use Modules\Content\app\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', config('content.pagination.per_page', 10));
        $status = $request->input('status');
        $categoryId = $request->input('category_id');
        $search = $request->input('search');
        
        $postsQuery = Post::with(['category', 'tags']);
        
        // Filter by status if provided
        if ($status) {
            $postsQuery->where('status', $status);
        }
        
        // Filter by category if provided
        if ($categoryId) {
            $postsQuery->where('category_id', $categoryId);
        }
        
        // Filter by search term if provided
        if ($search) {
            $postsQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        // If user is not admin, only show their own posts
        if (!Auth::user()->hasRole('admin')) {
            $postsQuery->where('user_id', Auth::id());
        }
        
        $posts = $postsQuery->orderBy('created_at', 'desc')->paginate($perPage);
        
        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Content\app\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        
        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store(
                config('content.storage.posts', 'public/posts')
            );
        }
        
        // Set user ID to current authenticated user
        $data['user_id'] = Auth::id();
        
        // Set published_at date if status is published and no date is provided
        if (($data['status'] ?? '') === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }
        
        // Extract tags if present
        $tags = null;
        if (isset($data['tags'])) {
            $tags = $data['tags'];
            unset($data['tags']);
        }
        
        $post = Post::create($data);
        
        // Attach tags if present
        if ($tags) {
            $post->tags()->sync($tags);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Post created successfully',
            'data' => $post->load(['category', 'tags'])
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Content\app\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // Check if user is authorized to view this post
        if (!Auth::user()->hasRole('admin') && $post->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to view this post'
            ], Response::HTTP_FORBIDDEN);
        }
        
        return response()->json([
            'success' => true,
            'data' => $post->load(['category', 'tags', 'user'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Content\app\Http\Requests\UpdatePostRequest  $request
     * @param  \Modules\Content\app\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        
        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($post->featured_image) {
                Storage::delete($post->featured_image);
            }
            
            $data['featured_image'] = $request->file('featured_image')->store(
                config('content.storage.posts', 'public/posts')
            );
        }
        
        // Set published_at date if status is changed to published and no date is provided
        if (isset($data['status']) && $data['status'] === 'published' && 
            ($post->status !== 'published' || $post->published_at === null) && 
            empty($data['published_at'])) {
            $data['published_at'] = now();
        }
        
        // Extract tags if present
        $tags = null;
        if (isset($data['tags'])) {
            $tags = $data['tags'];
            unset($data['tags']);
        }
        
        $post->update($data);
        
        // Sync tags if present
        if ($tags !== null) {
            $post->tags()->sync($tags);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Post updated successfully',
            'data' => $post->load(['category', 'tags'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Content\app\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Check if user is authorized to delete this post
        if (!Auth::user()->hasRole('admin') && $post->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to delete this post'
            ], Response::HTTP_FORBIDDEN);
        }
        
        // Delete featured image if exists
        if ($post->featured_image) {
            Storage::delete($post->featured_image);
        }
        
        $post->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully'
        ]);
    }
} 