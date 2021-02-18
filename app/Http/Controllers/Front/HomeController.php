<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Team;

class HomeController extends Controller
{
    public function index() {
        $data['team'] = Team::where('active', 1)->orderBy('sort')->get();
        $data['featured_categories'] = Category::where('isFeatured', 1)->orderBy('sort')->take(9)->get();
        $data['top_categories'] = Category::where('topCategory', 1)->orderBy('sort')->take(6)->get();
        $data['section_i_category'] = Category::where('section_i', 1)->first();
        $data['section_ii_category'] = Category::where('section_ii', 1)->first();
        $data['section_iii_category'] = Category::where('section_iii', 1)->first();
        $data['section_iv_category'] = Category::where('section_iv', 1)->first();
        $data['best_seller_products'] = Product::where('active', 1)->where('best_seller', 1)->orderBy('sort')->get();

        return view('front.index')->with($data);
    }
}
