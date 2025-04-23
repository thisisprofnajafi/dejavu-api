<?php

namespace Modules\Content\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Content\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Category::query();
        
        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by parent category
        if ($request->has('parent_id')) {
            if ($request->parent_id === 'null') {
                $query->whereNull('parent_id');
            } else {
                $query->where('parent_id', $request->parent_id);
            }
        }
        
        // Search by name or description
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('description', 'like', '%'.$request->search.'%');
            });
        }
        
        // Option to include post counts
        if ($request->has('with_count') && $request->with_count) {
            $query->withCount('posts');
        }
        
        // Get with parent and children
        if ($request->has('with_hierarchy') && $request->with_hierarchy) {
            $query->with(['parent', 'children']);
        }
        
        $categories = $query->orderBy($request->input('order_by', 'order'))
            ->orderBy('name')
            ->paginate($request->input('per_page', 15));
        
        return response()->json([
            'status' => 'success',
            'data' => $categories
        ]);
    }

    /**
     * Store a newly created category.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'order' => 'nullable|integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string'
        ]);
        
        // Check for circular reference
        if ($request->parent_id) {
            $this->checkCircularReference(null, $request->parent_id);
        }

        DB::beginTransaction();
        
        try {
            $category = Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'parent_id' => $request->parent_id,
                'status' => $request->status,
                'order' => $request->order ?? 0,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description
            ]);
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Category created successfully',
                'data' => $category->load(['parent', 'children'])
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create category: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified category.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $category = Category::with(['parent', 'children'])->findOrFail($id);
        
        return response()->json([
            'status' => 'success',
            'data' => $category
        ]);
    }

    /**
     * Update the specified category.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'order' => 'nullable|integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string'
        ]);
        
        // Check if parent_id is set and not the same as the category id
        if ($request->has('parent_id') && $request->parent_id == $id) {
            return response()->json([
                'status' => 'error',
                'message' => 'A category cannot be its own parent'
            ], 422);
        }
        
        // Check for circular reference
        if ($request->has('parent_id') && $request->parent_id) {
            $this->checkCircularReference($id, $request->parent_id);
        }

        DB::beginTransaction();
        
        try {
            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'parent_id' => $request->parent_id,
                'status' => $request->status,
                'order' => $request->order ?? $category->order,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description
            ]);
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Category updated successfully',
                'data' => $category->fresh()->load(['parent', 'children'])
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update category: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified category.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $category = Category::withCount('posts')->findOrFail($id);
        
        // Check if category has children
        if ($category->children()->count() > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot delete category with child categories'
            ], 422);
        }
        
        // Check if category has posts
        if ($category->posts_count > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot delete category with associated posts'
            ], 422);
        }
        
        DB::beginTransaction();
        
        try {
            $category->delete();
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Category deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete category: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Display a category by its slug.
     *
     * @param string $slug
     * @return JsonResponse
     */
    public function bySlug($slug): JsonResponse
    {
        $category = Category::where('slug', $slug)
            ->with(['parent', 'children'])
            ->firstOrFail();
        
        return response()->json([
            'status' => 'success',
            'data' => $category
        ]);
    }
    
    /**
     * Get all category posts.
     *
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function posts($id, Request $request): JsonResponse
    {
        $category = Category::findOrFail($id);
        
        $query = $category->posts();
        
        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter for published posts only
        if ($request->has('published') && $request->published) {
            $query->published();
        }
        
        $posts = $query->with('author')
            ->orderBy($request->input('order_by', 'published_at'), $request->input('order', 'desc'))
            ->paginate($request->input('per_page', 15));
        
        return response()->json([
            'status' => 'success',
            'data' => [
                'category' => $category,
                'posts' => $posts
            ]
        ]);
    }
    
    /**
     * Get category tree.
     *
     * @return JsonResponse
     */
    public function tree(): JsonResponse
    {
        // Get all root categories (with no parent)
        $categories = Category::whereNull('parent_id')
            ->with('childrenRecursive')
            ->orderBy('order')
            ->orderBy('name')
            ->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $categories
        ]);
    }
    
    /**
     * Check for circular reference when setting a parent.
     *
     * @param int|null $categoryId
     * @param int $parentId
     * @throws \Exception
     */
    private function checkCircularReference(?int $categoryId, int $parentId): void
    {
        $parent = Category::findOrFail($parentId);
        
        // If our category is the parent of our proposed parent, that's a circular reference
        if ($categoryId && $parent->parent_id == $categoryId) {
            throw new \Exception('Circular reference detected in category hierarchy');
        }
        
        // Continue checking up the tree
        if ($parent->parent_id) {
            $this->checkCircularReference($categoryId, $parent->parent_id);
        }
    }
} 