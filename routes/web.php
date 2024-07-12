<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\RequestDetails\RequestDetailsController;
use App\Http\Controllers\Admin\RequestVehicle\RequestVehicleController;


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
Route::get('/', function () {
    return redirect()->route('login');
});

// ------------------- Super Admin ------------------- //

Route::group(['middleware' => ['auth', 'role:|super_admin']], function () {

    // ------------------- Dashboard ------------------- //
    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    
    });
    
    // ------------------- Request Vehicle ------------------- //
    
    Route::name('request-vehicle.')->prefix('request-vehicle')->group(function () {
        Route::get('/', [RequestVehicleController::class, 'index'])->name('index');
        Route::get('/fetch', [RequestVehicleController::class, 'fetch']);
        Route::get('/show/{requestVehicle}', [RequestVehicleController::class, 'show'])->name('show');
        Route::put('/update/{requestVehicle}', [RequestVehicleController::class, 'update'])->name('update');
        Route::delete('/remove/{requestVehicle}', [RequestVehicleController::class, 'remove'])->name('remove');
        // Route::put('/update/{requestVehicle}', 'update')->name('update');
    });
    
    
    // ------------------- Request Details ------------------- //
    Route::name('request-details.')->prefix('request-details')->group(function () {
        Route::get('/', [RequestDetailsController::class, 'index'])->name('index');
        Route::get('/fetch', [RequestDetailsController::class, 'fetch']);
        Route::post('/store', [RequestDetailsController::class, 'storeDetails'])->name('store');
    
    
    });

});


require __DIR__.'/auth.php';
