<?php

use App\Http\Controllers\Dashboard\Profiles\ProfileController;
use Illuminate\Support\Facades\Route;

// Dashboard Profile Routes
Route::get('/profile', [ProfileController::class, 'index'])->name('dashboard.profile');
