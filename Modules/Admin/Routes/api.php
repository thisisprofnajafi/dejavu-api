<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\DashboardController;
use Modules\Admin\Http\Controllers\SettingsController;

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

Route::prefix('v1')->middleware(['auth:sanctum', 'permission:view dashboard'])->group(function () {
    Route::prefix('admin')->group(function () {
        // Dashboard routes
        Route::get('/dashboard', [DashboardController::class, 'index']);
        
        // Settings routes
        Route::prefix('settings')->group(function () {
            Route::get('/', [SettingsController::class, 'index'])->middleware('permission:manage settings');
            Route::get('/{type}', [SettingsController::class, 'getSettingsByType'])->middleware('permission:manage settings');
            Route::put('/{type}', [SettingsController::class, 'updateSettings'])->middleware('permission:manage settings');
        });
    });
}); 