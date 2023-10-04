<div id="paging-student">
  <table class="table table-hover">
    {{$sudentList->links('pagination::bootstrap-5')}}
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Mã học sinh</th>
        <th scope="col">Họ tên</th>
        <th scope="col">Ngày sinh</th>
        <th scope="col">Giới tính</th>
        <th scope="col">Lớp</th>
        <th scope="col">Địa chỉ</th>
        <th scope="col">Số điện thoại</th>
        <th scope="col">Thao tác</th>
      </tr>
    </thead>
    <tbody>
      @foreach($sudentList as $student)
      <tr>
        <td>{{++$i}}</td>
        <td>{{$student->student_id}}</td>
        <td>{{$student->name}}</td>
        <td>{{$student->date_of_birth}}</td>
        <td>{{$student->gender}}</td>
        <td>{{$student->class_name}}</td>
        <td>{{$student->address}}</td>
        <td>{{$student->student_phone}}</td>
        <td>
          <form action="" method="POST">
            <a href="#" class="btn btn-info">Sửa</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Xóa</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>