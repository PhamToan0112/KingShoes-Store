@extends('layout')
@section('title', 'Giỏ hàng')
@section('content')

    {{-- @if (Session::has('cart'))
        {{ var_dump(Session::get('cart')) }}
        {{ count(Session::get('cart')) }}
    @endif --}}
    <section id="cart">
        <div class="container pt-30 pb-30">
            <div class="row ">
                @if (Session::has('cart') && count(Session::get('cart')) != 0)
                    <div class="cartPage">
                        <div class="title_cart-header">
                            <h1>Giỏ hàng</h1>
                        </div>
                        @if (Session::has('cart') && count(Session::get('cart')) != 0)
                            @php
                                $totalPrice = 0;
                                $cart = Session::get('cart');
                            @endphp
                            @foreach ($cart as $item)
                                @php
                                    $subtotal = $item['quantity'] * $item['price'];
                                    $totalPrice += $subtotal;
                                @endphp
                                <div class="box_cart_items row">
                                    <div class="cart__img__left col-lg-4">
                                        <a href=""><img src="{{ asset('img/sp/' . $item['image']) }}" alt=""></a>
                                    </div>
                                    <div class="box_cart_number-price col-lg-8">
                                        <div class="cart__title">
                                            <h3>{{ $item['name'] }}</h3>
                                        </div>
                                        <div class="cart_size">
                                            <span class="badge bg-warning me-2">Size Giày: <b>{{ $item['size'] }}</b></span>
                                        </div>
                                        <p class="cart_items_p">
                                            <b>Mã SP:</b> ABC_XYZ<br>
                                        </p>
                                        <div class="number_Price">
                                            <div class="quantity">
                                                <div class="input-group ">
                                                    <button class="btn btn-warning" type="button"
                                                        id="decreaseBtn">-</button>
                                                    <input type="text" class="form-control focus quantity-input" id="quantityInput"
                                                        value="{{ $item['quantity'] }}">
                                                    <button class="btn btn-warning" type="button"
                                                        id="increaseBtn">+</button>
                                                </div>
                                            </div>
                                            <i class="fa fa-times"></i>
                                            <span class="textPrice">{{ number_format($item['price']) }}đ</span>
                                        </div>
                                        <p class="cart_items_p mt-2">
                                            <b>Thành tiền: </b>
                                            <b class="textPrice">
                                                {{ number_format($subtotal) }}đ
                                            </b>
                                            <br>
                                        </p>
                                    </div>
                                    <div class="delete_cart_item">
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id_size"
                                                value="{{ $item['id'] . '_' . $item['size'] }}">
                                            <button type="submit" class="btnClick btn">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                            <div class="SumItem_cart">
                                <div class="row">
                                    <div class="col-auto col-lg-12">
                                        <p class="cart_items_total_price">
                                            <span class="total_cart_items">
                                                Tổng tiền:
                                            </span>
                                            <span class="textPrice">{{ number_format($totalPrice) }}đ</span>
                                        </p>
                                    </div>
                                    <div class="col-auto col-12 d-flex justify-content-end">
                                        <div class="list-group-btn d-flex gap-3">
                                            <form action="{{ route('viewproduct') }}" method="get">
                                                @csrf
                                                <button class="btn btn-dark">
                                                    <i class="fa-solid fa-cart-plus"></i>Tiếp tục mua hàng
                                                </button>
                                            </form>
                                            <form action="{{ route('view.bill') }}" method="get">
                                                @csrf
                                                <button class="btn btn-warning"
                                                onclick="return(alert('Tiến hành đặt hàng'))">
                                                Đặt Hàng
                                                </button>
                                            </form>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="cartNull">
                        <div class="null_cart text-center">
                            <h1 class="coll-title cart-title text-uppercase">Giỏ hàng</h1>

                            <p class="text-null">Không có sản phẩm nào trong giỏ hàng</p>
                            <a href="{{ route('home') }}" class="back-home">
                              <b> Về trang chủ</b>
                            </a>
                            <div class="callship text-center">
                                Khi cần trợ giúp vui lòng gọi <a class="callNow textPrice"
                                    href="tel:0379993712">0379993712</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    
@endsection
