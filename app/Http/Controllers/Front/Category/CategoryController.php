<?php

namespace App\Http\Controllers\Front\Category;

use App\Helpers\Classes\CollectionPaginate;
use App\Helpers\Classes\ProductsSortDelivery;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
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
        ]);

        if(isset($request->sort) && is_individual()) {
            $filter = $products->allowedSorts([
                    'price',
                    AllowedSort::custom('delivery', new ProductsSortDelivery($products), 'delivery')
                ])
                ->with('category')
                ->get()->unique();
        } else {
            $filter = $products->with('category')
                ->get()
                ->sortByDesc('delivery')->groupBy('delivery')->map(function (Collection $collection) {
                    return $collection->sortByDesc('contacts')->groupBy('contacts')->map(function (Collection $collection) {
                        return $collection->sortBy('price')->groupBy(fn ($product) => (int) $product->price)->map(function (Collection $collection) {
                            return $collection->sortByDesc('views')->groupBy('views')->map(function (Collection $collection) {
                                return $collection->sortByDesc('updated_at');
                            })->ungroup();
                        })->ungroup();
                    })->ungroup();
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
