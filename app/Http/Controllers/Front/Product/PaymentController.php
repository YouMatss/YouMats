<?php

namespace App\Http\Controllers\Front\Product;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Devinweb\Payment\Facades\Payment;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Cache;

class PaymentController extends Controller
{
    public string $provider = 'payfort';

    public function form() {

        try {
            $data['order'] = Order::whereOrderId(Cache::get('order_id'))->first();

            $data['cart'] = Cart::instance('cart');
            $data['cartItems'] = $data['cart']->search(function($cartItems) {
                return true;
            });

            return view('front.payment.form')->with($data);
        } catch (\Exception $exception) {
            abort(401);
        }

    }

    public function submit() {
        $merchant_reference = Payment::use($this->provider)->generateMerchantReference();
        return Payment::use($this->provider, $merchant_reference)->pay();
    }

    public function success() {
        try {
            $data['order'] = Order::whereOrderId(Cache::get('order_id'))->first();

            $data['cart'] = Cart::instance('cart');
            $data['cartItems'] = $data['cart']->search(function($cartItems) {
                return true;
            });

            //Clear the cart!
            Cart::instance('cart')->destroy();

            return view('front.payment.success')->with($data);
        } catch (\Exception $exception) {
            abort(401);
        }
    }

    public function error() {

        dd(request());

        try {
            $data['order'] = Order::whereOrderId(Cache::get('order_id'))->first();

            $data['cart'] = Cart::instance('cart');
            $data['cartItems'] = $data['cart']->search(function($cartItems) {
                return true;
            });

            return view('front.payment.error')->with($data);
        } catch (\Exception $exception) {
            abort(401);
        }
    }
}
