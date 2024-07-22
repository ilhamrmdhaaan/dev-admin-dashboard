<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\FormRequestVehicle\FormRequestVehicleController;
use App\Http\Controllers\Admin\RequestDetails\RequestDetailsController;
use App\Http\Controllers\Admin\RequestVehicle\RequestVehicleController;





Route::get('/', function () {
    return redirect()->route('login');
});

// ------------------- Super Admin ------------------- //
Route::group(['middleware' => ['auth', 'role:|super_admin|user']], function () {

    // ------------------- Dashboard ------------------- //
    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });


    // ------------------- Master Request Vehicle ------------------- //
    Route::name('master-request-vehicle.')->prefix('master-request-vehicle')->group(function () {
        Route::get('/', [RequestVehicleController::class, 'index'])->name('index');
        Route::get('/fetch', [RequestVehicleController::class, 'fetch']);
        // Route::get('/update', [RequestVehicleController::class, 'update'])->name('update');
        Route::get('/show/{requestVehicle}', [RequestVehicleController::class, 'show'])->name('show');
        Route::post('/store', [RequestVehicleController::class, 'store'])->name('store');
        Route::put('/updated/{id}', [RequestVehicleController::class, 'updated'])->name('updated');
        Route::delete('/remove/{requestVehicle}', [RequestVehicleController::class, 'remove'])->name('remove');
        // Route::put('/update/{requestVehicle}', 'update')->name('update');
    });


    // ------------------- Master Request Details ------------------- //
    Route::name('master-request-details.')->prefix('master-request-details')->group(function () {
        Route::get('/', [RequestDetailsController::class, 'index'])->name('index');
        Route::get('/fetch', [RequestDetailsController::class, 'fetch']);
        // Route::post('/store', [RequestDetailsController::class, 'storeDetails'])->name('store');
    });


});


Route::group(['middleware' => ['auth', 'role:|user']], function () {

    // ------------------- Request Vehicle ------------------- //
    Route::name('request-vehicle.')->prefix('form-request-vehicle')->group(function () {
        Route::get('/', [FormRequestVehicleController::class, 'index'])->name('index');
        Route::get('/fetch', [FormRequestVehicleController::class, 'fetch']);
        // Route::get('/create', [FormRequestVehicleController::class, 'create'])
        // ->name('create');
        Route::post('/store', [FormRequestVehicleController::class, 'store'])->name('store');
        
    });

});


require __DIR__ . '/auth.php';
