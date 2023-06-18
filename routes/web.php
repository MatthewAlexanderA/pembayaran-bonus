<?php

use App\Http\Controllers\PembayaranController;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistController;
use App\Models\Pembayaran;
use Illuminate\Auth\Events\Logout;

use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/user-dashboard', [PembayaranController::class, 'user'])->name('user-dashboard');
    Route::get('/show-pembayaran/{id}', [PembayaranController::class, 'show'])->name('show-pembayaran');
    Route::get('/create-pembayaran', [PembayaranController::class, 'create'])->name('create-pembayaran');
    Route::post('/store-pembayaran', [PembayaranController::class, 'store'])->name('store-pembayaran');

    Route::middleware('checkLevel:admin')->group(function () {
        Route::get('/admin-dashboard', [PembayaranController::class, 'index'])->name('admin-dashboard');
        Route::get('/edit-pembayaran/{id}', [PembayaranController::class, 'edit'])->name('edit-pembayaran');
        Route::put('/update-pembayaran/{id}', [PembayaranController::class, 'update'])->name('update-pembayaran');
        Route::resource('pembayaran', PembayaranController::class);
    });

});

Route::middleware(['guest'])->group(function () {
    
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'auth'])->name('auth');
    
    Route::resource('register', RegistController::class);

});
