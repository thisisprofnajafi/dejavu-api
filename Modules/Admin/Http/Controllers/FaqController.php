<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Admin\Models\Faq;
use Modules\Admin\Models\FaqCategory;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    /**
     * Display a listing of FAQs.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Faq::query();
        
        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by category
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        
        // Search by question or answer
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('question', 'like', '%'.$request->search.'%')
                  ->orWhere('answer', 'like', '%'.$request->search.'%');
            });
        }
        
        // Include category if requested
        if ($request->boolean('with_category', true)) {
            $query->with('category');
        }
        
        $faqs = $query->orderBy($request->input('order_by', 'order'))
            ->orderBy('created_at', 'desc')
            ->paginate($request->input('per_page', 15));
        
        return response()->json([
            'status' => 'success',
            'data' => $faqs
        ]);
    }

    /**
     * Store a newly created FAQ.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category_id' => 'required|exists:faq_categories,id',
            'status' => 'required|in:active,inactive',
            'order' => 'nullable|integer'
        ]);

        // Check if category exists and is active
        $category = FaqCategory::findOrFail($request->category_id);
        if ($category->status !== 'active') {
            return response()->json([
                'status' => 'error',
                'message' => 'The selected category is inactive'
            ], 422);
        }

        DB::beginTransaction();
        
        try {
            $faq = Faq::create([
                'question' => $request->question,
                'answer' => $request->answer,
                'category_id' => $request->category_id,
                'status' => $request->status,
                'order' => $request->order ?? 0
            ]);
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'FAQ created successfully',
                'data' => $faq->load('category')
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create FAQ: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified FAQ.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $faq = Faq::with('category')->findOrFail($id);
        
        return response()->json([
            'status' => 'success',
            'data' => $faq
        ]);
    }

    /**
     * Update the specified FAQ.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $faq = Faq::findOrFail($id);
        
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category_id' => 'required|exists:faq_categories,id',
            'status' => 'required|in:active,inactive',
            'order' => 'nullable|integer'
        ]);

        // Check if category exists and is active
        $category = FaqCategory::findOrFail($request->category_id);
        if ($category->status !== 'active') {
            return response()->json([
                'status' => 'error',
                'message' => 'The selected category is inactive'
            ], 422);
        }

        DB::beginTransaction();
        
        try {
            $faq->update([
                'question' => $request->question,
                'answer' => $request->answer,
                'category_id' => $request->category_id,
                'status' => $request->status,
                'order' => $request->order ?? $faq->order
            ]);
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'FAQ updated successfully',
                'data' => $faq->fresh()->load('category')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update FAQ: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified FAQ.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $faq = Faq::findOrFail($id);
        
        DB::beginTransaction();
        
        try {
            $faq->delete();
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'FAQ deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete FAQ: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get all FAQs for a specific category.
     *
     * @param int $categoryId
     * @param Request $request
     * @return JsonResponse
     */
    public function getByCategory($categoryId, Request $request): JsonResponse
    {
        $category = FaqCategory::findOrFail($categoryId);
        
        $query = $category->faqs();
        
        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        $faqs = $query->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return response()->json([
            'status' => 'success',
            'data' => [
                'category' => $category,
                'faqs' => $faqs
            ]
        ]);
    }
    
    /**
     * Update the order of multiple FAQs.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateOrder(Request $request): JsonResponse
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:faqs,id',
            'items.*.order' => 'required|integer|min:0'
        ]);
        
        DB::beginTransaction();
        
        try {
            foreach ($request->items as $item) {
                Faq::where('id', $item['id'])->update(['order' => $item['order']]);
            }
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'FAQ order updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update FAQ order: ' . $e->getMessage()
            ], 500);
        }
    }
} 