<?php

namespace App\Nova;

use App\Helpers\Nova\Fields;
use Davidpiesse\NovaToggle\Toggle;
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use Drobee\NovaSluggable\SluggableText;
use GeneaLabs\NovaMapMarkerField\MapMarker;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use OptimistDigital\MultiselectField\Multiselect;
use OptimistDigital\NovaSimpleRepeatable\SimpleRepeatable;

class Vendor extends Resource
{
    public static $model = \App\Models\Vendor::class;

    public static $title = 'name';

    public static $perPageViaRelationship = 25;

    public static $search = [
        'id', 'name'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            BelongsTo::make('Membership')
                ->showCreateRelationButton()
                ->hideFromIndex()
                ->withoutTrashed(),

            BelongsTo::make('Country')
                ->showCreateRelationButton()
                ->hideFromIndex()
                ->withoutTrashed(),

            SluggableText::make('Name')
                ->slug($request->isUpdateOrUpdateAttachedRequest() ? 'DONOTUPDATE' : 'Slug')
                ->sortable()
                ->rules(REQUIRED_STRING_VALIDATION)->hideFromIndex()
                ->translatable(),

            Text::make('Name', 'name', fn() =>
                '<a href="'. \Nova::path()."/resources/{$this->uriKey()}/{$this->id}" . '" class="no-underline dim text-primary font-bold">'. $this->name . '</a>'
            )->asHtml()->onlyOnIndex(),

            Text::make('Main Email', 'email')
                ->sortable()
                ->help('It will be used to login')
                ->rules(REQUIRED_EMAIL_VALIDATION)
                ->creationRules('unique:vendors,email')
                ->updateRules('unique:vendors,email,{{resourceId}}'),

            Text::make('Address')
                ->rules(NULLABLE_STRING_VALIDATION)
                ->hideFromIndex(),

           SimpleRepeatable::make('Contacts', 'contacts', [
              Text::make('Person Name', 'person_name')
                  ->rules(REQUIRED_STRING_VALIDATION),
              Text::make('Email', 'email')
                  ->rules(REQUIRED_EMAIL_VALIDATION),
              Text::make('Phone', 'phone')
                  ->rules(REQUIRED_STRING_VALIDATION),
              Multiselect::make('Cities', 'cities')
                  ->options(\App\Models\City::pluck('name', 'id'))
                  ->saveAsJSON(),
              Select::make('With?', 'with')
                  ->options([
                      'individual' => 'Individual',
                      'company' => 'Company',
                      'both' => 'Both'
                  ])
                  ->rules(REQUIRED_STRING_VALIDATION),
           ]),

            Select::make('Type')->options([
                'factory' => 'Factory',
                'distributor' => 'Distributor',
                'wholesales' => 'Wholesales',
                'retail' => 'Retail'
            ])->displayUsingLabels()->hideFromIndex()
                ->rules([...NULLABLE_STRING_VALIDATION, 'In:factory,distributor,wholesales,retail']),

            MapMarker::make('Location')
                ->defaultZoom(8)
                ->defaultLatitude(24.7136)
                ->defaultLongitude(46.6753)
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

            Medialibrary::make('Cover', VENDOR_COVER)->fields(function () {
                return [
                    Text::make('File Name', 'file_name')
                        ->rules('required', 'min:2'),

                    Text::make('Image Title', 'img_title')
                        ->translatable()
                        ->rules(NULLABLE_STRING_VALIDATION),

                    Text::make('Image Alt', 'img_alt')
                        ->translatable()
                        ->rules(NULLABLE_STRING_VALIDATION)
                ];
            })->attachRules(REQUIRED_IMAGE_VALIDATION)
                ->accept('image/*')
                ->autouploading()->attachOnDetails()->single()
                ->croppable('cropper')
                ->hideFromIndex(),

            Medialibrary::make('Logo', VENDOR_LOGO)->fields(function () {
                return [
                    Text::make('File Name', 'file_name')
                        ->rules('required', 'min:2'),

                    Text::make('Image Title', 'img_title')
                        ->translatable()
                        ->rules(NULLABLE_STRING_VALIDATION),

                    Text::make('Image Alt', 'img_alt')
                        ->translatable()
                        ->rules(NULLABLE_STRING_VALIDATION)
                ];
            })->attachRules(REQUIRED_IMAGE_VALIDATION)
                ->accept('image/*')
                ->autouploading()->attachOnDetails()->single()
                ->hideFromIndex(),

            Medialibrary::make('Licenses', VENDOR_PATH)->fields(function () {
                return [
                    Text::make('File Name', 'file_name')->rules('required', 'min:2'),
                ];
            })->rules('array', 'required')->creationRules('min:1')
                ->attachRules(REQUIRED_IMAGE_VALIDATION)->accept('image/*')
                ->autouploading()->attachOnDetails()->hideFromIndex(),

            Toggle::make('Active')
                ->falseColor('#bacad6')->editableIndex(),

            Toggle::make('Featured', 'isFeatured')
                ->falseColor('#bacad6')->editableIndex(),

            Password::make('Password')->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            Fields::SEO(static::$model,'vendors'),

            HasMany::make('Products'),
            HasMany::make('Branches'),
            HasMany::make('Shippings'),
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
