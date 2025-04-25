<?php

namespace Modules\Support\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFaqRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Middleware handles authorization
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'category_id' => 'sometimes|exists:faq_categories,id',
            'question' => 'sometimes|string|max:255',
            'answer' => 'sometimes|string',
            'order' => 'sometimes|integer|min:0',
            'status' => 'sometimes|in:published,draft',
        ];
    }
} 