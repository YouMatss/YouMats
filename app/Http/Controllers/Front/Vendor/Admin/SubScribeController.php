<?php

namespace App\Http\Controllers\Front\Vendor\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\SubScribeRequest;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Membership;
use App\Models\Product;
use App\Models\Subscribe;
use App\Notifications\VendorSubscribeCanceled;
use App\Notifications\VendorSubscribed;
use App\Notifications\VendorUpdated;
use Carbon\Carbon;
use Devinweb\Payment\Facades\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
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

        $data['categories'] = Category::join('products', 'products.category_id', '=', 'categories.id')
            ->join('vendors', 'vendors.id', '=', 'products.vendor_id')
            ->join('categories_memberships', 'categories_memberships.category_id', '=', 'categories.id')
            ->join('memberships', 'categories_memberships.membership_id', '=', 'memberships.id')
            ->where('vendors.id', $data['vendor']->id)
            ->where('memberships.status', true)
            ->select('categories.*')
            ->distinct()->get();

//        $data['current_subscribe_id'] = $data['vendor']->current_subscribe->membership_id ?? null;

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

            $subscribe = Subscribe::create([
                'vendor_id' => $data['vendor']->id,
                'membership_id' => $data['membership']->id,
                'expiry_date' => Carbon::now()->addMonth(),
                'price' => $data['membership']->price,
            ]);

            $data['vendor']->update([
                'token_name' => $data['request']['token_name']
            ]);

            foreach(Admin::all() as $admin)
                $admin->notify(new VendorSubscribed($data['vendor'], $data['membership'], $subscribe));

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
        $subscribe = $data['vendor']->current_subscribe;

        $subscribe->update([
            'expiry_date' => Carbon::yesterday()
        ]);

        foreach(Admin::all() as $admin)
            $admin->notify(new VendorSubscribeCanceled($data['vendor'], $subscribe));

        return redirect()->back();
    }
}
