<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\MobileUserController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\ProductController;

use App\Models\booking;
use App\Models\Products;
use PHPUnit\Architecture\Services\ServiceContainer;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth','verified')->group(function(){

    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

    Route::get('/services', [ServicesController::class, 'index'])->name('services');
    Route::get('/addservicepage', [ServicesController::class, 'addpage'])->name('addservicepage');
    Route::post('/addservice', [ServicesController::class, 'addservice']);
    Route::get('/services/delete/{id}', [ServicesController::class, 'delete'] );

    Route::get('/booking', [BookingsController::class, 'index'])->name('booking');

    Route::get('/mobileuser/delete/{id}', [BookingsController::class, 'delete'] );
    Route::get('/mobileuser', [MobileUserController::class, 'index'])->name('mobileuser');
    Route::get('/mobileuser/delete/{id}', [MobileUserController::class, 'delete']);

    Route::get('/workers', [WorkerController::class, 'index'])->name('workers');
    Route::get('/workers/delete/{id}', [WorkerController::class, 'delete']);
    Route::post('/makeclient/{id}', [WorkerController::class, 'update']);
    Route::get('/newrequestworker', [WorkerController::class, 'newRequestWorker'])->name('newrequestworker');
    Route::get('/workers/deleterequest/{id}', [WorkerController::class, 'deleteNewRequest']);
    Route::post('/approveworker/{id}', [WorkerController::class, 'approveNewRequest']);

    Route::get('/adminuser', [AdminUserController::class, 'index'])->name('adminuser');
    Route::get('/adminuser/delete/{id}', [AdminUserController::class, 'delete']);
    Route::get('/addadminpage', [AdminUserController::class, 'addadminpage'])->name('addadminpage');
    Route::post('/addadmin', [AdminUserController::class, 'addadmin']);

    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/addproductpage', [ProductController::class, 'addproduct'])->name('addproductpage');
});



require __DIR__.'/auth.php';



