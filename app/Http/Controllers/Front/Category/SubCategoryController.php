<?php

namespace App\Http\Controllers\Front\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Tag;

class SubCategoryController extends Controller
{
    public function index($category_slug, $subCategory_slug) {
        $data['category'] = Category::with('subCategories')->where('slug', $category_slug)->first();
        $data['subCategory'] = SubCategory::with('category')->where('slug', $subCategory_slug)->first();

        abort_if(!$data['category'], 404);
        abort_if(!$data['subCategory'], 404);

        $data['products'] = $data['subCategory']->products()->paginate(15);
        $data['tags'] = $data['subCategory']->tags();

        return view('front.category.sub')->with($data);
    }
}
