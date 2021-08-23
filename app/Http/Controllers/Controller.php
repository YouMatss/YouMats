<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Currency;
use App\Models\Page;
use App\Models\Vendor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Stevebauman\Location\Facades\Location;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() {
//        $ip = Request::ip();
//        $location = Location::get($ip);
//        $data['city'] = ($location->cityName) ?? null;
//        $data['city'] = "Riyadh";

        $data['categories'] = Category::withDepth()->having('depth', '=', 0)->orderBy('sort')->get();
        $data['featuredVendors'] = Vendor::where('isFeatured', '1')->get();
        $config['currencies'] = Currency::where('active', '1')->orderBy('sort')->get();
        $data['pages'] = Page::orderBy('sort')->get();
        $data['footer_categories'] = Category::where('show_in_footer', '1')->orderBy('created_at', 'desc');

        View::share($data);
        Config::set($config);
    }

}
