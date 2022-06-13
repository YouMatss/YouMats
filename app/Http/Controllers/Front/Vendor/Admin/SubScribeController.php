<?php

namespace App\Http\Controllers\Front\Vendor\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\SubScribeRequest;
use App\Models\Membership;
use App\Models\Subscribe;
use Carbon\Carbon;
use Devinweb\Payment\Facades\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SubScribeController extends Controller
{
    public string $provider = 'payfort';
    public int $membership_id = 2;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:vendor');
        //If you would like to add "vendor verification middleware":
        $this->middleware('verified:vendor.verification.notice');
    }

    public function index() {
        $data['vendor'] = Auth::guard('vendor')->user();
        $data['membership'] = Membership::findorfail($this->membership_id);

        if($data['vendor']->current_subscribe)
            return redirect()->back();

        return view('vendorAdmin.subscribe.index')->with($data);
    }

    public function upgrade(SubScribeRequest $request) {
        $data = $request->validated();
        try {
            $data['vendor'] = Auth::guard('vendor')->user();
            $data['membership'] = Membership::findorfail($this->membership_id);

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
            $data['membership'] = Membership::findorfail($this->membership_id);

            Subscribe::create([
                'vendor_id' => $data['vendor']->id,
                'membership_id' => $data['membership']->id,
                'expiry_date' => Carbon::now()->addMonth(),
                'price' => $data['membership']->price,
            ]);

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
            $data['membership'] = Membership::findorfail($this->membership_id);

            return view('vendorAdmin.subscribe.payment.error')->with($data);
        } catch (\Exception $exception) {
            return redirect()->route('home');
        }
    }
}
