<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManajemenPenerima\DepartemenBagian\DepartemenController;
use App\Http\Controllers\ManajemenPenerima\DepartemenBagian\BagianController;
use App\Http\Controllers\ManajemenPenerima\PenerimaController;
use App\Http\Controllers\ManajemenPenerima\StatusController;
use App\Http\Controllers\ManajemenProdukSupplier\Produk\KategoriController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('manajemen-penerima')->name('manajemen-penerima.')->group(function () {
    Route::get('/penerima', [PenerimaController::class, 'index'])->name('penerima');
    Route::get('/penerima/{penerima}', [PenerimaController::class, 'show'])->name('penerima.show');
    Route::post('/penerima', [PenerimaController::class, 'store'])->name('penerima.store');
    Route::put('/penerima/{penerima}', [PenerimaController::class, 'update'])->name('penerima.update');
    Route::delete('/penerima/{penerima}', [PenerimaController::class, 'destroy'])->name('penerima.destroy');

    Route::prefix('departemen-bagian')->name('departemen-bagian.')->group(function () {
        Route::get('/departemen', [DepartemenController::class, 'index'])->name('departemen');
        Route::get('/departemen/{departemen}', [DepartemenController::class, 'show'])->name('departemen.show');
        Route::post('/departemen', [DepartemenController::class, 'store'])->name('departemen.store');
        Route::put('/departemen/{departemen}', [DepartemenController::class, 'update'])->name('departemen.update');
        Route::delete('/departemen/{departemen}', [DepartemenController::class, 'destroy'])->name('departemen.destroy');

        Route::get('bagian', [BagianController::class, 'index'])->name('bagian');
        Route::get('/bagian/{bagian}', [BagianController::class, 'show'])->name('bagian.show');
        Route::post('/bagian', [BagianController::class, 'store'])->name('bagian.store');
        Route::put('/bagian/{bagian}', [BagianController::class, 'update'])->name('bagian.update');
        Route::delete('/bagian/{bagian}', [BagianController::class, 'destroy'])->name('bagian.destroy');
    });

    Route::get('/status', [StatusController::class, 'index'])->name('status');
    Route::get('/status/{status}', [StatusController::class, 'show'])->name('status.show');
    Route::post('/status', [StatusController::class, 'store'])->name('status.store');
    Route::put('/status/{status}', [StatusController::class, 'update'])->name('status.update');
    Route::delete('/status/{status}', [StatusController::class, 'destroy'])->name('status.destroy');
});

Route::prefix('manajemen-produk-supplier')->name('manajemen-produk-supplier.')->group(function () {
    Route::prefix('produk')->name('produk.')->group(function () {
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
        Route::get('/kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    });
});
