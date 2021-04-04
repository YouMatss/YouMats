<?php

use Illuminate\Support\Facades\Route;

//Actions routes
Route::post('changeCurrency', 'Common\MiscController@changeCurrency')->name('front.currencySwitch');
Route::get('introduce/{type}', 'Common\MiscController@introduce')->name('front.introduce');

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

        Route::get('edit', 'IndexController@edit')->name('edit');
        Route::patch('update', 'IndexController@update')->name('update');
        Route::patch('update-shipping-prices', 'IndexController@updateShippingPrices')->name('updateShippingPrices');
        Route::delete('license/{vendor}/media/{media}', 'IndexController@deleteLicense')->name('deleteLicense');
        Route::post('branch', 'IndexController@addBranch')->name('addBranch');
        Route::delete('{branch}/branch', 'IndexController@deleteBranch')->name('deleteBranch');
        Route::get('product', 'ProductController@create')->name('addProduct');
        Route::post('product', 'ProductController@store')->name('storeProduct');
        Route::get('product/{product}/edit', 'ProductController@edit')->name('editProduct');
        Route::patch('product/{product}/update', 'ProductController@update')->name('updateProduct');
        Route::delete('/product/{product}/media/{media}', 'ProductController@deleteImage')->name('deleteImage');
        Route::get('{vendor_slug}', 'IndexController@show')->name('show');
    });

    //Cart Routes
    Route::group(['prefix' => 'cart', 'namespace' => 'Product'], function() {
        Route::get('/', 'CartController@show')->name('cart.show');
        Route::post('/add/{product}', 'CartController@add')->name('cart.add')->middleware('throttle:10,1');
        Route::delete('/delete/{rowId}', 'CartController@deleteItem')->name('cart.remove');
        Route::patch('/update', 'CartController@update')->name('cart.update')->middleware('throttle:10,1');
        Route::post('/coupon', 'CartController@applyCoupon')->name('apply.coupon');
    });

    Route::group(['prefix' => 'wishlist', 'namespace' => 'Product', 'middleware' => ['auth', 'verified']], function() {
        Route::get('/', 'WishlistController@index')->name('wishlist.index');
        Route::post('/add/{product}', 'WishlistController@add')->name('wishlist.add');
        Route::delete('/delete/{rowId}', 'WishlistController@deleteItem')->name('wishlist.remove');
    });

    Route::group(['prefix' => 'checkout', 'namespace' => 'Product'], function() {
        Route::get('/', 'CheckoutController@index')->name('checkout.index');
        Route::post('/', 'CheckoutController@checkout')->name('checkout');
    });

    //Pages routes
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/products', 'Product\ProductController@all')->name('front.product.all');
    Route::get('/partners', 'Vendor\IndexController@index')->name('vendor.index');
    Route::get('/team', 'Team\IndexController@index')->name('front.team.index');
    Route::get('/FAQs', 'Common\PageController@faqs')->name('front.faqs.page');
    Route::get('/contact-us', 'Common\PageController@contactUs')->name('front.contact.page');

    Route::post('/contact-us', 'Common\PageController@contactUsRequest')->name('front.contact.request');
    Route::post('/subscribe', 'Common\MiscController@subscribeRequest')->name('front.subscribe.request');
    Route::post('/inquire', 'Common\MiscController@inquireRequest')->name('front.inquire.request');

    // Vendor Order Routes (Auth/Verified protected)
    Route::group(['prefix' => 'order', 'namespace' => 'Product', 'middleware' => 'auth:vendor, verified:vendor.verification.notice'], function() {
        Route::get('/{order}/get', 'OrderController@get')->name('order.get');
        Route::patch('/vendor/{vendor}/update', 'OrderController@vendorUpdate')->name('vendor.order.update');
    });

    Route::get('/page/{slug}', 'Common\PageController@page')->name('front.page.index');
    Route::get('/search', 'Product\ProductController@search')->name('products.search');
    Route::get('/filter/{subCategory_id}', 'Category\SubCategoryController@filter')->name('subCategory.filter');
    Route::get('/tag/{tag_slug}', 'Tag\IndexController@index')->name('front.tag');
    Route::get('/{slug}/i', 'Product\ProductController@index')->name('front.product');
    Route::get('/{category_slug}/dp', 'Category\CategoryController@index')->name('front.category');
    Route::get('/{category_slug}/{subCategory_slug}/dp', 'Category\SubCategoryController@index')->name('front.subCategory');
});
