<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Partner;
use App\Models\Vendor;

class HomeController extends Controller
{
    public function index() {

        $data['featured_categories'] = Category::SelectBasicData()->with('media', 'ancestors')->where('isFeatured', true)->orderBy('sort')->take(9)->get();
        $data['top_categories'] = Category::SelectBasicData()->with('media', 'ancestors')->where('topCategory', true)->orderBy('sort')->take(6)->get();
        $data['featured_sections_categories'] = Category::SelectBasicData()->with('media', 'ancestors')->where('featured_sections', true)->orderBy('featured_section_order')->get();

        $data['featuredVendors'] = Vendor::with('media')->where('isFeatured', '1')->get();
        $data['featuredPartners'] = Partner::with('media')->where('featured', '1')->get();
        $data['sliders'] = Slider::where('active', true)->orderBy('sort')->get();
        $data['best_seller_products'] = Product::SelectProductBasicData()->with('media', 'category')->where('active', true)->where('best_seller', true)->orderBy('sort')->take(14)->get();

        return view('front.index')->with($data);
    }
}
