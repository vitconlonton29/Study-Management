<form action="{{Route('course.store')}}" method="post">
    @csrf
    Name: <input type="text" name="name"> <br>
    <button>Thêm</button>

</form>
