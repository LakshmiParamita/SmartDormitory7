<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\BuildingLockController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('dashboard'); // Mengubah redirect ke route dashboard
});

Route::get('gedungs/{id}', [GedungController::class, 'show'])->name('gedungs.show');
Route::post('lamps/{id}/toggle', [GedungController::class, 'toggleLamp'])->name('lamps.toggle');
Route::post('/gedungs/{gedung}/turn-all-on', [GedungController::class, 'turnAllOn']);
Route::post('/gedungs/{gedung}/turn-all-off', [GedungController::class, 'turnAllOff']);
Route::post('/gedungs/{gedung}/schedule', [GedungController::class, 'setSchedule']);
Route::post('/gedungs/{gedung}/lamps', [GedungController::class, 'addLamp']);
Route::delete('/lamps/{lamp}', [GedungController::class, 'deleteLamp']);

// Tambahkan route baru untuk dashboard
Route::get('/dashboard', [GedungController::class, 'dashboard'])->name('dashboard');

Route::get('/gedungs/create', [GedungController::class, 'create'])->name('gedungs.create');
Route::post('/gedungs', [GedungController::class, 'store'])->name('gedungs.store');

Route::get('/gedungs', [GedungController::class, 'index'])->name('gedungs.index');

Route::get('/building-lock', [BuildingLockController::class, 'index'])->name('building-lock.index');
Route::post('/building-lock/{id}/toggle', [BuildingLockController::class, 'toggleLock'])->name('building-lock.toggle');
Route::post('/building-lock/lock-all', [BuildingLockController::class, 'lockAll'])->name('building-lock.lockAll');
Route::post('/building-lock/unlock-all', [BuildingLockController::class, 'unlockAll'])->name('building-lock.unlockAll');