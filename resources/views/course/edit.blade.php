<form action="{{route('course.update', $course)}}" method="post">
    @csrf
    @method('PUT')
    Name
    <input type="text" name="name" method="post" value="{{$course->name}}">
    <br>
    <button>Edit</button>
</form>
