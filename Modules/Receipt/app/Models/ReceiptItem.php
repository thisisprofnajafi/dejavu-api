<?php

namespace Modules\Receipt\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReceiptItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt_id',
        'product_id',
        'product_type',
        'name',
        'description',
        'quantity',
        'unit_price',
        'tax_rate',
        'tax_amount',
        'discount_amount',
        'subtotal',
        'total',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    /**
     * Get the receipt that owns the item.
     */
    public function receipt(): BelongsTo
    {
        return $this->belongsTo(Receipt::class);
    }

    /**
     * Get the related product.
     */
    public function product()
    {
        return $this->morphTo();
    }

    /**
     * Calculate the subtotal (unit price * quantity).
     */
    public function calculateSubtotal(): float
    {
        return $this->unit_price * $this->quantity;
    }

    /**
     * Calculate the tax amount.
     */
    public function calculateTaxAmount(): float
    {
        $subtotal = $this->calculateSubtotal();
        return round($subtotal * ($this->tax_rate / 100), 2);
    }

    /**
     * Calculate the total (subtotal + tax - discount).
     */
    public function calculateTotal(): float
    {
        $subtotal = $this->calculateSubtotal();
        $taxAmount = $this->calculateTaxAmount();
        return round($subtotal + $taxAmount - $this->discount_amount, 2);
    }

    /**
     * Update the calculated fields.
     */
    public function updateCalculatedFields(): self
    {
        $this->subtotal = $this->calculateSubtotal();
        $this->tax_amount = $this->calculateTaxAmount();
        $this->total = $this->calculateTotal();
        
        return $this;
    }
} 