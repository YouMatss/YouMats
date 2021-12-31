<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class ShippingGroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => REQUIRED_STRING_VALIDATION,
            'cities' => ARRAY_VALIDATION,
            'cities.*' => [...REQUIRED_INTEGER_VALIDATION, ...['exists:cities,id']],
            'price' => ARRAY_VALIDATION,
            'price.*' => REQUIRED_NUMERIC_VALIDATION,
            'time' => ARRAY_VALIDATION,
            'time.*' => REQUIRED_INTEGER_VALIDATION,
            'format' => ARRAY_VALIDATION,
            'format.*' => [...REQUIRED_STRING_VALIDATION, ...['In:hour,day']],
            'default_price' => NULLABLE_NUMERIC_VALIDATION,
            'default_time' => NULLABLE_INTEGER_VALIDATION,
            'default_format' => [...NULLABLE_STRING_VALIDATION, ...['In:hour,day']],
        ];
    }
}
