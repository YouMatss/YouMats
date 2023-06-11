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
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() {

        $data['categories'] = Category::SelectBasicData()->with('media','children')->withDepth()->having('depth', '=', 0)->where('category', '1')->orderBy('sort')->get();
        $data['footer_categories'] = Category::SelectBasicData()->with('ancestors')->where('show_in_footer', '1')->orderBy('created_at', 'desc');
        $data['pages'] = Page::select('slug', 'title')->orderBy('sort')->get();
        $config['currencies'] = Currency::with('media')->select('name', 'code', 'symbol')->where('active', '1')->orderBy('sort')->get();

        View::share($data);
        Config::set($config);
    }

}
