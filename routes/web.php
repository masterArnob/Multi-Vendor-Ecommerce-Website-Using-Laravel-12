<?php

use App\Http\Controllers\Auth\RegisteredVendorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserVendorRequest;
use App\Http\Controllers\User\UserVendorRequestController;
use App\Http\Controllers\Vendor\VendorDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



    Route::get('vendor/register', [RegisteredVendorController::class, 'create'])->name('vendor.register.index');
    Route::post('vendor/register/store', [RegisteredVendorController::class, 'store'])->name('vendor.register.store');

Route::group(['middleware' => ['auth', 'verified', 'check_role:user'], 'prefix' => 'user', 'as' => 'user.'], function(){

    Route::resource('vendor-request', UserVendorRequestController::class);

    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    
});

Route::group(['middleware' => ['auth', 'verified', 'check_role:vendor'], 'prefix' => 'vendor', 'as' => 'vendor.'], function(){

    

    Route::get('dashboard', [VendorDashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
