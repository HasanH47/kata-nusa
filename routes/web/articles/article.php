<?php

use App\Http\Controllers\Articles\ArticleController;
use Illuminate\Support\Facades\Route;

// Article Routes
Route::group([
  'prefix' => 'articles',
], function () {
  Route::get('/', [ArticleController::class, 'index'])->name('articles.index');

  Route::get('/{article}', [ArticleController::class, 'show'])->name('articles.show');
});
