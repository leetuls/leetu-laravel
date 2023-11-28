@extends('layouts.admin')

@section('title')
<title>Thông tin đăng nhập</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  @include('partials.content-header', ['name' => 'Thông tin đăng nhập', 'key' => ''])
  <!-- /.content-header -->

  <!-- Main content -->
  @include('profile.profile-content')
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection