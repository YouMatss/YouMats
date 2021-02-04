<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index($category_slug, $subCategory_slug) {
        $subCategory = SubCategory::with('category')->where('slug', $subCategory_slug)->first();

        abort_if(!$subCategory, 404);

        return view('front.subCategory')->with(compact('subCategory'));
    }
}
