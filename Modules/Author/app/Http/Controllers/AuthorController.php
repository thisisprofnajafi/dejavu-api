<?php

namespace Modules\Author\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Author\Services\AuthorService;
use Modules\Content\Models\Post;
use Modules\Content\Models\Category;

class AuthorController extends Controller
{
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
        $this->middleware('auth:sanctum');
        $this->middleware('role:author');
    }

    /**
     * Display author dashboard with content statistics
     * 
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $user = Auth::user();
        $stats = $this->authorService->getAuthorStats($user->id);
        
        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }

    /**
     * Get author posts with pagination
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function posts(Request $request)
    {
        $user = Auth::user();
        $perPage = $request->input('per_page', 15);
        $status = $request->input('status', 'all');
        $search = $request->input('search');
        $categoryId = $request->input('category_id');
        
        $posts = $this->authorService->getAuthorPosts(
            $user->id, 
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
     * Get author categories
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function categories(Request $request)
    {
        $user = Auth::user();
        $categories = $this->authorService->getAuthorCategories($user->id);
        
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    /**
     * Get author profile info
     * 
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = Auth::user()->load('profile');
        
        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    /**
     * Update author profile
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'website' => 'nullable|url',
            'social_links' => 'nullable|array',
        ]);
        
        $user = Auth::user();
        $profile = $this->authorService->updateAuthorProfile($user->id, $request->all());
        
        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'data' => $profile
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('author::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('author::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('author::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('author::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
