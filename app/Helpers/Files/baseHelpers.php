<?php

use App\Helpers\Classes\Shipping as ShippingHelper;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
        $vendor = $product->vendor;
        $product_route = route('front.product', [generatedNestedSlug($product->category->ancestors()->pluck('slug')->toArray(), $product->category->slug), $product->slug]);
        $viewIndex = '<div><a href="'.$product_route.'"
                    class="cart-chat-category btn btn-primary transition-3d-hover">
                        <i class="fa fa-eye"></i> &nbsp;' . __("general.view_product") . '
                    </a>
                </div>';

        $viewDetails = '<a class="cart-chat-category btn-primary transition-3d-hover"
                            href="'.route('front.category', [generatedNestedSlug($product->category->ancestors()->pluck('slug')->toArray(), $product->category->slug)]).'">'. __('product.category_href'). ': ' . $product->category->name .'</a>';

        $chat = '<div><a target="_blank" href="'.$product->whatsapp_message().'"
                    class="cart-chat-category btn btn-primary transition-3d-hover log" data-log="chat" data-url="'.$product_route.'">
                        <i class="fa fa-comments"></i> &nbsp;' . __("general.chat_button") . '
                    </a>
                </div>';

        $call = '<div><button onclick="SetUpCall('. Clean_Phone_Number(get_contact($vendor, 'call_phone')) .')"
                            type="button"
                            class="cart-chat-category btn btn-primary transition-3d-hover log" data-log="call" data-url="'.$product_route.'"
                            style="cursor:pointer;background-color: #5cb85c;border-color: #5cb85c;">
                        <i class="fa fa-phone"></i> &nbsp;' . __("general.call_button") . '
                    </button>
                </div>';

        $directCall = '<div><a href="tel:'. get_contact($vendor, 'call_phone') .'"
                            class="cart-chat-category btn btn-primary transition-3d-hover log" data-log="call" data-url="'.$product_route.'"
                            style="cursor:pointer;background-color: #5cb85c;border-color: #5cb85c;">
                        <i class="fa fa-phone"></i> &nbsp;' . __("general.call_button") . '
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
                    data-delivery-url="'. route('cart.delivery_warning', ['product' => $product]) .'"
                    class="btn-add-cart cart-chat-category btn btn-primary transition-3d-hover" style="cursor: pointer;">
                    <i class="' . $icon .'"></i> &nbsp;' . $cart_word . '
                </button>
            </div>';
            $view = $viewDetails;
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
                        data-delivery-url="'. route('cart.delivery_warning', ['product' => $product]) .'"
                        class="btn-add-cart cart-chat-category btn btn-primary transition-3d-hover"><i class="' . $icon .'"></i></button>
                </div>
            </div>';
            $view = $viewIndex;
        }

        if(!(is_guest() && !\Illuminate\Support\Facades\Session::has('userType'))) {
            if (is_company()) {
                $result = $cart;
                if(get_contact($vendor, 'call_phone') && nova_get_setting('enable_phone_buttons')) {
                    if(nova_get_setting('enable_3cx') || $vendor->enable_3cx) {
                        $result .= $call;
                    } else {
                        $result .= $directCall;
                    }
                }
                if(get_contact($vendor, 'phone'))
                    $result .= $chat;
                return $result;
            } elseif(!$product->subscribe) {
                return $view;
            } elseif($product->price && $product->price > 0 && $product->delivery && $product->stock && $product->stock >= $product->min_quantity) {
                $result1 = $cart;
                if(get_contact($vendor, 'call_phone') && nova_get_setting('enable_phone_buttons')) {
                    if(nova_get_setting('enable_3cx') || $vendor->enable_3cx) {
                        $result1 .= $call;
                    } else {
                        $result1 .= $directCall;
                    }
                }
                if(get_contact($vendor, 'phone'))
                    $result1 .= $chat;
                return $result1;
            } else {
                $result2 = '';
                if(get_contact($vendor, 'call_phone') && nova_get_setting('enable_phone_buttons')) {
                    if(nova_get_setting('enable_3cx') || $vendor->enable_3cx) {
                        $result2 .= $call;
                    } else {
                        $result2 .= $directCall;
                    }
                } else {
                    $result2 .= $view;
                }
                if(get_contact($vendor, 'phone'))
                    $result2 .= $chat;
                return $result2;
            }
        }
        return;
    }
}

if (!function_exists('generate_map')) {
    function generate_map() {
        $html_tag = "";
        $html_tag .= '<div class="col-md-12">';
        $html_tag .= '<input id="pac-input" class="controls form-control" type="text" placeholder="'. __('general.map_search') .'">';
        $html_tag .= '<div id="element_map" class="col-md-12" style="max-width: 100%;height:400px;"></div>';
        $html_tag .= '</div>';
        $html_tag .= '<hr>';
        return $html_tag;
    }
}

