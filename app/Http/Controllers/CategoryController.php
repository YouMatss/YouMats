<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($category_slug) {
        $category = Category::where('slug', $category_slug)->first();

        abort_if(!$category, 404);

        return view('front.category')->with(compact('category'));
    }
}
