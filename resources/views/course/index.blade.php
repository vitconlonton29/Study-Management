@extends('layout.master')
@push('css')
    <link
        href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.0/fc-4.2.2/fh-3.3.2/r-2.4.1/rg-1.3.1/sc-2.1.1/sb-1.4.2/sl-1.6.2/datatables.min.css"
        rel="stylesheet"/>
@endpush


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
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.0/fc-4.2.2/fh-3.3.2/r-2.4.1/rg-1.3.1/sc-2.1.1/sb-1.4.2/sl-1.6.2/datatables.min.js"></script>
@endpush


