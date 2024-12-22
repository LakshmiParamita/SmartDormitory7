<?php

use App\Http\Controllers\WaterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::resource('water', WaterController::class);
Route::get('/water', [WaterController::class, 'index'])->name('water.index');
Route::get('/water/create', [WaterController::class, 'getCreateForm'])->name('water.create');
Route::post('/water', [WaterController::class, 'store'])->name('water.store');
Route::get('/water/{water}', [WaterController::class, 'show'])->name('water.show');
Route::get('/water/{water}/edit', [WaterController::class, 'getEditForm'])->name('water.edit');
Route::put('/water/{water}', [WaterController::class, 'update'])->name('water.update');
Route::delete('/water/{water}', [WaterController::class, 'destroy'])->name('water.destroy');
Route::put('/water/{id}/buang', [WaterController::class, 'buangAir'])->name('water.buang');
Route::put('/water/{id}/filter', [WaterController::class, 'filterAir'])->name('water.filter');
