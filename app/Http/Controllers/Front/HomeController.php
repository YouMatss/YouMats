<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Team;
use App\Models\Vendor;

class HomeController extends Controller
{
    public function index() {
        $data['sliders'] = Slider::where('active', true)->orderBy('sort')->get();
        $data['team'] = Team::where('active', true)->orderBy('sort')->take(4)->get();
        $data['vendors'] = Vendor::with('cities', 'media')->whereActive(true)->limit(10)->latest()->get();

        $data['featured_categories'] = Category::where('isFeatured', true)->orderBy('sort')->take(9)->get();
        $data['top_categories'] = Category::where('topCategory', true)->orderBy('sort')->take(6)->get();
        $data['featured_sections_categories'] = Category::where('featured_sections', true)->orderBy('featured_section_order')->get();

        $data['best_seller_products'] = Product::where('active', true)->where('best_seller', true)->orderBy('sort')->take(14)->get();

        return view('front.index')->with($data);
    }
}
