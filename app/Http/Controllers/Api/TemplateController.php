<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class TemplateController extends Controller
{
    /**
     * @param $product_id
     * @return mixed
     */
    public function loadData($product_id) {
        return Product::where('products.id', $product_id)->join('categories', 'categories.id', '=', 'products.category_id')
                ->firstorfail(['products.name', 'products.temp_name', 'categories.template']);
    }
}
