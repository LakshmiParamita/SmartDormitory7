<?php

use App\Http\Controllers\UserLoginController;

Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserLoginController::class, 'login'])->name('login.post');
Route::get('/register', [UserLoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserLoginController::class, 'register'])->name('register.post');
Route::get('/home', [UserLoginController::class, 'index'])->middleware('auth')->name('home');
Route::post('/logout', [UserLoginController::class, 'logout'])->middleware('auth')->name('logout');
