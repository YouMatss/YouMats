<?php

namespace App\Nova;

use GeneaLabs\NovaMapMarkerField\MapMarker;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Branch extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\VendorBranch::class;

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
        'name',
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

            BelongsTo::make(__('Vendor'), 'vendor')
                ->searchable(),

            BelongsTo::make(__('City'), 'city')
                ->withoutTrashed(),

            Text::make(__('Name'), 'name')
                ->rules(REQUIRED_STRING_VALIDATION)
                ->translatable()
                ->sortable(),

            Text::make(__('Phone Number'), 'phone_number')
                ->rules(REQUIRED_STRING_VALIDATION),

            Text::make(__('Fax'), 'fax')
                ->rules(REQUIRED_STRING_VALIDATION),

            Text::make(__('Website'), 'website')
                ->rules(REQUIRED_STRING_VALIDATION),

            Text::make(__('Address'), 'address')
                ->rules(REQUIRED_STRING_VALIDATION),

            MapMarker::make('Location')
                ->defaultZoom(8)
                ->defaultLatitude(24.7136)
                ->defaultLongitude(46.6753)
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
