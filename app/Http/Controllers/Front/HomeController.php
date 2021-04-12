<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\Team;

class HomeController extends Controller
{
    public function index() {
        $data['sliders'] = Slider::where('active', 1)->orderBy('sort')->get();
        $data['team'] = Team::where('active', 1)->orderBy('sort')->take(4)->get();
        $data['featured_categories'] = Category::where('isFeatured', 1)->orderBy('sort')->take(9)->get();
        $data['section_i_category'] = Category::where('section_i', 1)->first();

        $data['top_subCategories'] = SubCategory::where('topCategory', 1)->orderBy('sort')->take(6)->get();
        $data['section_ii_subCategory'] = SubCategory::where('section_ii', 1)->first();
        $data['section_iii_subCategory'] = SubCategory::where('section_iii', 1)->first();
        $data['section_iv_subCategory'] = SubCategory::where('section_iv', 1)->first();

        $data['best_seller_products'] = Product::where('active', 1)->where('best_seller', 1)->orderBy('sort')->get();

        return view('front.index')->with($data);
    }
}
