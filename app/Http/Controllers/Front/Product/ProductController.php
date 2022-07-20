<?php

namespace App\Http\Controllers\Front\Product;

use App\Helpers\Filters\FiltersJsonField;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    public function index($categories_slug, $slug) {
        $data['product'] = Product::with('category', 'tags', 'vendor')
            ->where(['slug' => $slug, 'active' => true])->first();
        abort_if(!$data['product'], 404);

        if(Session::has('city')) {
            $data['delivery'] = $data['product']->delivery;
            $data['delivery_cities'] = $data['product']->delivery_cities();
        }

        $data['product']->views++;
        $data['product']->save();

        $data['related_products'] = Product::with('category')
            ->where('category_id', $data['product']->category_id)
            ->where('id', '!=', $data['product']->id)
            ->where('active', 1)
            ->orderby('sort')->take(10)->get();

        return view('front.product.index')->with($data);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function all(Request $request)
    {
        if(isset($request->filter['city'])) {
            setCity($request->filter['city']);
        }

        $products = QueryBuilder::for(Product::class)
            ->where('products.active', true);

        if($request->has('search'))
            $products->where("name->en", 'like', '%'. $request->search . '%')
                ->orWhere("name->ar", 'like', '%'. $request->search .'%');

        if(isset($request->sort) && is_individual()) {
            $data['products'] = $products->paginate(20);
        } else {
            $data['products'] = $products->paginate(20);
        }

        $data['products']->withPath(url()->current())->withQueryString();

        return view('front.product.all')->with($data);
    }

    /**
     * @return string
     */
    public function search(): string
    {
        $data['selected_tags'] = [];
        $data['selected_categories'] = [];

        $search_products_by_name_only = QueryBuilder::for(Product::class)
                        ->allowedFilters([AllowedFilter::custom('name', new FiltersJsonField)])
                        ->where('active', true)->get();

        $data['search_products'] = QueryBuilder::for(Product::class)
                        ->allowedFilters([
                            AllowedFilter::custom('name', new FiltersJsonField),
                            AllowedFilter::scope('price'),
                            AllowedFilter::callback('has_tags', fn($query, $value) => $query->whereHas('tags', fn($query) => $query->whereIn('tags.id', $value))),
                            AllowedFilter::callback('has_categories', fn($query, $value) => $query->whereHas('category', fn($query) => $query->whereIn('categories.id', $value)))
                        ])
                        ->allowedIncludes(['tags', 'category'])
                        ->where('active', true)
                        ->limit(15)
                        ->get()
                        ->sortByDesc('subscribe')->groupBy('subscribe')->map(function (Collection $collection) {
                            return $collection->shuffle();
                        })->ungroup()
                        ->unique();

        foreach ($search_products_by_name_only as $product) {
            if($product->tags)
                foreach ($product->tags as $tag) {
                    $data['search_tags'][$tag->id] = $tag;
                }
            $data['search_categories'][$product->category->id] = $product->category;
        }

        if(isset($_GET['filter']['has_tags']))
            $data['selected_tags'] = explode(',', $_GET['filter']['has_tags']);
        if(isset($_GET['filter']['has_categories']))
            $data['selected_categories'] = explode(',', $_GET['filter']['has_categories']);

        $data['max_price'] = ceil($search_products_by_name_only->max('price'));

        return view('front.layouts.partials.searchDiv')->with($data)->render();
    }
}
