<?php

use App\Models\User;
use App\Models\Barang;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\User\ProductContoller;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Models\Transaksi;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth','revalidate']], function(){

    // Superadmin Routes Start
    Route::group([
        'middleware' => 'superadmin',
        'prefix' => 'superadmin',
        'as' => 'superadmin.'
    ], function(){
        Route::get('/',[DashboardController::class,'index']);
        Route::get('/barang/{id}/img', [BarangController::class,'editGambar']);
        Route::put('/barang/{id}/img-update',[BarangController::class,'updateGambar']);
        Route::delete('/barang/{id}/img',[BarangController::class,'destroyGambar']);
        Route::get('/barang/json',[BarangController::class,'json'])->name('barang-json');
        Route::get('/pengguna/admin',[PenggunaController::class,'index']);
        Route::get('/pengguna/json-admin',[PenggunaController::class,'jsonAdmin'])->name('admin-json');
        Route::get('/pengguna/json-user',[PenggunaController::class,'jsonUser'])->name('user-json');
        Route::get('/pengguna/user',[PenggunaController::class,'user']);
        Route::get('/pengguna/{id}/akun',[PenggunaController::class,'userShow']);
        Route::get('/transaksi/json',[TransaksiController::class,'json'])->name('transaksi-json');
        Route::get('/transaksi',[TransaksiController::class,'index']);
        Route::get('/transaksi/{id}',[TransaksiController::class,'detail']);
        Route::put('/transaksi/approve/{id}',[TransaksiController::class,'approve'])->name('approve');
        Route::get('/transaksi-berlangsung',[TransaksiController::class,'tBerlangsung']);
        Route::get('/transaksi-berlangsung/json',[TransaksiController::class,'pendingJson'])->name('transaksi-berlangsung.json');
        Route::get('/transaksi-selesai/json',[TransaksiController::class,'successJson'])->name('transaksi-selesai.json');
        Route::get('/transaksi-selesai',[TransaksiController::class,'tSelesai'])->name('transaksi-selesai');
        Route::resource('barang', BarangController::class);
        Route::resource('pengguna',PenggunaController::class);
        Route::resource('pesan', PesanController::class);
    });
    // Superadmin Routes End

    // Admin Routes Start
    Route::group(['middleware' => 'admin','prefix' => 'admin'], function(){
        Route::get('/',[DashboardController::class,'index']);
        Route::get('/barang/{id}/img', [BarangController::class,'editGambar']);
        Route::put('/barang/{id}/img-update',[BarangController::class,'updateGambar']);
        Route::delete('/barang/{id}/img',[BarangController::class,'destroyGambar']);
        Route::get('/barang/json',[BarangController::class,'json'])->name('admin.barang.json');
        Route::get('/pengguna/{id}/akun',[PenggunaController::class,'userShow']);
        Route::get('/transaksi/json',[TransaksiController::class,'json'])->name('admin.transaksi.json');
        Route::get('/transaksi',[TransaksiController::class,'index']);
        Route::get('/transaksi/{id}',[TransaksiController::class,'detail']);
        Route::put('/transaksi/approve/{id}',[TransaksiController::class,'approve'])->name('approve');
        Route::get('/transaksi-berlangsung',[TransaksiController::class,'tBerlangsung']);
        Route::get('/transaksi-berlangsung/json',[TransaksiController::class,'pendingJson'])->name('admin.transaksi.berlangsung.json');
        Route::get('/transaksi-selesai/json',[TransaksiController::class,'successJson'])->name('admin.transaksi.selesai.json');
        Route::get('/transaksi-selesai',[TransaksiController::class,'tSelesai'])->name('admin.transaksi.selesai');
        Route::resource('barang', BarangController::class);
        Route::resource('pengguna',PenggunaController::class)->except(['index']);
    });
    // Admin Routes End

    // User Route Start
    Route::middleware(['user'])->group(function(){
        Route::get('/user-profile/{id}', [PenggunaController::class,'editUser']);
        Route::put('/user-profile/{id}',[PenggunaController::class,'update']);

        Route::get('/checkout',[TransaksiController::class,'create']);
        Route::post('/checkout',[TransaksiController::class,'store']);

        Route::get('/cart', [CartController::class,'index'])->name('cart');
        Route::delete('/cart/{id}',[CartController::class,'destroy'])->name('deleteCart');
        
        Route::get('/invoice', function(){
            return view('user.content.invoice');
        });
        
        Route::get('/konfirmasi/pembayaran', function(){
            return view('user.content.confirm');
        });

        Route::post('/cart/add-to-cart/{id}', [CartController::class,'store'])->name('addCart');
         Route::post('/buy-now/{id}',[TransaksiController::class,'buyNow'])->name('buyNow');
        Route::post('/checkout-now',[TransaksiController::class,'checkoutNow'])->name('checkoutNow');
        Route::get('/transaksi/{id}',[TransaksiController::class,'transaksiSaya'])->name('transaksiSaya');
        Route::put('/transaksi/{id}/selesai',[TransaksiController::class,'transaksiSelesai'])->name('transaksiSelesai');
    });
    // User Route End

    Route::post('/logout',[LoginController::class,'logout'])->name('logout');
});
// Admin Routes End

// ======================================================================================== //

Route::post('/authenticating',[LoginController::class,'authenticate'])->middleware('guest');
Route::get('/registrasi',[RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/registrasi',[RegisterController::class, 'registrasi'])->middleware('guest');
// otp
Route::get('/otp/{email}', [RegisterController::class, 'otp'])->name('otp')->middleware('guest');
Route::post('/otp/{token}', [RegisterController::class, 'otp_store'])->name('otp_store')->middleware('guest');

Route::get('/login',[LoginController::class,'login'])->name('login')->middleware('guest');

Route::get('/', [ProductContoller::class,'index'])->name('product');
Route::get('/detail-product/{id}', [ProductContoller::class,'detail'])->name('detail-product');
Route::get('/card',[ProductContoller::class,'card'])->name('card');
Route::get('/action-figure',[ProductContoller::class,'actionFigure'])->name('actionFigure');
Route::get('/others',[ProductContoller::class,'others'])->name('others');

// Let it stay below
Route::fallback(function(){
    return abort(404);
});
