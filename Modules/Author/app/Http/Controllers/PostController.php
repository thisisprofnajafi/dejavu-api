<?php

namespace Modules\Author\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Author\Http\Requests\StorePostRequest;
use Modules\Author\Http\Requests\UpdatePostRequest;
use Modules\Author\Services\PostService;
use Modules\Content\Models\Post;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
        $this->middleware('auth:sanctum');
        $this->middleware('role:author');
    }

    /**
     * Display a listing of the author's posts.
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 15);
        $status = $request->input('status');
        $search = $request->input('search');
        $categoryId = $request->input('category_id');
        
        $posts = $this->postService->getAuthorPosts(
            Auth::id(),
            $perPage,
            $status,
            $search,
            $categoryId
        );
        
        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }

    /**
     * Store a newly created post.
     * 
     * @param StorePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = $this->postService->createPost(Auth::id(), $request->validated());
        
        return response()->json([
            'success' => true,
            'message' => 'Post created successfully',
            'data' => $post
        ], 201);
    }

    /**
     * Display the specified post.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->postService->getPost($id, Auth::id());
        
        return response()->json([
            'success' => true,
            'data' => $post
        ]);
    }

    /**
     * Update the specified post.
     * 
     * @param UpdatePostRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = $this->postService->updatePost($id, Auth::id(), $request->validated());
        
        return response()->json([
            'success' => true,
            'message' => 'Post updated successfully',
            'data' => $post
        ]);
    }

    /**
     * Remove the specified post.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->postService->deletePost($id, Auth::id());
        
        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully'
        ]);
    }
    
    /**
     * Update SEO metadata for a post
     * 
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateSeo(Request $request, $id)
    {
        $request->validate([
            'meta_title' => 'required|string|max:70',
            'meta_description' => 'required|string|max:160',
            'meta_keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:70',
            'og_description' => 'nullable|string|max:200',
            'og_image' => 'nullable|string',
            'canonical_url' => 'nullable|url',
        ]);
        
        $post = $this->postService->updatePostSeo($id, Auth::id(), $request->all());
        
        return response()->json([
            'success' => true,
            'message' => 'SEO metadata updated successfully',
            'data' => $post
        ]);
    }
    
    /**
     * Publish a post
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function publish($id)
    {
        $post = $this->postService->publishPost($id, Auth::id());
        
        return response()->json([
            'success' => true,
            'message' => 'Post published successfully',
            'data' => $post
        ]);
    }
    
    /**
     * Unpublish a post
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function unpublish($id)
    {
        $post = $this->postService->unpublishPost($id, Auth::id());
        
        return response()->json([
            'success' => true,
            'message' => 'Post unpublished successfully',
            'data' => $post
        ]);
    }
} 