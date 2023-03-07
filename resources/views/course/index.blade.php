<a href="{{route('course.create')}}">Thêm Course</a>

<table border ="1" width="100%">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Created_at</th>

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
        </tr>

    @endforeach
</table>
