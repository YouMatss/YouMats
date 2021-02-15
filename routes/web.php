<?php

use Illuminate\Support\Facades\Route;

//Actions routes
Route::post('changeCurrency', 'Common\MiscController@changeCurrency')->name('front.currencySwitch');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){
    //Auth (Verified/Authenticated) routes
    Route::group(['namespace' => 'User'], function () {
        Auth::routes(['verify' => true]);
        Route::group([
            'middleware' => ['auth', 'verified']
        ], function () {
            Route::get('/user/profile', 'ProfileController@index')->name('front.user.profile');
            Route::post('/user/profile', 'ProfileController@updateProfile')->name('front.user.updateProfile');
        });
    });

    //Vendor Auth Routes
    Route::group(['prefix' => 'vendor', 'namespace' => 'Vendor', 'as' => 'vendor.'], function () {

        Auth::routes(['verify' => true]);

        Route::get('show/{vendor}/{name}', 'IndexController@show')->name('show');
        Route::get('{vendor}/edit', 'IndexController@edit')->name('edit');
        Route::patch('{vendor}/update', 'IndexController@update')->name('update');
        Route::post('{vendor}/branch', 'IndexController@addBranch')->name('addBranch');
    });

    //Cart Routes
    Route::group(['prefix' => 'cart', 'namespace' => 'Product'], function() {
        Route::get('/', 'CartController@show')->name('cart.show');
        Route::post('/add/{product}', 'CartController@add')->name('cart.add')->middleware('throttle:10,1');
        Route::delete('/delete/{rowId}', 'CartController@deleteItem')->name('cart.remove');
        Route::patch('/update', 'CartController@update')->name('cart.update')->middleware('throttle:10,1');
    });

    Route::group(['prefix' => 'wishlist', 'namespace' => 'Product', 'middleware' => ['auth', 'verified']], function() {
        Route::get('/', 'WishlistController@index')->name('wishlist.index');
        Route::post('/add/{product}', 'WishlistController@add')->name('wishlist.add');
        Route::delete('/delete/{rowId}', 'WishlistController@deleteItem')->name('wishlist.remove');
    });

    //Pages routes
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/products', 'Product\ProductController@all')->name('front.product.all');
    Route::get('/partners', 'Vendor\IndexController@index')->name('vendor.index');
    Route::get('/team', 'Team\IndexController@index')->name('front.team.index');
    Route::get('/FAQs', 'Common\PageController@faqs')->name('front.faqs.page');
    Route::get('/about-us', 'Common\PageController@aboutUs')->name('front.about.page');

    //Vendor Order Routes (Auth/Verified protected)
    Route::group(['prefix' => 'order', 'namespace' => 'Product', 'middleware' => 'auth:vendor, verified:vendor.verification.notice'], function() {
        Route::get('/{order}/get', 'OrderController@get')->name('order.get');
        Route::patch('/vendor/{vendor}/update', 'OrderController@vendorUpdate')->name('vendor.order.update');
    });

    Route::get('/tag/{tag_slug}', 'Tag\IndexController@index')->name('front.tag');
    Route::get('/product/{slug}', 'Product\ProductController@index')->name('front.product');
    Route::get('/category/{category_slug}', 'Category\CategoryController@index')->name('front.category');
    Route::get('/category/{category_slug}/{subCategory_slug}', 'Category\SubCategoryController@index')->name('front.subCategory');
});




