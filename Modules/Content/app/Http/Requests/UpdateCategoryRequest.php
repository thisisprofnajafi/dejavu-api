<?php

namespace Modules\Content\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('author'));
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $titleMin = config('content.validation.category_title_min', 3);
        $titleMax = config('content.validation.category_title_max', 50);
        
        return [
            'title' => "sometimes|required|string|min:{$titleMin}|max:{$titleMax}",
            'slug' => [
                'sometimes',
                'required',
                'string',
                Rule::unique('categories', 'slug')->ignore($this->category)
            ],
            'description' => 'nullable|string|max:1000',
            'parent_id' => [
                'nullable',
                'exists:categories,id',
                function ($attribute, $value, $fail) {
                    // Prevent assigning itself or its children as parent (would create a loop)
                    if ($value == $this->category->id) {
                        $fail('A category cannot be its own parent.');
                    }
                    
                    // Check if the selected parent is not one of its children
                    $children = $this->getChildCategories($this->category);
                    if (in_array($value, $children)) {
                        $fail('You cannot select a child category as a parent.');
                    }
                },
            ],
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|array',
            'meta_keywords.*' => 'string|max:50',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->filled('title') && !$this->filled('slug')) {
            $this->merge([
                'slug' => \Str::slug($this->title)
            ]);
        }
    }
    
    /**
     * Get all child category IDs recursively
     */
    private function getChildCategories($category, $children = []): array
    {
        foreach ($category->children as $child) {
            $children[] = $child->id;
            $children = $this->getChildCategories($child, $children);
        }
        
        return $children;
    }
} 