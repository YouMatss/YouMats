<?php

namespace App\Nova;

use App\Models\Category;
use Davidpiesse\NovaToggle\Toggle;
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;
use Waynestate\Nova\CKEditor;

class ThirdCategory extends Resource
{
    use HasSortableRows;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ThirdCategory::class;

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
        'id', 'name', 'desc', 'short_desc', 'slug'
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

            NovaBelongsToDepend::make('Category')
                ->options(Category::all())->readonly(),
            NovaBelongsToDepend::make('SubCategory')
                ->optionsResolve(function ($category) {
                    return $category->subCategories()->get(['id', 'name']);
                })->dependsOn('Category'),

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

            Medialibrary::make('Image', THIRD_CATEGORY_PATH)->fields(function () {
                return [
                    Text::make('File Name', 'file_name')->rules('required', 'min:2'),
                    Text::make('Image Title', 'img_title')->translatable()->rules(NULLABLE_STRING_VALIDATION),
                    Text::make('Image Alt', 'img_alt')->translatable()->rules(NULLABLE_STRING_VALIDATION)
                ];
            })->attachRules(REQUIRED_IMAGE_VALIDATION)->accept('image/*')
                ->autouploading()->attachOnDetails()->single()
                ->croppable('cropper')->previewUsing('cropper'),

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
