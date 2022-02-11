<?php

namespace App\Http\Controllers\Front\Category;

use App\Helpers\Classes\CollectionPaginate;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    public function index($slug, Request $request) {
        setCityLocation();

        $parsedSlug = explode('/', $slug);
        $slug = end($parsedSlug);

        $data['category'] = Category::whereSlug($slug)->firstOrFail();

        $data['parent'] = $data['category']->parent;
        $data['children'] = $data['category']->children;

        if(isset($data['parent'])) {
            $children_categories_ids = Category::descendantsAndSelf($data['category']->id)->pluck('id');

            if(isset($request->filter['city'])){
                setCity($request->filter['city']);
            }

            $products = QueryBuilder::for(Product::class)
                ->whereIn('category_id', $children_categories_ids)
                ->where('products.active', '1')
                ->select('products.*');

            $data['minPrice'] = $products->min('price');
            $data['maxPrice'] = $products->max('price');

            $products->join('vendors', 'vendors.id', 'products.vendor_id')
                ->leftJoin('vendor_branches', 'vendor_branches.vendor_id', 'vendors.id');

            if(is_individual()) {
                $products->allowedFilters([
                    AllowedFilter::partial('attributes', null, true, ','),
                    AllowedFilter::scope('price'),
                    AllowedFilter::exact('city', 'vendor_branches.city_id', false)
                ]);
            } else {
                $products->allowedFilters([
                    AllowedFilter::partial('attributes', null, true, ','),
                    AllowedFilter::scope('price'),
                ]);
            }

            if(isset($request->sort) && is_individual()) {
                $filter = $products->allowedSorts('price')
                    ->with('category')
                    ->get()->unique();
            } else {
                $filter = $products->with('category')
                    ->get()
                    ->sortByDesc('delivery')->groupBy('delivery')->map(function (Collection $collection) {
                        return $collection->sortByDesc('contacts')->groupBy('contacts')->map(function (Collection $collection) {
                            return $collection->sortByDesc('views')->groupBy('views')->map(function (Collection $collection) {
                                return $collection->sortByDesc('updated_at');
                            })->ungroup();
                        })->ungroup();
                    })->ungroup()
                    ->unique();
            }

            $data['products'] = CollectionPaginate::paginate($filter, 20);
            $data['products']->withPath(url()->current())->withQueryString();

            $data['tags'] = $data['category']->tags();
            $data['category']->load('attributes', 'attributes.values');

            return view('front.category.sub')->with($data);
        } else {
            return view('front.category.index')->with($data);
        }
    }
}
