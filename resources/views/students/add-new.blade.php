<div class="wrapper rounded bg-white p-3">
    <form id="add-student" class="form" action="{{$mode == 'new' ? route('students.store') :  route('students.update')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mt-md-0 mt-3">
                <label>Mã học sinh</label>
                <input type="text" name="student_id" class="form-control" value="{{$mode == 'new' ? '' : $studentData->student_id}}" required>
            </div>
            <div class="col-md-6 mt-md-0 mt-3">
                <label>Lớp</label>
                <input type="text" name="class_name" value="{{$mode == 'new' ? '' : $studentData->class_name}}" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-md-0 mt-3">
                <label>Họ tên</label>
                <input type="text" name="name" class="form-control" value="{{$mode == 'new' ? '' : $studentData->name}}" required>
            </div>
            <div class="col-md-6 mt-md-0 mt-3">
                <label>Ngày sinh</label>
                <input type="date" name="date_of_birth" class="form-control" value="{{$mode == 'new' ? '' : $studentData->date_of_birth}}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-md-0 mt-3">
                <label>Địa chỉ</label>
                <input type="text" name="address" class="form-control" value="{{$mode == 'new' ? '' : $studentData->address}}" required>
            </div>
            <div class="col-md-5 mt-md-1 mt-3">
                <label>Giới tính</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input checked="checked" class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Nam" />
                        <label class="form-check-label" for="inlineRadio1">Nam</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Nữ" />
                        <label class="form-check-label" for="inlineRadio2">Nữ</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-md-0 mt-3">
                <label>Số điện thoại</label>
                <input type="text" name="student_phone" class="form-control" value="{{$mode == 'new' ? '' : $studentData->student_phone}}" required>
            </div>
        </div>
        @if($mode == 'new')
        <input type="submit" class="btn btn-primary mt-3" value="Thêm mới" />
        @endif
        @if($mode == 'edit')
        <input type="submit" class="btn btn-success mt-3" value="Update" />
        @endif
        <a href="{{route('students.index')}}" class="btn btn-dark mt-3">Quay lại</a>
    </form>

</div>