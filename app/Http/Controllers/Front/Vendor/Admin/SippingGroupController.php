<?php

namespace App\Http\Controllers\Front\Vendor\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SippingGroupController extends Controller
{
    public function index() {
        $data['vendor'] = Auth::guard('vendor')->user();
        $data['shipping_prices'] = $data['vendor']->shippings()->paginate(10);

        return view('vendorAdmin.shippingGroup.index')->with($data);
    }
}
