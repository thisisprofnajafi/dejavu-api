<?php

namespace Modules\Content\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Content\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            if ($request->parent_id === 'null') {
                $query->whereNull('parent_id');
            } else {
                $query->where('parent_id', $request->parent_id);
            }
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

        // Check for circular reference
        if ($request->has('parent_id') && $request->parent_id) {
            try {
                $this->checkCircularReference(null, $request->parent_id);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ], 422);
            }
        }

        DB::beginTransaction();
        
        try {
            $page = Page::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'status' => $request->status,
                'published_at' => $request->status == 'published' ? ($request->published_at ?? now()) : null,
                'user_id' => Auth::id(),
                'parent_id' => $request->parent_id,
                'order' => $request->order ?? 0
            ]);
            
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Page created successfully',
                'data' => $page->load(['author', 'parent', 'children'])
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create page: ' . $e->getMessage()
            ], 500);
        }
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
        if ($request->has('parent_id') && $request->parent_id == $id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Page cannot be its own parent'
            ], 422);
        }
        
        // Check for circular reference
        if ($request->has('parent_id') && $request->parent_id) {
            try {
                $this->checkCircularReference($id, $request->parent_id);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ], 422);
            }
        }

        DB::beginTransaction();
        
        try {
            $page->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'status' => $request->status,
                'published_at' => $request->status == 'published' ? ($request->published_at ?? $page->published_at ?? now()) : null,
                'parent_id' => $request->parent_id,
                'order' => $request->order ?? $page->order
            ]);
            
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Page updated successfully',
                'data' => $page->fresh()->load(['author', 'parent', 'children'])
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update page: ' . $e->getMessage()
            ], 500);
        }
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
        
        DB::beginTransaction();
        
        try {
            $page->delete();
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Page deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete page: ' . $e->getMessage()
            ], 500);
        }
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
    
    /**
     * Check for circular reference when setting a parent.
     *
     * @param int|null $pageId
     * @param int $parentId
     * @throws \Exception
     */
    private function checkCircularReference(?int $pageId, int $parentId): void
    {
        $parent = Page::findOrFail($parentId);
        
        // If our page is the parent of our proposed parent, that's a circular reference
        if ($pageId && $parent->parent_id == $pageId) {
            throw new \Exception('Circular reference detected in page hierarchy');
        }
        
        // Continue checking up the tree
        if ($parent->parent_id) {
            $this->checkCircularReference($pageId, $parent->parent_id);
        }
    }
} 