<?php

namespace App\Http\Controllers\Front\Vendor\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\RequestGenerateProductRequest;
use App\Models\Category;
use App\Models\GenerateProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenerateProductController extends Controller
{
    public function generate() {
        $data['vendor'] = Auth::guard('vendor')->user();
        $data['categories'] = Category::whereIsRoot()->get();

        return view('vendorAdmin.product.generate')->with($data);
    }

    public function requestGenerate(RequestGenerateProductRequest $request) {
        $data = $request->validated();
        $data['vendor_id'] = Auth::guard('vendor')->id();

        die();

//        $generate = GenerateProduct::create([
//            'vendor_id' => $data['vendor'],
//            'category_id' => $data['category_id'],
//            'template' => $data['']
//        ]);

    }
}
