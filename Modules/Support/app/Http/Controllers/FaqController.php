<?php

namespace Modules\Support\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Support\app\Http\Requests\StoreFaqRequest;
use Modules\Support\app\Http\Requests\UpdateFaqRequest;
use Modules\Support\app\Services\FaqService;
use Modules\Support\app\Models\Faq;
use Modules\Support\app\Models\FaqCategory;

class FaqController extends Controller
{
    protected $faqService;

    public function __construct(FaqService $faqService)
    {
        $this->faqService = $faqService;
        // Only authenticated admins can modify FAQs
        $this->middleware('auth:sanctum')->except(['index', 'show', 'getByCategory']);
        $this->middleware('role:admin')->except(['index', 'show', 'getByCategory']);
    }

    /**
     * Display a listing of FAQs.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 15);
        $search = $request->input('search');
        $categoryId = $request->input('category_id');
        
        $faqs = $this->faqService->getFaqs($perPage, $search, $categoryId);
        
        return response()->json([
            'success' => true,
            'data' => $faqs
        ]);
    }

    /**
     * Store a newly created FAQ.
     *
     * @param StoreFaqRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFaqRequest $request)
    {
        try {
            $faq = $this->faqService->createFaq($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'FAQ created successfully',
                'data' => $faq
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create FAQ: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified FAQ.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $faq = $this->faqService->getFaq($id);
            
            return response()->json([
                'success' => true,
                'data' => $faq
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'FAQ not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified FAQ.
     *
     * @param UpdateFaqRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFaqRequest $request, $id)
    {
        try {
            $faq = $this->faqService->updateFaq($id, $request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'FAQ updated successfully',
                'data' => $faq
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update FAQ: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified FAQ.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->faqService->deleteFaq($id);
            
            return response()->json([
                'success' => true,
                'message' => 'FAQ deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete FAQ: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get FAQs by category.
     *
     * @param int $categoryId
     * @return \Illuminate\Http\Response
     */
    public function getByCategory($categoryId)
    {
        try {
            $faqs = $this->faqService->getFaqsByCategory($categoryId);
            
            return response()->json([
                'success' => true,
                'data' => $faqs
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get FAQs: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    /**
     * Reorder FAQs.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'faqs' => 'required|array',
            'faqs.*.id' => 'required|integer|exists:faqs,id',
            'faqs.*.order' => 'required|integer|min:0'
        ]);
        
        try {
            $this->faqService->reorderFaqs($request->faqs);
            
            return response()->json([
                'success' => true,
                'message' => 'FAQs reordered successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reorder FAQs: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
} 