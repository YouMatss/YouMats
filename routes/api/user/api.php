<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::post('/reset_password', 'AuthController@reset_password');

Route::middleware('auth:api')->group(function () {

});
