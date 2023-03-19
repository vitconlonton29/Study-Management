<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index(Request $request)
    {
        //tìm kiếm
        $search = $request->get('q');
        $data = Course::query()
            ->where('name', 'like', '%' . $search . '%')
            //->get();
            ->paginate(5);//Tự động phân trang luôn (ảo ma vkl)
        $data->appends(['q'=>$search]); //truyền thêm vào để vừa phân trang vừa search
//        $data = Course::get();
        return view('course.index', [
            'data' => $data,
            'search' => $search,
        ]);
    }


    public function create()
    {
        return view('course.create');
    }


    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        //store kiểu OOP
        $object = new Course();
        //$object->fill($request->except('_token')); //Cách 1
        $object->fill($request->validated()); //Cách 2: chỉ lấy những thằng đã được khai báo validate
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


    public function update(UpdateRequest $request, Course $course): \Illuminate\Http\RedirectResponse
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
        $course->fill($request->except('_token', '_method'));
        $course->save();
        return redirect()->route('course.index');
    }

    public function destroy(Course $course): \Illuminate\Http\RedirectResponse
    {
        $course->delete();
        return redirect()->route('course.index');

    }
}
