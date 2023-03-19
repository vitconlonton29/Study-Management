<?php

namespace App\Http\Requests\Course;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    public function authorize(): bool //bắt buộc đăng nhập mới dùng đượợc
        //Nên chúng ta đổi là True
    {
        return true;
    }


    public function rules(): array //Validate ở đây
    {
        return [
            'name' => [
                'bail', //Hiển thị ngay khi có lỗi
                'required',
                'string',
                Rule::unique(Course::class)->ignore($this->course),
            ]
        ];
    }

    public function messages(): array
    {
        //attribute là tên biến mà có validate required
        return [
            'required' => ':attribute bắt buộc phải điền',
            'unique' => ':attribute đã trùng',

        ];
    }

    public function attributes(): array //đặt tên attribute
    {
        return [
            'name' => 'Tên Course',
        ];
    }
}
