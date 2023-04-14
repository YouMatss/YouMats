<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Mauricewijnia\NovaMapsAddress\MapsAddress;
use Nikaia\Rating\Rating;

class Trip extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Trip::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id'
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

            BelongsTo::make('User')->withoutTrashed(),
            BelongsTo::make('Driver')->withoutTrashed()->nullable(),

            MapsAddress::make('Pickup Location')
                ->zoom(11)
                ->center(['lat' => 24.7136, 'lng' => 46.6753])
                ->types(['establishment'])
                ->scriptUrlParams(['language' => 'ar'])
                ->mapOptions(['fullscreenControl' => true, 'mapTypeControl' => true])
                ->hideFromIndex(),

            MapsAddress::make('Destination Location')
                ->zoom(11)
                ->center(['lat' => 24.7136, 'lng' => 46.6753])
                ->types(['establishment'])
                ->scriptUrlParams(['language' => 'ar'])
                ->mapOptions(['fullscreenControl' => true, 'mapTypeControl' => true])
                ->hideFromIndex(),

            Number::make('Distance')
                ->rules(REQUIRED_NUMERIC_VALIDATION)
                ->min(0)
                ->step(0.01)
                ->help('In KiloMeter'),

            Currency::make('Price')
                ->rules(NULLABLE_NUMERIC_VALIDATION)
                ->min(0)
                ->step(0.05),

            Select::make('Driver Status')->options([
                '0' => 'Pending',
                '1' => 'Accepted'
            ])->displayUsingLabels()
                ->rules(array_merge(REQUIRED_STRING_VALIDATION, ['In:0,1'])),

            Select::make('Status')->options([
                '0' => 'Pending',
                '1' => 'In progress',
                '2' => 'Completed',
                '3' => 'Canceled'
            ])->displayUsingLabels()
                ->rules(array_merge(REQUIRED_STRING_VALIDATION, ['In:0,1,2,3'])),

            DateTime::make('Pickup Date')
                ->nullable()
                ->hideFromIndex(),

            DateTime::make('Started At')
                ->nullable()
                ->hideFromIndex(),

            Rating::make('User Rate')
                ->min(0)
                ->max(5)
                ->increment(1)
                ->hideFromIndex()
                ->rules(NULLABLE_NUMERIC_VALIDATION),

            Textarea::make('User Review')
                ->rules(NULLABLE_TEXT_VALIDATION)
                ->hideFromIndex(),

            Rating::make('Driver Rate')
                ->min(0)
                ->max(5)
                ->increment(1)
                ->hideFromIndex()
                ->rules(NULLABLE_NUMERIC_VALIDATION),

            Textarea::make('Driver Review')
                ->rules(NULLABLE_TEXT_VALIDATION)
                ->hideFromIndex(),
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
