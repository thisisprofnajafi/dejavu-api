<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\DashboardController;
use Modules\Admin\Http\Controllers\SettingsController;
use Modules\Admin\Http\Controllers\UserController;
use Modules\Admin\Http\Controllers\RoleController;
use Modules\Admin\Http\Controllers\FaqController;
use Modules\Admin\Http\Controllers\FaqCategoryController;
use Modules\Admin\Http\Controllers\CustomerController;
use Modules\Admin\Http\Controllers\TicketController;

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
            
            // Resume Settings routes
            Route::prefix('resume')->group(function () {
                Route::get('/service-duration', [SettingsController::class, 'getResumeDurationSettings']);
                Route::put('/service-duration', [SettingsController::class, 'updateResumeDurationSettings']);
                Route::get('/pricing', [SettingsController::class, 'getResumePricingSettings']);
                Route::put('/pricing', [SettingsController::class, 'updateResumePricingSettings']);
                Route::get('/notifications', [SettingsController::class, 'getResumeNotificationSettings']);
                Route::put('/notifications', [SettingsController::class, 'updateResumeNotificationSettings']);
            });
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
        
        // Customer management routes
        Route::prefix('customers')->middleware('permission:manage customers')->group(function () {
            Route::get('/', [CustomerController::class, 'index']);
            Route::post('/', [CustomerController::class, 'store']);
            Route::get('/{id}', [CustomerController::class, 'show']);
            Route::put('/{id}', [CustomerController::class, 'update']);
            Route::delete('/{id}', [CustomerController::class, 'destroy']);
        });
        
        // FAQ management routes
        Route::prefix('faqs')->middleware('permission:manage faqs')->group(function () {
            // FAQ Category routes
            Route::prefix('categories')->group(function () {
                Route::get('/', [FaqCategoryController::class, 'index']);
                Route::post('/', [FaqCategoryController::class, 'store']);
                Route::get('/{id}', [FaqCategoryController::class, 'show']);
                Route::put('/{id}', [FaqCategoryController::class, 'update']);
                Route::delete('/{id}', [FaqCategoryController::class, 'destroy']);
            });
            
            // FAQ routes
            Route::get('/', [FaqController::class, 'index']);
            Route::post('/', [FaqController::class, 'store']);
            Route::get('/{id}', [FaqController::class, 'show']);
            Route::put('/{id}', [FaqController::class, 'update']);
            Route::delete('/{id}', [FaqController::class, 'destroy']);
            Route::post('/order', [FaqController::class, 'updateOrder']);
            Route::get('/category/{categoryId}', [FaqController::class, 'getByCategory']);
        });
        
        // Ticket System routes
        Route::prefix('tickets')->middleware('permission:manage tickets')->group(function () {
            Route::get('/', [TicketController::class, 'index']);
            Route::post('/', [TicketController::class, 'store']);
            Route::get('/{id}', [TicketController::class, 'show']);
            Route::put('/{id}', [TicketController::class, 'update']);
            Route::delete('/{id}', [TicketController::class, 'destroy']);
            
            // Ticket status management
            Route::put('/{id}/status', [TicketController::class, 'updateStatus']);
            Route::put('/{id}/assign', [TicketController::class, 'assignTicket']);
            
            // Ticket comments
            Route::post('/{id}/comments', [TicketController::class, 'addComment']);
            Route::get('/{id}/comments', [TicketController::class, 'getComments']);
        });
    });
}); 