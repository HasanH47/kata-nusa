<?php

use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

$path = 'routes/web/dashboard';

// Dashboard Routes
Route::group([
  'prefix' => 'dashboard',
], function () use ($path) {
  Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

  // Articles Routes
  require base_path($path . '/articles/article.php');

  // Profiles Routes
  require base_path($path . '/profiles/profile.php');
});
