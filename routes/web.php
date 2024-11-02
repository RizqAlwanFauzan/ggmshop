<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManajemenPenerima\DepartemenBagian\DepartemenController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('manajemen-penerima')->name('manajemen-penerima.')->group(function () {
    Route::prefix('departemen-bagian')->name('departemen-bagian.')->group(function () {
        Route::get('/departemen', [DepartemenController::class, 'index'])->name('departemen');
        Route::get('/departemen/{departemen}', [DepartemenController::class, 'show'])->name('departemen.show');
        Route::post('/departemen', [DepartemenController::class, 'store'])->name('departemen.store');
        Route::put('/departemen/{departemen}', [DepartemenController::class, 'update'])->name('departemen.update');
        Route::delete('/departemen/{departemen}', [DepartemenController::class, 'destroy'])->name('departemen.destroy');
    });
});
