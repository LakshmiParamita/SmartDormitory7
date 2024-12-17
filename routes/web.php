<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\VideoController;

// Route untuk halaman utama
Route::get('/', [BuildingController::class, 'index'])->name('home');
Route::get('videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('videos/create', [VideoController::class, 'create'])->name('videos.create');
Route::post('videos', [VideoController::class, 'store'])->name('videos.store');
Route::get('videos/{id}', [VideoController::class, 'show'])->name('videos.show');
