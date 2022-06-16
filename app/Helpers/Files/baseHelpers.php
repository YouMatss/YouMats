<?php

use Illuminate\Support\Facades\Session;

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
    function cartOrChat($product, $view_page = true) {
        $chat = '<div><a target="_blank" href="https://wa.me/'. nova_get_setting('phone') .'?text='.$product->whatsapp_message().'"
                    class="cart-chat-category btn btn-primary transition-3d-hover">
                        <i class="fa fa-comments"></i> &nbsp;' . __("general.chat_button") . '
                    </a>
                </div>';

        $icon = is_company() ? 'fa fa-file-alt' : 'ec ec-add-to-cart';
        $cart_word = is_company() ? __("general.add_to_quote") : __("general.add_to_cart");

        if($view_page) {
            $cart = '
            <div class="border py-1 px-3 border-color-1">
                <div class="js-quantity row align-items-center">
                    <div class="col">
                        <input class="cart-quantity js-result form-control h-auto border-0 rounded p-0 shadow-none" type="text" min="'.$product->min_quantity.'" value="'.$product->min_quantity.'">
                    </div>
                    <div class="col-auto pr-1">
                        <a class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0">
                            <small class="fas fa-minus btn-icon__inner"></small>
                        </a>
                        <a class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0">
                            <small class="fas fa-plus btn-icon__inner"></small>
                        </a>
                    </div>
                </div>
            </div>
            <div>
                <button type="button" data-url="' . route('cart.add', ['product' => $product]) . '"
                    class="btn-add-cart cart-chat-category btn btn-primary transition-3d-hover" style="cursor: pointer;">
                    <i class="' . $icon .'"></i> &nbsp;' . $cart_word . '
                </button>
            </div>';
        } else {
            $cart = '
            <div class="float-container">
                <div class="float-child-quantity">
                    <div class="border py-1 px-3 border-color-1">
                        <div class="js-quantity row align-items-center">
                            <div class="col">
                                <input class="cart-quantity js-result form-control h-auto border-0 rounded p-0 shadow-none" type="text" min="'.$product->min_quantity.'" value="'.$product->min_quantity.'">
                            </div>
                            <div class="col-auto pr-1">
                                <a class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0">
                                    <small class="fas fa-minus btn-icon__inner"></small>
                                </a>
                                <a class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0">
                                    <small class="fas fa-plus btn-icon__inner"></small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="float-child-cart">
                    <button type="button" data-url="' . route('cart.add', ['product' => $product]) . '"
                        class="btn-add-cart cart-chat-category btn btn-primary transition-3d-hover"><i class="' . $icon .'"></i></button>
                </div>
            </div>';
        }

        $view = '<div><a href="'.route('front.product', [generatedNestedSlug($product->category->ancestors()->pluck('slug')->toArray(), $product->category->slug), $product->slug]).'"
                    class="cart-chat-category btn btn-primary transition-3d-hover">
                        <i class="fa fa-eye"></i> &nbsp;' . __("general.view_product") . '
                    </a>
                </div>';

        if(!(is_guest() && !\Illuminate\Support\Facades\Session::has('userType'))) {
            if (is_company()) {
                return $cart;
            } elseif(!$product->vendor->current_subscribe) {
                return $view;
            } elseif($product->type == 'product' && $product->price > 0 && $product->delivery) {
                if($product->stock && $product->stock < $product->min_quantity) {
                    return $view;
                }
                return $cart;
            } else {
                if(($product->price || $product->delivery) && $product->phone()) {
                    return $chat;
                } else {
                    return $view;
                }
            }
        }
        return;
    }
}

if (!function_exists('generate_map')) {
    function generate_map() {
        $html_tag = "";
        $html_tag .= '<div class="col-md-12">';
        $html_tag .= '<input id="pac-input" class="controls form-control" style="width: 60%;margin-top: 8px;" type="text" placeholder="'. __('general.map_search') .'">';
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
        $html_tag .= '<input id="pac-input-branch" class="controls form-control" style="width: 60%;margin-top: 8px;" type="text" placeholder="'. __('general.map_search') .'">';
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

if(!function_exists('generatedNestedSlug')) {
    /**
     * @param $array
     * @param $slug
     * @return string
     */
    function generatedNestedSlug($array, $slug): string
    {
        if(count($array) == 0) {
            return $slug;
        }

        return implode('/', $array) . '/' . $slug;
    }
}

if (!\Illuminate\Support\Collection::hasMacro('ungroup')) {
    /**
     * Ungroup a previously grouped collection (grouped by {@see Collection::groupBy()})
     */
    \Illuminate\Support\Collection::macro('ungroup', function () {
        // create a new collection to use as the collection where the other collections are merged into
        $newCollection = \Illuminate\Support\Collection::make([]);
        // $this is the current collection ungroup() has been called on
        // binding $this is common in JS, but this was the first I had run across it in PHP
        $this->each(function ($item) use (&$newCollection) {
            // use merge to combine the collections
            $newCollection = $newCollection->merge($item);
        });

        return $newCollection;
    });
}

function parseNumber($number) {
    return floatval(preg_replace('/[^\d.]/', '', $number));
}

if (!function_exists('getDelivery')) {
    function getDelivery($product, $quantity) {
        if($product->specific_shipping) {
            if($product->shipping_prices) {
                foreach ($product->shipping_prices as $shipping) {
                    if(Session::has('city') && $shipping['cities'] == Session::get('city')
                        && $shipping['from'] <= $quantity && $shipping['to'] >= $quantity) {
                        $shipping['price'] = (string)$shipping['price'];
                        return $shipping;
                    }
                }
            }
            if(isset($product->default_price) && isset($product->default_time) && isset($product->default_format)) {
                return [
                    'price' => (string)$product->default_price,
                    'from' => $product->default_from,
                    'to' => $product->default_to,
                    'time' => $product->default_time,
                    'format' => $product->default_format,
                ];
            }
        }
        if (isset($product->shipping)) {
            if($product->shipping->cities_prices) {
                foreach ($product->shipping->cities_prices as $shipping) {
                    if(Session::has('city') && $shipping['cities'] == Session::get('city')) {
                        $shipping['price'] = (string)$shipping['price'];
                        return $shipping;
                    }
                }
            }
            if($product->shipping->default_price && $product->shipping->default_time && $product->shipping->default_format) {
                return [
                    'price' => (string)$product->shipping->default_price,
                    'from' => $product->default_from,
                    'to' => $product->default_to,
                    'time' => $product->shipping->default_time,
                    'format' => $product->shipping->default_format,
                ];
            }
        }
        return null;
    }
}
