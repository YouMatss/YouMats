<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'item_id' => [...REQUIRED_INTEGER_VALIDATION, ...['exists:order_items,id']],
            'status' => [...REQUIRED_STRING_VALIDATION, ...['In:pending,shipping,completed,refused']],
            'refused_note' => NULLABLE_TEXT_VALIDATION
        ];
    }
}
