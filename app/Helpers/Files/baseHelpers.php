<?php

if (!function_exists('front_url')) {
    function front_url() {
        return url('/');
    }
}
