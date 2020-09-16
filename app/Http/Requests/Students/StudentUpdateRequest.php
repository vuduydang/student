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
            'name' => 'required',
            'birthday' => 'required|date',
            'email' => 'required|email|unique:users,email,'. $this->get('user_id'),
            'phone' => 'required|regex:/0([0-9]{9})/|max:10|unique:students,phone,'. $this->get('id'),
            'address' => 'required',
            'avatar' => 'image',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name not define',
            'birthday.required' => 'Birthday not define',
            'birthday.date' => '* Incorrect format',
            'email.required' => 'Email not define',
            'email.email' => '* Incorrect format',
            'email.unique' => '* Email already exists',
            'phone.required' => 'Phone not define',
            'phone.regex' => '* Incorrect format',
            'phone.unique' => '* Phone already exists',
            'address.required' => 'Address not Define',
            'avatar.image' => '* Incorrect format (jpeg, png, jpg)'
        ];
    }
}
