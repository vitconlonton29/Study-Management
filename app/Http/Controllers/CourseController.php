<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class CourseController extends Controller
{
    private $model; //model = Course
    private string $title='Course';

    public function __construct()
    {
        $this->model= new Course();
        $routeName= Route::currentRouteName();
        $arr= explode('.', $routeName); //cắt chuỗi thành mảng
        $arr = array_map('ucfirst', $arr); //Nối mảng thành chuỗi
        $this->title=implode(' - ', $arr);
//        dd($arr);
        View::share('title', $this->title);
    }

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

//        $arr=[];
//        $arr['data']=$this->model->paginate();
//        return $arr;

        return DataTables::of($this->model::query())
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
        $object = $this->model;
        //$object->fill($request->except('_token')); //Cách 1
        $object->fill($request->validated()); //Cách 2: chỉ lấy những thằng đã được khai báo validate trong storerequest
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


    public function update(UpdateRequest $request, $courseId): RedirectResponse
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
        $object = $this->model->find($courseId);
        $object->fill($request->except('_token', '_method'));
        $object->save();
        return redirect()->route('courses.index');
    }

    public function destroy( $courseId): RedirectResponse
    {
        $object = $this->model->find($courseId);
        $object->delete();
        return redirect()->route('courses.index');

    }

    public function apiName(Request $request)
    {
        return $this->model->where('name', 'like','%'. $request->get('q').'%')->get([
            'id',
            'name',
        ]);
    }
}