if (!function_exists('generate_map_branch')) {
    function generate_map_branch() {
        $html_tag = "";
        $html_tag .= '<div class="col-md-12">';
        $html_tag .= '<input id="pac-input-branch" class="controls form-control" type="text" placeholder="'. __('general.map_search') .'">';
        $html_tag .= '<div id="element_map_branch" class="col-md-12" style="height:400px;"></div>';
        $html_tag .= '</div>';
        $html_tag .= '<hr>';
        return $html_tag;
    }
}

function encrypt_vendor_message($vendor_name) {

    $encrypted_string = '';

    $array = [
        'a' => 'w', 'b' => 'h', 'c' => 'q', 'd' => 'g',
        'e' => 't', 'f' => 'r', 'g' => 'f', 'h' => 'd',
        'i' => 'e', 'j' => 's', 'k' => 'y', 'l' => 'a',
        'm' => 'u', 'n' => 'z', 'o' => 'i', 'p' => 'x',
        'q' => 'o', 'r' => 'c', 's' => 'p', 't' => 'v',
        'u' => 'l', 'v' => 'b', 'w' => 'k', 'x' => 'n',
        'y' => 'j', 'z' => 'm'
    ];

    foreach (str_split($vendor_name) as $letter) {
        $encrypted_string .= $array[strtolower($letter)] ?? $letter;
    }
    return $encrypted_string;

}

if (!function_exists('vendor_encrypt')) {
    function vendor_encrypt($vendor) {

        $vendor_name = $vendor ? $vendor->getTranslation('name', 'en') : '';

        return encrypt_vendor_message($vendor_name);
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

if(!function_exists('getFullProductLink')) {
    /**
     * @param $productModel
     * @return string
     */
    function getFullProductLink($productModel): string
    {
        $slugs = optional(optional(optional(optional($productModel)->category)->ancestors())->pluck('slug'))->toArray();

        if(!isset($slugs))
            return '#';

        return route('front.product', [generatedNestedSlug($slugs, $productModel->category->slug), $productModel->slug]);
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

if (!function_exists('nova_get_setting_translate')) {
    function nova_get_setting_translate($settingKey)
    {
        $value = nova_get_setting($settingKey);
        return json_decode($value)->{app()->getLocale()} ?? $value;
    }
}

if (!function_exists('getDelivery')) {
    function getDelivery($product, $quantity) {
        try {
            $remap_shipping = [];
            if($product->specific_shipping && $product->shipping_prices) {
                $remap_shipping = ShippingHelper::remap($product->shipping_prices, false);
            } elseif(isset($product->shipping) && $product->shipping->prices) {
                $remap_shipping = ShippingHelper::remap($product->shipping->prices);
            }
            foreach ($remap_shipping as $city => $shipping) {
                if(Session::has('city') && $city == Session::get('city')) {
                    return ShippingHelper::result(ShippingHelper::getBestPrice($shipping, $quantity));
                }
            }
            return null;
        } catch (\Exception $e) {}
    }
}

function cart_delivery() {
    $delivery = 0;
    $cart = Cart::instance('cart')->content();
    foreach ($cart as $item) {
        $product = $item->model;

        $deliveryIsExist = getDelivery($product, $item->qty);
        if(!is_null($deliveryIsExist)) {
            $delivery += round($deliveryIsExist['price'] / getCurrency('rate'), 2);
        }
    }

    return number_format($delivery, 2);
}

function cart_total() {
    return number_format(parseNumber(Cart::instance('cart')->total()) + cart_delivery(), 2);
}

if(!function_exists('getMetaTag')) {
    function getMetaTag($model, $key, $default, $second_default = '') {
        $value = $model->getTranslation($key, LaravelLocalization::getCurrentLocale(), false);
        if(!empty($value))
            return $value;
        elseif(!empty($default))
            return $default;
        else
            return $second_default;
    }
}

if(!function_exists('isSubscribe')) {
    function isSubscribe($subscribes, $category_id, $membership_id, $return_model = false) {
        if (!isset($subscribes) || !count($subscribes))
            return false;
        foreach ($subscribes as $subscribe)
            if ($subscribe->category_id == $category_id && $subscribe->membership_id == $membership_id) {
                if($return_model)
                    return $subscribe;
                else
                    return true;
            }
    }
}

if(!function_exists('Clean_Phone_Number')) {
    function Clean_Phone_Number($raw_number){
        // remove any character
        // remove country code of saudi arabia (966)

        $filered_number = preg_replace('/^\+?966|\|966|\D+/', '', ($raw_number));

        if(strlen($filered_number) >= 9 && strlen($filered_number) <= 10){
            $filered_number = (substr($filered_number, 0, 1) !== "0") ? "80".$filered_number : "8".$filered_number;
        }

        return  $filered_number;
    }
}

if(!function_exists('get_contact')) {
    function get_contact($vendor, $type) {
        try {
            if(isset($vendor->contacts)) {
                foreach ($vendor->contacts as $contact) {
                    if(Session::has('city') && Session::has('userType') && isset($contact['cities'])
                        && ($contact['with'] == Session::get('userType') || $contact['with'] == 'both')) {
                        foreach ($contact['cities'] as $city) {
                            if($city == Session::get('city')) {
                                return $contact[$type];
                            }
                        }
                    }
                }
                return null;
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
