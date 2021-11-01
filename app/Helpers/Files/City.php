<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use Stevebauman\Location\Facades\Location;
use App\Models\City;

function setDefaultCity() {
    $defaultCity = City::find(1);
    Session::put('city', $defaultCity);
}

if (!function_exists('setCityLocation')) {
    function setCityLocation() {
        if(!Session::has('city')) {
            try {
                $ip = Request::ip();
                $location = Location::get($ip);
                if($location) {
                    $city = City::where('name', 'LIKE', '%'.$location->cityName.'%')->first();
                    if($city) {
                        Session::put('city', $city);
                    } else {
                        setDefaultCity();
                    }
                } else {
                    setDefaultCity();
                }
            } catch (\Exception $e) {
                setDefaultCity();
            }
        }
    }
}

if (!function_exists('setCity')) {
    function setCity($city_id) {
        $city = City::find($city_id);
        if($city)
            Session::put('city', $city);
    }
}

if (!function_exists('getCity')) {
    function getCity() {
        if(Session::has('city'))
            return Session::get('city');
    }
}
