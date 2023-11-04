@extends('layouts.admin')

@section('title')
<title>Quản lý user</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="bg-light p-4 rounded">
        <h1>Tạo mới người dùng</h1>
        <div class="lead">
            Tạo mới và phân quyền cho tài khoản người dùng
        </div>

        <div class="mt-4">
            <form method="POST" action="">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Họ tên</label>
                    <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Name" required>

                    @if ($errors->has('name'))
                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input value="{{ old('email') }}" type="email" class="form-control" name="email" placeholder="Email address" required>
                    @if ($errors->has('email'))
                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Lưu lại</button>
                <a href="{{ route('users.index') }}" class="btn btn-default">Quay lại</a>
            </form>
        </div>

    </div>
</div>
@endsection