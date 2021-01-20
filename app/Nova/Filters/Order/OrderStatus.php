<?php

namespace App\Nova\Filters\Order;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class OrderStatus extends Filter
{
    public $component = 'select-filter';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('order_status', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [
            'Pending' => 'pending',
            'Shipping' => 'shipping',
            'Completed' => 'completed',
            'Refused' => 'refused'
        ];
    }
}
