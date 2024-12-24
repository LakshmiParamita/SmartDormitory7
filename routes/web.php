<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ErrorReportController;

Route::prefix('error-reports')->name('error_reports.')->group(function () {
    Route::get('/', [ErrorReportController::class, 'index'])->name('index');
    Route::get('/{buildingName}', [ErrorReportController::class, 'show'])->name('show');
    Route::get('/{buildingName}/create', [ErrorReportController::class, 'create'])->name('create');
    Route::post('/{buildingName}', [ErrorReportController::class, 'store'])->name('store');
    Route::get('/{buildingName}/edit/{id}', [ErrorReportController::class, 'edit'])->name('edit');
    Route::put('/{buildingName}/update/{id}', [ErrorReportController::class, 'update'])->name('update');
    Route::delete('/{buildingName}/{id}', [ErrorReportController::class, 'destroy'])->name('destroy');
});
