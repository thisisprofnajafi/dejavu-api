<?php

namespace Modules\Support\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Support\app\Http\Requests\StoreFaqCategoryRequest;
use Modules\Support\app\Http\Requests\UpdateFaqCategoryRequest;
use Modules\Support\app\Services\FaqService;
use Modules\Support\app\Models\FaqCategory;

class FaqCategoryController extends Controller
{
    protected $faqService;

    public function __construct(FaqService $faqService)
    {
        $this->faqService = $faqService;
        // Only authenticated admins can modify FAQ categories
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        $this->middleware('role:admin')->except(['index', 'show']);
    }

    /**
     * Display a listing of FAQ categories.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 15);
        $search = $request->input('search');
        $withFaqs = $request->boolean('with_faqs', false);
        
        $categories = $this->faqService->getFaqCategories($perPage, $search, $withFaqs);
        
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    /**
     * Store a newly created FAQ category.
     *
     * @param StoreFaqCategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFaqCategoryRequest $request)
    {
        try {
            $category = $this->faqService->createFaqCategory($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'دسته‌بندی سوالات متداول با موفقیت ایجاد شد',
                'data' => $category
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در ایجاد دسته‌بندی سوالات متداول: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified FAQ category.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $category = $this->faqService->getFaqCategory($id);
            
            return response()->json([
                'success' => true,
                'data' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'دسته‌بندی سوالات متداول یافت نشد'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified FAQ category.
     *
     * @param UpdateFaqCategoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFaqCategoryRequest $request, $id)
    {
        try {
            $category = $this->faqService->updateFaqCategory($id, $request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'دسته‌بندی سوالات متداول با موفقیت به‌روزرسانی شد',
                'data' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در به‌روزرسانی دسته‌بندی سوالات متداول: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified FAQ category.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->faqService->deleteFaqCategory($id);
            
            return response()->json([
                'success' => true,
                'message' => 'دسته‌بندی سوالات متداول با موفقیت حذف شد'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در حذف دسته‌بندی سوالات متداول: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    /**
     * Reorder FAQ categories.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'categories' => 'required|array',
            'categories.*.id' => 'required|integer|exists:faq_categories,id',
            'categories.*.order' => 'required|integer|min:0'
        ]);
        
        try {
            $this->faqService->reorderFaqCategories($request->categories);
            
            return response()->json([
                'success' => true,
                'message' => 'ترتیب دسته‌بندی‌های سوالات متداول با موفقیت تغییر کرد'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در تغییر ترتیب دسته‌بندی‌های سوالات متداول: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
} 