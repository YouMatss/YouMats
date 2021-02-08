<?php

use Illuminate\Support\Facades\Route;

Route::post('changeCurrency', 'CommonController@changeCurrency')->name('front.currencySwitch');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){
    Auth::routes(['verify' => true]);

    Route::group(['prefix' => 'vendor', 'namespace' => 'Vendor', 'as' => 'vendor.'], function () {
        Route::get('/', [\App\Http\Controllers\Vendor\IndexController::class, 'index']);

        Auth::routes(['verify' => true]);

        Route::get('/confirmed', function () {
            return 'password confirmed';
        })->middleware(['auth:vendor', 'password.confirm:vendor.password.confirm']);

        Route::get('/verified', function () {
            return 'email verified';
        })->middleware('verified:vendor.verification.notice,vendor');
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




