<?php

namespace Maher\GenerateProducts;

use Laravel\Nova\Fields\Field;

class GenerateProducts extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'generate-products';

    /**
     * @param $category
     * @return GenerateProducts
     */
    public function category($category)
    {
        return $this->withMeta([
            'category' => $category
        ]);
    }

    /**
     * @param $endpoint
     * @return GenerateProducts
     */
    public function endpoint($endpoint)
    {
        return $this->withMeta([
            'endpoint' => $endpoint
        ]);
    }

    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  string  $requestAttribute
     * @param  object  $model
     * @param  string  $attribute
     * @return void
     */
    protected function fillAttributeFromRequest($request, $requestAttribute, $model, $attribute)
    {
        dd($request->template);

        if ($request->exists($requestAttribute)) {
            foreach (json_decode($request->template) as $key => $item) {
                $template[$key] = implode(' ', $item);
            }
            $model->template = $template;
        }
    }

}
