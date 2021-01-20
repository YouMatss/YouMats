<?php

namespace App\Nova\Filters\Quote;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class QuoteStatus extends Filter
{
    public $component = 'select-filter';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('status', $value);
    }

    public function options(Request $request)
    {
        return [
            'Pending' => 'pending',
            'Processing' => 'processing',
            'Completed' => 'completed',
            'Refused' => 'refused'
        ];
    }
}
