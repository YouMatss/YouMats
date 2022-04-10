<?php

namespace Maher\TitleTemplate;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class TitleTemplate extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'title-template';

    /**
     * @param $endpoint
     * @return TitleTemplate
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
        if ($request->exists($requestAttribute))
        {
            dd(count(json_decode($request->name, true)));

            if(json_decode($request->name)) {
                foreach (json_decode($request->name) as $key => $item) {
                    $name[$key] = implode(' ', $item);
                    $tempName[$key] = implode('-', $item);
                }

                $model->name = $name;
                $model->temp_name = $tempName;
            } else {
                $model->{$attribute} = $request[$requestAttribute];
            }
        }
    }
}
