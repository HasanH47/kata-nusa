<?php

use App\Http\Controllers\Dashboard\Articles\ArticleController;
use Illuminate\Support\Facades\Route;

$articleIdPath = '/{articleId}';

// Dashboard Articles Routes
Route::group(
    [
        'prefix' => 'articles',
    ],
    function () use ($articleIdPath) {
        Route::get('/', [ArticleController::class, 'index'])->name('dashboard.articles.index');
        Route::get('/create', [ArticleController::class, 'create'])->name('dashboard.articles.create');
        Route::post('/store', [ArticleController::class, 'store'])->name('dashboard.articles.store');
        Route::get($articleIdPath, [ArticleController::class, 'edit'])->name('dashboard.articles.edit');
        Route::put($articleIdPath, [ArticleController::class, 'update'])->name('dashboard.articles.update');
        Route::delete($articleIdPath, [ArticleController::class, 'destroy'])->name('dashboard.articles.destroy');
    },
);
