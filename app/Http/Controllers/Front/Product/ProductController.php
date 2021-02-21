<?php

namespace App\Http\Controllers\Front\Product;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use App\Models\Product;

class ProductController extends Controller
{
    public function index($slug) {
        $data['product'] = Product::with('subCategory', 'category')->where([
            'slug' => $slug,
            'active' => 1
        ])->first();

        abort_if(!$data['product'], 404);


        $data['FAQs'] = FAQ::orderBy('sort')->get();
        $data['related_products'] = Product::with('subCategory')->where(function ($q) use ($data) {
                $q->where('subCategory_id', $data['product']->subCategory_id)
                ->orWhere('vendor_id', $data['product']->vendor_id);
        })->where('id', '!=', $data['product']->id)->orderby('sort')->get();

        return view('front.product.index')->with($data);
    }

    public function all() {
        $data['products'] = Product::where('active', 1)->orderBy('sort')->paginate(20);

        return view('front.product.all')->with($data);
    }
}
