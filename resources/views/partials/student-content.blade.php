<!-- Main content -->
@if(session()->has('error_message'))
<div class="alert alert-danger" role="alert">
  {{ session()->get('error_message') }}
</div>
@endif
@if(session()->has('success_message'))
<div class="alert alert-success" role="alert">
  {{ session()->get('success_message') }}
</div>
@endif
<div id="student-content">
  <div class="input-group">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
      Chọn tìm kiếm
    </button>
    <input id="url_hidden" type="hidden" value="{{route('search')}}">
    <input id="url_hidden_excel" type="hidden" value="{{route('students.export')}}">
    <input id="url_hidden_pdf" type="hidden" value="{{route('students.pdf')}}">
    <input id="token" type="hidden" value="{{csrf_token()}}">
    <div class="dropdown-menu">
      <table>
        <tr>
          <th scope="col"><input class="form-control border-end-0 border rounded-pill" type="text" placeholder="Mã học sinh" id="student-id-input"></th>
        </tr>
        <tr>
          <th scope="col"><input class="form-control border-end-0 border rounded-pill" type="text" placeholder="Họ tên" id="name-search-input"></th>
        </tr>
        <tr>
          <th scope="col"><input class="form-control border-end-0 border rounded-pill" type="text" placeholder="Ngày sinh" id="date-search-input"></th>
        </tr>
        <tr>
          <th scope="col"><input class="form-control border-end-0 border rounded-pill" type="text" placeholder="Lớp" id="class-search-input"></th>
        </tr>
        <tr>
          <th scope="col"><input class="form-control border-end-0 border rounded-pill" type="text" placeholder="Giới tính" id="gender-search-input"></th>
        </tr>
      </table>
    </div>&nbsp;
    <span class="input-group-append">
      <button id="search" class="btn btn-outline-secondary bg-white border-start-0 border rounded-pill ms-n3" type="button">
        <i class="fa fa-search"></i>
      </button>
    </span>
    <span class="input-group-append">
      <button id="clear-search" class="btn btn-outline-secondary bg-white border-start-0 border rounded-pill ms-n3" type="button">
        <i class="fa fa-times-circle"></i>
      </button>
    </span>
    <a id="export-excel" class="btn btn-success float-right">Excel</a>
    <a id="export-pdf" class="btn btn-danger float-right">Pdf</a>
    <a id="add-new" class="btn btn-primary float-right">Thêm mới</a>
    <input id="count_student" type="hidden" value="{{$studentTotal}}">
  </div>
  <div id="paging-student">
    <table id="table_search" class="table table-hover">
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
          <input class="{{'auto_id' . $i}}" type="hidden" value="{{$student->id}}">
          <td>{{$student->student_id}}</td>
          <td>{{$student->name}}</td>
          <td>{{$student->date_of_birth}}</td>
          <td>{{$student->gender}}</td>
          <td>{{$student->class_name}}</td>
          <td>{{$student->address}}</td>
          <td>{{$student->student_phone}}</td>
          <td>
            <form action="{{route('students.delete', ['auto_id' => $student->id, 'class_auto_id' => $student->class_auto_id, 'student_id' => $student->student_id])}}" method="POST">
              <a class="btn btn-info {{'student-edit' . $i}}">Sửa</a>
              @csrf
              <button type="submit" class="btn btn-danger {{'student-delete' . $i}}">Xóa</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!-- /.content -->