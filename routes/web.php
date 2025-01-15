<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Report;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front_page');
});
Route::group(['prefix' => 'admin'], function () {
    Route::view('/', 'dashboard');
    Route::view('daftar-tamu', 'daftar_tamu');
    Route::view('daftar-kamar', 'daftar_kamar');
    Route::view('daftar-transaksi', 'daftar_transaksi');
    Route::view('log-sistem', 'log_sistem');
});
// use for part 10
Route::group(['prefix' => 'part-10'], function () {
    Route::view('/', 'part_10.dashboard');
    Route::view('daftar-produk', 'part_10.daftar_produk');
    Route::view('kategori', 'part_10.kategori');
    Route::view('transaksi', 'part_10.transaksi');
    Route::view('customer', 'part_10.customer');
    Route::get('report-produk', [Report::class, 'report_produk']);
    Route::get('report-customer', [Report::class, 'report_customer']);
    Route::get('report-transaksi', [Report::class, 'report_transaksi']);
    Route::get('report-category', [Report::class, 'report_category']);
});
