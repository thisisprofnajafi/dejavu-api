<?php

namespace Modules\Support\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Public route
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'department' => 'nullable|string|max:100',
            'recaptcha_token' => 'nullable|string', // For Google reCAPTCHA validation
        ];
    }
} 