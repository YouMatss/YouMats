<?php

namespace App\Helpers\Classes;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Sorts\Sort;

class ProductsSortIsDelivery implements Sort
{
    private $products;

    public function __construct($products) {
        $this->products = $products;
    }

    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $this->products->with('category')->get()->sortBy(function($product) {
            if(isset($product->delivery))
                return 1;
            else
                return 0;
        });
    }
}
