<?php

use Illuminate\Support\Facades\Route;
use Modules\Role\Http\Controllers\PermissionController;
use Modules\Role\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Defines API routes for the Role module
|
*/

// Public routes (accessible only by authenticated users)
Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    // Role routes
    Route::get('roles', [RoleController::class, 'index'])->middleware('can:view roles');
    Route::post('roles', [RoleController::class, 'store'])->middleware('can:create roles');
    Route::get('roles/{id}', [RoleController::class, 'show'])->middleware('can:view roles');
    Route::put('roles/{id}', [RoleController::class, 'update'])->middleware('can:edit roles');
    Route::delete('roles/{id}', [RoleController::class, 'destroy'])->middleware('can:delete roles');
    
    // Special role routes
    Route::get('permissions', [RoleController::class, 'getAllPermissions'])->middleware('can:view permissions');
    Route::post('roles/{id}/permissions', [RoleController::class, 'assignPermissions'])->middleware('can:edit roles');
    
    // Permission routes
    Route::get('permissions', [PermissionController::class, 'index'])->middleware('can:view permissions');
    Route::post('permissions', [PermissionController::class, 'store'])->middleware('can:create permissions');
    Route::get('permissions/{id}', [PermissionController::class, 'show'])->middleware('can:view permissions');
    Route::put('permissions/{id}', [PermissionController::class, 'update'])->middleware('can:edit permissions');
    Route::delete('permissions/{id}', [PermissionController::class, 'destroy'])->middleware('can:delete permissions');
    
    // Special permission routes
    Route::get('permissions/{id}/roles', [PermissionController::class, 'getRoles'])->middleware('can:view roles');
});
