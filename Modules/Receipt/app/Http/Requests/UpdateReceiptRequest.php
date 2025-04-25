<?php

namespace Modules\Receipt\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateReceiptRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('visitor'));
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'visitor_id' => 'nullable|exists:visitors,id',
            'payment_method' => 'sometimes|required|string|in:' . implode(',', array_keys(config('receipt.payment_methods', []))),
            'payment_status' => 'sometimes|required|string|in:' . implode(',', array_keys(config('receipt.statuses', []))),
            'notes' => 'nullable|string|max:1000',
            'billing_address' => 'sometimes|nullable|array',
            'billing_address.name' => 'required_with:billing_address|string|max:100',
            'billing_address.address_line_1' => 'required_with:billing_address|string|max:100',
            'billing_address.address_line_2' => 'nullable|string|max:100',
            'billing_address.city' => 'required_with:billing_address|string|max:100',
            'billing_address.state' => 'required_with:billing_address|string|max:100',
            'billing_address.postal_code' => 'required_with:billing_address|string|max:20',
            'billing_address.country' => 'required_with:billing_address|string|max:100',
            'billing_address.phone' => 'nullable|string|max:20',
            'shipping_address' => 'sometimes|nullable|array',
            'shipping_address.name' => 'required_with:shipping_address|string|max:100',
            'shipping_address.address_line_1' => 'required_with:shipping_address|string|max:100',
            'shipping_address.address_line_2' => 'nullable|string|max:100',
            'shipping_address.city' => 'required_with:shipping_address|string|max:100',
            'shipping_address.state' => 'required_with:shipping_address|string|max:100',
            'shipping_address.postal_code' => 'required_with:shipping_address|string|max:20',
            'shipping_address.country' => 'required_with:shipping_address|string|max:100',
            'shipping_address.phone' => 'nullable|string|max:20',
            'payment_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'metadata' => 'nullable|array',
        ];
    }
} 