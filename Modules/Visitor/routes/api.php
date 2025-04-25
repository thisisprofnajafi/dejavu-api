<?php

use Illuminate\Support\Facades\Route;
use Modules\Visitor\Http\Controllers\VisitorController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('visitor', VisitorController::class)->names('visitor');
});
