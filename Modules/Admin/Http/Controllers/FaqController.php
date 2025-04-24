<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Admin\Models\Faq;
use Modules\Admin\Models\FaqCategory;
use Illuminate\Support\Facades\DB;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'FAQs', description: 'API endpoints for FAQ management')]
class FaqController extends Controller
{
    /**
     * Display a listing of FAQs.
     *
     * @param Request $request
     * @return JsonResponse
     */
    #[OA\Get(
        path: '/api/v1/faqs',
        summary: 'Get all FAQs',
        description: 'Returns a paginated list of FAQs'
    )]
    #[OA\Parameter(
        name: 'status',
        in: 'query',
        description: 'Filter by status (active or inactive)',
        schema: new OA\Schema(type: 'string', enum: ['active', 'inactive'])
    )]
    #[OA\Parameter(
        name: 'category_id',
        in: 'query',
        description: 'Filter by category ID',
        schema: new OA\Schema(type: 'integer')
    )]
    #[OA\Parameter(
        name: 'search',
        in: 'query',
        description: 'Search in question and answer fields',
        schema: new OA\Schema(type: 'string')
    )]
    #[OA\Parameter(
        name: 'with_category',
        in: 'query',
        description: 'Include category in response',
        schema: new OA\Schema(type: 'boolean', default: true)
    )]
    #[OA\Parameter(
        name: 'order_by',
        in: 'query',
        description: 'Field to order by',
        schema: new OA\Schema(type: 'string', default: 'order')
    )]
    #[OA\Parameter(
        name: 'per_page',
        in: 'query',
        description: 'Items per page',
        schema: new OA\Schema(type: 'integer', default: 15)
    )]
    #[OA\Response(
        response: 200,
        description: 'List of FAQs',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'data', type: 'object')
            ]
        )
    )]
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
    #[OA\Post(
        path: '/api/v1/faqs',
        summary: 'Create a new FAQ',
        description: 'Creates a new FAQ and returns it',
        security: [['bearerAuth' => []]]
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'question', type: 'string', example: 'How do I reset my password?'),
                new OA\Property(property: 'answer', type: 'string', example: 'Click on the "Forgot Password" link on the login page.'),
                new OA\Property(property: 'category_id', type: 'integer', example: 1),
                new OA\Property(property: 'status', type: 'string', enum: ['active', 'inactive'], example: 'active'),
                new OA\Property(property: 'order', type: 'integer', example: 1)
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: 'FAQ created successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'message', type: 'string', example: 'FAQ created successfully'),
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
                new OA\Property(property: 'message', type: 'string', example: 'The selected category is inactive')
            ]
        )
    )]
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
    #[OA\Get(
        path: '/api/v1/faqs/{id}',
        summary: 'Get a specific FAQ',
        description: 'Returns a specific FAQ by ID'
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        required: true,
        description: 'The FAQ ID',
        schema: new OA\Schema(type: 'integer')
    )]
    #[OA\Response(
        response: 200,
        description: 'FAQ details',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'data', type: 'object')
            ]
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'FAQ not found'
    )]
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
    #[OA\Put(
        path: '/api/v1/faqs/{id}',
        summary: 'Update a FAQ',
        description: 'Updates a FAQ and returns it',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        required: true,
        description: 'The FAQ ID',
        schema: new OA\Schema(type: 'integer')
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'question', type: 'string', example: 'How do I reset my password?'),
                new OA\Property(property: 'answer', type: 'string', example: 'Click on the "Forgot Password" link on the login page.'),
                new OA\Property(property: 'category_id', type: 'integer', example: 1),
                new OA\Property(property: 'status', type: 'string', enum: ['active', 'inactive'], example: 'active'),
                new OA\Property(property: 'order', type: 'integer', example: 1)
            ]
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'FAQ updated successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'message', type: 'string', example: 'FAQ updated successfully'),
                new OA\Property(property: 'data', type: 'object')
            ]
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'FAQ not found'
    )]
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
    #[OA\Delete(
        path: '/api/v1/faqs/{id}',
        summary: 'Delete a FAQ',
        description: 'Deletes a FAQ',
        security: [['bearerAuth' => []]]
    )]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        required: true,
        description: 'The FAQ ID',
        schema: new OA\Schema(type: 'integer')
    )]
    #[OA\Response(
        response: 200,
        description: 'FAQ deleted successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'message', type: 'string', example: 'FAQ deleted successfully')
            ]
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'FAQ not found'
    )]
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
    #[OA\Get(
        path: '/api/v1/faqs/category/{categoryId}',
        summary: 'Get FAQs by category',
        description: 'Returns all FAQs for a specific category'
    )]
    #[OA\Parameter(
        name: 'categoryId',
        in: 'path',
        required: true,
        description: 'The category ID',
        schema: new OA\Schema(type: 'integer')
    )]
    #[OA\Parameter(
        name: 'status',
        in: 'query',
        description: 'Filter by status (active or inactive)',
        schema: new OA\Schema(type: 'string', enum: ['active', 'inactive'])
    )]
    #[OA\Response(
        response: 200,
        description: 'FAQs for the category',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'data', properties: [
                    new OA\Property(property: 'category', type: 'object'),
                    new OA\Property(property: 'faqs', type: 'array', items: new OA\Items(type: 'object'))
                ], type: 'object')
            ]
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'Category not found'
    )]
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
    #[OA\Post(
        path: '/api/v1/faqs/update-order',
        summary: 'Update FAQ order',
        description: 'Updates the order of multiple FAQs',
        security: [['bearerAuth' => []]]
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'items',
                    type: 'array',
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: 'id', type: 'integer', example: 1),
                            new OA\Property(property: 'order', type: 'integer', example: 2)
                        ],
                        type: 'object'
                    )
                )
            ]
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Order updated successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'success'),
                new OA\Property(property: 'message', type: 'string', example: 'FAQ order updated successfully')
            ]
        )
    )]
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