@extends('admin.layout_admin')
@section('title','Trang add product')
@section('content_ad')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Thêm Sản Phẩm</h1>
    <p class="mb-4">Trang quản lí Chức năng Sản Phẩm <a target="_blank" href="https://datatables.net">Thuộc quyền sở hữu của PTT_FPT</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="container d-flex justify-content-center">
            <div class="content col-lg-9 mb-3 mt-3">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('add_product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex">
                        <div class="form-group col-lg-5">
                            <label class="text" for="name">Tên Sản Phẩm:</label>
                            <input class="form-control" type="text" name="name" id="name" placeholder="Tên" required>
                        </div>
                        <div class="form-group  col-lg-5">
                            <label class="text" for="price">Giá:</label>
                            <input class="form-control" type="number" name="price" id="price" placeholder="Price" required>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group col-lg-5">
                            <label class="text" for="slug">Slug:</label>
                            <input class="form-control" type="text" name="slug" id="slug" placeholder="Slug" required>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group col-lg-5">
                            <label class="text" for="price">Giá khuyến mãi:</label>
                            <input class="form-control" type="number" name="price_sale" id="price_sale" placeholder="price_sale">
                        </div>
                        <div class="form-group col-lg-5">
                            <label class="text" for="stock">Số lượng Nhập:</label>
                            <input class="form-control" type="number" name="stock" id="stock" placeholder="Số lượng sản phẩm" required>
                        </div>
                    </div>
                    <div class="form-group col-lg-10">
                        <label class="text" for="description">Mô tả Sản Phẩm:</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Mô tả sản phẩm" cols="30" rows="10" style="height: 100px;"></textarea>
                    </div>
                    <div class="form-group col-lg-10">
                        <label class="text" for="image">Hình ảnh:</label>
                        <input class="form-control-file" type="file" name="image" id="image" placeholder="upload hình ảnh" required>
                    </div>
                    <div class="d-flex">
                        <div class="form-group col-lg-5">
                            <label class="text" for="category_id">Danh mục:</label>
                            <select class="form-control" name="category_id" id="category_id" required>
                                <option value="">Thêm theo danh mục</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mb-3">Thêm Sản phẩm</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
