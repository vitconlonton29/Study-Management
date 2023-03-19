<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool //bắt buộc đăng nhập mới dùng đượợc
        //Nên chúng ta đổi là True
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array //Validate ở đây
    {
        return [
            'name' => [
                'bail', //Hiển thị ngay khi có lỗi
                'required',
                'string',
                'unique:App\Models\Course,name',
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
