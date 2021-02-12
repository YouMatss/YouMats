<?php


namespace App\Http\Controllers\Front\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function show(Request $request)
    {
        $cart = Cart::instance('cart')->content();

        return view('front.cart.index', ['items' => $cart]);
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return JsonResponse
     */
    public function add(Request $request, Product $product): JsonResponse
    {
        Cart::instance('cart')->add($product->id, $product->name, 1, $product->price, [], $product->rate)->associate($product);

        return response()->json(['message' => __('Product has been added to your cart'),
            'cart' => Cart::content(),
            'total' => getCurrency('code') . ' ' . Cart::total(),
            'count' => Cart::count()]);
    }

    /**
     * @param Request $request
     * @param $rowId
     * @return JsonResponse
     */
    public function deleteItem(Request $request, $rowId): JsonResponse
    {
        Cart::instance('cart')->remove($rowId);

        return response()->json(['status' => true, 'total' => getCurrency('code'). ' ' . Cart::total(), 'count' => Cart::count(), 'subtotal' => Cart::subtotal(), 'tax' => Cart::tax()]);
    }

    /**
     * @return JsonResponse
     */
    public function destroy(): JsonResponse
    {
        Cart::instance('cart')->destroy();

        return response()->json(['status' => true, 'message' => __('Cart has been destroyed')]);
    }

    /**
     * @param Request $request
     * @param $rowId
     */
    public function update(Request $request)
    {
        Cart::instance('cart')->update($request->rowId, $request->qty);

        return response()->json(['status' => true]);
    }
}
