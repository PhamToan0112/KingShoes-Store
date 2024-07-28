@extends('admin.layout_admin')
@section('title', 'Trang Sản Phẩm')
@section('content_ad')
<div class="container-fluid" style="max-height: 730px; overflow-y: auto;">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Lists Products</h1>
    <p class="mb-4">Trang quản lí danh sách sản phẩm <a target="_blank" href="https://datatables.net">Thuộc quyền sở hữu của PTT_FPT</a>.</p>
    <div class="form-group">
        <form action="{{ route('view_addproduct') }}" method="post">
            @csrf
            <button type="submit" class="btn bg-primary" style="color:azure">
                Add Product
            </button>
        </form>        
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 col-lg-8 font-weight-bold text-primary">DataTables Example</h6>
            <div class="input-group col-lg-4 right-0 end-0">
                <input type="search" placeholder="search here.." class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="css-th-content">
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Slug</th>
                            <th>Giá Gốc</th>
                            <th>Giá khuyến mãi</th>
                            <th>Thông tin mô tả sản phẩm</th>
                            <th>Lượt xem</th>
                            <th>Số lượng</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="css-th-content">
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Slug</th>
                            <th>Giá</th>
                            <th>Giá khuyến mãi</th>
                            <th>Mô tả</th>
                            <th>Lượt xem</th>
                            <th>Số lượng</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th>Chức năng</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($A_products as $item)
                        <tr class="css-td-content">
                            <td>{{ $item->id }}</td>
                            <td class="wh-img">
                                <img src="{{ asset('img/sp/' . $item->image) }}" alt="{{ $item->name }}" style="width: 100px; height: auto;">
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>{{ number_format($item->price) }}</td>
                            <td>{{ number_format($item->price_sale) }}</td>
                            <td><p>{{ $item->description }}</p></td>
                            <td>{{ $item->view }}</td>
                            <td>
                                @if ( $item->stock ==0)
                                    <span class="badge text-bg-danger p-2">{{ $item->stock }}</span>
                                @else
                                    <span class="badge text-bg-primary p-2">{{ $item->stock }}</span>
                                @endif
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->updated_at }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('products.edit', $item->id) }}" class="func">
                                        <span class="badge p-2 text-bg-primary"><i class="fas fa-edit"></i> Sửa</span>
                                    </a>
                                    <span class="p-1"></span>
                                    <a href="#" class="func" onclick="event.preventDefault(); if(confirm('Bạn có chắc chắn muốn xóa?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                        <span class="badge p-2 text-bg-danger"><i class="fas fa-trash"></i> Xóa</span>
                                    </a>
                                    <form id="delete-form-{{ $item->id }}" action="{{ route('products.destroy', $item->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>                                                                                                         
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    {{ $A_products->links('admin.pagination.custom') }}
                </ul>
            </nav>
        </div>
    </div>

</div>
@endsection
