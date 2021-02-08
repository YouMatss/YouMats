<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index($category_slug, $subCategory_slug) {
        $data['category'] = Category::with('subCategories')->where('slug', $category_slug)->first();
        $data['subCategory'] = SubCategory::with('category')->where('slug', $subCategory_slug)->first();

        abort_if(!$data['category'], 404);
        abort_if(!$data['subCategory'], 404);

        $data['products'] = $data['subCategory']->products()->paginate(10);

        return view('front.subCategory')->with($data);
    }
}
