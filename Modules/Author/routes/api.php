<?php

use Illuminate\Support\Facades\Route;
use Modules\Author\Http\Controllers\AuthorController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('author', AuthorController::class)->names('author');
});
