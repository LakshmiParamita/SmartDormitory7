<?php

use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WaterController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\BuildingLockController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UnlockingRecordController;
use App\Http\Controllers\ErrorReportController;
use App\Http\Controllers\Staff\ErrorReportController as StaffErrorReportController;

// Redirect root URL ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserLoginController::class, 'login'])->name('login.post');
Route::get('/register', [UserLoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserLoginController::class, 'register'])->name('register.post');
Route::get('/home', [UserLoginController::class, 'index'])->middleware('auth')->name('home');
Route::post('/logout', [UserLoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('penghuni/dashboard', [DashboardController::class, 'index'])->name('penghuni.dashboard');

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

Route::get('gedungs/{id}', [GedungController::class, 'show'])->name('gedungs.show');
Route::post('lamps/{id}/toggle', [GedungController::class, 'toggleLamp'])->name('lamps.toggle');
Route::post('/gedungs/{gedung}/turn-all-on', [GedungController::class, 'turnAllOn']);
Route::post('/gedungs/{gedung}/turn-all-off', [GedungController::class, 'turnAllOff']);
Route::post('/gedungs/{gedung}/schedule', [GedungController::class, 'setSchedule']);
Route::post('/gedungs/{gedung}/lamps', [GedungController::class, 'addLamp']);
Route::delete('/lamps/{lamp}', [GedungController::class, 'deleteLamp']);

Route::get('/gedungs/create', [GedungController::class, 'create'])->name('gedungs.create');
Route::post('/gedungs', [GedungController::class, 'store'])->name('gedungs.store');

Route::get('/gedungs', [GedungController::class, 'index'])->name('gedungs.index');

Route::get('/building-lock', [BuildingLockController::class, 'index'])->name('building-lock.index');
Route::post('/building-lock/{id}/toggle', [BuildingLockController::class, 'toggleLock'])->name('building-lock.toggle');
Route::post('/building-lock/lock-all', [BuildingLockController::class, 'lockAll'])->name('building-lock.lockAll');
Route::post('/building-lock/unlock-all', [BuildingLockController::class, 'unlockAll'])->name('building-lock.unlockAll');

Route::resource('asets', AsetController::class);

// Route::get('/', [BuildingController::class, 'index'])->name('home');
Route::get('videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('videos/create', [VideoController::class, 'create'])->name('videos.create');
Route::post('videos', [VideoController::class, 'store'])->name('videos.store');
Route::get('videos/{id}', [VideoController::class, 'show'])->name('videos.show');

Route::resource('buildings', BuildingController::class);

Route::resource('videos', VideoController::class);

Route::resource('unlocking-records', UnlockingRecordController::class);
Route::get('/unlocking-records', [UnlockingRecordController::class, 'index'])->name('unlocking_records.index');
Route::post('/unlocking-records', [UnlockingRecordController::class, 'store'])->name('unlocking_records.store');

Route::prefix('error-reports')->name('error_reports.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('error_reports.show', 'default-building');
    })->name('index');
    
    Route::get('/{buildingName}', [ErrorReportController::class, 'show'])->name('show');
    Route::get('/{buildingName}/create', [ErrorReportController::class, 'create'])->name('create');
    Route::post('/{buildingName}', [ErrorReportController::class, 'store'])->name('store');
    Route::get('/{buildingName}/edit/{id}', [ErrorReportController::class, 'edit'])->name('edit');
    Route::put('/{buildingName}/update/{id}', [ErrorReportController::class, 'update'])->name('update');
    Route::delete('/{buildingName}/{id}', [ErrorReportController::class, 'destroy'])->name('destroy');
});

// Routes untuk staff
Route::middleware(['auth', 'staff'])->group(function () {
    Route::get('/staff/error-reports', function () {
        return redirect()->route('staff.error-reports.show', 'default-building');
    })->name('staff.error-reports.index');
    
    Route::get('/staff/error-reports/{buildingName}', [StaffErrorReportController::class, 'show'])
        ->name('staff.error-reports.show');
    Route::patch('/staff/error-reports/{errorReport}/update-status', [StaffErrorReportController::class, 'updateStatus'])
        ->name('staff.error-reports.update-status');
});