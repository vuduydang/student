<?php

namespace App\Http\Requests\Results;

use Illuminate\Foundation\Http\FormRequest;

class ResultCreateRequest extends FormRequest
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
            "score.*" => "required|numeric|min:0|max:10"
        ];
    }

    function messages()
    {
        return [
          //
        ];
    }
}
