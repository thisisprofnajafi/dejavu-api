<?php

use Illuminate\Support\Facades\Route;
use Modules\Content\app\Http\Controllers\CategoryController;
use Modules\Content\app\Http\Controllers\PostController;
use Modules\Content\app\Http\Controllers\TagController;
use Modules\Content\app\Http\Controllers\SeoController;
use Modules\Content\app\Http\Controllers\SearchController;
use Modules\Content\app\Http\Controllers\StatsController;

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

// Public routes
Route::prefix('content')->group(function () {
    // Search routes
    Route::get('search', [SearchController::class, 'search']);
    Route::get('popular', [SearchController::class, 'popular']);
    Route::get('related/{postId}', [SearchController::class, 'related']);
    
    // View count
    Route::post('views/increment', [StatsController::class, 'incrementViews']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    // Post routes
    Route::apiResource('posts', PostController::class);
    
    // Category routes
    Route::apiResource('categories', CategoryController::class);
    
    // Tag routes
    Route::apiResource('tags', TagController::class);
    
    // SEO routes
    Route::post('seo', [SeoController::class, 'store']);
    Route::get('seo/{type}/{id}', [SeoController::class, 'show']);
    Route::put('seo/{type}/{id}', [SeoController::class, 'update']);
    Route::delete('seo/{type}/{id}', [SeoController::class, 'destroy']);
    
    // Stats routes
    Route::prefix('stats')->group(function () {
        Route::get('posts', [StatsController::class, 'postStats']);
        Route::get('categories', [StatsController::class, 'categoryStats']);
        Route::get('tags', [StatsController::class, 'tagStats']);
        Route::get('all', [StatsController::class, 'allStats']);
        Route::post('cache/clear', [StatsController::class, 'clearCache']);
    });
}); 