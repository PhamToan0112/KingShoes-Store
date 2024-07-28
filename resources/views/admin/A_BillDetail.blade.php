@extends('admin.layout_admin')
@section('title','Trang chi tiết đơn hàng')
@section('content_ad')
<div class="container-fluid"  style="max-height: 730px; overflow-y: auto;">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Chi tiết đơn hàng</h1>
    <p class="mb-4">Trang quản lí chi tiết đơn hàng <a target="_blank"
            href="https://datatables.net">Thuộc quyền sở hữu của PTT_FPT</a>.
    </p>
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
        <div class="card-body d-flex">
            <div class="info-user col-4 border-1">
                <h3 class="h4 mb-2 text-gray-800">
                    Thông tin khách hàng
                </h3>
                <div class="content">
                    <div class="box mb-2">
                        <span>Mã đơn hàng:</span>
                        <span style="font-weight: 700">{{ $bill->order_code }}</span>
                    </div>
                    <div class="box mb-2">
                        <span>Tên:</span>
                        <span style="font-weight: 700">{{ $bill->name_cus }}</span>
                    </div>
                    <div class="box mb-2">
                        <span>Email:</span>
                        <span style="font-weight: 700">{{ $bill->email_cus }}</span>
                    </div>
                    <div class="box mb-2">
                        <span>Số điện thoại:</span>
                        <span style="font-weight: 700">{{ $bill->sdt_cus }}</span>
                    </div>
                    <div class="box mb-2">
                        <span>Địa chỉ:</span>
                        <span style="font-weight: 700">{{ $bill->diachi_cus }}</span>
                    </div>
                    <div class="box mb-2">
                        <span>Ghi chú:</span>
                        <span style="font-weight: 700">{{ $bill->description }}</span>
                    </div>
                    <div class="box mb-2">
                        <span>Thời gian:</span>
                        <span  style="font-weight: 700">
                            {{ $bill->updated_at }}</span>
                    </div>
                    <div class="box mb-2">
                        <span>Trạng thái:</span>
                        <span  style="font-weight: 700">
                            @if ($bill->status == 'dxl')
                                Chờ xác nhận
                            @elseif ($bill->status == 'xn')
                                Xác nhận
                            @else
                                Trạng thái không xác định
                            @endif
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <form action="{{ route('update.bill', $bill->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="xn">
                        <button type="submit" class="badge p-2 text-bg-primary">Xác nhận hóa đơn</button>
                    </form>
                </div>
            </div>
            <div class="info-cart col-8">
                <h3 class="h4 mb-2 text-gray-800">
                    Thông tin đơn hàng
                </h3>
                <div class="table table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="css-th-content" style="background-color: #3eb8cd; color:white" >
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Hình ảnh</td>
                                <td>Size</td>
                                <td>Giá </td>
                                <td>Số lượng </td>
                                <td>Thành tiền </td>
                            </tr>
                        </thead>
                        <tbody class="css-th-content">
                            @php
                                $tongtien= 0;
                            @endphp
                            @foreach ($cart as $item)
                            @php
                                $tongtien += $bill->total
                            @endphp
                            <tr>
                                <td style="text-transform: uppercase; font-weight: 700">{{ $item->name }}</td>
                                <td><img src="{{ asset('img/sp/'.$item->image) }}" alt="" width="40px"></td>
                                <td>{{ $item->size }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($bill->total) }}</td>
                            </tr>
                            @endforeach
                            <td colspan="6" style="text-align: center">
                                <strong>Tổng tiền:</strong> 
                                {{ number_format($tongtien) }}
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       
    </div>

</div>
@endsection
