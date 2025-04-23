<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\DashboardController;
use Modules\Admin\Http\Controllers\SettingsController;
use Modules\Admin\Http\Controllers\UserController;
use Modules\Admin\Http\Controllers\RoleController;

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

Route::prefix('v1')->middleware(['auth:sanctum'])->group(function () {
    Route::prefix('admin')->group(function () {
        // Dashboard routes
        Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('permission:view dashboard');
        
        // Settings routes
        Route::prefix('settings')->middleware('permission:manage settings')->group(function () {
            Route::get('/', [SettingsController::class, 'index']);
            Route::get('/{type}', [SettingsController::class, 'getSettingsByType']);
            Route::put('/{type}', [SettingsController::class, 'updateSettings']);
        });
        
        // User management routes
        Route::prefix('users')->middleware('permission:manage users')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::post('/', [UserController::class, 'store']);
            Route::get('/{id}', [UserController::class, 'show']);
            Route::put('/{id}', [UserController::class, 'update']);
            Route::delete('/{id}', [UserController::class, 'destroy']);
            Route::post('/{id}/roles', [UserController::class, 'assignRoles']);
            Route::post('/{id}/permissions', [UserController::class, 'assignPermissions']);
        });
        
        // Role and permission management routes
        Route::prefix('roles')->middleware('permission:manage roles')->group(function () {
            Route::get('/', [RoleController::class, 'index']);
            Route::post('/', [RoleController::class, 'store']);
            Route::get('/{id}', [RoleController::class, 'show']);
            Route::put('/{id}', [RoleController::class, 'update']);
            Route::delete('/{id}', [RoleController::class, 'destroy']);
            Route::post('/{id}/permissions', [RoleController::class, 'assignPermissions']);
            
            // Permission routes
            Route::get('/permissions/all', [RoleController::class, 'permissions']);
            Route::post('/permissions', [RoleController::class, 'createPermission']);
        });
    });
}); 