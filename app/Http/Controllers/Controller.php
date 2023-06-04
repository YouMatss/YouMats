<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Currency;
use App\Models\Page;
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

        $data['categories']        = Category::with('media','children')->select('id', 'slug', 'name')->withDepth()->having('depth', '=', 0)->where('category', '1')->orderBy('sort')->get();
        $data['footer_categories'] = Category::select('id', 'slug', 'name')->where('show_in_footer', '1')->orderBy('created_at', 'desc');
        $data['pages']             = Page::select('slug', 'title')->orderBy('sort')->get();
        $data['NovaSetting']       = nova_get_settings(['home_meta_title', 'home_meta_keywords', 'home_meta_desc', 'home_schema', 'widget_phone', 'widget_whatsapp']);

        $config['currencies'] = Currency::with('media')->select('name', 'code', 'symbol')->where('active', '1')->orderBy('sort')->get();

        View::share($data);
        Config::set($config);
    }

}
