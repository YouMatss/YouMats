<?php

namespace App\Helpers\Classes;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class DeliveryFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
            $query->where('price', '>', 0)
                ->whereNotNull('shipping_id')
                ->where('specific_shipping', true)
                ->get();
    }
}
