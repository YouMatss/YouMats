<?php

use Illuminate\Support\Facades\Route;

Route::post('changeCurrency', 'CommonController@changeCurrency')->name('front.currencySwitch');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){
    Auth::routes(['verify' => true]);
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/user/profile', [\App\Http\Controllers\User\ProfileController::class, 'index'])->name('front.user.profile');
});




