<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Mauricewijnia\NovaMapsAddress\MapsAddress;

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

            BelongsTo::make('Vendor')
                ->searchable(),

            BelongsTo::make('City')
                ->withoutTrashed(),

            Text::make('Name')
                ->rules(REQUIRED_STRING_VALIDATION)
                ->translatable()
                ->hideFromIndex()
                ->sortable(),

            Text::make('Name', 'name', fn() =>
                '<a href="'. \Nova::path()."/resources/{$this->uriKey()}/{$this->id}" . '" class="no-underline dim text-primary font-bold">'. $this->name . '</a>'
            )->asHtml()->onlyOnIndex(),

            Text::make('Phone Number')
                ->rules(REQUIRED_STRING_VALIDATION),

            Text::make('Fax')
                ->rules(REQUIRED_STRING_VALIDATION),

            Text::make('Website')
                ->rules(REQUIRED_STRING_VALIDATION),

            Text::make('Address')
                ->rules(REQUIRED_STRING_VALIDATION),

            MapsAddress::make(__('Location'), 'location')
                ->zoom(11)
                ->center(['lat' => 24.7136, 'lng' => 46.6753])
                ->types(['establishment'])
                ->scriptUrlParams(['language' => 'ar'])
                ->mapOptions(['fullscreenControl' => true, 'mapTypeControl' => true])
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
