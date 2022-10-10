<?php

namespace App\Nova;

use App\Helpers\Nova\Fields;
use Davidpiesse\NovaToggle\Toggle;
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class Currency extends Resource
{
    use HasSortableRows;

    public static $model = \App\Models\Currency::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name', 'code', 'symbol'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make('Name')
                ->sortable()
                ->hideFromIndex()
                ->rules(REQUIRED_STRING_VALIDATION)
                ->creationRules('unique:currencies,name')
                ->updateRules('unique:currencies,name,{{resourceId}}'),

            Text::make('Name', 'name', fn() =>
                '<a href="'. \Nova::path()."/resources/{$this->uriKey()}/{$this->id}" . '" class="no-underline dim text-primary font-bold">'. $this->name . '</a>'
            )->asHtml()->onlyOnIndex(),

            Fields::image(false, CURRENCY_PATH, 'Image', true),

            Text::make('Code')
                ->sortable()
                ->rules(REQUIRED_STRING_VALIDATION)
                ->creationRules('unique:currencies,code')
                ->updateRules('unique:currencies,code,{{resourceId}}'),

            Text::make('Symbol')
                ->sortable()
                ->translatable()
                ->rules(REQUIRED_STRING_VALIDATION),

            Number::make('Rate')
                ->sortable()
                ->step(0.000001)
                ->rules(NULLABLE_NUMERIC_VALIDATION),

            Toggle::make('Active')
                ->falseColor('#bacad6')
                ->editableIndex(),

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
