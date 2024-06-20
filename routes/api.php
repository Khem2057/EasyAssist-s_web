<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DataController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(AuthController::class)->group(function() {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

// Route::post('login', [AuthController::class, 'login']);
// Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Route::get('data',[AuthController::class, 'getData']);

Route::get('getdata', [DataController::class, 'index']);  // for getting all table's data
Route::post('bookingservice', [DataController::class, 'booking_store']);   // for booking service 
Route::get('editprofile', [DataController::class, 'editProfile']);