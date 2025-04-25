<?php

namespace Modules\Content\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Content\app\Http\Requests\StoreCategoryRequest;
use Modules\Content\app\Http\Requests\UpdateCategoryRequest;
use Modules\Content\app\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', config('content.pagination.per_page', 10));
        $search = $request->input('search');
        $hierarchical = $request->boolean('hierarchical', false);
        
        $query = Category::with('parent');
        
        // Filter by search term if provided
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // If hierarchical is requested, only get root categories (those without parents)
        // and load their children
        if ($hierarchical) {
            $query->whereNull('parent_id')->with('children');
            $categories = $query->get();
            
            return response()->json([
                'success' => true,
                'data' => $categories
            ]);
        }
        
        // Otherwise, paginate flat list
        $categories = $query->orderBy('title')->paginate($perPage);
        
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Content\app\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        
        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store(
                config('content.storage.categories', 'public/categories')
            );
        }
        
        $category = Category::create($data);
        
        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => $category
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Content\app\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json([
            'success' => true,
            'data' => $category->load(['parent', 'children'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Content\app\Http\Requests\UpdateCategoryRequest  $request
     * @param  \Modules\Content\app\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        
        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($category->featured_image) {
                Storage::delete($category->featured_image);
            }
            
            $data['featured_image'] = $request->file('featured_image')->store(
                config('content.storage.categories', 'public/categories')
            );
        }
        
        $category->update($data);
        
        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data' => $category->fresh(['parent', 'children'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Content\app\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // Check if category has children
        if ($category->children()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete category that has child categories. Please remove all child categories first.'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        // Check if category has posts (consider using a soft delete strategy if needed)
        if ($category->posts()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete category that has posts. Please reassign or delete all posts first.'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        // Delete featured image if exists
        if ($category->featured_image) {
            Storage::delete($category->featured_image);
        }
        
        $category->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully'
        ]);
    }
} 