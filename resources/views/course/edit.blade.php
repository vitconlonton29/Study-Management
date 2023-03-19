<form action="{{route('course.update', $course)}}" method="post">
    @csrf
    @method('PUT')
    Name
    <input type="text" name="name" method="post" value="{{$course->name}}">
    @if($errors->has('name'))
        <span class="error">
            {{$errors->first('name')}}
        </span>
    @endif
    <br>
    <button>Edit</button>
</form>
