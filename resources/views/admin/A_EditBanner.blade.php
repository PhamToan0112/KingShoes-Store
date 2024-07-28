{{-- @extends('admin.layout_admin')
@section('title','Edit Banner')
@section('content_ad')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Banner</h1>
    <p class="mb-4">Trang quản lí Banner</p>

    <!-- Form Edit banner -->
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
                <form action="{{ route('update_banner',$banner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group col-lg-10">
                        <label for="name">Tên :</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ $banner->name }}">
                    </div>
                    <div class="form-group col-lg-10">
                        <label class="text" for="description">Mô tả banner:</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10" style="height: 100px;">
                            {{ $banner->description }}
                        </textarea>
                    </div>
                    <div class="form-group col-lg-10">
                        <label for="sort_order">Sắp xếp:</label>
                        <input class="form-control" type="text" name="sort_order" id="sort_order" 
                        value="{{ $banner->sort_order }}" >
                    </div>
                    <div class="d-flex">
                        <div class="form-group col-lg-5">
                            <label for="status">Trạng thái:</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="">Chọn Trạng thái</option>
                                <option value="active">active</option>
                                <option value="inactive">inactive</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="image">Hình ảnh:</label>
                            <input class="form-control-file" type="file" name="image" id="image">
                            @if ($banner->image)
                                <img src="{{ asset('img/banner/'.$banner->image) }}" alt="{{ $banner->name }}" style="max-width:100px; margin-top:10px">
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Update banner</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection --}}
