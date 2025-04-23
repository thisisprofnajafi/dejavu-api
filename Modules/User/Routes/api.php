<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

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
    // User management routes
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->middleware('permission:list users');
        Route::post('/', [UserController::class, 'store'])->middleware('permission:create user');
        Route::get('/{id}', [UserController::class, 'show'])->middleware('permission:list users');
        Route::put('/{id}', [UserController::class, 'update'])->middleware('permission:edit user');
        Route::delete('/{id}', [UserController::class, 'destroy'])->middleware('permission:delete user');
    });
}); 