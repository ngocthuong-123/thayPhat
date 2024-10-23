@extends('layouts.mylayout')
@section('title','ngocthuong168')
@section('content')

    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style=" padding: 20px;">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 style="font-size: 2.5rem; font-weight: bold; color: #363636; text-shadow: 2px 2px 2px rgba(255, 255, 255, 2);">
                    Chỉnh sửa sản phẩm
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
        <div class="row">
        <a href="{{ route('product.index') }}" class="btn btn-sm btn-primary" style="background-color: #696969; color: white;">
                    <i class="fas fa-list"></i> Back to List
                </a>
            </div>
        </div>
        <div class="card-body">
        <div class="container">
            <h1>Edit Product</h1>

            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Product id -->
                <div class="form-group">
                    <label for="id">Product ID</label>
                    <input type="number" class="form-control" id="id" name="id" value="{{ $product->id }}" required readonly>
                </div>
                <!-- Product id -->
                <div class="form-group">
                    <label for="category_id">Category ID</label>
                    <input type="number" class="form-control" id="category_id" name="category_id" value="{{ $product->category_id }}" required>
                </div>
                <!-- Product id -->
                <div class="form-group">
                    <label for="brand_id">Brand ID</label>
                    <input type="number" class="form-control" id="brand_id" name="brand_id" value="{{ $product->brand_id }}" required>
                </div>
                <!-- Product Name -->
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                </div>
                <!-- Product Name -->
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $product->slug }}" required>
                </div>
                <!-- Product Description -->
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ $product->description }}</textarea>
                </div>
                <!-- Product Content -->
                <div class="form-group">
                    <label for="content">Nội dung</label>
                    <textarea class="form-control" id="content" name="content" rows="3" required>{{ $product->content }}</textarea>
                </div>

                <!-- Product Pricebuy -->
                <div class="form-group">
                    <label for="pricebuy">Giá bán</label>
                    <input type="number" step="0.01" class="form-control" id="pricebuy" name="pricebuy" value="{{ $product->pricebuy }}" required>
                </div>
                <!-- Product Pricesale -->
                <div class="form-group">
                    <label for="pricesale">Giá khuyến mãi</label>
                    <input type="number" step="0.01" class="form-control" id="pricesale" name="pricesale" value="{{ $product->pricesale }}" required>
                </div>
                <!-- Product Qty -->
                <div class="form-group">
                    <label for="qty">Số lượng</label>
                    <input type="number" step="0.01" class="form-control" id="qty" name="qty" value="{{ $product->qty }}" required>
                </div>
                <!-- Product Thumbnail -->
                <div class="form-group">
                    <label for="thumbnail">Hình ảnh</label>
                    <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
                    @if ($product->thumbnail)
                        <img src="{{ asset('dist/img/product/' . $product->thumbnail) }}" alt="Current Thumbnail" class="img-thumbnail mt-2" style="max-width: 150px;">
                    @endif
                </div>

                <div class="form-group">
                    <label for="created_by">Created By (Admin ID)</label>
                    <input type="number" class="form-control" id="created_by" name="created_by" value="{{ $product->created_by }}" required>
                 </div>
                <!-- Product Status -->
                <div class="form-group">
                <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="2" {{ $product->status == 2 ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Update Product</button>
            </form>
            </div>
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
