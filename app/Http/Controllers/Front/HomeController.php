<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index() {

        $data['featured_categories']          = Category::with('media', 'ancestors')->select('id', 'slug', 'name')->where('isFeatured', true)->orderBy('sort')->take(9)->get();
        $data['top_categories']               = Category::with('media', 'ancestors')->select('id', 'slug', 'name')->where('topCategory', true)->orderBy('sort')->take(6)->get();
        $data['featured_sections_categories'] = Category::with('media', 'ancestors')->select('id', 'slug', 'name','parent_id','_lft','_rgt')->where('featured_sections', true)->orderBy('featured_section_order')->get();

        $data['sliders']              = Slider::where('active', true)->orderBy('sort')->get();
        $data['best_seller_products'] = Product::with('media', 'category')->select('id', 'slug', 'name','category_id')->where('active', true)->where('best_seller', true)->orderBy('sort')->take(14)->get();

        return view('front.index')->with($data);
    }
}
