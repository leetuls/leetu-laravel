<div class="wrapper rounded bg-white p-3">

    <form id="add-student" class="form" action="{{route('students.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mt-md-0 mt-3">
                <label>Họ tên</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-6 mt-md-0 mt-3">
                <label>Lớp</label>
                <input type="text" name="class_name" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-md-0 mt-3">
                <label>Ngày sinh</label>
                <input type="date" name="date_of_birth" class="form-control" required>
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
        </div>
        <div class="row">
            <div class="col-md-6 mt-md-0 mt-3">
                <label>Địa chỉ</label>
                <input type="text" name="address" class="form-control" required>
            </div>
        </div>
        <input type="submit" class="btn btn-primary mt-3" value="Thêm mới" />
        <a href="{{route('students.index')}}" class="btn btn-dark mt-3">Quay lại</a>
    </form>

</div>