<?php

namespace Modules\Content\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Content\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Pages', description: 'API endpoints for page management')]
class PageController extends Controller
{
    /**
     * Display a listing of pages.
     *
     * @param Request $request
     * @return JsonResponse
     */
    #[OA\Get(
        path: '/api/v1/content/pages',
        summary: 'Get all pages',
        description: 'Returns a paginated list of pages',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Parameter(
        name: 'status',
        in: 'query',
        description: 'Filter by status (draft or published)',
        schema: new OA\Schema(type: 'string', enum: ['draft', 'published'])
    )]
    #[OA\Parameter(
        name: 'parent_id',
        in: 'query',
        description: 'Filter by parent ID (use "null" for top-level pages)',
        schema: new OA\Schema(type: 'string')
    )]
    #[OA\Parameter(
        name: 'published',
        in: 'query',
        description: 'Filter by published status',
        schema: new OA\Schema(type: 'boolean')
    )]
    #[OA\Parameter(
        name: 'search',
        in: 'query',
        description: 'Search in title and content',
        schema: new OA\Schema(type: 'string')
    )]
    #[OA\Parameter(
        name: 'per_page',
        in: 'query',
        description: 'Items per page',
        schema: new OA\Schema(type: 'integer', default: 15)
    )]
    #[OA\Response(
        response: 200,
        description: 'List of pages',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'data', type: 'object')
            ]
        )
    )]
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
    #[OA\Post(
        path: '/api/v1/content/pages',
        summary: 'Create a new page',
        description: 'Creates a new page and returns it',
        security: [['bearerAuth' => []]]
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'title', type: 'string', example: 'About Us'),
                new OA\Property(property: 'content', type: 'string', example: '<p>This is the about us page content.</p>'),
                new OA\Property(property: 'status', type: 'string', enum: ['draft', 'published'], example: 'published'),
                new OA\Property(property: 'published_at', type: 'string', format: 'date-time', nullable: true),
                new OA\Property(property: 'parent_id', type: 'integer', nullable: true),
                new OA\Property(property: 'order', type: 'integer', example: 1, nullable: true)
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'Page created successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'message', type: 'string', example: 'Page created successfully'),
                new OA\Property(property: 'data', type: 'object')
            ]
        )
    )]
    #[OA\Response(
        response: 422,
        description: 'Validation error',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'error'),
                new OA\Property(property: 'message', type: 'string', example: 'Circular reference detected in page hierarchy')
            ]
        )
    )]
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
    #[OA\Get(
        path: '/api/v1/content/pages/{id}',
        summary: 'Get a specific page',
        description: 'Returns a specific page by ID',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        required: true,
        description: 'The page ID',
        schema: new OA\Schema(type: 'integer')
    )]
    #[OA\Response(
        response: 200,
        description: 'Page details',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'data', type: 'object')
            ]
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'Page not found'
    )]
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
    #[OA\Put(
        path: '/api/v1/content/pages/{id}',
        summary: 'Update a page',
        description: 'Updates a page and returns it',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        required: true,
        description: 'The page ID',
        schema: new OA\Schema(type: 'integer')
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'title', type: 'string', example: 'About Us'),
                new OA\Property(property: 'content', type: 'string', example: '<p>This is the updated about us page content.</p>'),
                new OA\Property(property: 'status', type: 'string', enum: ['draft', 'published'], example: 'published'),
                new OA\Property(property: 'published_at', type: 'string', format: 'date-time', nullable: true),
                new OA\Property(property: 'parent_id', type: 'integer', nullable: true),
                new OA\Property(property: 'order', type: 'integer', example: 1, nullable: true)
            ]
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Page updated successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'message', type: 'string', example: 'Page updated successfully'),
                new OA\Property(property: 'data', type: 'object')
            ]
        )
    )]
    #[OA\Response(
        response: 422,
        description: 'Validation error',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'error'),
                new OA\Property(property: 'message', type: 'string', example: 'Page cannot be its own parent')
            ]
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'Page not found'
    )]
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
    #[OA\Delete(
        path: '/api/v1/content/pages/{id}',
        summary: 'Delete a page',
        description: 'Deletes a page',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        required: true,
        description: 'The page ID',
        schema: new OA\Schema(type: 'integer')
    )]
    #[OA\Response(
        response: 200,
        description: 'Page deleted successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'message', type: 'string', example: 'Page deleted successfully')
            ]
        )
    )]
    #[OA\Response(
        response: 422,
        description: 'Cannot delete page with children',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'error'),
                new OA\Property(property: 'message', type: 'string', example: 'Cannot delete page with child pages')
            ]
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'Page not found'
    )]
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
    #[OA\Get(
        path: '/api/v1/content/pages/slug/{slug}',
        summary: 'Get a page by slug',
        description: 'Returns a specific page by its slug',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Parameter(
        name: 'slug',
        in: 'path',
        required: true,
        description: 'The page slug',
        schema: new OA\Schema(type: 'string')
    )]
    #[OA\Response(
        response: 200,
        description: 'Page details',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'data', type: 'object')
            ]
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'Page not found'
    )]
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