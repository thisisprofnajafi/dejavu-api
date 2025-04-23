<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Admin\Models\FaqCategory;
use Illuminate\Support\Facades\DB;

class FaqCategoryController extends Controller
{
    /**
     * Display a listing of FAQ categories.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = FaqCategory::query();
        
        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        // Search by name
        if ($request->has('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }
        
        // Get with count of FAQs
        if ($request->boolean('with_faqs_count', false)) {
            $query->withCount('faqs');
        }
        
        // Include FAQs if requested
        if ($request->boolean('with_faqs', false)) {
            $query->with(['faqs' => function($q) {
                $q->orderBy('order')->orderBy('created_at', 'desc');
            }]);
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
     * Store a newly created FAQ category.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'order' => 'nullable|integer'
        ]);

        DB::beginTransaction();
        
        try {
            $category = FaqCategory::create([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
                'order' => $request->order ?? 0
            ]);
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'FAQ category created successfully',
                'data' => $category
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create FAQ category: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified FAQ category.
     *
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function show($id, Request $request): JsonResponse
    {
        $query = FaqCategory::query();
        
        // Include FAQs if requested
        if ($request->boolean('with_faqs', true)) {
            $query->with(['faqs' => function($q) {
                $q->orderBy('order')->orderBy('created_at', 'desc');
            }]);
        }
        
        $category = $query->findOrFail($id);
        
        return response()->json([
            'status' => 'success',
            'data' => $category
        ]);
    }

    /**
     * Update the specified FAQ category.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $category = FaqCategory::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'order' => 'nullable|integer'
        ]);

        DB::beginTransaction();
        
        try {
            $category->update([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
                'order' => $request->order ?? $category->order
            ]);
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'FAQ category updated successfully',
                'data' => $category->fresh()
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update FAQ category: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified FAQ category.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $category = FaqCategory::withCount('faqs')->findOrFail($id);
        
        // Check if category has FAQs
        if ($category->faqs_count > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot delete category with associated FAQs'
            ], 422);
        }
        
        DB::beginTransaction();
        
        try {
            $category->delete();
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'FAQ category deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete FAQ category: ' . $e->getMessage()
            ], 500);
        }
    }
} 