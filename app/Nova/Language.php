<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Language extends Resource
{

    public static $model = \App\Models\Language::class;


    public static $title = 'name';

    public static $search = [
        'id', 'name', 'slug'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules(REQUIRED_STRING_VALIDATION),

            Avatar::make('Image', 'img')
                ->rules(REQUIRED_IMAGE_VALIDATION)
                ->disk('public')
                ->path(LANGUAGE_PATH)
                ->maxWidth(40)
                ->storeAs(function (Request $request) {
                    return time() . $request->img->getClientOriginalName();
                })->deletable(false),

            Text::make('Image Title', 'img_title')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION),

            Text::make('Image Alt', 'img_alt')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION),

            Slug::make('Slug')
                ->sortable()
                ->rules(REQUIRED_STRING_VALIDATION)
                ->creationRules('unique:languages,slug')
                ->updateRules('unique:languages,slug,{{resourceId}}'),

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
