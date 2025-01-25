<?php

use App\Http\Controllers\Categories\CategoryController;
use Illuminate\Support\Facades\Route;

// Category Routes
Route::group(
    [
        'prefix' => 'categories',
    ],
    function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');

        Route::get('/{category}', [CategoryController::class, 'show'])->name('categories.show');
    },
);
