<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use Stevebauman\Location\Facades\Location;
use App\Models\City;

if (!function_exists('setCityLocation')) {
    function setCityLocation() {
        try {
            $ip = Request::ip();
            $location = Location::get($ip);
            if($location) {
                $city = City::where('name', 'LIKE', '%'.$location->cityName.'%')->first();
                if($city) {
                    Session::put('city', $city);
                }
            }
        } catch (\Exception $e) {}
    }
}

if (!function_exists('setCity')) {
    function setCity($city_id) {
        $city = City::find($city_id);
        if($city)
            Session::put('city', $city);
    }
}
