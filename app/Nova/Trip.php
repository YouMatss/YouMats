<?php

namespace App\Nova;

use GeneaLabs\NovaMapMarkerField\MapMarker;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
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
            BelongsTo::make('Car')->withoutTrashed()->nullable(),

            MapMarker::make('Pickup Location')
                ->defaultZoom(8)
                ->defaultLatitude(24.7136)
                ->latitude('pickup_latitude')
                ->defaultLongitude(46.6753)
                ->longitude('pickup_longitude')
                ->hideFromIndex(),

            MapMarker::make('Destination Location')
                ->defaultZoom(8)
                ->defaultLatitude(24.7136)
                ->latitude('destination_latitude')
                ->defaultLongitude(46.6753)
                ->longitude('destination_longitude')
                ->hideFromIndex(),

            Number::make('Distance')
                ->rules(REQUIRED_NUMERIC_VALIDATION)
                ->min(0)
                ->step(0.1)
                ->help('In KiloMeter'),

            Currency::make('Price')
                ->rules(NULLABLE_NUMERIC_VALIDATION)
                ->min(0)
                ->step(0.05),

            Select::make('Driver Status')->options([
                '0' => 'Pending',
                '1' => 'Accepted',
                '2' => 'Refused'
            ])->displayUsingLabels()
                ->rules(array_merge(REQUIRED_STRING_VALIDATION, ['In:0,1,2'])),

            Select::make('Status')->options([
                '0' => 'Pending',
                '1' => 'In progress',
                '2' => 'Completed'
            ])->displayUsingLabels()
                ->rules(array_merge(REQUIRED_STRING_VALIDATION, ['In:0,1,2'])),

            DateTime::make('Started At')
                ->nullable()
                ->hideFromIndex(),

            Rating::make('User Rate')
                ->min(0)
                ->max(5)
                ->increment(1)
                ->hideFromIndex()
                ->rules(NULLABLE_NUMERIC_VALIDATION),

            Rating::make('Driver Rate')
                ->min(0)
                ->max(5)
                ->increment(1)
                ->hideFromIndex()
                ->rules(NULLABLE_NUMERIC_VALIDATION),

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
