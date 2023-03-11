<?php

namespace App\Helpers\Classes;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class AttributeFilter implements Filter
{

    public function __invoke(Builder $query, $value, string $property)
    {
        if(!is_array($value))
            $value = [$value];
        foreach ($value as $id) {
            $query->whereHas('attributes', function (Builder $query) use ($id) {
                 $query->where('attribute_values.id', $id);
            });
        }
        return $query;
    }
}
