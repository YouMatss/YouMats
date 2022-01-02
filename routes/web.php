<?php

use App\Http\Controllers\Front\Vendor\Admin\BranchController;
use App\Http\Controllers\Front\Vendor\Admin\IndexController;
use App\Http\Controllers\Front\Vendor\Admin\OrderController;
use App\Http\Controllers\Front\Vendor\Admin\ProductController;
use App\Http\Controllers\Front\Vendor\Admin\SippingGroupController;
use Illuminate\Support\Facades\Route;

//Actions routes
Route::post('changeCurrency', 'Common\MiscController@changeCurrency')->name('front.currencySwitch');
Route::post('changeCity', 'Common\MiscController@changeCity')->name('front.citySwitch');
Route::get('introduce/{type}', 'Common\MiscController@introduce')->name('front.introduce');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localizationRedirect' ]
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

    Route::group(['prefix' => 'chat', 'namespace' => 'Chat', 'as' => 'chat.'], function () {
        Route::get('user/conversations/{vendor_id}', 'MessageController@userConversations')->name('user.conversations');
        Route::get('vendor/conversations/{user_id}', 'MessageController@vendorConversations')->name('vendor.conversations');
        Route::post('send_message', 'MessageController@sendMessage')->name('send_message');
    });

    // Vendor Routes
    Route::group(['prefix' => 'vendor', 'namespace' => 'Vendor', 'as' => 'vendor.'], function () {
        Auth::routes(['verify' => true]);

        Route::get('dashboard', [IndexController::class, 'dashboard'])->name('dashboard');

        Route::get('edit', [IndexController::class, 'edit'])->name('edit');
        Route::put('update', [IndexController::class, 'update'])->name('update');

        Route::get('getSubCategories', [IndexController::class, 'getSubCategories'])->name('category.getSub');

        Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/store', [ProductController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
            Route::get('/deleteImage/{product}/{image}', [ProductController::class, 'deleteImage'])->name('deleteImage');
        });
        Route::group(['prefix' => 'branch', 'as' => 'branch.'], function () {
            Route::get('/', [BranchController::class, 'index'])->name('index');
            Route::get('/create', [BranchController::class, 'create'])->name('create');
            Route::post('/store', [BranchController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [BranchController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [BranchController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [BranchController::class, 'delete'])->name('delete');
        });
        Route::group(['prefix' => 'shipping-group', 'as' => 'shipping-group.'], function () {
            Route::get('/', [SippingGroupController::class, 'index'])->name('index');
            Route::get('/create', [SippingGroupController::class, 'create'])->name('create');
            Route::post('/store', [SippingGroupController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [SippingGroupController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [SippingGroupController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [SippingGroupController::class, 'delete'])->name('delete');
        });

        Route::get('order', [OrderController::class, 'index'])->name('order.index');
        Route::get('order/edit/{id}', [OrderController::class, 'edit'])->name('order.edit');
        Route::post('order/update', [OrderController::class, 'update'])->name('order.update');
    });
    // Vendor Routes

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

        Route::get('/payment', 'PaymentController@form')->name('payment.form');
        Route::post('/submit-payment', 'PaymentController@submit')->name('payment.submit');
        Route::get('/success', 'PaymentController@success')->name('payment.success');
        Route::get('/error', 'PaymentController@error')->name('payment.error');
    });

    //Pages routes
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/products', 'Product\ProductController@all')->name('front.product.all');
    Route::get('/partners', 'Vendor\IndexController@index')->name('vendor.index');
    Route::get('/partners/{vendor_slug}', 'Vendor\IndexController@show')->name('vendor.show');
    Route::get('/team', 'Team\IndexController@index')->name('front.team.index');
    Route::get('/FAQs', 'Common\PageController@faqs')->name('front.faqs.page');
    Route::get('/contact-us', 'Common\PageController@contactUs')->name('front.contact.page');

    Route::post('/contact-us', 'Common\PageController@contactUsRequest')->name('front.contact.request');
    Route::post('/subscribe', 'Common\MiscController@subscribeRequest')->name('front.subscribe.request');
    Route::post('/inquire', 'Common\MiscController@inquireRequest')->name('front.inquire.request');

    Route::get('/page/{slug}', 'Common\PageController@page')->name('front.page.index');
    Route::get('/search', 'Product\ProductController@search')->name('products.search');
    Route::get('/filter/{category_id}', 'Category\CategoryController@filter')->name('category.filter');
    Route::get('/tag/{tag_slug}', 'Tag\IndexController@index')->name('front.tag');

    Route::get('/{categories_slug}/{slug}/i', 'Product\ProductController@index')
        ->name('front.product')->where('categories_slug', '.*');

    Route::get('/{slug}', 'Category\CategoryController@index')
        ->name('front.category')->where('slug', '.*')
        ->where('slug', '^(?!admin_panel|nova-api|nova-vendor).*$');

});
