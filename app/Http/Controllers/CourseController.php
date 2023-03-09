<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index()
    {
        $data = Course::get();
        return view('course.index', ['data'=>$data,]);
    }


    public function create()
    {
        return view('course.create');
    }


    public function store(Request $request)
    {
        //store kiểu OOP
    $object = new Course();
    $object ->fill($request->except('_token'));
    $object->save();

    //điều hướng về trang course.index
    return redirect()->route('course.index');

    }

    public function show(Course $course)
    {
        //
    }


    public function edit(Course $course)
    {
        return view('course.edit', ['course' => $course]);

    }


    public function update(Request $request, Course $course)
    {
        //Không hiểu sao cách này mình không làm được huhu
//        $course ->update(
//            $request->except(('_token', '_method'))
//            //update trừ @csrf(token) và method(put)
//        );

        //Cách làm theo Query Builder (tạo ra câu lệnh SQL)
        // Phù hợp cho tạo nhiều cái cùng 1 luc
//        Course::where('id', $course->id)->update(
//            $request->except(['_token', '_method'])
//        );

        //Cách làm theo OOP
        //Phù hợp với
        $course->fill($request->except('_token', '_method'));
        $course->save();
        return redirect()->route('course.index');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('course.index');

    }
}
