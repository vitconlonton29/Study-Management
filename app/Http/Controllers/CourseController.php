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
    $object = new Course();
    $object ->name = $request->get('name');
    $object->save();

    }


    public function show(Course $course)
    {
        //
    }


    public function edit(Course $course)
    {
        //
    }


    public function update(UpdateCourseRequest $request, Course $course)
    {
        //
    }

    public function destroy(Course $course)
    {
        //
    }
}
