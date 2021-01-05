<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;
use Nikaia\Rating\Rating;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;

class Product extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
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

            BelongsTo::make('Category')
                ->withoutTrashed(),

            BelongsTo::make('Sub Category', 'subCategory')
                ->withoutTrashed(),

            NovaBelongsToDepend::make('Category')
                ->placeholder('Select Category')
                ->options(\App\Models\Category::all()),
            NovaBelongsToDepend::make('SubCategory')
                ->placeholder('Select SubCategory')
                ->optionsResolve(function ($category) {
                    return $category->subCategories()->get(['id','name']);
                })->dependsOn('Category'),


            BelongsTo::make('Vendor')
                ->hideFromIndex()
                ->withoutTrashed(),

            Text::make('Name')
                ->sortable()
                ->translatable()
                ->rules(REQUIRED_STRING_VALIDATION),

            Markdown::make('Description', 'desc')
                ->hideFromIndex()
                ->translatable()
                ->rules(REQUIRED_TEXT_VALIDATION),

            Avatar::make('Image', 'img')
                ->rules(REQUIRED_IMAGE_VALIDATION)
                ->disk('public')
                ->path(PRODUCT_PATH)
                ->maxWidth(150)
                ->storeAs(function (Request $request) {
                    return time() . $request->img->getClientOriginalName();
                })->deletable(false),

            Text::make('Image Title', 'img_title')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION),

            Text::make('Image Alt', 'img_alt')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION),

            Text::make('SKU')
                ->hideFromIndex()
                ->rules(REQUIRED_STRING_VALIDATION)
                ->creationRules('unique:products,SKU')
                ->updateRules('unique:products,SKU,{{resourceId}}'),

            Number::make('Stoke')
                ->min(0)
                ->hideFromIndex()
                ->rules(REQUIRED_INTEGER_VALIDATION),

            Rating::make('rate')
                ->min(0)
                ->max(5)
                ->increment(0.5)
                ->sortable()
                ->rules(REQUIRED_NUMERIC_VALIDATION),

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
