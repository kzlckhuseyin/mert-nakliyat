<?php

use App\Http\Controllers\CommissionController;
use App\Http\Controllers\OperationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('nakliye.index');
});

// Nakliye İşlemleri
Route::prefix('nakliye')->name('nakliye.')->group(function () {
    Route::get('/', [OperationController::class, 'index'])->name('index');
    Route::get('/ekle', [OperationController::class, 'create'])->name('create');
    Route::post('/', [OperationController::class, 'store'])->name('store');
    Route::get('/{operation}/duzenle', [OperationController::class, 'edit'])->name('edit');
    Route::put('/{operation}', [OperationController::class, 'update'])->name('update');
    Route::delete('/{operation}', [OperationController::class, 'destroy'])->name('destroy');
});

// Komisyon İşlemleri
Route::prefix('masraf')->name('komisyon.')->group(function () {
    Route::get('/', [CommissionController::class, 'index'])->name('index');
    Route::get('/ekle', [CommissionController::class, 'create'])->name('create');
    Route::post('/', [CommissionController::class, 'store'])->name('store');
    Route::delete('/{commission}', [CommissionController::class, 'destroy'])->name('destroy');
});
