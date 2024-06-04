<?php

use App\Events\OrderShipped;
use App\Http\Controllers\cekPesananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisProdukController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\ListPesananController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StatusPesananController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [cekPesananController::class, 'index'])->middleware('guest');
Route::get('detailpesanan', [cekPesananController::class, 'show'])->middleware('guest');
Route::post('uploadbuktipembayaran', [cekPesananController::class, 'uploadbuktipembayaran'])->middleware('guest');


Route::get('test-socket', function () {
    return view('socket.test');
});
Route::get('home', function () {
    return view('pages.cek.cekpesanan');
})->middleware('guest');

Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth');



// LOGIN
Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('signin', [LoginController::class, 'authentication'])->middleware('guest');
Route::get('registrasi', [LoginController::class, 'registrasi'])->middleware('guest');
Route::post('signup', [LoginController::class, 'signup'])->middleware('guest');
Route::get('logout', [LoginController::class, 'logout'])->middleware('auth');

// USER
Route::get('setting', [UserController::class, 'index'])->middleware('auth');
Route::post('update-profile/{id}', [UserController::class, 'update'])->middleware('auth');

// PENSANAN
Route::get('pesanan', [PesananController::class, 'index'])->middleware('auth');
Route::get('tambahpesanan', [PesananController::class, 'create'])->middleware('auth');
Route::post('tambahpesanan/submit', [PesananController::class, 'store'])->middleware('auth');
Route::get('editpesanan/{id}', [PesananController::class, 'edit'])->middleware('auth');
Route::get('hapuspesanan/{id}', [PesananController::class, 'destroy'])->middleware('auth');
Route::get('listpesananowner/{id}', [PesananController::class, 'listpesananowner'])->middleware('auth');

// LIST PESANAN
Route::get('listpesanan', [ListPesananController::class, 'index'])->middleware('auth');
Route::post('updatelistpesanan/{id}', [ListPesananController::class, 'update'])->middleware('auth');

// STATUS
Route::get('status', [StatusPesananController::class, 'index'])->middleware('auth');

// PRODUK
Route::get('produk', [ProdukController::class, 'index'])->middleware('auth');
Route::get('produk/add', [ProdukController::class, 'create'])->middleware('auth');
Route::post('produk/store', [ProdukController::class, 'store'])->middleware('auth');
// Route::get('produk/show/{id}', [ProdukController::class, 'show'])->middleware('auth');
Route::get('produk/edit/{id}', [ProdukController::class, 'edit'])->middleware('auth');
Route::post('produk/update/{id}', [ProdukController::class, 'store'])->middleware('auth');
Route::get('produk/delete/{id}', [ProdukController::class, 'destroy'])->middleware('auth');
Route::get('download-barcode/{id}', [ProdukController::class, 'printBarcode'])->middleware('auth');

// PRODUK
Route::get('jenis_produk', [JenisProdukController::class, 'index'])->middleware('auth');
Route::get('jenis_produk/add', [JenisProdukController::class, 'create'])->middleware('auth');
Route::post('jenis_produk/store', [JenisProdukController::class, 'store'])->middleware('auth');
Route::get('jenis_produk/show/{id}', [JenisProdukController::class, 'show'])->middleware('auth');
Route::get('jenis_produk/edit/{id}', [JenisProdukController::class, 'edit'])->middleware('auth');
Route::post('jenis_produk/update/{id}', [JenisProdukController::class, 'update'])->middleware('auth');
Route::get('jenis_produk/delete/{id}', [JenisProdukController::class, 'destroy'])->middleware('auth');

// LAPORAN PENJUALAN
Route::get('laporan-penjualan', [LaporanPenjualanController::class, 'index'])->middleware('auth');
// Route::get('jenis_produk/add', [JenisProdukController::class, 'create'])->middleware('auth');
// Route::post('jenis_produk/store', [JenisProdukController::class, 'store'])->middleware('auth');
// Route::get('jenis_produk/show/{id}', [JenisProdukController::class, 'show'])->middleware('auth');
// Route::get('jenis_produk/edit/{id}', [JenisProdukController::class, 'edit'])->middleware('auth');
// Route::post('jenis_produk/update/{id}', [JenisProdukController::class, 'update'])->middleware('auth');
// Route::get('jenis_produk/delete/{id}', [JenisProdukController::class, 'destroy'])->middleware('auth');




// TEST SOCKET

Route::get('test-event', function () {
    $order = 1; // Ganti dengan ID order yang ada
    event(new OrderShipped($order));
    return 'Event has been sent!';
});



Route::get('/send', function () {
    broadcast(new App\Events\EveryoneEvent());
    return response('Sent');
});

Route::get('/receiver', function () {
    return view('socket.test');
});
