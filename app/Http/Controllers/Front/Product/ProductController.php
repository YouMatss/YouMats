<?php

namespace App\Http\Controllers\Front\Product;

use App\Helpers\Classes\Log;
use App\Helpers\Filters\FiltersJsonField;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
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
    /**
     * @param $categories_slug
     * @param $product
     * @return void
     */
    private function checkOnCategoriesSlugs($categories_slug, $product) {
        $categories_slug_array = array_reverse(explode('/', $categories_slug));

        abort_if(count($categories_slug_array) < 1, 404);

        foreach ($categories_slug_array as $key => $category_slug) {
            $category = Category::where('slug', $category_slug)->firstorfail();

            if($key == 0) {
                abort_if($category->id != $product->category->id, 404);
            } elseif($key == 1) {
                abort_if($category->id != $product->category->parent->id, 404);
            } elseif($key == 2) {
                abort_if($category->id != $product->category->parent->parent->id, 404);
            } elseif($key == 3) {
                abort_if($category->id != $product->category->parent->parent->parent->id, 404);
            }
        }
    }

    /**
     * @param $categories_slug
     * @param $slug
     * @return Application|Factory|View
     */
    public function index($categories_slug, $slug) {
        $data['product'] = Product::with('category', 'tags', 'vendor')
            ->where(['slug' => $slug, 'active' => true])->first();

        if(!$data['product']) {
            return redirect(route('home'), 301);
        }

        $this->checkOnCategoriesSlugs($categories_slug, $data['product']);

        if(Session::has('city')) {
            $data['delivery'] = $data['product']->delivery;
            $data['delivery_cities'] = $data['product']->delivery_cities();
        }

        $data['product']->views++;
        $data['product']->save();

        if($data['product']->subscribe) {
            $data['same_vendor_products'] = Product::with('category')
                ->where('category_id', $data['product']->category_id)
                ->where('vendor_id', $data['product']->vendor_id)
                ->where('id', '!=', $data['product']->id)
                ->where('active', true)
                ->inRandomOrder()->take(10)->get();
        }

        $data['subscribed_vendors'] = Vendor::with(['products' => function ($query) use ($data) {
            $query->where('category_id', $data['product']->category_id)->inRandomOrder();
        }])
            ->join('products', 'products.vendor_id', '=', 'vendors.id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('subscribes', 'subscribes.vendor_id', '=', 'vendors.id')
            ->whereDate('subscribes.expiry_date', '>', now())
            ->where('subscribes.category_id', $data['product']->category_id)
            ->where('products.category_id', $data['product']->category_id)
            ->where('vendors.active', true)
            ->where('vendors.id', '!=', $data['product']->vendor_id)
            ->select('vendors.*')
            ->inRandomOrder()->distinct()->get();

        $data['same_category_products'] = Product::with('category')
            ->where('category_id', $data['product']->category_id)
            ->where('id', '!=', $data['product']->id)
            ->where('active', true)
            ->inRandomOrder()->take(10)->get();

        if ($data['product']->subscribe && !$data['product']->vendor->manage_by_admin) {
            $data['widget_phone'] = Clean_Phone_Number(get_contact($data['product']->vendor, 'call_phone'));
            $data['widget_whatsapp'] = $data['product']->whatsapp_message();
        }

        if(is_company())
            if(isset($data['product']->vendor->contacts[0]))
                $data['contact'] = $data['product']->vendor->contacts[0];

        Log::set('visit', [Product::class, $data['product']->id]);

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
    public function suggest(): string
    {
        $data['selected_categories'] = [];
        $data['searched_word']  = $_GET['filter']['name'];

        $data['suggested_products'] = QueryBuilder::for(Product::class)
                        ->select(
                            'id',
                            'category_id',
                            'vendor_id',
                            'name',
                            'rate',
                            'price',
                            'slug'
                          )
                        ->allowedFilters([
                            AllowedFilter::custom('name', new FiltersJsonField),
                            AllowedFilter::scope('price'),
                            AllowedFilter::callback('has_categories', fn($query, $value) => $query->whereHas('category', fn($query) => $query->whereIn('categories.id', $value)))
                        ])
                        ->allowedIncludes(['category'])
                        ->where('active', true)
                        ->limit(8)
                        ->get()
                        ->sortByDesc('subscribe')->groupBy('subscribe')->map(function (Collection $collection) {
                            return $collection->shuffle();
                        })->ungroup()
                        ->unique();

          return view('front.layouts.partials.searchDiv')->with($data)->render();
    }

    /**
     * @return string
     */
    public function search() {

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
                        ->paginate(20);

        $data['search_products']->withPath(url()->current())->withQueryString();



        foreach ($search_products_by_name_only as $product) {
            if($product->tags)
                foreach ($product->tags as $tag) {
                    $data['search_tags'][$tag->id] = $tag;
                }
            if(isset($product->category->id))
                $data['search_categories'][$product->category->id] = $product->category;
        }

        if(isset($_GET['filter']['has_tags']))
            $data['selected_tags'] = explode(',', $_GET['filter']['has_tags']);
        if(isset($_GET['filter']['has_categories']))
            $data['selected_categories'] = explode(',', $_GET['filter']['has_categories']);

        $data['max_price'] = ceil($search_products_by_name_only->max('price'));

        return view('front.search.search')->with($data);

    }
}
