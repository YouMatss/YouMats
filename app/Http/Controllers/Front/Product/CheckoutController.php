<?php

namespace App\Http\Controllers\Front\Product;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentGateway;
use App\Models\City;
use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\User;
use App\Notifications\OrderCreated;
use App\Notifications\QuoteCreated;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

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
            'payment_method' => [...[NULLABLE_STRING_VALIDATION], 'In:Cash,Online', Rule::requiredIf(fn() => is_individual())],
            'terms' => 'required|accepted',
            'name' => REQUIRED_STRING_VALIDATION,
            'phone_number' => REQUIRED_STRING_VALIDATION,
            'address' => REQUIRED_STRING_VALIDATION,
            'building_number' => NULLABLE_INTEGER_VALIDATION,
            'street' => NULLABLE_STRING_VALIDATION,
            'district' => NULLABLE_STRING_VALIDATION,
            'city' => NULLABLE_INTEGER_VALIDATION,
            'email' => REQUIRED_EMAIL_VALIDATION,
            'notes' => NULLABLE_STRING_VALIDATION,
            'notes.*.title' => NULLABLE_STRING_VALIDATION,
            'delivery_time' => [...[NULLABLE_STRING_VALIDATION], Rule::requiredIf(fn() => is_company())],
            'delivery_time_unit' => [...[NULLABLE_STRING_VALIDATION], Rule::requiredIf(fn() => is_company()), 'In:day,week,month'],
            'attachments.*' => NULLABLE_FILE_VALIDATION,
            'latitude' => NULLABLE_STRING_VALIDATION,
            'longitude' => NULLABLE_STRING_VALIDATION
        ];

        $data = $request->validate($rules);

        //Let's create an account for him & login so we complete the order.
        if(!Auth::guard('web')->check()) {
            $rules['email'] = 'required|email|unique:users|max:191';

            if(!session()->has('userType'))
                $rules['type'] =  'required|string|In:individual,company';

            $rules['password'] =  'required|string|min:8|confirmed';
            $data += $request->validate($rules);

            $user = User::create([
                'type' => session()->has('userType') ? session()->get('userType') : $data['type'],
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone_number'],
                'address' => $data['address'],
                'password' => Hash::make($data['password']),
            ]);

            //Login
            Auth::guard('web')->loginUsingId($user->id);
        }

        $coupon = Cart::instance('cart')->search(function($cartItem, $rowItem) {
            return $cartItem->id == 'discount';
        });
        $total = round(parseNumber(Cart::instance('cart')->total()));

        //Append default values to the data.
        $data['city'] = Session::get('city') ?? null;
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

        //Prepare data for insertion
        $user = Auth::guard('web')->user();
        $type = '';

        if($user)
            $type = $user->type;
        else if(session()->has('userType'))
            $type = session()->get('userType');
        else
            $type = $data['type'];

        $data['phone'] = $data['phone_number'];
        unset($data['phone_number']);


        //A company is ordering. So let's register all the order as service
        if($type == 'company') {
            $data['quote_no'] = 'QOT-'. strtoupper(uniqid());
            $data['user_id'] = $user->id;
            $data['status'] = 'pending';
            $quote = Quote::create($data);

            foreach(Admin::all() as $admin)
                $admin->notify(new QuoteCreated($user, $quote));


            if($request->has('attachments'))
                foreach($data['attachments'] as $attachment)
                    $quote->addMedia($attachment)->toMediaCollection(QUOTE_ATTACHMENT);

            foreach($cartItems as $item)
            {
                QuoteItem::create([
                    'quote_id'      => $quote->id,
                    'product_id'    => $item->model->id,
                    'product_name'  => $item->model->name,
                    'vendor_id'     => $item->model->vendor_id,
                    'vendor_name'   => $item->model->vendor->name,
                    'quantity'      => $item->qty,
                ]);
            }
            $returnText = __('checkout.quote_placed_successfully');

        } else if ($type == 'individual') {
            $order = Order::create($data);

            foreach(Admin::all() as $admin)
                $admin->notify(new OrderCreated($user, $order));

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
            $returnText = __('checkout.order_placed_successfully');
        }

        if(isset($order) && strtolower($order->payment_method) == 'online') {
            Cache::put('order_id', $order->order_id);
            return redirect()->route('payment.form');
        }

        //Clear the cart!
        Cart::instance('cart')->destroy();

        return redirect('/')->with(['custom_success' => __($returnText) ]);
    }
}
