<?php

namespace App\Helpers\Classes;

use App\Models\Category;
use App\Models\Log as LogModel;
use App\Models\Product;
use Illuminate\Support\Facades\Request;
use Stevebauman\Location\Facades\Location;

class Log
{
    public static function set($type = 'visit', $page = [null, null], $url = '') {
        $ip = Request::ip();
        $location = Location::get($ip);
        if($location) {
            $is_subscribed = false;
            if(empty($url))
                $url = url()->current();

            if((!is_null($page[0])) && $page[0] != Category::class) {
                if($page[0] == Product::class)
                    $model = $page[0]::whereId($page[1])->first(['id', 'vendor_id', 'category_id']);
                else
                    $model = $page[0]::whereId($page[1])->first('id');
                $is_subscribed = $model->subscribe;
            }
            LogModel::create([
                'ip' => $ip,
                'country' => $location->countryName,
                'city' => $location->cityName,
                'url' => $url,
                'type' => $type,
                'page_type' => $page[0],
                'page_id' => $page[1],
                'is_subscribed' => $is_subscribed,
                'created_at' => now()
            ]);
        }
    }
}
