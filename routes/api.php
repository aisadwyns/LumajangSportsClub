<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\JoinKomunitasController;
use App\Http\Controllers\Client\BookingController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/midtrans-callback', [BookingController::class, 'handleUniversalCallback']);
// Route::post('/midtrans-callback', [JoinKomunitasController::class, 'midtransCallback']);
// Route::post('/booking-callback', [BookingController::class, 'bookingCallback']);
