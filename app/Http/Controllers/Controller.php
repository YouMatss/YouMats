<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Currency;
use App\Models\FAQ;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Vendor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() {
        $data['categories'] = Category::withDepth()->having('depth', '=', 0)->where('category', '1')->orderBy('sort')->get();
        $data['featuredVendors'] = Vendor::where('isFeatured', '1')->get();
        $data['featuredPartners'] = Partner::where('featured', '1')->get();
        $config['currencies'] = Currency::where('active', '1')->orderBy('sort')->get();
        $data['pages'] = Page::orderBy('sort')->get();
        $data['footer_categories'] = Category::where('show_in_footer', '1')->orderBy('created_at', 'desc');
        $data['FAQs'] = FAQ::orderBy('sort')->get();

        $translation = [
            'company' => [
                'ar' => 'شركه',
                'en' => 'Company'
            ]
        ];

        Session::put('userType', 'company');
        Session::put('userTypeTranslation', $translation['company']);

        View::share($data);
        Config::set($config);
    }

}
