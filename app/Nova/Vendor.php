<?php

namespace App\Nova;

use App\Helpers\Nova\Fields;
use Davidpiesse\NovaToggle\Toggle;
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use Drobee\NovaSluggable\SluggableText;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Mauricewijnia\NovaMapsAddress\MapsAddress;
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
                Text::make('Code', 'phone_code')
                    ->readonly(),
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

            MapsAddress::make(__('Location'), 'location')
                ->zoom(11)
                ->center(['lat' => 24.7136, 'lng' => 46.6753])
                ->types(['establishment'])
                ->scriptUrlParams(['language' => 'ar'])
                ->mapOptions(['fullscreenControl' => true, 'mapTypeControl' => true])
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

            Toggle::make('Featured', 'isFeatured')->sortable()
                ->falseColor('#bacad6')->editableIndex(),

            Password::make('Password')->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            Fields::SEO(static::$model,'vendors'),

            HasMany::make('Products'),
            HasMany::make('Branches'),
            HasMany::make('Shippings'),
            HasOne::make('Subscribes'),
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
