<?php

namespace App\Http\Controllers\Front\Product;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentGateway;
use App\Models\City;
use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $rules = [
//            'payment_method' => REQUIRED_STRING_VALIDATION,
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
        ];
        $data = $request->validate($rules);

        //Let's create an account for him & login so we complete the order.
        if(!Auth::guard('web')->check()) {
            $rules['email'] = 'required|email|unique:users|max:191';
            $rules['type'] =  'required|string|In:individual,company';
            $rules['password'] =  'required|string|min:8|confirmed';
            $data += $request->validate($rules);

            $user = User::create([
                'type' => $data['type'],
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'password' => Hash::make($data['password']),
            ]);

            //Login
            Auth::guard('web')->loginUsingId($user->id);
        }

        $coupon = Cart::instance('cart')->search(function($cartItem, $rowItem) {
            return $cartItem->id == 'discount';
        });
        $total = Cart::instance('cart')->total();

        //Append default values to the data.
        $data['payment_status'] = 'pending';
        $data['status']   = 'pending';
        $data['coupon_code']    = $coupon[array_key_first(current($coupon))]->name ?? null;
        $data['total_price']    = $total;
        $data['order_id']       = 'ORD-'. strtoupper(uniqid());
        $data['user_id']        = Auth::guard('web')->user()->id;
        unset($data['terms']);
        unset($data['type']);
        unset($data['password']);
        $returnText = '';

        $cartItems = Cart::instance('cart')->search(function($cartItems, $rowItems) {
            return $cartItems->id !== 'discount';
        });
        $user = Auth::guard('web')->user();

        //A company is ordering. So let's register all the order as service
        if($user->type == 'company') {
            $quote = Quote::create([
                'quote_no'          => 'QOT-'. strtoupper(uniqid()),
                'user_id'           => $user->id,
                'name'              => $data['name'],
                'email'             => $data['email'],
                'phone'             => $data['phone'],
                'address'           => $data['address'],
                'building_number'   => $data['building_number'],
                'street'            => $data['street'],
                'district'          => $data['district'],
                'city'              => $data['city'],
                'status'            => 'pending',
                'notes'             => $data['notes']
            ]);

            foreach($cartItems as $item)
            {
                QuoteItem::create([
                    'quote_id'      => $quote->id,
                    'product_id'    => $item->model->id,
                    'product_name'  => $item->model->name,
                    'quantity'      => $item->qty,
                ]);
            }
            $returnText = "Quote has been placed successfully.";

        } else if ($user->type == 'individual') {
            $order = Order::create($data);

            foreach($cartItems as $item)
            {
                if($item->model->type == 'product')
                    OrderItem::create([
                        'order_id'      => $order->id,
                        'product_id'    => $item->model->id,
                        'vendor_id'     => $item->model->vendor_id,
                        'vendor_name'   => $item->model->vendor->name,
                        'status'        => 'pending',
                        'payment_status'=> 'pending',
                        'quantity'      => $item->qty,
                        'price'         => $item->model->price
                    ]);
            }
            $returnText = "Order has been placed successfully.";
        }

        //Clear the cart!
        Cart::instance('cart')->destroy();

        return redirect('/')->with(['custom_success' => __($returnText) ]);
    }
}
