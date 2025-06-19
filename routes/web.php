<?php

use App\Http\Controllers\Auth\RegisteredVendorController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductDetailsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserAddressController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserVendorRequest;
use App\Http\Controllers\User\UserVendorRequestController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\ProductImageGalleryController;
use App\Http\Controllers\Vendor\ProductVariantController;
use App\Http\Controllers\Vendor\ProductVariantItemController;
use App\Http\Controllers\Vendor\VendorDashboardController;
use App\Http\Controllers\Vendor\VendorProfileController;
use Illuminate\Support\Facades\Route;





Route::get('vendor/register', [RegisteredVendorController::class, 'create'])->name('vendor.register.index');
Route::post('vendor/register/store', [RegisteredVendorController::class, 'store'])->name('vendor.register.store');

/**
 * User Routes
 */
Route::group(['middleware' => ['auth', 'verified', 'check_role:user'], 'prefix' => 'user', 'as' => 'user.'], function () {

    Route::resource('address', UserAddressController::class);
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

    
    Route::resource('product/image-gallery', ProductImageGalleryController::class);
    Route::delete('product/variant-item/destroy/{variant_item_id}', [ProductVariantItemController::class, 'destroy'])->name('product-variant-item.destroy');
    Route::put('product/variant-item/update/{variant_item_id}', [ProductVariantItemController::class, 'update'])->name('product-variant-item.update');
    Route::get('product/variant-item/edit/{product_id}/{variant_id}/{variant_item_id}', [ProductVariantItemController::class, 'edit'])->name('product-variant-item.edit');
    Route::post('product/variant-item/store', [ProductVariantItemController::class, 'store'])->name('product-variant-item.store');
    Route::get('product/variant-item/create/{product_id}/{variant_id}', [ProductVariantItemController::class, 'create'])->name('product-variant-item.create');
    Route::get('product/variant-item/{product_id}/{variant_id}', [ProductVariantItemController::class, 'index'])->name('product-variant-item.index');

    /**
     * Product Variant Routes
     */
    Route::delete('product/variant/destroy/{variant_id}', [ProductVariantController::class, 'destroy'])->name('product-variant.destroy');
    Route::put('product/variant/update/{variant_id}', [ProductVariantController::class, 'update'])->name('product-variant.update');
    Route::get('product/variant/edit/{product_id}/{variant_id}', [ProductVariantController::class, 'edit'])->name('product-variant.edit');
    Route::post('product/variant/store', [ProductVariantController::class, 'store'])->name('product-variant.store');
    Route::get('product/variant/create/{product_id}', [ProductVariantController::class, 'create'])->name('product-variant.create');
    Route::get('product/variant/{product_id}', [ProductVariantController::class, 'index'])->name('product-variant.index');
    /**
     * Product Variant Routes
     */
    Route::get('product/get-child-categories/', [ProductController::class, 'getChildCategories'])->name('product.get-child-categories');
    Route::get('product/get-sub-categories/', [ProductController::class, 'getSubCategories'])->name('product.get-sub-categories');
    Route::resource('product', ProductController::class);
    Route::resource('profile', VendorProfileController::class);
    Route::get('dashboard', [VendorDashboardController::class, 'index'])->name('dashboard');
});
 /**
 * Vendor Routes
 */


 /**
 * Frontend Routes
 */
Route::get('cart/remove-item/{rowid}', [CartController::class, 'removeItem'])->name('cart-remove-item');
Route::delete('cart/clear-cart/{id}', [CartController::class, 'clearCart'])->name('clear-cart');
Route::post('cart/qty-update', [CartController::class, 'updateQty'])->name('qty-update');
Route::get('cart-details', [CartController::class, 'cartDetails'])->name('cart-details');
Route::get('cart-count', [CartController::class, 'getCartCount'])->name('cart-count');
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::resource('product-details', ProductDetailsController::class);
Route::resource('flash-sale', FlashSaleController::class);
Route::get('/', [HomeController::class, 'home'])->name('home');

  /**
 * Frontend Routes
 */




require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
