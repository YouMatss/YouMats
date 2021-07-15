<?php

namespace App\Http\Controllers\Front\Category;

use App\Helpers\Filters\FiltersJsonField;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SubCategoryController extends Controller
{
    public function index($category_slug, $subCategory_slug) {
        $data['category'] = Category::with('subCategories')->where('slug', $category_slug)->first();
        $data['subCategory'] = SubCategory::with('category')->where('slug', $subCategory_slug)->first();

        abort_if(!$data['category'], 404);
        abort_if(!$data['subCategory'], 404);

        $data['products'] = $data['subCategory']->products()->paginate(20);
        $data['tags'] = $data['subCategory']->tags();
        $data['subCategory']->load('attributes', 'attributes.values');
        $data['minPrice'] = $data['products']->min('price');
        $data['maxPrice'] = $data['products']->max('price');

        return view('front.category.sub')->with($data);
    }

    public function filter($subCategory_id) {
        $data['subCategory'] = SubCategory::findorfail($subCategory_id);

        $data['products'] = QueryBuilder::for(Product::class)
            ->allowedFilters([
                'attributes',
                AllowedFilter::scope('price_from'),
                AllowedFilter::scope('price_to')
            ])
            ->where([
                'active' => 1,
                'subCategory_id' => $subCategory_id
            ])
            ->with('subCategory', 'subCategory.category')
            ->paginate(15);

        return view('front.category.productsContainer')->with($data)->render();
    }
}
