<?php

namespace App\Http\Requests\Courses;

use Illuminate\Foundation\Http\FormRequest;

class CourseCreateRequest extends FormRequest
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
            'name'=>'required|unique:courses',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên khóa học',
            'name.unique' => 'Tên đã tồn tại'
        ];
    }
}
