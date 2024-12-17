<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});
Route::group(['prefix'=> 'admin'], function () {
    Route::view('/','dashboard');
    Route::view('daftar-tamu','daftar_tamu');
    Route::view('daftar-kamar','daftar_kamar');
    Route::view('daftar-transaksi','daftar_transaksi');
    Route::view('log-sistem','log_sistem');
});
