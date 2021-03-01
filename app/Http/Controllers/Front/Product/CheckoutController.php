<?php

namespace App\Http\Controllers\Front\Product;

use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;
use App\Models\City;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class CheckoutController extends Controller
{
    /**
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function index()
    {
        $cartItems = Cart::instance('cart')->content();

        if(Cart::count() == 0)
            return redirect('/')->with(['custom_warning' => __('Add products to your cart first')]);

        $paymentGateways = PaymentGateway::all();
        $cities = City::all();

        return view('front.checkout.index', [
            'cartItems' => $cartItems,
            'paymentGateways' => $paymentGateways,
            'cities' => $cities
        ]);
    }

    public function checkout(Request $request)
    {
        dd($request->all());
    }
}
