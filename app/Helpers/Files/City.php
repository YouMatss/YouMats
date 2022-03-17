<?php

use Illuminate\Support\Facades\Session;
use App\Models\City;

if (!function_exists('setDefaultCity')) {
    function setDefaultCity() {
        Session::put('city', 'all');
    }
}

if (!function_exists('setCity')) {
    function setCity($city_id) {
        if(City::find($city_id) || $city_id == 'all')
            Session::put('city', $city_id);
    }
}

if (!function_exists('getCurrentCityName')) {
    function getCurrentCityName() {
        $city = City::find(Session::get('city'));
        if($city)
            return $city->name;
    }
}
