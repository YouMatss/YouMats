<?php

namespace App\Nova;

use Davidpiesse\NovaToggle\Toggle;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class Country extends Resource
{
    use HasSortableRows;

    public static $model = \App\Models\Country::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make('Name')
                ->sortable()
                ->translatable()
                ->hideFromIndex()
                ->rules(REQUIRED_STRING_VALIDATION),

            Text::make('Name', 'name', fn() =>
                '<a href="'. \Nova::path()."/resources/{$this->uriKey()}/{$this->id}" . '" class="no-underline dim text-primary font-bold">'. $this->name . '</a>'
            )->asHtml()->onlyOnIndex(),

            Toggle::make('Active')
                ->falseColor('#bacad6')
                ->editableIndex(),

            HasMany::make('Cities'),

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
