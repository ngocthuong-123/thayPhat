@extends('layouts.mylayout')
@section('title','ngocthuong168')
@section('content')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-image: url('{{ asset($category->thumbnail) }}'); background-size: cover; background-position: center;">
    <!-- Content Header (Page header) -->
    <section class="content-header" style=" padding: 20px;">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 style="font-size: 2.5rem; font-weight: bold; color: #363636; text-shadow: 2px 2px 2px rgba(255, 255, 255, 2);">
                    Chi tiết sản phẩm
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="background-color: #ffffff; border-radius: 5px; padding: 5px; margin: 0; box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);">
                    <li class="breadcrumb-item"><a href="#" style="color: #007bff; text-decoration: none;">Trang chủ</a></li>
                    <li class="breadcrumb-item active" style="color: #6c757d;">Quản lí sản phẩm</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
      <div class="card-header">
      <a href="{{ route('category.index') }}" class="btn btn-sm btn-primary" style="background-color: #696969; color: white;">
                    <i class="fas fa-list"></i> Back to List
                </a>
      </div>
        <div class="card-body">
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Hình</th>
                        <th>Tên danh mục</th>
                        <th>Mô tả</th>
                        <th>ID</th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                  <td>
                    <img class="img-fluid" 
                        src="{{ asset($category->thumbnail) }}"
                        alt="hinh.png" 
                        style="width: 150px; height: 100px; border: 2px solid #696969;border-radius: 15px;" />
                    </td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->id }}</td>
                  </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection