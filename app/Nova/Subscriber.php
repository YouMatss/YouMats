<?php

namespace App\Nova;

use App\Nova\Actions\ImportSubscribers;
use App\Nova\Metrics\SubscribersCount;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Subscriber extends Resource
{
    public static $model = \App\Models\Subscriber::class;

    public static $title = 'email';

    public static $tableStyle = 'tight';

    public static $search = [
        'id', 'email'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make('Email')
                ->sortable()
                ->rules(REQUIRED_EMAIL_VALIDATION)
                ->creationRules('unique:subscribers,email')
                ->updateRules('unique:subscribers,email,{{resourceId}}'),
        ];
    }

    public function cards(Request $request)
    {
        return [
            new SubscribersCount
        ];
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
        return [
            (new DownloadExcel)->withHeadings()->askForFilename()->askForWriterType(),
            new ImportSubscribers
        ];
    }
}
