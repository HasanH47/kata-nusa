<?php

use App\Http\Controllers\Dashboard\Profiles\ProfileController;
use Illuminate\Support\Facades\Route;

// Dashboard Profile Routes
Route::group(
  [
  'prefix' => 'profiles'
],
function () {
  Route::get('/', [ProfileController::class, 'edit'])->name('dashboard.profiles.index');
  Route::put('/', [ProfileController::class, 'update'])->name('dashboard.profiles.update');
},
);
