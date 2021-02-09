<?php

use Illuminate\Support\Facades\Route;

Route::post('changeCurrency', 'CommonController@changeCurrency')->name('front.currencySwitch');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){
    Auth::routes(['verify' => true]);
    Route::group([
        'middleware' => ['auth', 'verified']
    ], function () {
        Route::get('/user/profile', [\App\Http\Controllers\User\ProfileController::class, 'index'])->name('front.user.profile');
    });


    Route::resource('vendor', \Vendor\IndexController::class);

    Route::group(['prefix' => 'auth/vendor', 'namespace' => 'Vendor', 'as' => 'vendor.'], function () {

        Auth::routes(['verify' => true]);

        Route::get('/confirmed', function () {
            return 'password confirmed';
        })->middleware(['auth:vendor', 'password.confirm:vendor.password.confirm']);

        Route::get('/verified', function () {
            return 'email verified';
        })->middleware('verified:vendor.verification.notice,vendor');
    });


    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/allProducts', [\App\Http\Controllers\ProductController::class, 'all'])->name('front.product.all');
    Route::get('/FAQs', [\App\Http\Controllers\CommonController::class, 'faqs'])->name('front.faqs.page');
    Route::get('/about-us', [\App\Http\Controllers\CommonController::class, 'aboutUs'])->name('front.about.page');

    Route::get('/product/{slug}', [\App\Http\Controllers\ProductController::class, 'index'])->name('front.product');
    Route::get('/category/{category_slug}', [\App\Http\Controllers\CategoryController::class, 'index'])->name('front.category');
    Route::get('/category/{category_slug}/{subCategory_slug}', [\App\Http\Controllers\SubCategoryController::class, 'index'])->name('front.subCategory');
});




