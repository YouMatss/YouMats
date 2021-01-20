<?php

namespace App\Nova\Metrics;

use App\Models\SubCategory;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class SubCategoryCount extends Value
{
    public function calculate(NovaRequest $request)
    {
        return $this->result(SubCategory::count())->suffix('SubCategories');
    }

    public function ranges()
    {
        return [
        ];
    }

    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    public function uriKey()
    {
        return 'sub-category-count';
    }
}
