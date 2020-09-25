<?php

namespace App\Http\Requests\Mails;

use Illuminate\Foundation\Http\FormRequest;

class MailCreateRequest extends FormRequest
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
            'email'=> 'required|email',
            'name' => 'required',
            'title'=> 'required',
            'content' => 'required',
        ];
    }
}
