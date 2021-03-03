<?php

namespace App\Http\Controllers\Front\Product;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentGateway;
use App\Models\City;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function index()
    {
        $cartItems = Cart::instance('cart')->content();

        $coupon = Cart::instance('cart')->search(function($cartItem, $rowItem) {
           return $cartItem->id == 'discount';
        });

        if(Cart::count() == 0)
            return redirect('/')->with(['custom_warning' => __('Add products to your cart first')]);

        $paymentGateways = PaymentGateway::all();
        $cities = City::all();

        return view('front.checkout.index', [
            'cartItems' => $cartItems,
            'paymentGateways' => $paymentGateways,
            'cities' => $cities,
            'coupon' => $coupon[array_key_first(current($coupon))] ?? null
        ]);
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function checkout(Request $request)
    {
        //Validating the data.
        $data = $request->validate([
            'payment_method' => REQUIRED_STRING_VALIDATION,
            'terms' => 'required|accepted',
            'name' => REQUIRED_STRING_VALIDATION,
            'phone' => REQUIRED_STRING_VALIDATION,
            'address' => REQUIRED_STRING_VALIDATION,
            'building_number' => REQUIRED_INTEGER_VALIDATION,
            'street' => NULLABLE_STRING_VALIDATION,
            'district' => NULLABLE_STRING_VALIDATION,
            'city' => REQUIRED_STRING_VALIDATION,
            'email' => REQUIRED_EMAIL_VALIDATION,
            'notes' => NULLABLE_STRING_VALIDATION
        ]);

        $coupon = Cart::instance('cart')->search(function($cartItem, $rowItem) {
            return $cartItem->id == 'discount';
        });
        $total = Cart::instance('cart')->total();

        //Append default values to the data.
        $data['payment_status'] = 'pending';
        $data['order_status']   = 'pending';
        $data['coupon_code']    = $coupon[array_key_first(current($coupon))]->name ?? null;
        $data['total_price']    = $total;
        $data['order_id']       = 'ORD-'. strtoupper(uniqid());
        $data['user_id']        = Auth::guard('web')->user()->id;
        unset($data['terms']);

        $cartItems = Cart::instance('cart')->search(function($cartItems, $rowItems) {
            return $cartItems->id !== 'discount';
        });
        $userType = Auth::guard('web')->user()->type;

        //A company is ordering. So let's register all the order as service
        if($userType == 'company') {
            dd('Enta company yasta? Mashy...');
        } else if ($userType == 'individual') {
            $order = Order::create($data);

            foreach($cartItems as $item)
            {
                if($item->model->type == 'product')
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->model->id,
                        'vendor_id' => $item->model->vendor_id,
                        'vendor_name' => $item->model->vendor->name,
                        'status' => 'pending',
                        'quantity' => $item->qty,
                        'price' => $item->model->price
                    ]);
                else
                    dd("You are ordering a service");
            }

            Cart::instance('cart')->destroy();
        }

        return redirect('/')->with(['custom_success' => __("Order has been placed successfully.") ]);
    }
}
