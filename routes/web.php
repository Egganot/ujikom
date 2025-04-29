<?php

use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
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

Route::resource('/login', LoginController::class)->names('login');
Route::get('/register', [LoginController::class, 'regis'])->name('register.index');
Route::post('/register', [LoginController::class, 'register'])->name('register.store');
Route::get('/', [ProductController::class, 'index'])->name('landing.index');
Route::get('/produk/{id}', [ProductController::class, 'detail'])->name('produk.detail');
Route::post('/produk/beli/{id}', [TransactionController::class, 'beli'])->name('produk.beli');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'checkRole:admin,superAdmin'])->group(function () {
    Route::resource('/product', ProductController::class)->names('product');
    Route::resource('/report', ReportController::class)->names('report');
});

Route::middleware(['auth', 'checkRole:superAdmin'])->group(function () {
    Route::get('/dashboard', [LandingController::class, 'index'])->name('admin.index');
    Route::resource('/customer', CustomerController::class)->names('customer');
    Route::resource('/supplier', SupplierController::class)->names('supplier');
    Route::resource('/apoteker', ApotekerController::class)->names('apoteker');
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/search-obat', [TransactionController::class, 'searchObat']);
    Route::post('/simpan-transaksi', [TransactionController::class, 'simpanTransaksi']);
});
