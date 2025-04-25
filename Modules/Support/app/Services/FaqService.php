<?php

namespace Modules\Support\app\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\Support\app\Models\Faq;
use Modules\Support\app\Models\FaqCategory;

class FaqService
{
    /**
     * Get FAQs with pagination and filtering.
     *
     * @param int $perPage
     * @param string|null $search
     * @param int|null $categoryId
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getFaqs($perPage = 15, $search = null, $categoryId = null)
    {
        $query = Faq::with('category')->orderBy('order');
        
        // Filter by category if provided
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
        
        // Filter by search term if provided
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('question', 'like', "%{$search}%")
                  ->orWhere('answer', 'like', "%{$search}%");
            });
        }
        
        return $query->paginate($perPage);
    }

    /**
     * Get a specific FAQ.
     *
     * @param int $id
     * @return Faq
     */
    public function getFaq($id)
    {
        return Faq::with('category')->findOrFail($id);
    }

    /**
     * Create a new FAQ.
     *
     * @param array $data
     * @return Faq
     */
    public function createFaq(array $data)
    {
        // If order is not specified, set it to the highest order + 1
        if (!isset($data['order'])) {
            $maxOrder = Faq::where('category_id', $data['category_id'])->max('order') ?? 0;
            $data['order'] = $maxOrder + 1;
        }
        
        $faq = Faq::create($data);
        
        // Clear cache
        $this->clearFaqCache();
        
        return $faq->load('category');
    }

    /**
     * Update an existing FAQ.
     *
     * @param int $id
     * @param array $data
     * @return Faq
     */
    public function updateFaq($id, array $data)
    {
        $faq = Faq::findOrFail($id);
        $faq->update($data);
        
        // Clear cache
        $this->clearFaqCache();
        
        return $faq->fresh('category');
    }

    /**
     * Delete a FAQ.
     *
     * @param int $id
     * @return bool
     */
    public function deleteFaq($id)
    {
        $faq = Faq::findOrFail($id);
        $result = $faq->delete();
        
        // Clear cache
        $this->clearFaqCache();
        
        return $result;
    }

    /**
     * Get FAQs by category.
     *
     * @param int $categoryId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFaqsByCategory($categoryId)
    {
        return Cache::remember('faqs_category_' . $categoryId, 3600, function () use ($categoryId) {
            return Faq::where('category_id', $categoryId)
                ->orderBy('order')
                ->get();
        });
    }

    /**
     * Reorder FAQs.
     *
     * @param array $faqs
     * @return bool
     */
    public function reorderFaqs(array $faqs)
    {
        DB::beginTransaction();
        
        try {
            foreach ($faqs as $faqData) {
                Faq::where('id', $faqData['id'])->update(['order' => $faqData['order']]);
            }
            
            DB::commit();
            
            // Clear cache
            $this->clearFaqCache();
            
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Get FAQ categories with pagination and filtering.
     *
     * @param int $perPage
     * @param string|null $search
     * @param bool $withFaqs
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getFaqCategories($perPage = 15, $search = null, $withFaqs = false)
    {
        $query = FaqCategory::orderBy('order');
        
        // Include FAQs if requested
        if ($withFaqs) {
            $query->with(['faqs' => function ($q) {
                $q->orderBy('order');
            }]);
        }
        
        // Filter by search term if provided
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        return $query->paginate($perPage);
    }

    /**
     * Get a specific FAQ category.
     *
     * @param int $id
     * @return FaqCategory
     */
    public function getFaqCategory($id)
    {
        return FaqCategory::with(['faqs' => function ($q) {
            $q->orderBy('order');
        }])->findOrFail($id);
    }

    /**
     * Create a new FAQ category.
     *
     * @param array $data
     * @return FaqCategory
     */
    public function createFaqCategory(array $data)
    {
        // If order is not specified, set it to the highest order + 1
        if (!isset($data['order'])) {
            $maxOrder = FaqCategory::max('order') ?? 0;
            $data['order'] = $maxOrder + 1;
        }
        
        $category = FaqCategory::create($data);
        
        // Clear cache
        $this->clearFaqCache();
        
        return $category;
    }

    /**
     * Update an existing FAQ category.
     *
     * @param int $id
     * @param array $data
     * @return FaqCategory
     */
    public function updateFaqCategory($id, array $data)
    {
        $category = FaqCategory::findOrFail($id);
        $category->update($data);
        
        // Clear cache
        $this->clearFaqCache();
        
        return $category->fresh();
    }

    /**
     * Delete a FAQ category.
     *
     * @param int $id
     * @return bool
     */
    public function deleteFaqCategory($id)
    {
        $category = FaqCategory::findOrFail($id);
        
        // Check if category has FAQs
        if ($category->faqs()->count() > 0) {
            throw new \Exception('Cannot delete category that has FAQs. Please delete or move all FAQs first.');
        }
        
        $result = $category->delete();
        
        // Clear cache
        $this->clearFaqCache();
        
        return $result;
    }

    /**
     * Reorder FAQ categories.
     *
     * @param array $categories
     * @return bool
     */
    public function reorderFaqCategories(array $categories)
    {
        DB::beginTransaction();
        
        try {
            foreach ($categories as $categoryData) {
                FaqCategory::where('id', $categoryData['id'])->update(['order' => $categoryData['order']]);
            }
            
            DB::commit();
            
            // Clear cache
            $this->clearFaqCache();
            
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Clear FAQ related cache.
     *
     * @return void
     */
    private function clearFaqCache()
    {
        $categories = FaqCategory::all(['id']);
        
        foreach ($categories as $category) {
            Cache::forget('faqs_category_' . $category->id);
        }
        
        Cache::forget('faq_categories');
    }
} 