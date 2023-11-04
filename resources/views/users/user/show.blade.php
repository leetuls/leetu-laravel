@extends('layouts.admin')

@section('title')
<title>Quản lý user</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="bg-light p-4 rounded">
        <h1>Show user</h1>
        <div class="lead">

        </div>

        <div class="container mt-4">
            <div>
                Họ tên: {{ $user->name }}
            </div>
            <div>
                Email: {{ $user->email }}
            </div>
            <div>
                <img src="{{asset('img/' . $user->image)}}" alt="User Image" style="width: 25%; height:10%">
            </div>
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Chỉnh sửa</a>
        <a href="{{ route('users.index') }}" class="btn btn-default">Quay lại</a>
    </div>
</div>
@endsection