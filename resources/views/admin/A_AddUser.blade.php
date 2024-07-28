@extends('admin.layout_admin')
@section('title','Thêm Người dùng')
@section('content_ad')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Thêm Người dùng</h1>
    <p class="mb-4">Trang quản lí tài khoản người dùng</p>

    <!-- Form thêm user -->
    <div class="card shadow mb-4">
        <div class="container d-flex justify-content-center">
            <div class="content col-lg-9 mb-3 mt-3">
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('add_user') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex">
                        <div class="form-group col-lg-5">
                            <label for="fullname">Họ tên:</label>
                            <input class="form-control" type="text" name="fullname" id="fullname" placeholder="Họ tên">
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="username">Tên đăng nhập:</label>
                            <input class="form-control" type="text" name="username" id="username" placeholder="Tên đăng nhập" required>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group col-lg-5">
                            <label for="phone">Số điện thoại:</label>
                            <input class="form-control" type="text" name="phone" id="phone" placeholder="Số điện thoại">
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="email">Email:</label>
                            <input class="form-control" type="email" name="email" id="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group col-lg-10">
                        <label for="address">Địa chỉ:</label>
                        <input class="form-control" type="text" name="address" id="address" placeholder="Địa chỉ">
                    </div>
                    <div class="form-group col-lg-10">
                        <label for="password">Mật khẩu:</label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Mật khẩu" required>
                    </div>
                    <div class="form-group col-lg-10">
                        <label for="password_confirmation">Xác nhận mật khẩu:</label>
                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="Xác nhận mật khẩu" required>
                    </div>
                    <div class="d-flex">
                        <div class="form-group col-lg-5">
                            <label for="role">Vai trò:</label>
                            <select class="form-control" name="role" id="role" required>
                                <option value="">Chọn vai trò</option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="image">Hình ảnh:</label>
                            <input class="form-control-file" type="file" name="image" id="image">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Thêm Người dùng</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
