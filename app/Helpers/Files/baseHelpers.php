<?php

if (!function_exists('front_url')) {
    function front_url() {
        return url('/');
    }
}

if (!function_exists('is_guest')) {
    function is_guest() {
        return (auth('web')->user() || auth('vendor')->user()) ? false : true;
    }
}

if (!function_exists('is_individual')) {
    function is_individual() {
        $session = \Illuminate\Support\Facades\Session::get('userType');
        if(auth('web')->user()) {
            if(auth('web')->user()->type == 'individual') {
                return true;
            }
        } else {
            if(isset($session) && $session == 'individual') {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('is_company')) {
    function is_company() {
        $session = \Illuminate\Support\Facades\Session::get('userType');
        if(auth('web')->user()) {
            if(auth('web')->user()->type == 'company') {
                return true;
            }
        } else {
            if(isset($session) && $session == 'company') {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('getCityNameById')) {
    function getCityNameById($id) {
        $city = \App\Models\City::find($id);

        if($city)
            return $city->name;
        else
            return 'City Not Found.';
    }
}

if (!function_exists('cartOrChat')) {
    function cartOrChat($product) {

        $chat = '<div><a href="'. route('chat.user.conversations', [$product->vendor_id]) .'" class="btn-add-cart btn-primary transition-3d-hover"><i class="fa fa-comments"></i></a></div>';
        $icon = is_company() ? 'fa fa-file-alt': 'ec ec-add-to-cart';
        $additionalStyle = '';

        $cartItems = \Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->content();
        foreach($cartItems as $item) {
            if($item->id == $product->id) {
                $icon = 'fa fa-check';
                $additionalStyle = 'background-color: green; border-color: green;';
            }
        }

        $cart = '<div class="prodcut-add-cart" ><button style="' . $additionalStyle . '" data-url="' . route('cart.add', ['product' => $product]) . '" class="btn-add-cart btn-primary transition-3d-hover"><i class="' . $icon .'"></i></button></div>';

        if(!(is_guest() && !\Illuminate\Support\Facades\Session::has('userType'))) {
            if (is_company() || ($product->type == 'product' && $product->price > 0))
                return $cart;
            else
                return $chat;
        }
        return;
    }
}

if (!function_exists('generate_map')) {
    function generate_map() {
        $html_tag = "";
        $html_tag .= '<div class="col-md-12">';
        $html_tag .= '<input id="pac-input" class="controls form-control" style="width: 60%;margin-top: 8px;" type="text" placeholder="Search Box">';
        $html_tag .= '<div id="element_map" class="col-md-12" style="height:400px;"></div>';
        $html_tag .= '</div>';
        $html_tag .= '<hr>';
        return $html_tag;
    }
}
if (!function_exists('generate_map_branch')) {
    function generate_map_branch() {
        $html_tag = "";
        $html_tag .= '<div class="col-md-12">';
        $html_tag .= '<input id="pac-input-branch" class="controls form-control" style="width: 60%;margin-top: 8px;" type="text" placeholder="Search Box">';
        $html_tag .= '<div id="element_map_branch" class="col-md-12" style="height:400px;"></div>';
        $html_tag .= '</div>';
        $html_tag .= '<hr>';
        return $html_tag;
    }
}

function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000) {
    // convert from degrees to radians
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
    return ($angle * $earthRadius) / 1000;
}
