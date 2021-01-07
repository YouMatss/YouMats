<?php

namespace App\Nova;

use DmitryBubyakin\NovaMedialibraryField\Fields\GeneratedConversions;
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use DmitryBubyakin\NovaMedialibraryField\TransientModel;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;
use Nikaia\Rating\Rating;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Waynestate\Nova\CKEditor;

class Product extends Resource
{

    public static $model = \App\Models\Product::class;

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
        'id', 'name', 'desc'
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
            ID::make(__('ID'), 'id')->sortable(),

            BelongsTo::make('SubCategory', 'subCategory')
                ->withoutTrashed(),

            BelongsTo::make('Vendor')
                ->hideFromIndex()
                ->withoutTrashed(),

            Text::make('Name')
                ->sortable()
                ->translatable()
                ->rules(REQUIRED_STRING_VALIDATION),

            Textarea::make('Short Description', 'short_desc')
                ->hideFromIndex()
                ->translatable()
                ->rules(NULLABLE_TEXT_VALIDATION),

            CKEditor::make('Description', 'desc')
                ->hideFromIndex()
                ->translatable()
                ->rules(REQUIRED_TEXT_VALIDATION),


            Select::make('Type')->options([
                'product' => 'Product',
                'service' => 'Service'
            ])->hideFromIndex()
            ->rules(array_merge(REQUIRED_STRING_VALIDATION, ['In:product,service'])),

            NovaDependencyContainer::make([
                Currency::make('Price')
                    ->hideFromIndex()
                    ->rules(REQUIRED_NUMERIC_VALIDATION)
                    ->min(1)
                    ->step(0.05),

                Text::make('Unit')
                    ->hideFromIndex()
                    ->translatable()
                    ->rules(REQUIRED_STRING_VALIDATION),
            ])->dependsOn('type', 'product'),

            Text::make('SKU', 'SKU')
                ->hideFromIndex()
                ->rules(REQUIRED_STRING_VALIDATION)
                ->creationRules('unique:products,SKU')
                ->updateRules('unique:products,SKU,{{resourceId}}'),

            Number::make('Stoke')
                ->min(0)
                ->hideFromIndex()
                ->rules(REQUIRED_INTEGER_VALIDATION),

            Rating::make('Rate')
                ->min(0)
                ->max(5)
                ->increment(0.5)
                ->sortable()
                ->rules(REQUIRED_NUMERIC_VALIDATION),

            (new Panel('Gallery', [
                Medialibrary::make('Images', PRODUCT_PATH)->fields(function () {
                    return [
                        Text::make('File Name', 'file_name')
                            ->rules('required', 'min:2'),

                        Text::make('Image Title', 'img_title')
                            ->rules(NULLABLE_STRING_VALIDATION),

                        Text::make('Image Alt', 'img_alt')
                            ->rules(NULLABLE_STRING_VALIDATION)
                    ];
                })->rules('array', 'required')
                    ->creationRules('min:1')
                    ->attachRules(REQUIRED_IMAGE_VALIDATION)
                    ->accept('image/*')
                    ->autouploading()->sortable()->attachOnDetails()
                    ->croppable('cropper')
            ])),

            (new Panel('SEO', [
                Slug::make('Slug')
                    ->hideFromIndex()
                    ->rules(REQUIRED_STRING_VALIDATION)
                    ->creationRules('unique:products,slug')
                    ->updateRules('unique:products,slug,{{resourceId}}'),

                Text::make('Meta Title', 'meta_title')
                    ->hideFromIndex()
                    ->rules(NULLABLE_STRING_VALIDATION)
                    ->translatable(),

                Text::make('Meta Keywords', 'meta_keywords')
                    ->hideFromIndex()
                    ->rules(NULLABLE_TEXT_VALIDATION)
                    ->translatable(),

                Textarea::make('Meta Description', 'meta_desc')
                    ->hideFromIndex()
                    ->rules(NULLABLE_TEXT_VALIDATION)
                    ->translatable(),

            ])),

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
