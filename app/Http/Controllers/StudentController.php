<?php

namespace App\Http\Controllers;

use App\Enums\StudenStatusEnum;
use App\Http\Requests\Student\StoreRequest;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    private $model;
    private string $title='Student';

    public function __construct()
    {
        $this->model= new Student();
        $routeName= Route::currentRouteName();
        $arr= explode('.', $routeName); //cắt chuỗi thành mảng
        $arr = array_map('ucfirst', $arr); //Nối mảng thành chuỗi
        $this->title=implode(' - ', $arr);
        View::share('title', $this->title);
    }

    public function index()
    {


        return view('student.index');    }

    public function api()
    {
        return DataTables::of($this->model::query())

            ->addColumn('age', function ($object){
                return $object->age;
            })
            ->addColumn('edit', function ($object) {
                return route('students.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('students.destroy', $object);
            })
            ->make(true);

    }

    public function create()
    {
        $status = StudenStatusEnum::asArray();
//        \DB::enableQueryLog();
        $courses=Course::query()->get();
//        dd(\DB::getQueryLog());
//        dd($courses);
        return view('student.create',[
            'status' => $status,
            'courses' => $courses,
        ]);
    }

    public function store(StoreRequest $request)
    {
        $object = $this->model;
        //$object->fill($request->except('_token')); //Cách 1
        $object->fill($request->validated()); //Cách 2: chỉ lấy những thằng đã được khai báo validate trong storerequest
        $object->save();
        return redirect()->route('students.index')
            ->with('success', 'Đã thêm thành công');
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }

}
