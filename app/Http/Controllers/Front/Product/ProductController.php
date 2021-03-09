<?php

namespace App\Http\Controllers\Front\Product;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    public function index($slug) {
        $data['product'] = Product::with('subCategory', 'category', 'tags', 'vendor')->where(['slug' => $slug, 'active' => 1])->first();
        abort_if(!$data['product'], 404);

        $data['FAQs'] = FAQ::orderBy('sort')->get();
        $data['related_products'] = Product::with('subCategory')
            ->where('subCategory_id', $data['product']->subCategory_id)
            ->where('id', '!=', $data['product']->id)
            ->orderby('sort')->take(10)->get();

        return view('front.product.index')->with($data);
    }

    public function all() {
        $data['products'] = Product::where('active', 1)->orderBy('sort')->paginate(20);

        return view('front.product.all')->with($data);
    }

    /**
     * @return JsonResponse
     */
    public function search(): JsonResponse
    {
        $products = QueryBuilder::for(Product::class)
                        ->allowedFilters([
                            'name',
                            AllowedFilter::scope('price_from'),
                            AllowedFilter::scope('price_to'),
                            AllowedFilter::callback('has_tags', fn($query, $value) => $query->whereHas('tags', fn($query) => $query->whereIn('tags.id', $value)))
                        ])
                        ->with(['subCategory', 'subCategory.category', 'tags'])
                        ->get();

        return response()->json(['products' => $products, 'maxPrice' => $products->max('price')], 200);
    }
}
