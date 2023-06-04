<?php

namespace App\Nova;

use App\Helpers\Nova\Fields;
use App\Nova\Actions\ImportProducts;
use Benjacho\BelongsToManyField\BelongsToManyField;
use Davidpiesse\NovaToggle\Toggle;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Inspheric\Fields\Url;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;
use Maher\TitleTemplate\TitleTemplate;
use Nikaia\Rating\Rating;
use OptimistDigital\NovaSimpleRepeatable\SimpleRepeatable;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use Waynestate\Nova\CKEditor;
use Whitecube\NovaFlexibleContent\Flexible;
use ZiffDavis\Nova\Nestedset\Fields\NestedsetSelect;

class Product extends Resource
{
    use HasSortableRows;

    public static $model = \App\Models\Product::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name', 'desc', 'short_desc', 'slug', 'SKU'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make('Name', 'name', fn() =>
                '<a href="'. \Nova::path()."/resources/{$this->uriKey()}/{$this->id}" . '" class="no-underline dim text-primary font-bold">'. $this->name . '</a>'
            )->asHtml()->onlyOnIndex(),

//            BelongsTo::make('Category')->hideWhenCreating()->hideWhenUpdating(),
//            NestedTreeAttachManyField::make('Category', 'category', Category::class)->useSingleSelect(),

            NestedsetSelect::make('Category'),

            BelongsTo::make('Vendor')->withoutTrashed()->searchable(),

            TitleTemplate::make('Name')
                ->category('category')
                ->endpoint('/api/loadData/{category}/product/{product}')
                ->hideFromIndex(),

