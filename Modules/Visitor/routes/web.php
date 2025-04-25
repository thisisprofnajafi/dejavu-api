<?php

use Illuminate\Support\Facades\Route;
use Modules\Visitor\Http\Controllers\VisitorController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('visitor', VisitorController::class)->names('visitor');
});
