<?php

namespace App\Nova;

use Davidpiesse\NovaToggle\Toggle;
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use Waynestate\Nova\CKEditor;
use Yassi\NestedForm\NestedForm;

class SubCategory extends Resource
{
    use HasSortableRows;

    public static $model = \App\Models\SubCategory::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name', 'desc', 'short_desc', 'slug'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            BelongsTo::make('Category')
                ->withoutTrashed(),

            Text::make('Name')
                ->sortable()
                ->translatable()
                ->rules(REQUIRED_STRING_VALIDATION),

            Textarea::make('Short Description', 'short_desc')
                ->translatable()
                ->rules(NULLABLE_TEXT_VALIDATION),

            CKEditor::make('Description', 'desc')
                ->hideFromIndex()
                ->translatable()
                ->rules(REQUIRED_TEXT_VALIDATION),

            Medialibrary::make('Image', SUB_CATEGORY_PATH)->fields(function () {
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
                ->croppable('cropper'),

            Toggle::make('Show In Footer')
                ->falseColor('#bacad6')
                ->editableIndex(),

            (new Panel('SEO', [
                Slug::make('Slug')
                    ->hideFromIndex()
                    ->rules(REQUIRED_STRING_VALIDATION)
                    ->creationRules('unique:sub_categories,slug')
                    ->updateRules('unique:sub_categories,slug,{{resourceId}}')
                    ->canSee(fn() => auth('admin')->user()->can('seo')),

                Text::make('Meta Title', 'meta_title')
                    ->hideFromIndex()
                    ->rules(NULLABLE_STRING_VALIDATION)
                    ->translatable()
                    ->canSee(fn() => auth('admin')->user()->can('seo')),

                Text::make('Meta Keywords', 'meta_keywords')
                    ->hideFromIndex()
                    ->rules(NULLABLE_TEXT_VALIDATION)
                    ->translatable()
                    ->canSee(fn() => auth('admin')->user()->can('seo')),

                Textarea::make('Meta Description', 'meta_desc')
                    ->hideFromIndex()
                    ->rules(NULLABLE_TEXT_VALIDATION)
                    ->translatable()
                    ->canSee(fn() => auth('admin')->user()->can('seo')),

                Textarea::make('Schema')
                    ->hideFromIndex()
                    ->rules(NULLABLE_TEXT_VALIDATION)
                    ->canSee(fn() => auth('admin')->user()->can('seo')),
            ])),

            HasMany::make('Products'),

            (new Panel('Attributes (For Product Filtration)', [
                NestedForm::make('Attributes')->open(false),
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
