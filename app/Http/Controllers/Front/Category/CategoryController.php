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
    private int $pagination_limit = 20;

    public function index($slug) {
        setCityLocation();

        $parsedSlug = explode('/', $slug);
        $slug = end($parsedSlug);

        $data['category'] = Category::whereSlug($slug)->firstOrFail();
        $children_categories_ids = Category::descendantsAndSelf($data['category']->id)->pluck('id');

        $products = Product::whereIn('category_id', $children_categories_ids)
            ->where('active', '1')
            ->get()
            ->sortByDesc('delivery')->groupBy('delivery')->map(function (Collection $collection) {
                return $collection->sortByDesc('contacts')->groupBy('contacts')->map(function (Collection $collection) {
                    return $collection->sortByDesc('views')->groupBy('views')->map(function (Collection $collection) {
                        return $collection->sortByDesc('updated_at');
                    })->ungroup();
                })->ungroup();
            })->ungroup()
            ->unique();

        $data['products'] = CollectionPaginate::paginate($products, $this->pagination_limit);

        $data['parent'] = $data['category']->parent;
        $data['children'] = $data['category']->children;

        if(isset($data['parent'])) {
            $data['tags'] = $data['category']->tags();
            $data['category']->load('attributes', 'attributes.values');
            $data['minPrice'] = $products->min('price');
            $data['maxPrice'] = $products->max('price');

            return view('front.category.sub')->with($data);
        } else {
            return view('front.category.index')->with($data);
        }
    }

    public function filter($category_id) {
        $data['category'] = Category::findorfail($category_id);
        $children_categories_ids = Category::descendantsAndSelf($category_id)->pluck('id');

        $products = QueryBuilder::for(Product::class)
            ->allowedFilters([
                'attributes',
                AllowedFilter::scope('price_from'),
                AllowedFilter::scope('price_to')
            ])
            ->with('category')
            ->whereIn('category_id', $children_categories_ids)
            ->where('active', '1')
            ->get()
            ->sortByDesc('delivery')->groupBy('delivery')->map(function (Collection $collection) {
                return $collection->sortByDesc('contacts')->groupBy('contacts')->map(function (Collection $collection) {
                    return $collection->sortByDesc('views')->groupBy('views')->map(function (Collection $collection) {
                        return $collection->sortByDesc('updated_at');
                    })->ungroup();
                })->ungroup();
            })->ungroup()
            ->unique();

        $data['products'] = CollectionPaginate::paginate($products, $this->pagination_limit);
        $data['products']->withPath(route('front.category', [generatedNestedSlug($data['category']->ancestors()->pluck('slug')->toArray(), $data['category']->slug)]));
        $data['products']->withQueryString();

        return view('front.category.productsContainer')->with($data)->render();
    }
}
