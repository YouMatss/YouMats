<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Currency;
use App\Models\Vendor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() {
        $data['categories'] = Category::with('subCategories')->orderBy('sort')->get();
        $config['currencies'] = Currency::where('active', '1')->orderBy('sort')->get();
        $data['featuredVendors'] = Vendor::where('isFeatured', 1)->get();

        View::share($data);
        Config::set($config);
    }

}
