<?php

namespace App\Nova;

use App\Nova\Metrics\SubscribesRevenue;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;

class Subscribe extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Subscribe::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public static $tableStyle = 'tight';

    public static $polling = true;
    public static $pollingInterval = 30;
    public static $showPollingToggle = true;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'expiry_date'
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
                ->rules([...REQUIRED_INTEGER_VALIDATION, ...['exists:vendors,id']])
                ->withoutTrashed(),

            BelongsTo::make('Membership')
                ->rules([...REQUIRED_INTEGER_VALIDATION, ...['exists:memberships,id']])
                ->withoutTrashed(),

            Date::make('Expiry Date')
                ->rules(REQUIRED_DATE_VALIDATION),

            Currency::make('Price')
                ->rules(REQUIRED_NUMERIC_VALIDATION)->min(0)->step(0.05),
        ];
    }

    /**
     * @param Request $request
     * @return bool
     */
    public static function authorizedToCreate(Request $request): bool
    {
        return true;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function authorizedToUpdate(Request $request): bool
    {
        return false;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function authorizedToDelete(Request $request): bool
    {
        return false;
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            new SubscribesRevenue
        ];
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
