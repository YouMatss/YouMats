<?php

namespace App\Nova;

use App\Helpers\Nova\Fields;
use App\Nova\Filters\Quote\QuoteDate;
use App\Nova\Filters\Quote\QuoteStatus;
use App\Nova\Metrics\Quote\QuotePerDay;
use App\Nova\Metrics\Quote\QuotesStatus;
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use Illuminate\Http\Request;
use Inspheric\Fields\Indicator;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Quote extends Resource
{
    public static $model = \App\Models\Quote::class;

    public static $title = 'quote_no';

    public static $tableStyle = 'tight';

    public static $polling = true;
    public static $pollingInterval = 30;
    public static $showPollingToggle = true;

    public static $search = [
        'id', 'quote_no', 'name', 'email'
    ];

    public function fields(Request $request)
    {
        return [
            Text::make(__('ID'), 'id')->exceptOnForms()->sortable(),
            Text::make('Quote No', 'quote_no', fn() =>
                '<a href="'. \Nova::path()."/resources/{$this->uriKey()}/{$this->id}" . '" class="no-underline dim text-primary font-bold">'. $this->quote_no . '</a>'
            )->asHtml()->exceptOnForms()->default('QUO-'.strtoupper(uniqid())),
            DateTime::make('Date', 'created_at')->format('LLLL')->hideWhenCreating()->hideWhenUpdating()->sortable(),
            BelongsTo::make('User')->withoutTrashed()->hideFromIndex(),
            Text::make('Name')->sortable()->rules(REQUIRED_STRING_VALIDATION),
            Text::make('Email')->hideFromIndex()->rules(REQUIRED_EMAIL_VALIDATION),
            Text::make('Phone')->sortable()->rules(REQUIRED_STRING_VALIDATION),
            Text::make('Phone2')->hideFromIndex()->rules(NULLABLE_STRING_VALIDATION),
            Text::make('Address')->hideFromIndex()->rules(REQUIRED_STRING_VALIDATION),

            Fields::file(false, QUOTE_ATTACHMENT, 'Attachments', false),

            Select::make('Status')->options([
                'pending' => 'Pending',
                'processing' => 'Processing',
                'completed' => 'Completed',
                'refused' => 'Refused'
            ])->default('pending')->hideFromIndex()->hideFromDetail()
                ->rules(array_merge(REQUIRED_STRING_VALIDATION, ['In:pending,processing,completed,refused'])),
            Indicator::make('Status')->colors([
                'pending' => 'yellow',
                'processing' => 'orange',
                'completed' => 'green',
                'refused' => 'red'
            ])->labels([
                'pending' => 'Pending',
                'processing' => 'Processing',
                'completed' => 'Completed',
                'refused' => 'Refused'
            ]),

            Textarea::make('Notes')->rules(NULLABLE_TEXT_VALIDATION),

            Currency::make('Estimated Price')->rules(NULLABLE_NUMERIC_VALIDATION),

            HasMany::make('Quote Items', 'items'),

        ];
    }

    public function cards(Request $request)
    {
        return [
            (new QuotePerDay)->width('1/2'),
            (new QuotesStatus)->width('1/2'),
        ];
    }

    public function filters(Request $request)
    {
        return [
            new QuoteDate,
            new QuoteStatus
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
