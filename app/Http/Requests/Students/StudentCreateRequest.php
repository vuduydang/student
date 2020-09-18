<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;

class StudentCreateRequest extends FormRequest
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
            'name' => 'required|max:100',
            'birthday' => 'required|date|before:now',
            'email' => 'required|email|max:100|unique:users',
            'phone' => 'required|regex:/0([0-9]{9})/|unique:students|max:10',
            'address' => 'required',
            'avatar' => 'mimes:jpeg,png',
            'password' => 'required'
        ];
    }

    /**
     * @return array|string[]
     */

    public function messages()
    {
        return [
            'avatar.mimes' => '* Incorrect format (jpeg, png)',
        ];
    }
}
