<?php

use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\RequestVehicle\RequestVehicleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


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


// ------------------- Super Admin ------------------- //

// ------------------- Dashboard ------------------- //
Route::name('dashboard.')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

});

// ------------------- Request Vehicle ------------------- //

Route::name('request-vehicle.')->prefix('request-vehicle')->group(function () {
    Route::get('/', [RequestVehicleController::class, 'index'])->name('index');
    Route::get('/fetch', [RequestVehicleController::class, 'fetch']);
    Route::get('/show/{requestVehicle}', [RequestVehicleController::class, 'show'])->name('show');
    Route::get('/update/{requestVehicle}', [RequestVehicleController::class, 'update'])->name('update');
    // Route::put('/update/{requestVehicle}', 'update')->name('update');
});



require __DIR__.'/auth.php';
