<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('dashboard/index');
});

Route::resource('/barang', BarangController::class);

Route::resource('/tipe', TipeController::class);

Route::resource('/transaksi', TransaksiController::class);

Route::get('/uruttanggal',[TransaksiController::class, 'uruttanggal']);
