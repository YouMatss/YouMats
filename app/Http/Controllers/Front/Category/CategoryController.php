<?php

namespace App\Http\Controllers\Front\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Stevebauman\Location\Facades\Location;

class CategoryController extends Controller
{
    public function index($slug) {
        $parsedSlug = explode('/', $slug);
        $slug = end($parsedSlug);

        $data['category'] = Category::whereSlug($slug)->firstOrFail();

//        $city = City::where('name', 'LIKE', '%'.$this->getCityByLocation().'%')->first();
        $data['products'] = $data['category']->products()
//            ->join('vendors', 'vendors.id', '=', 'products.vendor_id')
//            ->join('vendor_branches', 'vendor_branches.vendor_id', '=', 'vendors.id')
//            ->leftJoin('cities', function($join) use($city) {
//                $join->on( 'cities.id', '=', $city->id);
//            })
//            ->limit(2)
//            ->orderBy('cities.id', 'ASC')
            ->paginate(20);

//        dd($data['products']->get());

        $data['parent'] = $data['category']->parent;
        $data['children'] = $data['category']->children;
        if(isset($data['parent'])) {
            $data['tags'] = $data['category']->tags();
            $data['category']->load('attributes', 'attributes.values');
            $data['minPrice'] = $data['products']->min('price');
            $data['maxPrice'] = $data['products']->max('price');

            return view('front.category.sub')->with($data);
        } else {
            return view('front.category.index')->with($data);
        }
    }

    public function filter($category_id) {
        $data['category'] = Category::findorfail($category_id);
        $data['city_location'] = $this->getCityByLocation();
        $data['products'] = QueryBuilder::for(Product::class)
            ->allowedFilters([
                'attributes',
                AllowedFilter::scope('price_from'),
                AllowedFilter::scope('price_to')
            ])
            ->where([
                'active' => 1,
                'category_id' => $category_id
            ])
            ->orderBy('updated_at', 'DESC')
            ->with('category'/*, 'vendor', 'vendor.branches'*/)
            ->paginate(20);

        return view('front.category.productsContainer')->with($data)->render();
    }

    public function getCityByLocation() {
        $ip = Request::ip();
        $location = Location::get($ip);
        if($location) {
            $city = City::where('name', 'LIKE', '%'.$location->cityName.'%')->first();
            if($city) {
                return $location->cityName;
            }
        }
        return null;
    }
}
