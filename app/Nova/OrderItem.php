<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class OrderItem extends Resource
{
    public static $model = \App\Models\OrderItem::class;

    public static $displayInNavigation = false;

    public static $title = 'SKU';

    public static $search = [
        'id', 'SKU'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            BelongsTo::make('Product')
                ->readonly(),

            Number::make('Quantity')
                ->min(1),

            Currency::make('Price')
                ->rules(REQUIRED_NUMERIC_VALIDATION)
                ->min(1)
                ->step(0.05),

            Currency::make('total Price')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->withMeta([
                    'value' => 'SAR ' . $this->price * $this->quantity
                ]),
        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
    }
}
