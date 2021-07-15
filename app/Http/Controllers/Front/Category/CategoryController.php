<?php

namespace App\Http\Controllers\Front\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index($category_slug) {
        $data['category'] = Category::with('subCategories')->where('slug', $category_slug)->first();
        abort_if(!$data['category'], 404);

        $data['products'] = $data['category']->products()->paginate(20);

        return view('front.category.index')->with($data);
    }
}
