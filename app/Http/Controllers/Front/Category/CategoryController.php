<?php

namespace App\Http\Controllers\Front\Category;

use App\Helpers\Classes\CollectionPaginate;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    private int $pagination_limit = 20;

    public function index($slug) {
        $parsedSlug = explode('/', $slug);
        $slug = end($parsedSlug);

        $data['category'] = Category::whereSlug($slug)->firstOrFail();

        $data['products'] = $this->getProductsByCategoryId($data['category']->id, $this->pagination_limit);

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
        $children_categories_ids = Category::descendantsAndSelf($category_id)->pluck('id');

        $products = QueryBuilder::for(Product::class)
            ->allowedFilters([
                'attributes',
                AllowedFilter::scope('price_from'),
                AllowedFilter::scope('price_to')
            ])
            ->with('category')
            ->where('active', 1)
            ->whereIn('category_id', $children_categories_ids)
            ->get()
            ->sortByDesc('updated_at')
            ->sortByDesc('views')
            ->sortByDesc('delivery');

        $data['products'] = CollectionPaginate::paginate($products, $this->pagination_limit);

        return view('front.category.productsContainer')->with($data)->render();
    }

    private function getProductsByCategoryId($category_id, $limit = 20) {
        $children_categories_ids = Category::descendantsAndSelf($category_id)->pluck('id');

        $products = Product::whereIn('category_id', $children_categories_ids)
            ->where('active', 1)
            ->get()
            ->sortByDesc('updated_at')
            ->sortByDesc('views')
            ->sortByDesc('delivery');

        return CollectionPaginate::paginate($products, $limit);
    }
}
