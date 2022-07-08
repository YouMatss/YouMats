<?php

namespace App\Http\Controllers\Front\Vendor\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\SubScribeRequest;
use App\Models\Membership;
use App\Models\Subscribe;
use Carbon\Carbon;
use Devinweb\Payment\Facades\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class SubScribeController extends Controller
{
    public string $provider = 'payfort';

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:vendor');
        //If you would like to add "vendor verification middleware":
        $this->middleware('verified:vendor.verification.notice');
    }

    public function index() {
        $data['vendor'] = Auth::guard('vendor')->user();
        $data['memberships'] = Membership::all();
        $data['current_subscribe_id'] = $data['vendor']->current_subscribe->membership_id ?? null;

        return view('vendorAdmin.subscribe.index')->with($data);
    }

    public function upgrade(SubScribeRequest $request) {
        $data = $request->validated();
        try {
            $data['vendor'] = Auth::guard('vendor')->user();
            $data['membership'] = Membership::findorfail($data['membership_id']);

            if(isset($data['vendor']->current_subscribe) && $data['vendor']->current_subscribe->membership_id == $data['membership_id'])
                return abort(404);

            Session::put('membership_id', $data['membership_id']);

            return view('vendorAdmin.subscribe.payment.form')->with($data);
        } catch (\Exception $exception) {
            return redirect()->route('home');
        }
    }

    public function submit() {
        $merchant_reference = Payment::use($this->provider)->generateMerchantReference();
        return Payment::use($this->provider, $merchant_reference)->pay();
    }

    public function success() {
        try {
            $data['request'] = Session::get('request');
            if(!$data['request'])
                return redirect()->route('home');

            $data['vendor'] = Auth::guard('vendor')->user();
            $data['membership'] = Membership::findorfail(Session::get('membership_id'));

            if($data['vendor']->current_subscribe) {
                $data['vendor']->current_subscribe->update([
                    'expiry_date' => Carbon::yesterday()
                ]);
            }

            Subscribe::create([
                'vendor_id' => $data['vendor']->id,
                'membership_id' => $data['membership']->id,
                'expiry_date' => Carbon::now()->addMonth(),
                'price' => $data['membership']->price,
            ]);


//            $arrData = [
//                'command' => env('PAYFORT_COMMAND'),
//                'access_code' => env('PAYFORT_ACCESS_CODE'),
//                'merchant_identifier' => env('PAYFORT_MERCHANT_IDENTIFIER'),
//                'merchant_reference' => $data['request']['merchant_reference'],
//                'amount' => $data['request']['amount'],
//                'currency' => $data['request']['currency'],
//                'language' => $data['request']['language'],
//                'customer_email' => $data['request']['customer_email'],
//                'eci' => $data['request']['eci'],
//                'token_name' => $data['request']['token_name'],
//                'order_description' => 'Membership',
//                'customer_name' => $data['request']['customer_name'],
//                'return_url' => url('/api/payfort/response'),
//                'card_security_code' => '123'
//            ];
//            $signature = Payment::use($this->provider)->calculateSignature($arrData, 'request');
//
//            $arrData['signature'] = $signature;
//
//            $response = Http::post('https://sbpaymentservices.payfort.com/FortAPI/paymentApi', $arrData);
//
//            dd($response->object());

            return view('vendorAdmin.subscribe.payment.success')->with($data);
        } catch (\Exception $exception) {
            return redirect()->route('home');
        }
    }

    public function error() {
        try {
            $data['request'] = Session::get('request');

            if(!$data['request'])
                return redirect()->route('home');

            $data['vendor'] = Auth::guard('vendor')->user();
            $data['membership'] = Membership::findorfail(Session::get('membership_id'));

            return view('vendorAdmin.subscribe.payment.error')->with($data);
        } catch (\Exception $exception) {
            return redirect()->route('home');
        }
    }

    public function cancel() {
        $data['vendor'] = Auth::guard('vendor')->user();

        $data['vendor']->current_subscribe->update([
            'expiry_date' => Carbon::yesterday()
        ]);

        return redirect()->back();
    }
}
