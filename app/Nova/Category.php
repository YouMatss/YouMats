<?php

namespace App\Nova;

use App\Helpers\Nova\Fields;
use App\Nova\Filters\Category\CategoryType;
use Davidpiesse\NovaToggle\Toggle;
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use Drobee\NovaSluggable\SluggableText;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use OptimistDigital\NovaSimpleRepeatable\SimpleRepeatable;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use PhoenixLib\NovaNestedTreeAttachMany\NestedTreeAttachManyField;
use Waynestate\Nova\CKEditor;
use Whitecube\NovaFlexibleContent\Flexible;

class Category extends Resource
{
    use HasSortableRows;

    public static $model = \App\Models\Category::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name', 'title', 'desc', 'short_desc'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            SluggableText::make('Name')
                ->slug($request->isUpdateOrUpdateAttachedRequest() ? 'DONOTUPDATE' : 'Slug')
                ->hideFromIndex()->translatable()->rules(REQUIRED_STRING_VALIDATION),

            Text::make('Name', 'name', fn() =>
                '<a href="'. \Nova::path()."/resources/{$this->uriKey()}/{$this->id}" . '" class="no-underline dim text-primary font-bold">'. $this->name . '</a>'
            )->asHtml()->onlyOnIndex(),

            Text::make('H1 Title', 'title')->hideFromIndex()->translatable()->rules(NULLABLE_STRING_VALIDATION),

            Boolean::make('Category')->hideFromIndex(),
            BelongsTo::make('Parent', 'parent', self::class)->onlyOnIndex(),
            NovaDependencyContainer::make([
                NestedTreeAttachManyField::make('Parent', 'parent', self::class)
                    ->useSingleSelect()->hideFromIndex()->nullable(),
            ])->dependsOn('category', false),

            Textarea::make('Short Description', 'short_desc')
                ->translatable()
                ->rules(NULLABLE_TEXT_VALIDATION),

            CKEditor::make('Description', 'desc')
                ->hideFromIndex()
                ->translatable()
                ->rules(REQUIRED_TEXT_VALIDATION),

            Medialibrary::make('Image', CATEGORY_PATH)->fields(function () {
                return [
                    Text::make('File Name', 'file_name')->rules('required', 'min:2'),
                    Text::make('Image Title', 'img_title')->translatable()->rules(NULLABLE_STRING_VALIDATION),
                    Text::make('Image Alt', 'img_alt')->translatable()->rules(NULLABLE_STRING_VALIDATION)
                ];
            })->attachRules(REQUIRED_IMAGE_VALIDATION)
                ->accept('image/*')->autouploading()->attachOnDetails()->single()
                ->croppable('cropper'),

            Medialibrary::make('Cover', CATEGORY_COVER)->fields(function () {
                return [
                    Text::make('File Name', 'file_name')->rules('required', 'min:2'),
                    Text::make('Image Title', 'img_title')->translatable()->rules(NULLABLE_STRING_VALIDATION),
                    Text::make('Image Alt', 'img_alt')->translatable()->rules(NULLABLE_STRING_VALIDATION)
                ];
            })->attachRules(REQUIRED_IMAGE_VALIDATION)
                ->accept('image/*')->autouploading()->attachOnDetails()->single()
                ->croppable('cropper')
                ->hideFromIndex(),

            Toggle::make(__('Section I'), 'section_i')->falseColor('#bacad6')->editableIndex(),
            Toggle::make(__('Section II'), 'section_ii')->falseColor('#bacad6')->editableIndex(),
            Toggle::make(__('Section III'), 'section_iii')->falseColor('#bacad6')->editableIndex(),
            Toggle::make(__('Section IV'), 'section_iv')->falseColor('#bacad6')->editableIndex(),
            Toggle::make(__('Featured'), 'isFeatured')->falseColor('#bacad6')->editableIndex(),
            Toggle::make(__('Top Category'), 'topCategory')->falseColor('#bacad6')->editableIndex(),
            Toggle::make(__('Show in footer'), 'show_in_footer')->falseColor('#bacad6')->editableIndex(),
            Toggle::make(__('Hide Availability & Stock'), 'hide_availability')->falseColor('#bacad6')->hideFromIndex(),

            new Panel('Template For Title', [
                Heading::make('Instructions: + => for input, - => for dropdown, Ex for dropdown: -Orientation-Horizontal-Vertical'),
                SimpleRepeatable::make('Template', 'template', [
                    Text::make('Word')->rules(NULLABLE_TEXT_VALIDATION)->translatable(),
                ])->canAddRows(true)->canDeleteRows(true),
            ]),

            Fields::SEO(static::$model,'categories'),

            HasMany::make('Children', 'children', self::class),
            HasMany::make('Products'),
            HasMany::make('Attributes'),
            HasMany::make('Vendors'),
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
        return [
            new CategoryType
        ];
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
        return [
            new DownloadExcel,
        ];
    }
}
