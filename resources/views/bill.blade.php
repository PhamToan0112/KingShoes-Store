@extends('layout')
@section('title','Trang thanh toán')
@section('content')
<section id="Breadcrumb" class="pt-3 mb-2">
    <div class="container-fluid p-3 bg-Breadcrumb">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item">
            <a href="/">
              <i class="fa-solid fa-house"></i>
              TRANG CHỦ
            </a>
          </li>
          <li class="breadcrumb-item IN" aria-current="page">
            <a href="/">
              Thanh Toán
            </a>
          </li>
        </ol>
      </nav>
    </div>
</section>
@php
$cart = Session::get('cart');
$totalPrice = 0;
$countcart = 0;
$user = Auth::user();
@endphp
<!-- Checkout Section Begin -->
<main role="main" class="mb-4">
    <!-- Block content - Đục lỗ trên giao diện bố cục chung, đặt tên là `content` -->
    <div class="container mt-4">
        <form class="needs-validation" name="frmthanhtoan" action="checkout" method="post">
            @csrf
            <div class="py-5 text-center">
                <i class="fa fa-credit-card fa-4x textPrice" aria-hidden="true"></i>
                <h2 class="textPrice">Thanh toán</h2>
                <p class="lead">Vui lòng <span class="badge text-bg-warning">kiểm tra thông tin Khách hàng</span>, thông tin Đơn hàng trước khi Đặt hàng.</p>
            </div>

            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="textPrice">Thông tin đơn hàng</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @if ($cart)
                            @foreach ($cart as $item)
                                @php
                                    $subTotal = $item['price'] * $item['quantity'];
                                    $totalPrice += $subTotal;
                                    $countcart += $item['quantity'];
                                @endphp
                                <li class="list-group-item d-flex justify-content-between align-items-center lh-condensed">
                                    <div>
                                        <h6 class="my-0">{{ $item['name'] }}</h6>
                                        <small class="text-muted">{{ number_format($item['price']) }} x {{ $item['quantity'] }}</small>
                                        <div class="d-flex align-items-center gap-3">
                                            <h6 class="m-0">Size:</h6>
                                            <p class="textPrice m-0">{{ $item['size'] }}</p>
                                        </div>
                                    </div>
                                    <span class="text-muted">
                                        <img src="{{ asset('img/sp/'.$item['image']) }}" width="80px" alt="">
                                    </span>
                                </li>
                            @endforeach
                        @endif
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong class="textPrice">Tổng thành tiền:</strong>
                            <strong class="textPrice">{{ number_format($totalPrice) }}đ</strong>
                        </li>
                    </ul>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Mã khuyến mãi">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">Xác nhận</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3 textPrice"><strong>Thông tin khách hàng</strong></h4>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label for="name">Họ tên (*)</label>
                            <input type="text" class="bg-input form-control" name="name_cus" id="name"
                                value="{{ old('name_cus', $user ? $user->username : '') }}" required>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="diachi_cus">Địa chỉ (*)</label>
                            <input type="text" class="bg-input form-control" name="diachi_cus" id="diachi_cus"
                                value="{{ old('diachi_cus', $user ? $user->address : '') }}" required>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="sdt_cus">Điện thoại (*)</label>
                            <input type="number" class="bg-input form-control" name="sdt_cus" id="sdt_cus"
                                value="{{ old('sdt_cus', $user ? $user->phone : '') }}" required>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="email_cus">Email</label>
                            <input type="email" class="bg-input form-control" name="email_cus" id="email_cus"
                                value="{{ old('email_cus', $user ? $user->email : '') }}">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="description">Ghi chú:</label>
                            <textarea class="forcus form-control" name="description" id="" cols="30" rows="5" >
                            </textarea>
                        </div>
                    </div>
                    <h4 class="mb-3">Hình thức thanh toán</h4>
                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="httt-1" name="payment_method" type="radio" class="custom-control-input" required=""
                                value="1" checked>
                            <label class="custom-control-label" for="httt-1">
                                <img src="/public/img/" alt="">
                                Tiền mặt
                            </label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="httt-2" name="payment_method" type="radio" class="custom-control-input" required=""
                                value="2">
                            <label class="custom-control-label" for="httt-2">Chuyển khoản</label>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <button class="btn text-bg-warning btn-lg btn-block" type="submit" name="btnDatHang">Đặt hàng</button>
                </div>
            </div>
        </form>
    </div>
    <!-- End block content -->
</main>
@endsection
