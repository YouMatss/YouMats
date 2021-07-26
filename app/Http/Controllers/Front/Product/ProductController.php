<?php

namespace App\Http\Controllers\Front\Product;

use App\Helpers\Filters\FiltersJsonField;
use App\Http\Controllers\Controller;
use App\Models\FAQ;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Filters\Filter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    public function index($category_slug, $subCategory_slug, $slug) {
        $data['product'] = Product::with('subCategory', 'category', 'tags', 'vendor')->where(['slug' => $slug, 'active' => 1])->first();
        abort_if(!$data['product'], 404);

        $data['product']->views++;
        $data['product']->save();

        $data['FAQs'] = FAQ::orderBy('sort')->get();
        $data['related_products'] = Product::with('subCategory')
            ->where('subCategory_id', $data['product']->subCategory_id)
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
        $query = Product::where('active', 1)->orderBy('sort');

        if($request->has('search'))
            $query->where("name->en", 'like', '%'. $request->search . '%')
                ->orWhere("name->ar", 'like', '%'. $request->search .'%');

        $data['products'] = $query->paginate(20);

        return view('front.product.all')->with($data);
    }

    /**
     * @return JsonResponse
     */
    public function search(): JsonResponse
    {

        $products = QueryBuilder::for(Product::class)
                        ->allowedFilters([
                            AllowedFilter::custom('name', new FiltersJsonField),
                            AllowedFilter::scope('price_from'),
                            AllowedFilter::scope('price_to'),
                            AllowedFilter::callback('has_tags', fn($query, $value) => $query->whereHas('tags', fn($query) => $query->whereIn('tags.id', $value))),
                            AllowedFilter::callback('has_subcategories', fn($query, $value) => $query->whereHas('subCategory', fn($query) => $query->whereIn('sub_categories.id', $value)))
                        ])
                        ->allowedIncludes(['tags', 'subCategory', 'subCategory.category'])
                        ->where('active', 1)
                        ->limit(30)
                        ->get();

        return response()->json(['products' => $products, 'maxPrice' => $products->max('price')], 200);
    }
}
