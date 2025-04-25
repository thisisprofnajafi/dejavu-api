<?php

namespace Modules\Receipt\app\Services;

use Illuminate\Support\Facades\DB;
use Modules\Receipt\app\Models\Receipt;
use Modules\Receipt\app\Models\ReceiptItem;

class ReceiptService
{
    /**
     * Create a new receipt with its items.
     *
     * @param array $data
     * @return Receipt
     */
    public function createReceipt(array $data): Receipt
    {
        return DB::transaction(function () use ($data) {
            // Extract items from the data
            $items = $data['items'] ?? [];
            unset($data['items']);
            
            // Generate receipt number
            $data['receipt_number'] = Receipt::generateReceiptNumber();
            
            // Create the receipt
            $receipt = Receipt::create($data);
            
            // Add items to the receipt
            if (!empty($items)) {
                $this->addItemsToReceipt($receipt, $items);
            }
            
            // Calculate totals and update the receipt
            $this->updateReceiptTotals($receipt);
            
            return $receipt->fresh(['items']);
        });
    }
    
    /**
     * Update an existing receipt.
     *
     * @param Receipt $receipt
     * @param array $data
     * @return Receipt
     */
    public function updateReceipt(Receipt $receipt, array $data): Receipt
    {
        return DB::transaction(function () use ($receipt, $data) {
            // Update receipt fields
            $receipt->update($data);
            
            // If payment status changed to paid and payment date is not set, set it to now
            if (isset($data['payment_status']) && 
                $data['payment_status'] === config('receipt.statuses.paid') && 
                !$receipt->payment_date) {
                $receipt->payment_date = now();
                $receipt->save();
            }
            
            return $receipt->fresh(['items']);
        });
    }
    
    /**
     * Add items to a receipt.
     *
     * @param Receipt $receipt
     * @param array $items
     * @return void
     */
    public function addItemsToReceipt(Receipt $receipt, array $items): void
    {
        foreach ($items as $itemData) {
            // Set the receipt_id
            $itemData['receipt_id'] = $receipt->id;
            
            // Set default values for tax_rate and discount_amount if not provided
            $itemData['tax_rate'] = $itemData['tax_rate'] ?? 0;
            $itemData['discount_amount'] = $itemData['discount_amount'] ?? 0;
            
            // Create the item
            $item = new ReceiptItem($itemData);
            
            // Calculate and set the subtotal, tax_amount, and total
            $item->subtotal = $item->calculateSubtotal();
            $item->tax_amount = $item->calculateTaxAmount();
            $item->total = $item->calculateTotal();
            
            $item->save();
        }
    }
    
    /**
     * Remove items from a receipt.
     *
     * @param Receipt $receipt
     * @param array $itemIds
     * @return void
     */
    public function removeItemsFromReceipt(Receipt $receipt, array $itemIds): void
    {
        $receipt->items()->whereIn('id', $itemIds)->delete();
        $this->updateReceiptTotals($receipt);
    }
    
    /**
     * Update the totals for a receipt based on its items.
     *
     * @param Receipt $receipt
     * @return Receipt
     */
    public function updateReceiptTotals(Receipt $receipt): Receipt
    {
        $items = $receipt->items;
        
        // Calculate totals
        $subtotal = $items->sum('subtotal');
        $taxAmount = $items->sum('tax_amount');
        $discountAmount = $items->sum('discount_amount');
        $totalAmount = $items->sum('total');
        
        // Update receipt
        $receipt->total_amount = $totalAmount;
        $receipt->tax_amount = $taxAmount;
        $receipt->discount_amount = $discountAmount;
        $receipt->save();
        
        return $receipt;
    }
    
    /**
     * Generate a PDF receipt.
     *
     * @param Receipt $receipt
     * @return mixed
     */
    public function generatePdf(Receipt $receipt)
    {
        // Implementation depends on the PDF generation library you choose
        // This is a placeholder for the actual implementation
        
        return "PDF for receipt #{$receipt->receipt_number}";
    }
    
    /**
     * Send receipt by email.
     *
     * @param Receipt $receipt
     * @param string $email
     * @return bool
     */
    public function sendByEmail(Receipt $receipt, string $email): bool
    {
        // Implementation depends on your mailing service
        // This is a placeholder for the actual implementation
        
        return true;
    }
} 