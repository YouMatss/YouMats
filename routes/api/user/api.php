<?php

use Illuminate\Support\Facades\Route;

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::post('password/forget', 'AuthController@password_forgot');

Route::middleware('auth:api')->group(function () {
    Route::post('password/reset', 'AuthController@password_reset');
    Route::post('profile/update', 'AuthController@profile_update');

    Route::post('make-request', 'TripController@makeRequest');
    Route::post('pick-driver', 'TripController@makeRequest');
});

Route::get('/get-driver/{id}', 'DriverController@getDriverById');
