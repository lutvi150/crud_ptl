<?php

use App\Http\Controllers\KamarController;
use App\Http\Controllers\TamuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('tamu',[TamuController::class,'index']);
Route::get('kamar',[KamarController::class,'index']);
Route::post('kamar',[KamarController::class,'store']);
Route::get('kamar/{id}',[KamarController::class,'show']);
Route::get('kamar-delete/{id}',[KamarController::class,'destroy']);
// use for tamu
Route::get('tamu',[TamuController::class,'index']);
Route::post('tamu',[TamuController::class,'store']);
Route::get('tamu/{id}',[TamuController::class,'show']);
Route::get('tamu-delete/{id}',[TamuController::class,'destroy']);
