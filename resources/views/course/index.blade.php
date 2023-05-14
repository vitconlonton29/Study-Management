@extends('layout.master')
@push('css')
    <link
        href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.0/fc-4.2.2/fh-3.3.2/r-2.4.1/rg-1.3.1/sc-2.1.1/sb-1.4.2/sl-1.6.2/datatables.min.css"
        rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush
@section('content')

    <div class='card'>
        <div class='card-header'>
            <h4>Courses</h4>
        </div>
        <div class="card-body">
            <a href="{{route('courses.create')}}" class="btn btn-success">Thêm Course</a>
            <br><br><br>
            <div class="form-group"> >
                <select id="select-name"></select>
            </div>

            <table class="table table-striped table-centered mb-0" id="table-index">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Created_at</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
                </thead>


                {{--                @foreach($data as $each)--}}
                {{--                    <tr>--}}
                {{--                        <td>--}}
                {{--                            {{$each->id}}--}}
                {{--                        </td>--}}
                {{--                        <td>--}}
                {{--                            {{$each->name}}--}}
                {{--                        </td>--}}
                {{--                        <td>--}}
                {{--                            {{$each->getCreatedAt()}}--}}
                {{--                        </td>--}}
                {{--                        <td>--}}
                {{--                            <a href="{{route('courses.edit', $each)}}"><i class="mdi mdi-pencil"></i></a>--}}
                {{--                        </td>--}}
                {{--                        <td>--}}
                {{--                            <form action="{{route('courses.destroy',$each)}}" method="post">--}}
                {{--                                @csrf--}}
                {{--                                @method('DELETE')--}}
                {{--                                <button class="btn btn-danger">Delete</button>--}}
                {{--                            </form>--}}
                {{--                        </td>--}}
                {{--                    </tr>--}}
                {{--                @endforeach--}}
            </table>
        </div>
    </div>
    {{--    <nav>--}}
    {{--        <div class="pagination pagination-rounded mb-0">--}}
    {{--            {{$data->links()  }}--}}
    {{--        </div>--}}
    {{--    </nav>--}}

@endsection
@push('js')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.0/fc-4.2.2/fh-3.3.2/r-2.4.1/rg-1.3.1/sc-2.1.1/sb-1.4.2/sl-1.6.2/datatables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function () {
            $("#select-name").select2({
                ajax: {
                    url: "{{route('courses.api.name')}}", //route lấy giá trị về
                    dataType: 'json',
                    data: function (params) {
                        const queryParameters = {
                            q: params.term
                        };
                        return queryParameters;
                    },
                    processResults: function (data, params) {
                        console.log(data);

                        return {
                            //keets quar tra ve
                            results: $.map(data, function (item){
                                return {
                                    text: item.name,
                                    id: item.id,
                                }
                            })
                        };
                    }
                },
                placeholder: 'Search for a repository'
            });


            function formatRepoSelection(repo) {
                return repo.full_name || repo.text;
            }

            $('#table-index').DataTable({
                dom: 'Blfrtip', //Hiện tất cả các nút
                select: true,
                processing: true,
                serverSide: true,
                ajax: '{!!route('courses.api')!!}',
                columns: [
                    // data: du
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'edit', name: 'edit'},
                    // {data:'destroy', name:'destroy'},

                ]
            })
        })
    </script>

@endpush


