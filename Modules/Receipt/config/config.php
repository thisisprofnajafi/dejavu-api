<?php

return [
    'name' => 'Receipt',
    
    // Default pagination settings
    'pagination' => [
        'per_page' => 15,
    ],
    
    // Receipt statuses
    'statuses' => [
        'pending' => 'pending',
        'paid' => 'paid',
        'failed' => 'failed',
        'refunded' => 'refunded',
        'partially_refunded' => 'partially_refunded',
        'canceled' => 'canceled'
    ],
    
    // Payment methods
    'payment_methods' => [
        'credit_card' => 'Credit Card',
        'bank_transfer' => 'Bank Transfer',
        'paypal' => 'PayPal',
        'cash' => 'Cash',
        'wallet' => 'Wallet',
        'other' => 'Other'
    ],
    
    // Default currency
    'currency' => 'USD',
    
    // Receipt number prefix and sequence start
    'receipt_number' => [
        'prefix' => 'REC-',
        'sequence_start' => 10000
    ],
    
    // Receipt expiry time in days
    'expiry_days' => 30,
]; 