<?php

namespace App\Helpers\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class FiltersJsonField implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        return $query->where("{$property}->en", 'like', '%'. $value . '%')
                     ->orWhere("{$property}->ar", 'like', '%'. $value .'%');
    }
}
