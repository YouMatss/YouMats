<?php

namespace Maher\TitleTemplate;

use Laravel\Nova\Fields\Field;

class TitleTemplate extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'title-template';


    /**
     * @param $temp
     * @return TitleTemplate
     */
    public function temp($temp)
    {
        return $this->withMeta([
            'temp' => $temp
        ]);
    }

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
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param string $requestAttribute
     * @param object $model
     * @param string $attribute
     * @return mixed|void
     */
    protected function fillAttributeFromRequest($request, $requestAttribute, $model, $attribute)
    {
        if ($request->exists($requestAttribute))
        {
            $model->{$attribute} = $request[$requestAttribute];
        }
    }
}
