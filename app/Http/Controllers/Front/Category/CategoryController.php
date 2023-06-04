<?php

namespace App\Http\Controllers\Front\Category;

use App\Helpers\Classes\AttributeFilter;
use App\Helpers\Classes\CollectionPaginate;
use App\Helpers\Classes\DeliveryFilter;
use App\Helpers\Classes\Log;
use App\Helpers\Classes\PriceFilter;
use App\Helpers\Classes\ProductsSortDelivery;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    public function index($slug, Request $request) {

        $parsedSlug = explode('/', $slug);
        $slug       = end($parsedSlug);

        $data['category'] = Category::with("ancestors")->whereSlug($slug)->firstOrFail();

        if(count($parsedSlug) - count($data['category']->ancestors) != 1) {
            abort(404);
        }

        $data['parent']   = $data['category']->parent;
        $data['children'] = $data['category']->children;

        $children_categories_ids = Category::descendantsAndSelf($data['category']->id)->pluck('id');

        $products = QueryBuilder::for(Product::class)
            ->whereIn('category_id', $children_categories_ids)
            ->where('products.active', true)
            ->select('products.id', 'products.category_id', 'products.vendor_id',
            'products.name', 'products.short_desc', 'products.type', 'products.price',
            'products.stock', 'products.min_quantity', 'products.active',
            'products.shipping_id', 'products.specific_shipping', 'products.shipping_prices',
            'products.slug', 'products.sort');

        $products->allowedFilters([
            AllowedFilter::custom('attributes', new AttributeFilter()),
            AllowedFilter::scope('price'),
            AllowedFilter::custom('is_price', new PriceFilter()),
            AllowedFilter::custom('is_delivery', new DeliveryFilter())
        ]);

        $data['minPrice'] = $products->min('price');
        $data['maxPrice'] = $products->max('price');



        if(isset($request->filter['city'])) {
            setCity($request->filter['city']);
        }

        if(isset($request->sort) && is_individual()) {
            $filter = $products->allowedSorts([
                    'price',
                    AllowedSort::custom('delivery', new ProductsSortDelivery($products), 'delivery')
                ])
                ->with("media", "vendor", "category")
                ->take(500)->get()->unique();
        } else {
            $filter = $products->take(500)
            ->with("media", "vendor", "category")
            ->get()
            ->sortByDesc('subscribe')->groupBy('subscribe')->map(function (Collection $collection) {
                return $collection->sortByDesc('contacts')->groupBy('contacts')->map(function (Collection $collection) {
                    return $this->customSort($collection);
                })->ungroup();
            })->ungroup()
            ->unique();
        }


        $data['products'] = CollectionPaginate::paginate($filter, 20);
        $data['products']->withPath(url()->current())->withQueryString();



        $data['tags'] = $data['category']->tags();
        $data['category']->load('attributes', 'attributes.values');

        Log::set('visit', [Category::class, $data['category']->id]);


        if(isset($data['parent'])) {
            $data['subscribeVendors'] = $data['category']->subscribedVendors();

            return view('front.category.sub')->with($data);
        } else {

            return view('front.category.index')->with($data);
        }

    }


    private function customSort($collection) {
        $groupCollection = $collection->groupBy('vendor_id');
        $maxCount = count(max($groupCollection->toArray()));
        $groupCollection = $groupCollection->shuffle();

        foreach ($groupCollection as $key => $vendor_group) {
            $groupCollection[$key] = $vendor_group->shuffle();
        }
        for ($i = 0; $i < $maxCount; $i++) {
            foreach ($groupCollection as $vendor_group) {
                if(isset($vendor_group[$i]))
                    $newCollection[] = $vendor_group[$i];
            }
        }
        return $newCollection;
    }

}
