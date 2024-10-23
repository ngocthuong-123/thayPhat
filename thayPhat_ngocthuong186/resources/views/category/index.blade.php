@extends('layouts.mylayout')
@section('title','ngocthuong168')
@section('content')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản lí sản phẩm</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lí sản phẩm</li>
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
          <div class="row">
            <div class="col-12 text-right">Nuts</div>
          </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 30px;" class="text-center">#</th>
                        <th style="width: 90px;" class="text-center">Hình</th>
                        <th>Tên sản phẩm</th>
                        <th>Slug</th>
                        <th style="width: 180px;" class="text-center">Chức năng</th>
                        <th style="width: 30px;" class="text-center">ID</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $categories)
                  <tr>
                    <td><input type="checkbox"/></td>
                    <td>
                      <img class="img-fluid" src="{{ asset($categories->thumbnail) }}" atl="hinh.png"/>
                    </td>
                    <td>{{ $categories->name }}</td>
                    <td>{{ $categories->slug }}</td>
                    <td class="text-center">
                    <?php if ($categories['status']==1):?>
                      <a href="index.php?option=category&cat=status&id=<?=$categories['id'];?>" class="btn btn-sm btn-success">
                      <i class="fas fa-toggle-on"></i></a>
                    <?php else:?>
                      <a href="index.php?option=category&cat=status&id=<?=$categories['id'];?>" class="btn btn-sm btn-danger">
                      <i class="fas fa-toggle-off"></i></a>
                    <?php endif;?>
                  <a href="{{ route('category.show', $categories->id) }}" class="btn btn-sm btn-info">
                  <i class="fas fa-eye"></i>
                  </a>
                  <a href="{{ route('category.edit', $categories->id) }}" class="btn btn-sm btn-primary">
                  <i class="fas fa-edit"></i>
                  </a>
                  <a href="{{ route('category.destroy', $categories->id) }}" class="btn btn-sm btn-danger">
                  <i class="fas fa-trash"></i>
                  </a>
                  </td>
                    <td>{{ $categories->id }}</td>
                  </tr>
                  @endforeach
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