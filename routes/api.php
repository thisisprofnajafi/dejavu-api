<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use Modules\Admin\Http\Controllers\FaqController;
use Modules\Admin\Http\Controllers\FaqCategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes
Route::prefix('v1')->group(function () {
    // Authentication routes
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    
    // Public FAQ routes
    Route::prefix('faqs')->group(function () {
        Route::get('/', [FaqController::class, 'index']);
        Route::get('/{id}', [FaqController::class, 'show']);
        Route::get('/category/{categoryId}', [FaqController::class, 'getByCategory']);
        Route::get('/categories', [FaqCategoryController::class, 'index']);
        Route::get('/categories/{id}', [FaqCategoryController::class, 'show']);
    });
    
    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });
}); 