<?php

use Illuminate\Support\Facades\Route;
use Modules\Content\Http\Controllers\PostController;
use Modules\Content\Http\Controllers\CategoryController;
use Modules\Content\Http\Controllers\PageController;

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

Route::prefix('v1')->group(function () {
    Route::prefix('content')->group(function () {
        // Public routes
        Route::get('posts/slug/{slug}', [PostController::class, 'bySlug']);
        Route::get('categories/slug/{slug}', [CategoryController::class, 'bySlug']);
        Route::get('pages/slug/{slug}', [PageController::class, 'bySlug']);
        Route::get('categories/{id}/posts', [CategoryController::class, 'posts']);
        Route::get('posts/{id}/related', [PostController::class, 'related']);
        Route::get('categories/tree', [CategoryController::class, 'tree']);
        
        // Protected routes
        Route::middleware(['auth:sanctum'])->group(function () {
            // Post routes
            Route::get('posts', [PostController::class, 'index'])->middleware('permission:view posts');
            Route::post('posts', [PostController::class, 'store'])->middleware('permission:create posts');
            Route::get('posts/{id}', [PostController::class, 'show'])->middleware('permission:view posts');
            Route::put('posts/{id}', [PostController::class, 'update'])->middleware('permission:edit posts');
            Route::delete('posts/{id}', [PostController::class, 'destroy'])->middleware('permission:delete posts');
            
            // Category routes
            Route::get('categories', [CategoryController::class, 'index'])->middleware('permission:view categories');
            Route::post('categories', [CategoryController::class, 'store'])->middleware('permission:create categories');
            Route::get('categories/{id}', [CategoryController::class, 'show'])->middleware('permission:view categories');
            Route::put('categories/{id}', [CategoryController::class, 'update'])->middleware('permission:edit categories');
            Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->middleware('permission:delete categories');
            
            // Page routes
            Route::get('pages', [PageController::class, 'index'])->middleware('permission:view pages');
            Route::post('pages', [PageController::class, 'store'])->middleware('permission:create pages');
            Route::get('pages/{id}', [PageController::class, 'show'])->middleware('permission:view pages');
            Route::put('pages/{id}', [PageController::class, 'update'])->middleware('permission:edit pages');
            Route::delete('pages/{id}', [PageController::class, 'destroy'])->middleware('permission:delete pages');
        });
    });
}); 