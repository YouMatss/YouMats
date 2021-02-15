<?php

namespace App\Nova;

use App\Nova\Filters\Contact\ContactDate;
use App\Nova\Metrics\ContactCount;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Contact extends Resource
{
    public static $model = \App\Models\Contact::class;

    public static $title = 'email';

    public static $tableStyle = 'tight';

    public static $polling = true;
    public static $pollingInterval = 30;
    public static $showPollingToggle = true;

    public static $search = [
        'id', 'name', 'email', 'phone', 'message'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules(REQUIRED_STRING_VALIDATION),

            DateTime::make('Date', 'created_at')->format('LLLL')->hideWhenCreating()->hideWhenUpdating()->sortable(),


            Text::make('Email')
                ->sortable()
                ->rules(REQUIRED_EMAIL_VALIDATION),

            Text::make('Phone')
                ->sortable()
                ->rules(REQUIRED_STRING_VALIDATION),

            Textarea::make('Message')
                ->hideFromIndex()
                ->rules(NULLABLE_TEXT_VALIDATION)
                ->alwaysShow(),

        ];
    }

    public function cards(Request $request)
    {
        return [
            new ContactCount
        ];
    }

    public function filters(Request $request)
    {
        return [
            new ContactDate
        ];
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
