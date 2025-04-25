<?php

namespace Modules\Receipt\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Receipt extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'receipt_number',
        'user_id',
        'visitor_id',
        'total_amount',
        'tax_amount',
        'discount_amount',
        'payment_method',
        'payment_status',
        'currency',
        'notes',
        'billing_address',
        'shipping_address',
        'payment_date',
        'due_date',
        'metadata'
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'due_date' => 'datetime',
        'metadata' => 'array',
        'billing_address' => 'array',
        'shipping_address' => 'array',
    ];

    /**
     * Get the user that owns the receipt.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the visitor that referred the receipt.
     */
    public function visitor(): BelongsTo
    {
        return $this->belongsTo('Modules\Visitor\app\Models\Visitor');
    }

    /**
     * Get the receipt items for the receipt.
     */
    public function items(): HasMany
    {
        return $this->hasMany(ReceiptItem::class);
    }

    /**
     * Scope a query to only include receipts with a specific status.
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('payment_status', $status);
    }

    /**
     * Scope a query to only include receipts for a specific user.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope a query to only include receipts for a specific visitor.
     */
    public function scopeForVisitor($query, $visitorId)
    {
        return $query->where('visitor_id', $visitorId);
    }

    /**
     * Calculate the commission amount based on the receipt total.
     */
    public function getCommissionAmountAttribute()
    {
        // If this receipt has a visitor, calculate the commission
        if ($this->visitor && $this->payment_status === config('receipt.statuses.paid')) {
            $commissionRate = $this->visitor->commission_rate ?? 0.05; // Default 5% if not set
            return round($this->total_amount * $commissionRate, 2);
        }
        
        return 0;
    }

    /**
     * Check if the receipt is paid.
     */
    public function isPaid(): bool
    {
        return $this->payment_status === config('receipt.statuses.paid');
    }

    /**
     * Check if the receipt is overdue.
     */
    public function isOverdue(): bool
    {
        return $this->due_date && $this->due_date->isPast() && 
               $this->payment_status === config('receipt.statuses.pending');
    }

    /**
     * Generate a new receipt number.
     */
    public static function generateReceiptNumber(): string
    {
        $prefix = config('receipt.receipt_number.prefix', 'REC-');
        $sequenceStart = config('receipt.receipt_number.sequence_start', 10000);
        
        $lastReceipt = self::orderBy('id', 'desc')->first();
        
        if ($lastReceipt) {
            $lastNumber = intval(str_replace($prefix, '', $lastReceipt->receipt_number));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = $sequenceStart;
        }
        
        return $prefix . $newNumber;
    }
} 