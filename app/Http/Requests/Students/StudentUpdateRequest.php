<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,'. $this->get('user_id'),
            'phone' => 'required|regex:/0([0-9]{9})/|max:10|unique:students,phone,'. $this->get('id'),
            'address' => 'required',
            'avatar' => 'image',
        ];
    }
    public function messages()
    {
        return [
            'avatar.image' => '* Incorrect format (jpeg, png, jpg)'
        ];
    }
}
