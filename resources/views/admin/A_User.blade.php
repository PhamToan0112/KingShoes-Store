@extends('admin.layout_admin')
@section('title', 'Trang user')
@section('content_ad')
<div class="container-fluid" style="max-height: 730px; overflow-y: auto;">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Lists Users</h1>
    <p class="mb-4">Trang quản lí danh sách tài khoản <a target="_blank" href="https://datatables.net">Thuộc quyền sở hữu của PTT_FPT</a>.</p>
    
    <div class="form-group">
        <form action="{{ route('view_adduser') }}" method="GET">
            @csrf
            <button type="submit" class="btn bg-primary" style="color:azure"> 
                Add user
            </button>
        </form>  
    </div>
    <div class="form-group">
        <form action="{{ route('export') }}" method="GET">
            @csrf
            <button type="submit" class="btn bg-primary" style="color:azure"> 
                Export file
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
        <div class="card-header py-3 d-flex ">
            <h6 class="m-0 col-lg-8 font-weight-bold text-primary">DataTables Example</h6>
            <div class="input-group col-lg-4">
                <input type="search" placeholder="search here.." class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="css-th-content">
                            <th>STT</th>
                            <th>Image</th>
                            <th>Fullname</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>PassWord</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Role</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th>Func</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="css-th-content">
                            <th>STT</th>
                            <th>Image</th>
                            <th>Fullname</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>PassWord</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Role</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th>Func</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($A_user as $item)
                        <tr class="css-td-content">
                            <td>{{ $item->id }}</td>
                            <td class="wh-img">
                                <img src="{{ asset('img/user/' . $item->image) }}" alt="{{ $item->name }}" style="width: 100px; height: auto;">
                            </td>
                            <td>{{ $item->fullname }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <span data-toggle="tooltip" title="{{ $item->password }}">
                                    {{ str_repeat('*', 10) }}
                                </span>
                            </td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->address }}</td>
                            <td>
                                @if ($item->role == 1)
                                    <span class="badge p-2 text-bg-danger">Admin</span>
                                @else
                                    <span class="badge p-2 text-bg-primary">User</span>
                                @endif
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->updated_at }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('user.edit',$item->id) }}" class="func">
                                        <span class="badge p-2 text-bg-primary"><i class="fas fa-edit"></i> Sửa</span>
                                    </a>
                                    <span class="p-1"></span>
                                    <a href="#" class="func" onclick="event.preventDefault(); if(confirm('Bạn có chắc chắn muốn xóa?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                        <span class="badge p-2 text-bg-danger"><i class="fas fa-trash"></i> Xóa</span>
                                    </a>
                                    <form id="delete-form-{{ $item->id }}" action="{{ route('user.destroy', $item->id) }}" method="POST" style="display: none;">
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
                    {{ $A_user->links('vendor.pagination.custom') }}
                </ul>
            </nav>
        </div>
    </div>

</div>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection
