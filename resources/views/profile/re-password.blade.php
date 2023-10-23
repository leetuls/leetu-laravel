<div id="pw_content">
    <form id="re_password" action="{{route('admin.changed_pw')}}" method="POST">
        @csrf
        <div class="wrapper rounded bg-white p-3">
            <div class="row">
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>Mật khẩu cũ</label>
                    <input type="password" name="old_pw" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>Mật khẩu mới</label>
                    <input type="password" name="new_pw" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>Xác nhận mật khẩu mới</label>
                    <input type="password" name="re_new_pw" class="form-control" required>
                </div>
            </div>
            <input type="submit" class="btn btn-outline-success mt-3" value="Đổi mật khẩu" />
            <a href="{{route('admin.profile')}}" class="btn btn-outline-info mt-3">Quay lại</a>
        </div>
    </form>
</div>