<?php

namespace App\Http\Controllers\Statistics;

use App\Helpers\Classes\Log;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class IndexController
{
    /**
     * @param Request $request
     * @return void
     */
    public function setLog(Request $request) {
        $data = $request->validate([
            'type' => [...REQUIRED_STRING_VALIDATION, ...['In:visit,chat,call,email']],
            'url' => NULLABLE_URL_VALIDATION
        ]);

        if($data['url']) {
            $model = $this->detectProduct($data['url']);
            Log::set($data['type'], $model, $data['url']);
        } else {
            $model = $this->detectModel();
            Log::set($data['type'], $model, url()->previous());
        }
    }

    /**
     * @return array|null[]
     */
    private function detectModel(): array
    {
        $route_name = app('router')->getRoutes()
            ->match(app('request')->create(URL::previous()))
            ->getName();
        $segments = explode('/', url()->previous());
        $slug = $segments[count($segments) - 1];

        switch ($route_name) {
            case('front.category'):
                $category = Category::whereSlug($slug)->first('id');
                return [Category::class, $category->id];
                break;
            case('front.product'):
                $slug = $segments[count($segments) - 2];
                $product = Product::whereSlug($slug)->first('id');
                return [Product::class, $product->id];
                break;
            case('vendor.show'):
                $vendor = Vendor::whereSlug($slug)->first('id');
                return [Vendor::class, $vendor->id];
                break;
            default:
                return [null, null];
        }
    }

    /**
     * @param $url
     * @return array
     */
    private function detectProduct($url): array
    {
        $segments = explode('/', $url);
        $slug = $segments[count($segments) - 2];
        $product = Product::whereSlug($slug)->first('id');
        return [Product::class, $product->id];
    }
}
