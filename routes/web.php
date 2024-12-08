<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManajemenPenerima\DepartemenBagian\DepartemenController;
use App\Http\Controllers\ManajemenPenerima\DepartemenBagian\BagianController;
use App\Http\Controllers\ManajemenPenerima\KuotaController;
use App\Http\Controllers\ManajemenPenerima\PenerimaController;
use App\Http\Controllers\ManajemenPenerima\StatusController;
use App\Http\Controllers\ManajemenProdukSupplier\ProdukKategori\KategoriController;
use App\Http\Controllers\ManajemenProdukSupplier\ProdukKategori\ProdukController;
use App\Http\Controllers\ManajemenProdukSupplier\SupplierController;
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
    Route::get('/bagian-by-departemen/{departemen}', [PenerimaController::class, 'getBagianByDepartemen'])->name('bagian.by.departemen');

    Route::get('/kuota', [KuotaController::class, 'index'])->name('kuota');
    Route::get('/kuota/{kuota}', [KuotaController::class, 'show'])->name('kuota.show');
    Route::post('/kuota', [KuotaController::class, 'store'])->name('kuota.store');
    Route::put('/kuota/{kuota}', [KuotaController::class, 'update'])->name('kuota.update');
    Route::delete('/kuota/{kuota}', [KuotaController::class, 'destroy'])->name('kuota.destroy');

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
    Route::prefix('produk-kategori')->name('produk-kategori.')->group(function () {
        Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
        Route::get('/produk/{produk}', [ProdukController::class, 'show'])->name('produk.show');
        Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
        Route::put('/produk/{produk}', [ProdukController::class, 'update'])->name('produk.update');
        Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');

        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
        Route::get('/kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    });

    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
    Route::get('/supplier/{supplier}', [SupplierController::class, 'show'])->name('supplier.show');
    Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
    Route::put('/supplier/{supplier}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::delete('/supplier/{supplier}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
});
