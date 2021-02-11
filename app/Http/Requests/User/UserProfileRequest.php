<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:1024',
            'profile' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:1024',
            'licenses' => 'nullable|array',
            'licenses.*' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:1024',
            'name' => 'required|max:191|string',
            'email' => 'required|max:191|email|unique:users,email,' . auth()->user()->id,
            'phone' => 'required|max:191|string',
            'phone2' => 'nullable|max:191|string',
            'address' => 'required|max:191|string',
            'address2' => 'nullable|max:191|string',
            'password' => 'nullable|min:8|string|confirmed',
        ];
    }
}
