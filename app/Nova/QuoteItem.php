<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class QuoteItem extends Resource
{
    public static $model = \App\Models\QuoteItem::class;

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

            Text::make('SKU', 'SKU')
                ->rules(REQUIRED_STRING_VALIDATION),

            Number::make('Quantity')
                ->min(1),
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
