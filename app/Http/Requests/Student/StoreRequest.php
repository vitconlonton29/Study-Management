<?php

namespace App\Http\Requests\Student;

use App\Enums\StudenStatusEnum;
use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'=>[
                'required',
                'string',
                'min:2',
                'max:50',
            ],
            'gender'=>[
                'required',
                'boolean',
            ],
            'birthdate' => [
                'required',
                'date',
                'before:today',
            ],
            'status' => [
                'required',
                Rule::in(StudenStatusEnum::asArray()),
                ],
            //course_id tồn tại trong bảng courses
            'course_id' => [
                'required',
                Rule::exists(Course::class, 'id'),
            ],
        ];
    }
}
