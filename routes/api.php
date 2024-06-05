<?php

use App\Events\DataReceived;
use App\Http\Controllers\api\ApiDashboardController;
use App\Http\Controllers\api\ApiLaporanPenjualanController;
use App\Http\Controllers\api\ApiPesananController;
use App\Http\Controllers\api\ApiProdukController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Pesanan
Route::post('showDataProduk', [ApiPesananController::class, 'showDataProduk'])->name('showDataProduk');
Route::post('getDataProduk', [ApiPesananController::class, 'getDataProduk'])->name('getDataProduk');
Route::post('updatestatuspesanan', [ApiPesananController::class, 'updatestatuspesanan'])->name('updatestatuspesanan');



// Dashboard
Route::post('laporan.penjualan', [ApiDashboardController::class, 'getData'])->name('laporan.penjualan');
// Laporan Penjualan
Route::post('getData.laporan.penjualan', [ApiLaporanPenjualanController::class, 'getData'])->name('getData.laporan.penjualan');
Route::post('cetak_pdf', [ApiLaporanPenjualanController::class, 'cetak_pdf'])->name('cetak_pdf');




// API MOBILE
// Login User With API
Route::post('login/loginApi', [LoginController::class, 'loginMobile']);
// Search Produk
Route::post('produk/findData', [ApiProdukController::class, 'findData']);

