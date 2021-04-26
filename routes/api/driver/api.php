<?php

use Illuminate\Support\Facades\Route;

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::post('password/forget', 'AuthController@password_forgot');

Route::middleware('auth:driver-api')->group(function () {
    Route::post('password/reset', 'AuthController@password_reset');
    Route::post('profile/update', 'AuthController@profile_update');
    Route::post('profile/update-photos', 'AuthController@updatePhotos');

    Route::group(['prefix' => 'cars'], function () {
        Route::get('/', 'CarController@index');
        Route::post('/store', 'CarController@store');
        Route::put('/update/{id}', 'CarController@update');
        Route::delete('/delete/{id}', 'CarController@delete');
    });
});

Route::get('/car-types', 'CarController@getCarTypes');
Route::get('/countries', 'CountryController@index');
