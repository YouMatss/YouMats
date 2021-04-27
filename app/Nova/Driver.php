<?php

namespace App\Nova;

use Davidpiesse\NovaToggle\Toggle;
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;

class Driver extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Driver::class;

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
        'id', 'name', 'email', 'phone', 'phone2'
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
            ID::make()->sortable(),

            BelongsTo::make('Country')
                ->showCreateRelationButton()
                ->withoutTrashed()
                ->hideFromIndex(),

            Text::make('Name')
                ->sortable()
                ->rules(REQUIRED_STRING_VALIDATION),

            Text::make('Email')
                ->hideFromIndex()
                ->rules(REQUIRED_EMAIL_VALIDATION)
                ->creationRules('unique:drivers,email')
                ->updateRules('unique:drivers,email,{{resourceId}}'),

            Text::make('Phone')
                ->rules(REQUIRED_STRING_VALIDATION),

            Text::make('Phone2')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION),

            Toggle::make('Active')
                ->falseColor('#bacad6')
                ->editableIndex(),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            Medialibrary::make('Driver Photo', DRIVER_PHOTO)->fields(function () {
                return [
                    Text::make('File Name', 'file_name')
                        ->rules('required', 'min:2'),
                ];
            })->attachRules(NULLABLE_IMAGE_VALIDATION)
                ->accept('image/*')
                ->autouploading()->attachOnDetails(),

            Medialibrary::make('Driver ID', DRIVER_ID)->fields(function () {
                return [
                    Text::make('File Name', 'file_name')
                        ->rules('required', 'min:2'),
                ];
            })->attachRules(NULLABLE_IMAGE_VALIDATION)
                ->accept('image/*')
                ->autouploading()->attachOnDetails()
                ->hideFromIndex(),

            Medialibrary::make('Driver License', DRIVER_LICENSE)->fields(function () {
                return [
                    Text::make('File Name', 'file_name')
                        ->rules('required', 'min:2'),
                ];
            })->attachRules(NULLABLE_IMAGE_VALIDATION)
                ->accept('image/*')
                ->autouploading()->attachOnDetails()
                ->hideFromIndex(),

            HasOne::make('Car'),

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
