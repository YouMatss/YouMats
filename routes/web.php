<?php

use Illuminate\Support\Facades\Route;

Route::post('changeCurrency', 'CommonController@changeCurrency')->name('front.currencySwitch');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){
    Route::get('/', 'HomeController@index');
});


