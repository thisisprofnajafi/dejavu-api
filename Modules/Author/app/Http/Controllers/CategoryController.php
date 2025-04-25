<?php

namespace Modules\Author\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Author\Http\Requests\StoreCategoryRequest;
use Modules\Author\Http\Requests\UpdateCategoryRequest;
use Modules\Author\Services\CategoryService;
use Modules\Content\Models\Category;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->middleware('auth:sanctum');
        $this->middleware('role:author');
    }

    /**
     * Display a listing of the categories.
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 15);
        $search = $request->input('search');
        $parent = $request->input('parent_id');
        
        $categories = $this->categoryService->getCategories(
            Auth::id(),
            $perPage,
            $search,
            $parent
        );
        
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    /**
     * Store a newly created category.
     * 
     * @param StoreCategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryService->createCategory(Auth::id(), $request->validated());
        
        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }

    /**
     * Display the specified category.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->categoryService->getCategory($id);
        
        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    /**
     * Update the specified category.
     * 
     * @param UpdateCategoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = $this->categoryService->updateCategory($id, Auth::id(), $request->validated());
        
        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data' => $category
        ]);
    }

    /**
     * Remove the specified category.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id, Auth::id());
        
        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully'
        ]);
    }
    
    /**
     * Get all categories for a select dropdown
     * 
     * @return \Illuminate\Http\Response
     */
    public function dropdown()
    {
        $categories = $this->categoryService->getCategoriesForDropdown();
        
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }
} 