<?php

namespace App\Http\Controllers\Front\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    public function index($category_slug) {
        $data['category'] = Category::whereSlug($category_slug)->first();
        abort_if(!$data['category'], 404);
        $data['products'] = $data['category']->products()->paginate(15);
        $data['parent'] = $data['category']->parent;
        $data['children'] = $data['category']->children;
        if(isset($data['parent'])) {
            $data['tags'] = $data['category']->tags();
            $data['category']->load('attributes', 'attributes.values');
            $data['minPrice'] = $data['products']->min('price');
            $data['maxPrice'] = $data['products']->max('price');

            return view('front.category.sub')->with($data);
        } else {
            return view('front.category.index')->with($data);
        }
    }

    public function filter($category_id) {
        $data['category'] = Category::findorfail($category_id);

        $data['products'] = QueryBuilder::for(Product::class)
            ->allowedFilters([
                'attributes',
                AllowedFilter::scope('price_from'),
                AllowedFilter::scope('price_to')
            ])
            ->where([
                'active' => 1,
                'category_id' => $category_id
            ])
            ->with('category')
            ->paginate(15);

        return view('front.category.productsContainer')->with($data)->render();
    }
}
