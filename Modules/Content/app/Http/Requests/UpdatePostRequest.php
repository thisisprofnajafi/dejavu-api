<?php

namespace Modules\Content\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && 
            (Auth::user()->hasRole('admin') || 
             Auth::user()->hasRole('author') && $this->post->user_id === Auth::id());
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $titleMin = config('content.validation.post_title_min', 5);
        $titleMax = config('content.validation.post_title_max', 100);
        $contentMin = config('content.validation.post_content_min', 50);
        
        return [
            'title' => "sometimes|required|string|min:{$titleMin}|max:{$titleMax}",
            'slug' => [
                'sometimes',
                'required',
                'string',
                Rule::unique('posts', 'slug')->ignore($this->post)
            ],
            'content' => "sometimes|required|string|min:{$contentMin}",
            'excerpt' => 'nullable|string|max:500',
            'status' => 'sometimes|required|in:draft,published,archived',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'category_id' => 'sometimes|required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'published_at' => 'nullable|date',
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
} 