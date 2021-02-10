<?php

use Illuminate\Support\Facades\Route;

Route::post('changeCurrency', 'Common\MiscController@changeCurrency')->name('front.currencySwitch');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){
    Route::group(['namespace' => 'User'], function () {
        Auth::routes(['verify' => true]);
        Route::group([
            'middleware' => ['auth', 'verified']
        ], function () {
            Route::get('/user/profile', 'ProfileController@index')->name('front.user.profile');
            Route::post('/user/profile', 'ProfileController@updateProfile')->name('front.user.updateProfile');
        });
    });

    Route::resource('vendor', 'Vendor\IndexController');

    Route::group(['prefix' => 'auth/vendor', 'namespace' => 'Vendor', 'as' => 'vendor.'], function () {

        Auth::routes(['verify' => true]);

        Route::get('/confirmed', function () {
            return 'password confirmed';
        })->middleware(['auth:vendor', 'password.confirm:vendor.password.confirm']);

        Route::get('/verified', function () {
            return 'email verified';
        })->middleware('verified:vendor.verification.notice,vendor');
    });


    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/allProducts', 'Product\ProductController@all')->name('front.product.all');
    Route::get('/FAQs', 'Common\PageController@faqs')->name('front.faqs.page');
    Route::get('/about-us', 'Common\PageController@aboutUs')->name('front.about.page');

    Route::get('/product/{slug}', 'Product\ProductController@index')->name('front.product');
    Route::get('/category/{category_slug}', 'Category\CategoryController@index')->name('front.category');
    Route::get('/category/{category_slug}/{subCategory_slug}', 'Category\SubCategoryController@index')->name('front.subCategory');
});




