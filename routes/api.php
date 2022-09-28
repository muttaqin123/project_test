<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiTransaksiController;
use App\Http\Controllers\API\ApiBarangController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('transaksi', [ApiTransaksiController::class, 'index']);
Route::post('transaksi/store', [ApiTransaksiController::class, 'store']);
Route::get('transaksi/show/{id}', [ApiTransaksiController::class, 'show']);
Route::post('transaksi/update/{id}', [ApiTransaksiController::class, 'update']);
Route::get('transaksi/destroy/{id}', [ApiTransaksiController::class, 'destroy']);

Route::get('barang', [ApiBarangController::class, 'index']);
Route::get('barang/show/{id}', [ApiBarangController::class, 'show']);
Route::post('barang/update/{id}', [ApiBarangController::class, 'update']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});