@extends('layout')
@section('title','Search')
@section('content')  
    @if ($products)
    <section class="pt-5 mb-5" >
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="titleSearch">
                    Kết quả tìm kiếm <b style="color:red; font-size:20px;">{{ count($products) }}</b> sản phẩm   
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <section class="search">
        <div class="container">
            <div class="row">
                @foreach ($products as $pd)
                    <div class="collums-me col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-5">
                        <div class="card">
                            <div class="icon-new">
                                <span>mới</span>
                            </div>
                            <img src="{{ asset('img/sp/'.$pd->image) }}" class="card-img-top">
                            <div class="card-content">
                                <a class="name" href="product_detail/{{ $pd->id }}" >
                                    <p>{{ $pd->name }}</p>
                                </a>
                                <div class="category">
                                    <strong>Danh mục: </strong><span>{{ $pd->category->name }}</span>
                                </div>
                                <div class="items-cart-price">
                                    @if($pd->price_sale)
                                        <del class="old-price">{{ number_format($pd->price) }} đ</del>
                                        <div class="info-price">
                                            <strong>{{ number_format($pd->price_sale) }} đ</strong>
                                        </div>
                                    @else
                                        <div class="info-price">
                                            <strong>{{ number_format($pd->price) }} đ</strong>
                                        </div>
                                    @endif
                                    <div class="add-cart" data-bs-toggle="modal" data-bs-target="#modal{{ $pd->id }}">
                                        <span>Thêm</span>
                                        <i class="fa-solid fa-circle-plus add-items"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="modal{{ $pd->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" style="max-width: 70%">
                            <div class="modal-content">
                                <div class="position-absolute close-modal">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <section id="Product-detail">
                                        <div class="container box-product-detail">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-6 row pt-3">
                                                    <div class="chitiet-info">
                                                        <div class="main">
                                                            <img class="img-feature img-fluid" src="img/sp/{{ $pd->image }}" id="anh">
                                                        </div>
                                                        <div class="list-image">
                                                            <div class="active_bd"> <img class="active-img img-fluid" src="img/sp/{{ $pd->image }}" alt=""></div>
                                                            <div> <img class="active-img img-fluid" src="img/sp/hinh2.jpeg" alt=""></div>
                                                            <div> <img class="active-img img-fluid" src="img/sp/hinh3.jpeg" alt=""></div>
                                                            <div> <img class="active-img img-fluid" src="img/sp/hinh4.jpg" alt=""></div>
                                                            <div> <img class="active-img img-fluid" src="img/sp/hinh5.jpeg" alt=""></div>
                                                            <div> <img class="active-img img-fluid" src="img/sp/hinh6.jpeg" alt=""></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 pt-3">
                                                    <div class="product__details__text">
                                                        <div class="product-tag">
                                                            @if ($pd->view > 50)
                                                                <div class="bestseller-tag">#Bán chạy</div>
                                                            @else
                                                                <div class="bestseller-tag">#Mua ngay</div>
                                                            @endif
                                                            <div class="sold-tag">Đã bán: 41</div>
                                                        </div>
                                                        <h1 class="text-uppercase">{{ $pd->name }}</h1>
                                                        <div class="info-product">
                                                            <div class="rate-sku">
                                                                <div class="rate">
                                                                    <i class="fas fa-star"></i><span class="ml-2">5/5</span>
                                                                </div>
                                                                <div class="sku">Mã: ABC_xJ</div>
                                                                <div class="status">
                                                                    @if ($pd->status == 'active')
                                                                        <span class="badge text-bg-success">Còn hàng</span>
                                                                    @elseif(($pd->status == 'inactive'))
                                                                        <span class="badge text-bg-danger">Hết hàng</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="info-product-price d-flex align-items-center gap-1">
                                                            <h3>Giá:</h3>
                                                            <div class="items-cart-price d-flex gap-3">
                                                                @if($pd->price_sale)
                                                                    <del class="old-price">{{ number_format($pd->price) }} đ</del>
                                                                    <div class="info-price">
                                                                        <strong>{{ number_format($pd->price_sale) }} đ</strong>
                                                                    </div>
                                                                @else
                                                                    <div class="info-price">
                                                                        <strong>{{ number_format($pd->price) }} đ</strong>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="info-product-size">
                                                            <h3>Kích cỡ:</h3>
                                                            <div class="item-size">
                                                                <button type="button" class="btn togtle check checked_cl">40</button>
                                                                <button type="button" class="btn togtle check">41</button>
                                                                <button type="button" class="btn togtle check">42</button>
                                                                <button type="button" class="btn togtle check">43</button>
                                                                <button type="button" class="btn togtle check">44</button>
                                                            </div>
                                                            <div data-bs-toggle="offcanvas" data-bs-target="#offcanvasCenter" aria-controls="offcanvasCenter">
                                                                <p class="huongdan">Hướng dẫn chọn size</p>
                                                            </div>
                                                            <div class="offcanvas form-huongdan offcanvas-center" tabindex="-1" id="offcanvasCenter" aria-labelledby="offcanvasCenterLabel">
                                                                <div class="offcanvas-header">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                                </div>
                                                                <div class="offcanvas-body">
                                                                    <div class="container">
                                                                        <div class="row pd-2">
                                                                            <img src="img/huongdan.png" alt="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="quantity">
                                                            <h3>Số lượng:</h3>
                                                            <div class="input-group">
                                                                <button class="btn btn-warning" type="button" id="decreaseBtn">-</button>
                                                                <input type="text" class="form-control focus" id="quantityInput" value="10">
                                                                <button class="btn btn-warning" type="button" id="increaseBtn">+</button>
                                                            </div>
                                                        </div>
                                                        <div class="gioithieusp">
                                                            <h3>Giới thiệu: </h3>
                                                            <p>{{ $pd->desciption }}</p>
                                                        </div>
                                                        <div class="list-group-btn">
                                                            <a href="giohang.html">
                                                                <button class="btn btn-dark">
                                                                    <i class="fa-solid fa-cart-plus"></i> Thêm giỏ hàng
                                                                </button>
                                                            </a>
                                                            <button class="btn bg-warning" onclick="return(alert('chưa có trang này thầy ơi'))">Mua Ngay</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-12 pt-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        {{ $products->links('vendor.pagination.custom') }} 
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <section id="Product-Lienquan" class="pt-5">
        <div class="container">
            <div class="content-Pd pt-4 pb-4">
                <h5><strong>Đề cử cho bạn</strong></h5>
            </div>
            <div class="swiper-container">
                <div class="row">
                    @foreach($related_products as $item)
                    <div class="collums-me col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-5">
                        <div class="card">
                            @if ($item->view >'50')
                                    <div class="icon-new bg-warning">
                                        <span>Hot</span>
                                    </div>
                                @elseif($item->created_at->diffInDays(now()) <= 30)
                                <div class="icon-new ">
                                    <span>mới</span>
                                </div>
                            @endif
                            <img src="{{ asset('img/sp/'.$item->image) }}" class="card-img-top" alt="...">
                            <div class="card-content">
                                <a class="name" href="{{ url('product_detail/'.$item->id) }}">
                                    <p>{{ $item->name }}</p>
                                </a>
                                <div class="caterory">
                                    <strong>Danh mục: </strong><span>{{ $item->category->name }}</span>
                                </div>
                                <div class="items-cart-price">
                                    @if($item->price_sale)
                                            <del class="old-price">{{ number_format($item->price) }} </del>
                                            <div class="info-price">
                                                <strong>{{ number_format($item->price_sale) }}</strong>
                                            </div>
                                        @else
                                            <div class="info-price">
                                                <strong>{{ number_format($item->price) }}</strong>
                                            </div>
                                    @endif
                                    <div class="add-cart">
                                        <span>Thêm</span>
                                        <i class="fa-solid fa-circle-plus add-items"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </section>
@endsection