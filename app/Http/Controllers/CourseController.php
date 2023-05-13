<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CourseController extends Controller
{

    public function index(Request $request)
    {
        //Dùng datatable
        return view('course.index');


        //Cách làm bình thường
//        //tìm kiếm
//        $search = $request->get('q');
//        $data = Course::query()
//            ->where('name', 'like', '%' . $search . '%')
//            //->get();
//            ->paginate(5);//Tự động phân trang luôn (ảo ma vkl)
//        $data->appends(['q'=>$search]); //truyền thêm vào để vừa phân trang vừa search
//        return view('course.index', [
//            'data' => $data,
//            'search' => $search,
//        ]);
    }

    public function api()
    {
        return DataTables::of(Course::query())
            ->editColumn('created_at',function ($object){
                return $object->created_at->format('Y/m/d');
            })
            ->addColumn('edit', function ($object){
                $link=route('courses.edit', $object);
                return "<a href='$link'><i class='mdi mdi-pencil'></i></a>";
            })
            ->addColumn('delete', function ($object){
                $link=route('courses.destroy', $object);
                return "<form action='$link' method='DELETE'>
                                @csrf
                                @method('DELETE')
                                <button class='btn btn-danger'>Delete</button>
                            </form>
                ";
            })
            ->rawColumns(['edit','delete'])
            ->make(true);
//
    }


    public function create()
    {
        return view('course.create');
    }


    public function store(StoreRequest $request): RedirectResponse
    {
        //store kiểu OOP
        $object = new Course();
        //$object->fill($request->except('_token')); //Cách 1
        $object->fill($request->validated()); //Cách 2: chỉ lấy những thằng đã được khai báo validate
        $object->save();

        //điều hướng về trang course.index
        return redirect()->route('courses.index');

    }

    public function show(Course $course)
    {
        //
    }


    public function edit(Course $course)
    {
        return view('course.edit', ['course' => $course]);

    }


    public function update(UpdateRequest $request, Course $course): RedirectResponse
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
        return redirect()->route('courses.index');
    }

    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();
        return redirect()->route('courses.index');

    }
}
