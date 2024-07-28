@extends('admin.layout_admin')
@section('title','Trang Danh mục')
@section('content_ad')
<div class="container-fluid"  style="max-height: 730px; overflow-y: auto;">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Lists Users</h1>
    <p class="mb-4">Trang quản lí danh mục hàng hóa <a target="_blank"
            href="">Thuộc quyền sở hữu của PTT_FPT</a>.
    </p>
    <div class="form-group">
        <a href="{{ route('view_addcategories') }}">
            <button type="button" class="btn bg-primary" style="color:azure"> 
                Add Categories
            </button>
        </a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex ">
            <h6 class="m-0 col-lg-8 font-weight-bold text-primary">DataTables Example</h6>
            <div class="input-group col-lg-4 right-0 end-0">
                  <input type="search" placeholder="search here.." class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="css-th-content">
                            <th>STT</th>
                            <th>Name_Cate</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Name_cate_Url</th>
                            <th>Parent_id</th>
                            <th>Sort_Order</th>
                            <th>Status</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th>Func</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <th>STT</th>
                            <th>Name_Cate</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Name_cate_Url</th>
                            <th>Parent_id</th>
                            <th>Sort_Order</th>
                            <th>Status</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th>Func</th>
                    </tfoot>
                    <tbody>
                        @foreach ($A_Categories as $item)
                        <tr class="css-td-content">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <img src="{{ asset('img/cate/'.$item->image) }}" alt="{{ $item->name }}" style="width: 100px; height: auto;">
                            </td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->name_cate_Url }}</td>
                            <td>{{ $item->parent_id }}</td>
                            <td>
                               {{ $item->sort_order }}
                            </td>
                            <td>
                                @if ( $item->status == 'active' )
                                    <span style="color:rgb(0, 85, 255)"><h5>Show</h5></span>
                                @else
                                    <span style="color: red"><h5>Ẩn</h5></span>
                                @endif
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->updated_at }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('edit_categories',$item->id) }}" class="func">
                                        <span class="badge p-2 text-bg-primary"><i class="fas fa-edit"></i> Sửa</span>
                                    </a>
                                    <span class="p-1"></span>
                                    <a href="#" class="func" onclick="event.preventDefault(); if(confirm('Bạn có chắc chắn muốn xóa?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                        <span class="badge p-2 text-bg-danger"><i class="fas fa-trash"></i> Xóa</span>
                                    </a>
                                    <form id="delete-form-{{ $item->id }}" action="{{ route('destroy_categories', $item->id) }}" method="POST" style="display: none;">
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
                    {{ $A_Categories->links('vendor.pagination.custom') }}
                </ul>
            </nav>
        </div>
    </div>

</div>
@endsection