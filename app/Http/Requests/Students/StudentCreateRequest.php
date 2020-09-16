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
            'name' => 'required',
            'birthday' => 'required|date',
            'email' => 'required|email|unique:users',
            'phone' => 'required|regex:/0([0-9]{9})/|unique:students|max:10',
            'address' => 'required',
            'avatar' => 'required|mimes:jpeg,png',
            'password' => 'required'
        ];
    }

    /**
     * @return array|string[]
     */

    public function messages()
    {
        return [
            'name.required' => '* Not define',
            'birthday.required' => '* Not define',
            'birthday.date' => '* Incorrect format',
            'email.required' => '* Not define',
            'email.email' => '* Incorrect format',
            'email.unique' => '* Email already exists',
            'phone.required' => '* Not define',
            'phone.regex' => '* Incorrect format',
            'phone.unique' => '* Phone already exists',
            'address.required' => '* Not Define',
            'avatar.required' => '* Not define',
            'avatar.mimes' => '* Incorrect format (jpeg, png)',
            'password.required' => '* Not define'
        ];
    }
}
