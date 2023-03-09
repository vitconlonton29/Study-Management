<a href="{{route('course.create')}}">Thêm Course</a>

<table border ="1" width="100%">
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
                <a href="{{route('course.edit', $each)}}">Edit</a>
            </td>
            <td>
                <form action="{{route('course.destroy',$each)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button>Delete</button>
                </form>
            </td>

        </tr>

    @endforeach
</table>
