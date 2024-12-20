<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\StokController;

Route::get('/', function () {
    return view('home');
});

Route::resource('barang_masuk', BarangMasukController::class);
Route::resource('barang_keluar', BarangKeluarController::class);
Route::get('stok-barang', [StokController::class, 'index'])->name('stok.barang.index');
Route::delete('/stok/{kode_barang}', [StokController::class, 'destroy'])->name('stok.delete');
