<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($category_slug) {
        $data['category'] = Category::with('subCategories')->where('slug', $category_slug)->first();
        abort_if(!$data['category'], 404);

        $data['products'] = $data['category']->products()->paginate(10);

        return view('front.category')->with($data);
    }
}
