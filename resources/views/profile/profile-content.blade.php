<div id="pw_content">
    <form id="profile_form" action="{{route('admin.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container">

            @if(session()->has('updated_profile'))
            <div class="alert alert-info" role="alert">
                {{ session()->get('updated_profile') }}
            </div>
            @endif
            @if(session()->has('error_changed'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('error_changed') }}
            </div>
            @endif
            <button type="submit" class="btn btn-outline-info">Cập nhật</button>
            <button id="re_pw" type="button" class="btn btn-outline-success">Đổi mật khẩu</button>
            <input id="change_password" type="hidden" value="{{route('admin.change_password')}}">
            <a type="button" href="{{route('admin.logout')}}" class="btn btn-outline-secondary">Logout</a>
        </div>

        <div class="container">
            <div class="avatar-upload">
                <div class="avatar-edit">
                    <input name="image_profile" type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                    <label for="imageUpload"></label>
                </div>
                <div class="avatar-preview">
                    <input id="image_hidden" type="hidden" value="{{asset('img/' . Auth::user()->image)}}">
                    <div id="imagePreview">
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-12">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Nhập email" value="{{Auth::user()->email}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Họ tên</label>
                <div class="col-sm-12">
                    <input type="text" name="name" class="form-control" id="inputPassword" placeholder="Nhập họ tên" value="{{Auth::user()->name}}">
                </div>
            </div>
        </div>
    </form>
</div>