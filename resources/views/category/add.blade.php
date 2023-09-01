@extends('layouts.admin')

@section('title')
<title>Shop Lee Tu</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Category', 'key' => 'Add'])
    <!-- ./Content Header (Page header) -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Danh Mục</label>
                            <input type="email" class="form-control" placeholder="Nhập tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Chọn danh mục cha</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option value="0">Chọn danh mục cha</option>
                                <option value="1">2</option>
                                <option value="2">3</option>
                                <option value="3">4</option>
                                <option value="4">5</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection