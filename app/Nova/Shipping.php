<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;
use OptimistDigital\NovaSimpleRepeatable\SimpleRepeatable;

class Shipping extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Shipping::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            BelongsTo::make('Vendor')
                ->searchable()->withoutTrashed(),

            Text::make('Name')->rules(REQUIRED_STRING_VALIDATION),

            new Panel('Specific shipping terms', [
                SimpleRepeatable::make('Cities Prices', 'cities_prices', [
                    Select::make('Cities')->options(function () {
                        $collection = [];
                        $data = \App\Models\City::with('country')->get();
                        foreach ($data as $row) {
                            $collection[$row->id] = ['label' => $row->name, 'group' => $row->country->name];
                        }
                        return $collection;
                    })->displayUsingLabels()->placeholder('Choose City')->rules(['required', 'integer']),
                    Currency::make('Price')->rules(REQUIRED_NUMERIC_VALIDATION)->min(0)->step(0.05),
                    Number::make('From', 'from')->rules(NULLABLE_INTEGER_VALIDATION)->min(1)->step(1),
                    Number::make('To', 'to')->rules(NULLABLE_INTEGER_VALIDATION)->min(1)->step(1),
                    Number::make('Time')->rules(REQUIRED_INTEGER_VALIDATION)->min(1)->step(1),
                    Select::make('Format')->options([
                        'hour' => 'Hour',
                        'day' => 'Day'
                    ])->rules(['required', 'in:hour,day']),
                ]),
            ]),

            new Panel('Default for all cities (Optional)', [
                Currency::make('Price', 'default_price')->rules(NULLABLE_NUMERIC_VALIDATION)->min(0)->step(0.05)
                    ->help('If leave it blank, that\'s mean you are not shipping to other/all cities except selected in specific terms above'),
                Number::make('From', 'default_from')->rules(NULLABLE_INTEGER_VALIDATION)->min(1)->step(1)
                    ->help('If leave it blank, it means you have set the price for any quantity & If leave it blank, that\'s mean you are not shipping to other/all cities except selected in specific terms above'),
                Number::make('To', 'default_to')->rules(NULLABLE_INTEGER_VALIDATION)->min(1)->step(1)
                    ->help('If leave it blank, it means you have set the price for any quantity & If leave it blank, that\'s mean you are not shipping to other/all cities except selected in specific terms above'),
                Number::make('Time', 'default_time')->rules(NULLABLE_INTEGER_VALIDATION)->min(1)->step(1)
                    ->help('If leave it blank, that\'s mean you are not shipping to other/all cities except selected in specific terms above'),
                Select::make('Format', 'default_format')->options([
                    'hour' => 'Hour',
                    'day' => 'Day'
                ])->rules(['nullable', 'in:hour,day'])
                    ->help('If leave it blank, that\'s mean you are not shipping to other/all cities except selected in specific terms above'),
            ]),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
