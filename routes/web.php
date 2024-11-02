<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManajemenPenerima\DepartemenBagian\BagianController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('manajemen-penerima')->name('manajemen-penerima.')->group(function () {
    Route::prefix('departemen-bagian')->name('departemen-bagian.')->group(function () {
        Route::get('bagian', [BagianController::class, 'index'])->name('bagian');
        Route::get('/bagian/{bagian}', [BagianController::class, 'show'])->name('bagian.show');
        Route::post('/bagian', [BagianController::class, 'store'])->name('bagian.store');
        Route::put('/bagian/{bagian}', [BagianController::class, 'update'])->name('bagian.update');
        Route::delete('/bagian/{bagian}', [BagianController::class, 'destroy'])->name('bagian.destroy');
    });
});
