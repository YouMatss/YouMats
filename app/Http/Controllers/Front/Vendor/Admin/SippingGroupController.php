<?php

namespace App\Http\Controllers\Front\Vendor\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SippingGroupController extends Controller
{
    public function index() {
        $data['vendor'] = Auth::guard('vendor')->user();
        $data['shipping_prices'] = $data['vendor']->shippings()->paginate(10);

        return view('vendorAdmin.shippingGroup.index')->with($data);
    }

    public function create() {
        $data['vendor'] = Auth::guard('vendor')->user();
        $data['cities'] = City::where('country_id', $data['vendor']->country_id)->get();

        return view('vendorAdmin.shippingGroup.create')->with($data);
    }

    public function edit($id) {
        $data['vendor'] = Auth::guard('vendor')->user();
        $data['shipping'] = Shipping::where('vendor_id', $data['vendor']->id)->firstorfail();
        $data['cities'] = City::where('country_id', $data['vendor']->country_id)->get();

        return view('vendorAdmin.shippingGroup.edit')->with($data);
    }
}
