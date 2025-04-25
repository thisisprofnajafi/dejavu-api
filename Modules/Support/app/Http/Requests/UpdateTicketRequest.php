<?php

namespace Modules\Support\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UpdateTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Checked in controller
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'subject' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ];
        
        // Only admins can change priority and department
        if (Auth::user()->hasRole('admin')) {
            $rules['priority'] = ['sometimes', Rule::in(['low', 'medium', 'high', 'urgent'])];
            $rules['department_id'] = 'sometimes|exists:departments,id';
        }
        
        return $rules;
    }
} 