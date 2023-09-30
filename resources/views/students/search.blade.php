<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Họ tên</th>
      <th scope="col">Ngày sinh</th>
      <th scope="col">Giới tính</th>
      <th scope="col">Lớp</th>
      <th scope="col">Địa chỉ</th>
      <th scope="col">Thao tác</th>
    </tr>
  </thead>
  <tbody>
    @foreach($sudentList as $student)
    <tr>
      <td>{{$student->id}}</td>
      <td>{{$student->name}}</td>
      <td>{{$student->date_of_birth}}</td>
      <td>{{$student->gender}}</td>
      <td>{{$student->class_name}}</td>
      <td>{{$student->address}}</td>
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