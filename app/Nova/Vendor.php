<?php

namespace App\Nova;

use Davidpiesse\NovaToggle\Toggle;
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaGoogleMaps\GoogleMaps;

class Vendor extends Resource
{
    public static $model = \App\Models\Vendor::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name', 'email', 'phone', 'phone2', 'address', 'address2'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            BelongsTo::make('Membership')
                ->showCreateRelationButton()
                ->withoutTrashed(),

            BelongsTo::make('Country')
                ->showCreateRelationButton()
                ->withoutTrashed(),

            Text::make('Name')
                ->sortable()
                ->rules(REQUIRED_STRING_VALIDATION)
                ->translatable(),

            Text::make('Email')
                ->sortable()
                ->rules(REQUIRED_EMAIL_VALIDATION)
                ->creationRules('unique:vendors,email')
                ->updateRules('unique:vendors,email,{{resourceId}}'),

            Text::make('Phone')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION),

            Text::make('Phone2')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION),

            Text::make('Whatsapp Phone')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION),

            Text::make('Address')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION),

            Text::make('Address2')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION),

            GoogleMaps::make('Location')
                ->zoom(6)
                ->hideFromIndex(),

            Text::make('Facebook', 'facebook_url')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION),
            Text::make('Twitter', 'twitter_url')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION),
            Text::make('Youtube', 'youtube_url')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION),
            Text::make('Instagram', 'instagram_url')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION),
            Text::make('Pinterest', 'pinterest_url')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION),
            Text::make('Website', 'website_url')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION),

        Medialibrary::make('Cover', VENDOR_COVER)
                ->rules('required')
                ->accept('image/*')
                ->autouploading()
                ->attachRules(REQUIRED_IMAGE_VALIDATION)
                ->attachOnDetails()
                ->hideFromIndex(),

        Medialibrary::make('Logo', VENDOR_LOGO)
                ->rules('required')
                ->accept('image/*')
                ->autouploading()
                ->attachRules(REQUIRED_IMAGE_VALIDATION)
                ->attachOnDetails()
                ->hideFromIndex(),

            Medialibrary::make('Licenses', VENDOR_PATH)->fields(function () {
                return [
                    Text::make('File Name', 'file_name')
                        ->rules('required', 'min:2'),
                ];
            })->rules('array', 'required')
                ->creationRules('min:1')
                ->attachRules(REQUIRED_IMAGE_VALIDATION)
                ->accept('image/*')
                ->autouploading()->attachOnDetails()
                ->hideFromIndex(),

            Toggle::make('Active')
                ->falseColor('#bacad6')
                ->editableIndex(),

            Toggle::make(__('Featured'), 'isFeatured')
                ->falseColor('#bacad6')
                ->editableIndex(),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            (new Panel('Shipping Prices', [
                Flexible::make('Shipping Prices')
                    ->addLayout('Shipping Prices', 'shipping_prices', [
                        Select::make('Cities')->options(function () {
                            return $this->cities->pluck('name', 'id');
                        })->rules(['required', 'integer']),
                        Currency::make('Price')->rules(REQUIRED_NUMERIC_VALIDATION)->min(0)->step(0.05),
                        Text::make('Time')->placeholder('2 Days, 1 Week'),
                    ])->button('Add')
            ])),

            HasMany::make('Products'),

            HasMany::make('Branches'),
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
