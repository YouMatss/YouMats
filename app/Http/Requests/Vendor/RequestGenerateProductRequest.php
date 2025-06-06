<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class RequestGenerateProductRequest extends FormRequest
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
            'category_id' => [...REQUIRED_NUMERIC_VALIDATION, ...['exists:categories,id']],
            'template_en' => REQUIRED_VALIDATION,
            'template_ar' => REQUIRED_VALIDATION
        ];
    }
}
