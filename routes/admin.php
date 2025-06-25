<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AllOrdersController;
use App\Http\Controllers\Admin\ApprovedVendorController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\FlashSaleController;
use App\Http\Controllers\Admin\ManageAdminController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\PaymentSettingsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageGalleryController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\ProductVariantItemController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ShippingRuleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\VendorProductController;
use App\Http\Controllers\Admin\VendorProductImageGalleryController;
use App\Http\Controllers\Admin\VendorProductVariant;
use App\Http\Controllers\Admin\VendorProductVariantItem;
use App\Http\Controllers\Admin\VendorRequestController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {


    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {



    


    Route::resource('all-orders', AllOrdersController::class);

    Route::resource('payment-settings', PaymentSettingsController::class);

    Route::resource('shipping-rule', ShippingRuleController::class);

    Route::resource('coupon', CouponController::class);

    Route::resource('settings', SettingsController::class);

    Route::resource('flash-sale', FlashSaleController::class);

    
    Route::resource('vendor/product/vendor-image-gallery', VendorProductImageGalleryController::class);


    Route::resource('product/image-gallery', ProductImageGalleryController::class);

    /**
     * Vendor Product Variant Items Routes
     */
    Route::delete('vendor-product/variant-item/destroy/{variant_item_id}', [VendorProductVariantItem::class, 'destroy'])->name('vendor-product-variant-item.destroy');
    Route::put('vendor-product/variant-item/update/{variant_item_id}', [VendorProductVariantItem::class, 'update'])->name('vendor-product-variant-item.update');
    Route::get('vendor-product/variant-item/edit/{product_id}/{variant_id}/{variant_item_id}', [VendorProductVariantItem::class, 'edit'])->name('vendor-product-variant-item.edit');
    Route::get('vendor-product/variant-item/{product_id}/{variant_id}', [VendorProductVariantItem::class, 'index'])->name('vendor-product-variant-item.index');
    /**
     * Vendor Product Variant Items Routes
     */


    /**
     * Vendor Product Variant Routes
     */
    Route::delete('vendor-product/variant/destroy/{variant_id}', [VendorProductVariant::class, 'destroy'])->name('vendor-product-variant.destroy');
    Route::put('vendor-product/variant/update/{variant_id}', [VendorProductVariant::class, 'update'])->name('vendor-product-variant.update');
    Route::get('vendor-product/variant/edit/{product_id}/{variant_id}', [VendorProductVariant::class, 'edit'])->name('vendor-product-variant.edit');
    Route::get('vendor-product/variant/{product_id}', [VendorProductVariant::class, 'index'])->name('vendor-product-variant.index');
    /**
     * Vendor Product Variant Routes
     */

    
    /**
     * Product Variant Items Routes
     */
    Route::delete('product/variant-item/destroy/{variant_item_id}', [ProductVariantItemController::class, 'destroy'])->name('product-variant-item.destroy');
    Route::put('product/variant-item/update/{variant_item_id}', [ProductVariantItemController::class, 'update'])->name('product-variant-item.update');
    Route::get('product/variant-item/edit/{product_id}/{variant_id}/{variant_item_id}', [ProductVariantItemController::class, 'edit'])->name('product-variant-item.edit');
    Route::post('product/variant-item/store', [ProductVariantItemController::class, 'store'])->name('product-variant-item.store');
    Route::get('product/variant-item/create/{product_id}/{variant_id}', [ProductVariantItemController::class, 'create'])->name('product-variant-item.create');
    Route::get('product/variant-item/{product_id}/{variant_id}', [ProductVariantItemController::class, 'index'])->name('product-variant-item.index');
    /**
     * Product Variant Items Routes
     */


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


    Route::resource('vendor-product', VendorProductController::class);
    Route::get('product/get-child-categories/', [ProductController::class, 'getChildCategories'])->name('product.get-child-categories');
    Route::get('product/get-sub-categories/', [ProductController::class, 'getSubCategories'])->name('product.get-sub-categories');
    Route::resource('product', ProductController::class);
    Route::resource('brand', BrandController::class);
    Route::resource('child-category', ChildCategoryController::class);
    Route::resource('sub-category', SubCategoryController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('manage-admin', ManageAdminController::class);
    Route::resource('manage-user', ManageUserController::class);
    Route::resource('profile', AdminProfileController::class);
    Route::resource('approved-vendors', ApprovedVendorController::class);
    Route::resource('vendor-request', VendorRequestController::class);
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
