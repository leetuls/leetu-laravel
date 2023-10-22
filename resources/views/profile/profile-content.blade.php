<form>
    <div class="container">
        <div class="avatar-upload">
            <div class="avatar-edit">
                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                <label for="imageUpload"></label>
            </div>
            <div class="avatar-preview">
                <input id="image_hidden" type="hidden" value="{{asset('img/bean.jpg')}}">
                <div id="imagePreview">
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" name="email" class="form-control" id="email" placeholder="Nhập email" value="{{Auth::user()->email}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Họ tên</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="inputPassword" placeholder="Nhập họ tên" value="{{Auth::user()->name}}">
            </div>
        </div>
    </div>

    <div class="container">
        <button type="button" class="btn btn-outline-info">Cập nhật</button>
        <button type="button" class="btn btn-outline-success">Đổi mật khẩu</button>
        <a type="button" href="{{route('admin.logout')}}" class="btn btn-outline-secondary">Logout</a>
    </div>
</form>