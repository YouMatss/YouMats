<?php

if (!function_exists('front_url')) {
    function front_url() {
        return url('/');
    }
}

if (!function_exists('is_guest')) {
    function is_guest() {
        return (auth('web')->user()) ? false : true;
    }
}

if (!function_exists('is_individual')) {
    function is_individual() {
        if(auth('web')->user() && auth('web')->user()->type == 'individual')
            return true;
        else
            return false;
    }
}

if (!function_exists('is_company')) {
    function is_company() {
        if(auth('web')->user() && auth('web')->user()->type == 'company')
            return true;
        else
            return false;
    }
}

