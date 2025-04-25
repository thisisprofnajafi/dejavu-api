<?php

use Illuminate\Support\Facades\Route;
use Modules\Support\app\Http\Controllers\TicketController;
use Modules\Support\app\Http\Controllers\FaqController;
use Modules\Support\app\Http\Controllers\FaqCategoryController;
use Modules\Support\app\Http\Controllers\ContactFormController;

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

Route::prefix('v1/support')->group(function () {
    // Public routes for FAQs
    Route::prefix('faqs')->group(function () {
        Route::get('/', [FaqController::class, 'index']);
        Route::get('/{id}', [FaqController::class, 'show']);
        Route::get('/category/{categoryId}', [FaqController::class, 'getByCategory']);
    });
    
    Route::prefix('faq-categories')->group(function () {
        Route::get('/', [FaqCategoryController::class, 'index']);
        Route::get('/{id}', [FaqCategoryController::class, 'show']);
    });
    
    // Public route for contact form submission
    Route::post('/contact', [ContactFormController::class, 'store']);
    
    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        // Ticket routes
        Route::prefix('tickets')->group(function () {
            Route::get('/', [TicketController::class, 'index']);
            Route::post('/', [TicketController::class, 'store']);
            Route::get('/{id}', [TicketController::class, 'show']);
            Route::put('/{id}', [TicketController::class, 'update']);
            Route::patch('/{id}/status', [TicketController::class, 'changeStatus']);
            Route::post('/{id}/responses', [TicketController::class, 'addResponse']);
            Route::get('/attachments/{attachmentId}/download', [TicketController::class, 'downloadAttachment']);
        });
        
        // Admin-only routes
        Route::middleware('role:admin')->group(function () {
            // FAQ management routes
            Route::prefix('admin/faqs')->group(function () {
                Route::post('/', [FaqController::class, 'store']);
                Route::put('/{id}', [FaqController::class, 'update']);
                Route::delete('/{id}', [FaqController::class, 'destroy']);
                Route::post('/reorder', [FaqController::class, 'reorder']);
            });
            
            // FAQ category management routes
            Route::prefix('admin/faq-categories')->group(function () {
                Route::post('/', [FaqCategoryController::class, 'store']);
                Route::put('/{id}', [FaqCategoryController::class, 'update']);
                Route::delete('/{id}', [FaqCategoryController::class, 'destroy']);
                Route::post('/reorder', [FaqCategoryController::class, 'reorder']);
            });
            
            // Contact form management routes
            Route::prefix('admin/contact-forms')->group(function () {
                Route::get('/', [ContactFormController::class, 'index']);
                Route::get('/{id}', [ContactFormController::class, 'show']);
                Route::put('/{id}', [ContactFormController::class, 'update']);
                Route::delete('/{id}', [ContactFormController::class, 'destroy']);
                Route::get('/stats', [ContactFormController::class, 'stats']);
            });
        });
    });
}); 