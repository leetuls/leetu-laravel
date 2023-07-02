@extends('layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Sửa thông tin người tham dự</h3>
                        <a href="{{route('wedding_attendee.index')}}" class="btn btn-primary float-end">Danh sách người tham dự</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('wedding_attendee.update', $attender->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Số điện thoại</strong>
                                <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại" value="{{$attender->phone}}">
                            </div>
                            <div class="form-group">
                                <strong>Họ tên</strong>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên của bạn" value="{{$attender->name}}">
                            </div>
                            <div class="form-group">
                                <strong>Tham dự lễ cưới tại</strong>
                                <input type="text" name="join_at" class="form-control" placeholder="Nhập địa điểm tham dự" value="{{$attender->join_at}}"> 
                            </div>
                            <div class="form-group">
                                <strong>Chọn ngày tham dự</strong>
                                <input type="date" name="attend_date" class="form-control" value="{{$attender->attend_date}}">
                            </div>
                            <div class="form-group">
                                <strong>Mã code trong thiệp mời</strong>
                                <input type="text" name="attend_key" class="form-control" placeholder="Nhập mã code" value="{{$attender->attend_key}}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection