<?php

namespace App\Http\Controllers\Front\Category;

use App\Helpers\Classes\CollectionPaginate;
use App\Helpers\Classes\DeliveryFilter;
use App\Helpers\Classes\PriceFilter;
use App\Helpers\Classes\ProductsSortDelivery;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    public function index($slug, Request $request) {
        $parsedSlug = explode('/', $slug);
        $slug = end($parsedSlug);

        $data['category'] = Category::whereSlug($slug)->firstOrFail();

        $data['parent'] = $data['category']->parent;
        $data['children'] = $data['category']->children;

        $children_categories_ids = Category::descendantsAndSelf($data['category']->id)->pluck('id');

        if(isset($request->filter['city'])){
            setCity($request->filter['city']);
        }

        $products = QueryBuilder::for(Product::class)
            ->whereIn('category_id', $children_categories_ids)
            ->where('products.active', true)
            ->select('products.*');

        $data['minPrice'] = $products->min('price');
        $data['maxPrice'] = $products->max('price');

        $products->allowedFilters([
            AllowedFilter::partial('attributes', null, true, ','),
            AllowedFilter::scope('price'),
            AllowedFilter::custom('is_price', new PriceFilter()),
            AllowedFilter::custom('is_delivery', new DeliveryFilter())
        ]);

        if(isset($request->sort) && is_individual()) {
            $filter = $products->allowedSorts([
                    'price',
                    AllowedSort::custom('delivery', new ProductsSortDelivery($products), 'delivery'),
                ])
                ->with('category')
                ->take(500)->get()->unique();
        } else {
            $filter = $products->with('category')
                ->take(500)->get()
                ->sortByDesc('subscribe')->groupBy('subscribe')->map(function (Collection $collection) {
                    return $collection->shuffle();
                })->ungroup()
                ->unique();
        }

        $data['products'] = CollectionPaginate::paginate($filter, 20);
        $data['products']->withPath(url()->current())->withQueryString();

        $data['tags'] = $data['category']->tags();
        $data['category']->load('attributes', 'attributes.values');

        if(isset($data['parent'])) {
            return view('front.category.sub')->with($data);
        } else {
            return view('front.category.index')->with($data);
        }

    }
}
