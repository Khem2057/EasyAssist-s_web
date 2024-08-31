<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DataController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\api\BookingController;
use App\Http\Controllers\api\WorkerController;
use Illuminate\Support\Facades\Mail;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(AuthController::class)->group(function() {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout','logout')->middleware('auth:sanctum');
    Route::post('forgotPassword','forgotPassword');
    Route::post('resendOtp', 'resendOtp');
    Route::post('resetpassword','resetpassword');
    Route::post('verifiedOtp', 'verifiedOtp');
});

// Route::post('login', [AuthController::class, 'login']);
// Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Route::get('data',[AuthController::class, 'getData']);

Route::controller(DataController::class)->middleware('auth:sanctum')->group(function(){
    Route::get('getdata', 'index');
});

Route::get('getdata', [DataController::class, 'index']);// for getting all table's data
Route::post('bookingservice', [BookingController::class, 'booking_store'])->middleware('auth:sanctum');   // for booking service 
Route::post('editprofile', [ProfileController::class, 'editProfile']);
Route::post('appliedForWorkers/{id}', [WorkerController::class, 'applyForWorker'])->middleware('auth:sanctum');