<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

$path = 'routes/web';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/trending', [HomeController::class, 'trending'])->name('trending');

// Articles Routes
require base_path($path . '/articles/article.php');

// Categories Routes
require base_path($path . '/categories/category.php');

// Authors Routes
require base_path($path . '/authors/author.php');

// Protected Routes
Route::middleware('auth')->group(function () use ($path) {
    // Dashboard Routes
    require base_path($path . '/dashboard/dashboard.php');

    // Logout Route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Fallback Route for 404
Route::fallback(function () {
    return view('errors.404');
});
