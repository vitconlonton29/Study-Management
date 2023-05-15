@extends('layout.master')

@section('content')
    <form action="{{ route('students.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        Gender
        <input type="radio" name="gender" value="0" checked>Nam
        <input type="radio" name="gender" value="1">Nữ
        <br>
        Birthdate
        <input type="date" name="birthdate">
        <br>
        Status
        <select name="status" class="form-control">
            @foreach($status as $status => $value)
                <option value="{{ $value }}">
                    {{ $status }}
                </option>
            @endforeach
        </select>
        <br>
        Course
        <select name="course_id">
            @foreach($courses as $course)
                <option value="{{ $course->id }}">
                    {{ $course->name }}
                </option>
            @endforeach
        </select>
        <br>
        <button>Create</button>
    </form>
@endsection
