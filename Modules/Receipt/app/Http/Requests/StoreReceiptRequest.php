<?php

namespace Modules\Receipt\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreReceiptRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'visitor_id' => 'nullable|exists:visitors,id',
            'payment_method' => 'required|string|in:' . implode(',', array_keys(config('receipt.payment_methods', []))),
            'payment_status' => 'required|string|in:' . implode(',', array_keys(config('receipt.statuses', []))),
            'currency' => 'required|string|size:3',
            'notes' => 'nullable|string|max:1000',
            'billing_address' => 'nullable|array',
            'billing_address.name' => 'required_with:billing_address|string|max:100',
            'billing_address.address_line_1' => 'required_with:billing_address|string|max:100',
            'billing_address.address_line_2' => 'nullable|string|max:100',
            'billing_address.city' => 'required_with:billing_address|string|max:100',
            'billing_address.state' => 'required_with:billing_address|string|max:100',
            'billing_address.postal_code' => 'required_with:billing_address|string|max:20',
            'billing_address.country' => 'required_with:billing_address|string|max:100',
            'billing_address.phone' => 'nullable|string|max:20',
            'shipping_address' => 'nullable|array',
            'shipping_address.name' => 'required_with:shipping_address|string|max:100',
            'shipping_address.address_line_1' => 'required_with:shipping_address|string|max:100',
            'shipping_address.address_line_2' => 'nullable|string|max:100',
            'shipping_address.city' => 'required_with:shipping_address|string|max:100',
            'shipping_address.state' => 'required_with:shipping_address|string|max:100',
            'shipping_address.postal_code' => 'required_with:shipping_address|string|max:20',
            'shipping_address.country' => 'required_with:shipping_address|string|max:100',
            'shipping_address.phone' => 'nullable|string|max:20',
            'payment_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:today',
            'metadata' => 'nullable|array',
            
            // Validate receipt items
            'items' => 'required|array|min:1',
            'items.*.name' => 'required|string|max:255',
            'items.*.description' => 'nullable|string|max:1000',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.tax_rate' => 'nullable|numeric|min:0|max:100',
            'items.*.discount_amount' => 'nullable|numeric|min:0',
            'items.*.product_id' => 'nullable|integer',
            'items.*.product_type' => 'nullable|string|max:255',
            'items.*.metadata' => 'nullable|array',
        ];
    }
} 