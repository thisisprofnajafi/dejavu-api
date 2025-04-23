<?php

use Illuminate\Support\Facades\Route;
use Modules\Role\Http\Controllers\RoleController;
use Modules\Role\Http\Controllers\PermissionController;
use Modules\Role\Http\Controllers\UserRoleController;

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

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    // Role routes
    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->middleware('permission:list roles');
        Route::post('/', [RoleController::class, 'store'])->middleware('permission:create role');
        Route::get('/{id}', [RoleController::class, 'show'])->middleware('permission:list roles');
        Route::put('/{id}', [RoleController::class, 'update'])->middleware('permission:edit role');
        Route::delete('/{id}', [RoleController::class, 'destroy'])->middleware('permission:delete role');
    });

    // Permission routes
    Route::prefix('permissions')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->middleware('permission:list permissions');
        Route::post('/', [PermissionController::class, 'store'])->middleware('permission:assign permission');
        Route::get('/{id}', [PermissionController::class, 'show'])->middleware('permission:list permissions');
        Route::put('/{id}', [PermissionController::class, 'update'])->middleware('permission:assign permission');
        Route::delete('/{id}', [PermissionController::class, 'destroy'])->middleware('permission:assign permission');
    });

    // User-Role routes
    Route::prefix('user-roles')->group(function () {
        Route::post('/{userId}/assign', [UserRoleController::class, 'assignRoles'])->middleware('permission:edit role');
        Route::get('/{userId}', [UserRoleController::class, 'getUserRoles'])->middleware('permission:list roles');
        Route::get('/role/{roleId}/users', [UserRoleController::class, 'getUsersByRole'])->middleware('permission:list users');
        Route::post('/{userId}/remove', [UserRoleController::class, 'removeRole'])->middleware('permission:edit role');
    });
}); 