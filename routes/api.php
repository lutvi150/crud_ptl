<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiMobilControlller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('tamu', [TamuController::class, 'index']);
Route::get('kamar', [KamarController::class, 'index']);
Route::post('kamar', [KamarController::class, 'store']);
Route::get('kamar/{id}', [KamarController::class, 'show']);
Route::get('kamar-delete/{id}', [KamarController::class, 'destroy']);
// use for tamu
Route::get('tamu', [TamuController::class, 'index']);
Route::post('tamu', [TamuController::class, 'store']);
Route::get('tamu/{id}', [TamuController::class, 'show']);
Route::get('tamu-delete/{id}', [TamuController::class, 'destroy']);
// use for transaction
Route::get('transaksi', [TransaksiController::class, 'index']);
// use for log database
Route::get('log-database', [LogController::class, 'index']);

// par 10
Route::get('category', [CategoryController::class, 'index']);
Route::post('category', [CategoryController::class, 'store']);
Route::get('category/{id}', [CategoryController::class, 'show']);
Route::get('category-delete/{id}', [CategoryController::class, 'destroy']);
// produk
Route::get('produk', [ProductController::class, 'index']);
Route::post('produk', [ProductController::class, 'store']);
Route::get('produk/{id}', [ProductController::class, 'show']);
Route::get('produk-delete/{id}', [ProductController::class, 'destroy']);
// customer
Route::get('customer', [CustomerController::class, 'index']);
Route::post('customer', [CustomerController::class, 'store']);
Route::get('customer/{id}', [CustomerController::class, 'show']);
Route::get('customer-delete/{id}', [CustomerController::class, 'destroy']);

// transaki
Route::get('transaksi-mobil', [TransaksiMobilControlller::class, 'index']);
Route::post('transaksi-mobil', [TransaksiMobilControlller::class, 'store']);
Route::get('transaksi-mobil/{id}', [TransaksiMobilControlller::class, 'show']);
Route::get('transaksi-mobil-delete/{id}', [TransaksiMobilControlller::class, 'destroy']);