//            SluggableText::make('Name')
//                ->slug($request->isUpdateOrUpdateAttachedRequest() ? 'DONOTUPDATE' : 'Slug')
//                ->sortable()->translatable()->hideFromIndex()
//                ->rules(REQUIRED_STRING_VALIDATION),

            BelongsToManyField::make('Tags')
                ->optionsLabel('translated_name')->hideFromIndex(),

            CKEditor::make('Short Description', 'short_desc')
                ->hideFromIndex()->translatable()
                ->rules(NULLABLE_TEXT_VALIDATION),

            CKEditor::make('Description', 'desc')
                ->hideFromIndex()->translatable()
                ->rules(REQUIRED_TEXT_VALIDATION),

            Select::make('Type')->options([
                'product' => 'Product',
                'service' => 'Service'
            ])->displayUsingLabels()->hideFromIndex()
            ->rules(array_merge(REQUIRED_STRING_VALIDATION, ['In:product,service'])),

            NovaDependencyContainer::make([
                Currency::make('Cost')
                    ->rules(REQUIRED_NUMERIC_VALIDATION)->min(0)->step(0.05),

                Currency::make('Price')
                    ->rules(REQUIRED_NUMERIC_VALIDATION)->min(0)->step(0.05),

                Number::make('Stock')
                    ->min(0)->rules(REQUIRED_INTEGER_VALIDATION),
            ])->dependsOn('type', 'product'),

            BelongsTo::make('Unit')
                ->hideFromIndex()->nullable(),

            Number::make('Minimum Order Quantity', 'min_quantity')
                ->rules(REQUIRED_INTEGER_VALIDATION)
                ->default(1)->min(1)
                ->hideFromIndex(),

            Text::make('SKU', 'SKU')
                ->hideFromIndex()
                ->rules(NULLABLE_STRING_VALIDATION)
                ->default(\Illuminate\Support\Str::sku('yt', '-'))
                ->creationRules('unique:products,SKU')
                ->updateRules('unique:products,SKU,{{resourceId}}'),

            Rating::make('Rate')
                ->min(0)->max(5)->increment(1)
                ->hideFromIndex()->rules(REQUIRED_NUMERIC_VALIDATION),

            Toggle::make('Active')
                ->falseColor('#bacad6')->editableIndex(),

            Toggle::make('Best Seller')->sortable()
                ->falseColor('#bacad6')->editableIndex(),

            Number::make('Views')->hideFromIndex()
                ->hideWhenUpdating()->hideWhenCreating(),

            DateTime::make('Creation Date', 'created_at')
                ->onlyOnDetail(),

            Url::make('Link')
                ->customHtmlUsing(function($value, $resource, $label) {
                    return view('vendor.nova.partials.custom_link', [
                        'url'   => getFullProductLink($this->model()),
                        'label' => 'Link',
                    ])->render();
                })->exceptOnForms(),

            (new Panel('Gallery', [
                Fields::image(false, PRODUCT_PATH, 'Images', false),
            ])),

            (new Panel('Shipping Prices', [
                Boolean::make('Specific shipping', 'specific_shipping')->hideFromIndex()->nullable(),
                NovaDependencyContainer::make([
                    Select::make('Shipping', 'shipping_id')
                        ->options(function () {
                            return \App\Models\Shipping::where('vendor_id', $this->vendor_id)->pluck('name', 'id');
                        })->placeholder('Choose shipping group')->nullable()->displayUsingLabels()
                        ->hideFromIndex()->hideWhenCreating(),
                ])->dependsOn('specific_shipping', false),
                NovaDependencyContainer::make([
                    Flexible::make('Shipping Prices', 'shipping_prices')
                        ->addLayout('Cars', 'cars', [
                            Text::make('Car Type', 'car_type')->rules(REQUIRED_STRING_VALIDATION),
                            SimpleRepeatable::make('cities', 'cities', [
                                Select::make('City')->options(function () {
                                    $collection = [];
                                    $data = \App\Models\City::with('country')->get();
                                    foreach ($data as $row) {
                                        $collection[$row->id] = ['label' => $row->name, 'group' => $row->country->name];
                                    }
                                    return $collection;
                                })->displayUsingLabels()->placeholder('Choose City')->rules(['required', 'integer']),
                                Number::make('Quantity')->rules(REQUIRED_INTEGER_VALIDATION)->min(1)->step(1),
                                Currency::make('Price')->rules(REQUIRED_NUMERIC_VALIDATION)->min(0)->step(0.05),
                                Number::make('Time')->rules(REQUIRED_INTEGER_VALIDATION)->min(1)->step(1),
                                Select::make('Format')->options(['hour' => 'Hour', 'day' => 'Day'])->rules(['required', 'in:hour,day']),
                            ]),
                        ]),
                ])->dependsOn('specific_shipping', true),
            ])),

            (new Panel('Attributes (For Product Filtration)', [
                BelongsToManyField::make('Attributes')
                    ->options(\App\Models\AttributeValue::with('attribute')
                        ->whereHas('attribute', function ($query) {
                            $query->where('category_id', $this->category_id);
                        })->get()
                    )
                    ->setMultiselectProps(['selectLabel' => 'click for select'])
                    ->optionsLabel('translated_name')->hideFromIndex()
                    ->showAsListInDetail()->hideWhenCreating(),

                BelongsToManyField::make('Attributes')
                    ->options(\App\Models\AttributeValue::with('attribute')->get())
                    ->setMultiselectProps(['selectLabel' => 'click for select'])
                    ->optionsLabel('translated_name')
                    ->hideFromDetail()->hideFromIndex()->hideWhenUpdating(),

//                Multiselect::make('Attributes', 'attributes')
//                    ->options(function () {
//                        $collection = [];
//                        $query = \App\Models\Attribute::with('values');
//
//                        if(!is_null($this->category_id))
//                            $query->where('category_id', $this->category_id);
//
//                        $data = $query->get();
//
//                        foreach ($data as $row) {
//                            foreach ($row->values as $value) {
//                                $collection[$value->id] = ['label' => $value->value, 'group' => $row->key];
//                            }
//                        }
//                        return $collection;
//                    })
//                    ->placeholder('Choose Attributes Values')
//                    ->hideFromIndex(),
            ])),

            new Panel('Search Keywords', [
                Heading::make("Instructions: Set every keyword in one line"),
                Textarea::make('Search Keywords')
                    ->rules(NULLABLE_TEXT_VALIDATION)
                    ->translatable(),
            ]),

            Fields::SEO(static::$model,'products', false, true),
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
        return [
            new ImportProducts
        ];
    }
}
