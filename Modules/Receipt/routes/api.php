<?php

use Illuminate\Support\Facades\Route;
use Modules\Receipt\app\Http\Controllers\ReceiptController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {
    // Receipt routes
    Route::apiResource('receipts', ReceiptController::class);
    
    // Visitor-specific receipt routes
    Route::get('visitor/receipts', [ReceiptController::class, 'visitorReceipts']);
    Route::get('visitor/commissions', [ReceiptController::class, 'commissionSummary']);
}); 