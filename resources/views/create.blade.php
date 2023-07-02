@extends('layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Thêm người tham dự</h3>
                        <a href="{{route('wedding_attendee.index')}}" class="btn btn-primary float-end">Danh sách người tham dự</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('wedding_attendee.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Số điện thoại</strong>
                                <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại">
                            </div>
                            <div class="form-group">
                                <strong>Họ tên</strong>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên của bạn">
                            </div>
                            <div class="form-group">
                                <strong>Tham dự lễ cưới tại</strong>
                                <input type="text" name="join_at" class="form-control" placeholder="Nhập địa điểm tham dự">
                            </div>
                            <div class="form-group">
                                <strong>Chọn ngày tham dự</strong>
                                <input type="date" name="attend_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <strong>Mã code trong thiệp mời</strong>
                                <input type="text" name="attend_key" class="form-control" placeholder="Nhập mã code">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Lưu</button>
                </form>
            </div>
        </div>
    </div>
@endsection