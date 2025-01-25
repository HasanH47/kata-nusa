<?php

use App\Http\Controllers\Authors\AuthorController;
use Illuminate\Support\Facades\Route;

// Author Routes
Route::group(
    [
        'prefix' => 'authors',
    ],
    function () {
        Route::get('/{author}', [AuthorController::class, 'show'])->name('authors.show');
    },
);
