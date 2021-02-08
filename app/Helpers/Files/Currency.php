<?php

use Illuminate\Support\Facades\Session;
use App\Models\Currency;

if (!function_exists('checkCurrencyLocation')) {
    function checkCurrencyLocation() {
        try {
            $ip = request()->ip();
            $location = geoip($ip);
            $currencyCode = $location->currency;
        } catch (\Exception $e) {
            $currencyCode = 'SAR';
        }
        return $currencyCode;
    }
}

if (!function_exists('checkCurrencySession')) {
    function checkCurrencyCode() {
        if(Session::has('currencyCode'))
            $currencyCode = Session::get('currencyCode');
        else
            $currencyCode = checkCurrencyLocation();
        return $currencyCode;
    }
}

if (!function_exists('setCurrency')) {
    function setCurrency() {
        $currencyCode = checkCurrencyCode();
        $currency = Currency::where('code', $currencyCode)->select('name', 'code', 'symbol', 'rate')->first();
        Session::put('currency', [
            'name' => $currency->name ?? 'Saudi Riyal',
            'code' => $currency->code ?? 'SAR',
            'symbol' => $currency->symbol ?? '﷼',
            'rate' => $currency->rate ?? 1
        ]);
    }
}

if (!function_exists('getCurrency')) {
    function getCurrency($value) {
        if(!Session::has('currency'))
            setCurrency();
        return Session::get('currency')[$value];
    }
}
