<?php

namespace Modules\Support\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Auth middleware handles authorization
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'department_id' => 'required|exists:departments,id',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'priority' => ['nullable', Rule::in(['low', 'medium', 'high', 'urgent'])],
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|max:10240', // Max 10MB per file
        ];
    }
} 