<?php

use App\Http\Controllers\AsetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::resource('asets', AsetController::class);
