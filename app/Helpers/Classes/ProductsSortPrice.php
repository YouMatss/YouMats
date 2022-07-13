<?php

namespace App\Helpers\Classes;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Sorts\Sort;

class ProductsSortPrice implements Sort
{
    private $products;

    public function __construct($products) {
        $this->products = $products;
    }

    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $this->products->get()->sortBy(function($product) {
            if(isset($product->price) || $product->price > 0)
                return 1;
            else
                return 0;
        });
    }
}
