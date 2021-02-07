<?php

use Illuminate\Support\Facades\Route;

Route::post('changeCurrency', 'CommonController@changeCurrency')->name('front.currencySwitch');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){
    Auth::routes(['verify' => true]);

    Route::group(['prefix' => 'vendor'], function() {
        Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showVendorLoginForm'])->name('vendor.loginForm');
        Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'vendorLogin'])->name('vendor.login');
        Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showVendorRegisterForm'])->name('vendor.registerForm');
        Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'registerVendor'])->name('vendor.register');

        Route::get('/', [App\Http\Controllers\Front\VendorController::class], 'index');
    });

    Route::group([
        'middleware' => ['auth', 'verified']
    ], function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/user/profile', [\App\Http\Controllers\User\ProfileController::class, 'index'])->name('front.user.profile');

        Route::get('/category/{category_slug}', [\App\Http\Controllers\CategoryController::class, 'index'])->name('front.category');
        Route::get('/subCategory/{category_slug}/{subCategory_slug}', [\App\Http\Controllers\SubCategoryController::class, 'index'])->name('front.subCategory');
    });

});




