<?php

namespace App\Http\Controllers\Front\Category;

use App\Helpers\Filters\FiltersJsonField;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Tag;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SubCategoryController extends Controller
{
    public function index($category_slug, $subCategory_slug) {
        $data['category'] = Category::with('subCategories')->where('slug', $category_slug)->first();
        $data['subCategory'] = SubCategory::with('category')->where('slug', $subCategory_slug)->first();

        abort_if(!$data['category'], 404);
        abort_if(!$data['subCategory'], 404);

        $data['products'] = $data['subCategory']->products()->paginate(15);
        $data['tags'] = $data['subCategory']->tags();
        $data['subCategory']->load('attributes', 'attributes.values');

        return view('front.category.sub')->with($data);
    }

    public function filter() {
//        $products = QueryBuilder::for(Product::class)
//            ->allowedFilters([
//                AllowedFilter::custom('name', new FiltersJsonField),
//                AllowedFilter::scope('price_from'),
//                AllowedFilter::scope('price_to'),
//                AllowedFilter::callback('has_tags', fn($query, $value) => $query->whereHas('tags', fn($query) => $query->whereIn('tags.id', $value))),
//                AllowedFilter::callback('has_subcategories', fn($query, $value) => $query->whereHas('subCategory', fn($query) => $query->whereIn('sub_categories.id', $value)))
//            ])
//            ->allowedIncludes(['tags', 'subCategory', 'subCategory.category'])
//            ->where('active', 1)
//            ->limit(30)
//            ->get();
//
//        return response()->json(['products' => $products, 'maxPrice' => $products->max('price')], 200);
    }
}
