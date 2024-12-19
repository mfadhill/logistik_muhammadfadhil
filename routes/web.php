<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\StokController;

Route::resource('barang_masuk', BarangMasukController::class);
Route::resource('barang_keluar', BarangKeluarController::class);
Route::get('stok-barang', [StokController::class, 'index'])->name('stok.barang.index');
