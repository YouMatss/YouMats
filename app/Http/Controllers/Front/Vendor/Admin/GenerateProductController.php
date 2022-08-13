<?php

namespace App\Http\Controllers\Front\Vendor\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenerateProductController extends Controller
{
    public function generate() {
        $data['vendor'] = Auth::guard('vendor')->user();
        $data['categories'] = Category::whereIsRoot()->get();

        return view('vendorAdmin.product.generate')->with($data);
    }

    public function requestGenerate(Request $request) {
        dd($request->all());
    }
}
