<?php

use App\Http\Controllers\Dashboard\Articles\ArticleController;
use Illuminate\Support\Facades\Route;

// Dashboard Articles Routes
Route::group([
  'prefix' => 'articles',
], function () {
  Route::get('/', [ArticleController::class, 'index'])->name('dashboard.articles.index');

  Route::get('/create', [ArticleController::class, 'create'])->name('dashboard.articles.create');
});
