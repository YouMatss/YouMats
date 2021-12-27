<?php

namespace App\Http\Controllers\Front\Vendor\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:vendor');
        //If you would like to add "vendor verification middleware":
        $this->middleware('verified:vendor.verification.notice');
    }

    public function index() {
        $data['vendor'] = Auth::guard('vendor')->user();
        $data['items'] = $data['vendor']->order_items()->paginate(10);

        return view('vendorAdmin.order.index')->with($data);
    }

    public function edit($id) {
        $data['vendor'] = Auth::guard('vendor')->user();
        $data['item'] = OrderItem::with('order')->where('order_id', $id)
            ->where('vendor_id', $data['vendor']->id)->firstorfail();

        return view('vendorAdmin.order.edit')->with($data);
    }
}
