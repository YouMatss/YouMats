<?php

namespace App\Http\Controllers\Front\Vendor\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index() {
        $data['vendor'] = Auth::guard('vendor')->user();
        $data['items'] = $data['vendor']->order_items()->paginate(10);

        return view('vendorAdmin.order.index')->with($data);
    }
}
