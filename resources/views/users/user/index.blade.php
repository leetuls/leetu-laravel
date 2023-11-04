@extends('layouts.admin')

@section('title')
<title>Quản lý user</title>
@endsection

@section('content')

<div class="content-wrapper">

    <div class="bg-light p-4 rounded">
        <h1>Users</h1>
        <div class="lead">
            Danh sách user sử dụng hệ thống
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">Thêm mới user</a>

            <a href="{{ route('permissions.index') }}" class="btn-dark btn-sm float-right">Permissions</a>

            <a href="{{ route('roles.index') }}" class="btn-secondary btn-sm float-right">Roles</a>
        </div>

        <div class="mt-2">
            @include('partials.messages')
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" width="1%">STT</th>
                    <th scope="col">Mã người dùng</th>
                    <th scope="col" width="15%">Họ tên</th>
                    <th scope="col">Email</th>
                    <th scope="col" width="10%">Roles</th>
                    <th scope="col" width="1%" colspan="3">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <th scope="row">{{ ++$i }}</th>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($user->roles as $role)
                        <span class="badge bg-primary">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td><a href="{{ route('users.show', $user->id) }}" class="btn btn-warning btn-sm">XEM</a></td>
                    <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">SỬA</a></td>
                    <td>
                        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('XÓA', ['class' => 'btn btn-danger btn-sm deleteUser']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex">
            {!! $users->links('pagination::bootstrap-5') !!}
        </div>

    </div>
</div>
@endsection