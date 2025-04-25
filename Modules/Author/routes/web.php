<?php

use Illuminate\Support\Facades\Route;
use Modules\Author\Http\Controllers\AuthorController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('author', AuthorController::class)->names('author');
});
