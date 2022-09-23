<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('dashboard/index');
});

// Route::get('/barang', [BarangController::class, 'index']);

Route::resource('/barang', BarangController::class);

Route::resource('/tipe', TipeController::class);

Route::resource('/transaksi', TransaksiController::class);

Route::get('/search',[BarangController::class, 'search']);

Route::get('/searchh',[TipeController::class, 'search']);

Route::get('/searchhh',[TransaksiController::class, 'search']);

Route::post('/urut',[TransaksiController::class, 'urut']);

Route::post('/uruttanggal',[TransaksiController::class, 'uruttanggal']);

Route::post('/urutjual',[TransaksiController::class, 'urutjual']);