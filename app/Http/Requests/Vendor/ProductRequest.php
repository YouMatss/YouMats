<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name_en' => REQUIRED_STRING_VALIDATION,
            'name_ar' => REQUIRED_STRING_VALIDATION,
            'category_id' => REQUIRED_NUMERIC_VALIDATION,
            'type' => 'required|in:product,service',
            'price' => 'required_if:type,product|numeric',
            'stock' => 'required_if:type,product|numeric',
            'unit_id' => 'integer|exists:units,id',
            'rate' => REQUIRED_NUMERIC_VALIDATION,
            'short_desc_en' => NULLABLE_TEXT_VALIDATION,
            'short_desc_ar' => NULLABLE_TEXT_VALIDATION,
            'desc_en' => NULLABLE_TEXT_VALIDATION,
            'desc_ar' => NULLABLE_TEXT_VALIDATION
        ];
    }
}
