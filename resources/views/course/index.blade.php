@extends('layout.master')
@section('content')

    <div class='card'>
        <div class='card-header'>
            <h4>Courses</h4>
        </div>
        <div class="card-body">
            <a href="{{route('course.create')}}" class="btn btn-success">Thêm Course</a>
            <caption>
                <form class="float-right form-group" method="get">
                    <label>Search</label>
                    <input type="search" name="q" class="form-control">
                </form>
            </caption>
            <table class="table table-striped table-centered mb-0">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Created_at</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
                @foreach($data as $each)
                    <tr>
                        <td>
                            {{$each->id}}
                        </td>
                        <td>
                            {{$each->name}}
                        </td>
                        <td>
                            {{$each->getCreatedAt()}}
                        </td>
                        <td>
                            <a href="{{route('course.edit', $each)}}"><i class="mdi mdi-pencil"></i></a>
                        </td>
                        <td>
                            <form action="{{route('course.destroy',$each)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <nav>
        <div class="pagination pagination-rounded mb-0">
            {{$data->links()  }}
        </div>
    </nav>

@endsection

