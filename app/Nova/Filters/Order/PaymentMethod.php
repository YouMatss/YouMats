<?php

namespace App\Nova\Filters\Order;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class PaymentMethod extends Filter {
    public $component = 'select-filter';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('payment_method', $value);
    }

    public function options(Request $request)
    {
        return [
            'Cash' => 'cash',
            'Credit Card' => 'credit card',
            'PayPal' => 'paypal'
        ];
    }
}
