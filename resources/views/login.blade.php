<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('login/css/style.css')}}">
    <title>Trang đăng nhập</title>
</head>

<body>
    <div id="logreg-forms">
        <form class="form-signin" method="POST" action="{{ route('admin.login') }}">
            @csrf
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Đăng nhập</h1>
            <div class="social-login">
                <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign in with Facebook</span> </button>
                <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign in with Google+</span> </button>
                <input id="google_url" type="hidden" value="{{route('admin.google')}}">
                <input id="facebook_url" type="hidden" value="{{route('admin.facebook')}}">
            </div>
            <p style="text-align:center"> HOẶC </p>
            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Địa chỉ email" required="" autofocus="">
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mật khẩu" required="">

            @if(session()->has('error_login_message'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('error_login_message') }}
            </div>
            @endif
            <button class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Đăng nhập</button>
            <a href="#" id="forgot_pswd">Quên mật khẩu?</a>
            @if(session()->has('reset_success'))
            <div class="alert alert-info" role="alert">
                {{ session()->get('reset_success') }}
            </div>
            @endif
            @if(session()->has('reset_error'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('reset_error') }}
            </div>
            @endif
            <hr>
            <!-- <p>Don't have an account!</p>  -->
            <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Tạo mới tài khoản</button>
            @if(session()->has('error_signup_message'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('error_signup_message') }}
            </div>
            @endif
        </form>

        <form action="{{route('admin.reset_password')}}" class="form-reset" method="POST">
            @csrf
            <input name="email_reset" type="email" id="resetEmail" class="form-control" placeholder="Địa chỉ email" required="" autofocus="">
            <button class="btn btn-primary btn-block" type="submit">Thiết định lại mật khẩu</button>
            <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Quay lại</a>
        </form>

        <form action="{{route('admin.create')}}" class="form-signup" method="POST">
            @csrf
            <div class="social-login">
                <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign up with Facebook</span> </button>
            </div>
            <div class="social-login">
                <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign up with Google+</span> </button>
            </div>

            <p style="text-align:center">OR</p>

            <input type="text" name="name" id="user-name" class="form-control" placeholder="Họ và tên" required="" autofocus="">
            <input type="email" name="email" id="user-email" class="form-control" placeholder="Địa chỉ email" required autofocus="">
            <input type="password" name="password" id="user-pass" class="form-control" placeholder="Mật khẩu" required autofocus="">
            <input type="password" name="re_password" id="user-repeatpass" class="form-control" placeholder="Xác nhận mật khẩu" required autofocus="">

            <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-user-plus"></i> Đăng kí</button>
            <a href="#" id="cancel_signup"><i class="fas fa-angle-left"></i> Quay lại</a>
        </form>
        <br>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{asset('login/js/script.js')}}"></script>
</body>

</html>