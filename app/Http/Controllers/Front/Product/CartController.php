<?php


namespace App\Http\Controllers\Front\Product;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function showCart(Request $request)
    {
        $cart = session('cart');

        return view('front.cart.index', ['cart' => $cart]);
    }

    public function addToCart(Request $request, $product)
    {
        /**
         * TODO: implement add to cart functionality here.
         */
    }
}
