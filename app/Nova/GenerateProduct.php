<?php

namespace App\Nova;

use App\Nova\Actions\GenerateProductsAction;
use App\Nova\Actions\GenerateProductsTestAction;
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Maher\GenerateProducts\GenerateProducts;
use OptimistDigital\NovaSimpleRepeatable\SimpleRepeatable;
use Pdmfc\NovaFields\ActionButton;
use Waynestate\Nova\CKEditor;
use Whitecube\NovaFlexibleContent\Flexible;
use ZiffDavis\Nova\Nestedset\Fields\NestedsetSelect;

class GenerateProduct extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\GenerateProduct::class;

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
     * @var bool
     */
    public static $searchable = false;

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

            NestedsetSelect::make('Category'),

            BelongsTo::make('Vendor')->withoutTrashed()->searchable(),

            GenerateProducts::make('Template')
                ->category('category')
                ->endpoint('/api/loadData/{category}/model/{model}')
                ->onlyOnForms(),

            ActionButton::make('Generate')
                ->action(GenerateProductsAction::class, $this->id)
                ->text('Generate')
                ->exceptOnForms()
                ->showLoadingAnimation(),

            ActionButton::make('Test Generate')
                ->action(GenerateProductsTestAction::class, $this->id)
                ->text('Test')
                ->exceptOnForms()
                ->showLoadingAnimation(),

            CKEditor::make('Short Description', 'short_desc')
                ->hideFromIndex()->translatable()
                ->rules(REQUIRED_TEXT_VALIDATION),

            CKEditor::make('Description', 'desc')
                ->hideFromIndex()->translatable()
                ->rules(REQUIRED_TEXT_VALIDATION),

            (new Panel('Images', [
                Medialibrary::make('Images', GENERATE_PRODUCT_PATH)->fields(function () {
                    return [Text::make('File Name', 'file_name')->rules('required', 'min:2')];
                })->rules('array', 'nullable')
                    ->creationRules('min:1')
                    ->attachRules(NULLABLE_IMAGE_VALIDATION)
                    ->accept('image/*')
                    ->autouploading()->sortable()->attachOnDetails()
                    ->hideFromIndex()
                    ->croppable('cropper'),
            ])),

            new Panel('Search Keywords', [
                Heading::make("Instructions: Set every keyword in one line"),
                Textarea::make('Search Keywords')
                    ->rules(NULLABLE_TEXT_VALIDATION)
                    ->translatable(),
            ]),

        ];
    }


    /**
     * @param Request $request
     * @return bool
     */
    public static function authorizedToCreate(Request $request)
    {
        return true;
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
        return [
            (new GenerateProductsAction)
                ->confirmText('Are you sure you want to generate this products?')
                ->confirmButtonText('Generate')
                ->cancelButtonText("Don't generate"),
            new GenerateProductsTestAction
        ];
    }
}
