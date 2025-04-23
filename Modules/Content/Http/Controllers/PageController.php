<?php

namespace Modules\Content\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Content\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Display a listing of pages.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Page::query();
        
        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by parent
        if ($request->has('parent_id')) {
            $query->where('parent_id', $request->parent_id);
        } else {
            // Only top-level pages by default
            $query->whereNull('parent_id');
        }
        
        // Published filter
        if ($request->has('published') && $request->published) {
            $query->published();
        }
        
        // Search by title or content
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                  ->orWhere('content', 'like', '%'.$request->search.'%');
            });
        }
        
        $pages = $query->with('author')
            ->orderBy('order', 'asc')
            ->orderBy('title', 'asc')
            ->paginate($request->input('per_page', 15));
        
        return response()->json([
            'status' => 'success',
            'data' => $pages
        ]);
    }

    /**
     * Store a newly created page.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'parent_id' => 'nullable|exists:pages,id',
            'order' => 'nullable|integer'
        ]);

        $page = Page::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'status' => $request->status,
            'published_at' => $request->published_at,
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id,
            'order' => $request->order ?? 0
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Page created successfully',
            'data' => $page->load('author')
        ], 201);
    }

    /**
     * Display the specified page.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $page = Page::with(['author', 'parent', 'children'])->findOrFail($id);
        
        return response()->json([
            'status' => 'success',
            'data' => $page
        ]);
    }

    /**
     * Update the specified page.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $page = Page::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'parent_id' => 'nullable|exists:pages,id',
            'order' => 'nullable|integer'
        ]);

        // Prevent circular reference
        if ($request->parent_id == $id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Page cannot be its own parent'
            ], 422);
        }

        $page->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'status' => $request->status,
            'published_at' => $request->published_at,
            'parent_id' => $request->parent_id,
            'order' => $request->order ?? $page->order
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Page updated successfully',
            'data' => $page->load(['author', 'parent', 'children'])
        ]);
    }

    /**
     * Remove the specified page.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $page = Page::findOrFail($id);
        
        // Check if page has children
        if ($page->children()->count() > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot delete page with child pages'
            ], 422);
        }
        
        $page->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Page deleted successfully'
        ]);
    }
    
    /**
     * Display a page by its slug.
     *
     * @param string $slug
     * @return JsonResponse
     */
    public function bySlug($slug): JsonResponse
    {
        $page = Page::where('slug', $slug)
            ->with(['author', 'parent', 'children'])
            ->firstOrFail();
        
        return response()->json([
            'status' => 'success',
            'data' => $page
        ]);
    }
} 