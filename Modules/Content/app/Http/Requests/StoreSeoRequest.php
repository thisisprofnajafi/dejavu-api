<?php

namespace Modules\Content\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreSeoRequest extends FormRequest
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
        $metaTitleMaxLength = config('content.seo.meta_title_max_length', 60);
        $metaDescriptionMaxLength = config('content.seo.meta_description_max_length', 160);
        $keywordsMax = config('content.seo.keywords_max', 10);
        
        return [
            'meta_title' => "required|string|max:{$metaTitleMaxLength}",
            'meta_description' => "nullable|string|max:{$metaDescriptionMaxLength}",
            'meta_keywords' => "nullable|array|max:{$keywordsMax}",
            'meta_keywords.*' => 'string|max:50',
            'og_title' => 'nullable|string|max:60',
            'og_description' => 'nullable|string|max:160',
            'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'twitter_title' => 'nullable|string|max:60',
            'twitter_description' => 'nullable|string|max:160',
            'twitter_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'canonical_url' => 'nullable|url',
            'seoable_id' => 'required|integer',
            'seoable_type' => 'required|string',
        ];
    }
} 