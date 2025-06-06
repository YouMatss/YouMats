<?php

namespace App\Nova;

use App\Helpers\Nova\Fields;
use Davidpiesse\NovaToggle\Toggle;
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use Drobee\NovaSluggable\SluggableText;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use PhoenixLib\NovaNestedTreeAttachMany\NestedTreeAttachManyField;
use Waynestate\Nova\CKEditor;

class MainCategory extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Category::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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

            SluggableText::make('Name')
                ->slug($request->isUpdateOrUpdateAttachedRequest() ? 'DONOTUPDATE' : 'Slug')
                ->hideFromIndex()->translatable()->rules(REQUIRED_STRING_VALIDATION),

            Text::make('Name', 'name', fn() =>
                '<a href="'. \Nova::path()."/resources/{$this->uriKey()}/{$this->id}" . '" class="no-underline dim text-primary font-bold">'. $this->name . '</a>'
            )->asHtml()->onlyOnIndex(),

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

            Fields::SEO(static::$model,'categories'),
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
