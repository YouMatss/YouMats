<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class TemplateController extends Controller
{
    /**
     * @param $category_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($category_id) {
        return Category::select('template')->findorfail($category_id);
    }
}
