<?php

use App\Http\Controllers\Auth\RegisteredVendorController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserVendorRequest;
use App\Http\Controllers\User\UserVendorRequestController;
use App\Http\Controllers\Vendor\VendorDashboardController;
use App\Http\Controllers\Vendor\VendorProfileController;
use Illuminate\Support\Facades\Route;





Route::get('vendor/register', [RegisteredVendorController::class, 'create'])->name('vendor.register.index');
Route::post('vendor/register/store', [RegisteredVendorController::class, 'store'])->name('vendor.register.store');

/**
 * User Routes
 */
Route::group(['middleware' => ['auth', 'verified', 'check_role:user'], 'prefix' => 'user', 'as' => 'user.'], function () {

    Route::resource('profile', UserProfileController::class);
    Route::resource('vendor-request', UserVendorRequestController::class);
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});
/**
 * User Routes
 */


 /**
 * Vendor Routes
 */
Route::group(['middleware' => ['auth', 'verified', 'check_role:vendor'], 'prefix' => 'vendor', 'as' => 'vendor.'], function () {

    Route::resource('profile', VendorProfileController::class);
    Route::get('dashboard', [VendorDashboardController::class, 'index'])->name('dashboard');
});
 /**
 * Vendor Routes
 */


 /**
 * Frontend Routes
 */
Route::get('/', [HomeController::class, 'home'])->name('home');

  /**
 * Frontend Routes
 */




require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
