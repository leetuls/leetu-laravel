@extends('layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Quản lí người tham dự đám cưới Tú & Dương</h3>
                    </div>
                    <div class="col-md-">
                        <a href="{{route('wedding_attendee.create')}}" class="btn btn-primary float-end">Thêm mới</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(Session::has('info'))
                    <div class="alert alert-success">
                        {{Session::get('info')}}
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Số điện thoại</th>
                            <th>Họ tên</th>
                            <th>Dự tiệc cưới tại</th>
                            <th>Ngày đăng kí tham dự</th>
                            <th>Mã code trong thiệp mời</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($weddingAttender as $attender)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$attender->phone}}</td>
                                <td>{{$attender->name}}</td>
                                <td>{{$attender->join_at}}</td>
                                <td>{{$attender->attend_date}}</td>
                                <td>{{$attender->attend_key}}</td>
                                <td>
                                    <form action="{{route('wedding_attendee.destroy', $attender->id)}}" method="POST">
                                        <a href="{{route('wedding_attendee.edit', $attender->id)}}" class="btn btn-info">Sửa</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
