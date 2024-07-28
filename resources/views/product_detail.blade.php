@extends('layout')
@section('title', 'Chi tiết sản phẩm')
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
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="/product">
                            SẢN PHẨM
                        </a>
                    </li>
                    <li class="breadcrumb-item " aria-current="page">
                        <a href="{{ route('category.name_url', $product_detail->category->name) }}">
                            {{ $product_detail->category->name }}
                        </a>
                    </li>
                    <li class="breadcrumb-item IN" aria-current="page">
                        <a href="/product_detail/{{ $product_detail->slug }}">
                            {{ $product_detail->name }}
                        </a>
                    </li>
                </ol>
            </nav>
        </div>
    </section>
    <section id="Product-detail">
        <div class="container box-product-detail">
            <div class="row justify-content-center">
                <div class="col-lg-6 row pt-3">
                    <div class="chitiet-info">
                        <div class="main">
                            <img class="img-feature img-fluid" src="{{ asset('img/sp/' . $product_detail->image) }}"
                                id="anh">
                        </div>
                        <div class="list-image">
                            <div class="active_bd"> <img class="active-img img-fluid"
                                    src="{{ asset('img/sp/' . $product_detail->image) }}" alt=""></div>
                            @foreach (json_decode($product_detail->additional_images) as $item)
                                <div> <img class="active-img img-fluid" src="{{ asset('img/sp/' . $item) }}" alt="">
                                </div>
                            @endforeach
                            <div> <img class="active-img img-fluid" src="{{ asset('img/sp/hinh3.jpeg') }}" alt="">
                            </div>
                            <div> <img class="active-img img-fluid" src="{{ asset('img/sp/hinh4.jpeg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 pt-3">
                    <div class="product__details__text">
                        <div class="product-tag">
                            <div class="bestseller-tag">#Bán chạy</div>
                            <div class="sold-tag">Đã bán: 41</div>
                        </div>
                        <h1 class="text-uppercase">
                            {{ $product_detail->name }}
                        </h1>
                        <div class="info-product">
                            <div class="rate-sku">
                                <div class="rate">
                                    <i class="fas fa-star"></i><span class="ml-2">5/5</span>
                                </div>
                                <div class="sku">
                                    Mã: ABC_xJ
                                </div>
                                <div class="status">
                                    @if ($product_detail->status == 'active')
                                        <span class="badge text-bg-success">
                                            Còn hàng
                                        </span>
                                    @else
                                        <span class="badge text-bg-danger">
                                            Hết hàng
                                        </span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="info-product-price">
                            <h3 class="d-flex gap-3">Giá:
                                @if ($product_detail->price_sale)
                                    <del class="old-price">{{ number_format($product_detail->price) }} đ</del>
                                    <div class="info-price">
                                        <strong class="textPrice">{{ number_format($product_detail->price_sale) }} đ</strong>
                                    </div>
                                @else
                                    <div class="info-price">
                                        <strong class="textPrice">{{ number_format($product_detail->price) }} đ</strong>
                                    </div>
                                @endif
                            </h3>
                        </div>
                        <div class="info-product-size">
                            <h3>Kích cỡ:</h3>
                            <div class="item-size">
                                @if (count($product_detail->productSizes) > 0)
                                    @foreach ($product_detail->productSizes as $item)
                                        <button type="button" class="btn togtle default-size" id="buyNowSize"
                                            data-size="{{ $item->size }}">{{ $item->size }}</button>
                                    @endforeach
                                @else
                                    <button type="button" class="btn togtle default-size" data-size="39">39</button>
                                @endif
                            </div>
                            <div data-bs-toggle="offcanvas" data-bs-target="#offcanvasCenter"
                                aria-controls="offcanvasCenter">
                                <p class="huongdan">Hướng dẫn chọn size</p>
                            </div>

                            <div class="offcanvas form-huongdan offcanvas-center" tabindex="-1" id="offcanvasCenter"
                                aria-labelledby="offcanvasCenterLabel">
                                <div class="offcanvas-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <div class="container">
                                        <div class="row pd-2 ">
                                            <img src="{{ asset('img/huongdan.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="quantity">
                            <h3>Số lượng:</h3>
                            <div class="input-group ">
                              <input type="number" class="form-control focus" name="quantity" id="quantityInput" value="1" min="1" max="10" required>
                                {{-- <button class="btn btn-warning" type="button" id="decreaseBtn">-</button>
                                <input type="number" class="form-control focus" name="quantity" id="quantityInput" value="1" min="1" max="10">
                                <button class="btn btn-warning" type="button" id="increaseBtn">+</button> --}}
                            </div>
                        </div>
                        <div class="gioithieusp">
                            <h3>Giới thiệu: </h3>
                            <p>
                                {{ $product_detail->desciption }}
                            </p>
                        </div>
                        <div class="list-group-btn d-flex gap-3">
                            <button class="btn btn-dark add-to-cart" data-product-id={{ $product_detail->id }}><i
                                    class="fa-solid fa-cart-plus">
                                </i>Thêm giỏ hàng
                            </button>
                            <form id="buyNowForm" action="{{ route('buyNow', ['id' => $product_detail->id]) }}" method="get">
                              @csrf
                              <input type="hidden" name="size" id="hiddenSize" value="">
                              <input type="hidden" name="quantity" id="hiddenQuantity" value="">
                              <button class="btn btn-danger buynow">Mua Ngay</button>
                          </form>                          
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 pt-3">
                    <div class="product-info-comment">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link " id="nav-home-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                    aria-selected="true">Mô Tả</button>
                                <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-profile" type="button" role="tab"
                                    aria-controls="nav-profile" aria-selected="false">Bình luận</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade " id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab" tabindex="0">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6 pt-4">
                                            <div class="product-box">
                                                <h4 class="product-title">{{ $product_detail->name }}</h4>
                                                <img class="product-image"
                                                    src="{{ asset('img/sp/' . $product_detail->image) }}" height="auto"
                                                    width="200px" alt="{{ $product_detail->name }}">
                                                <p class="product-description">{{ $product_detail->name }} là một phiên
                                                    bản của dòng giày Yeezy Boost, nổi tiếng được thiết kế bởi Kanye West.
                                                    Đặc điểm nổi bật của dòng này là sự kết hợp của các màu xám và trắng
                                                    trên phần upper cùng với các chi tiết phản quang. Sản phẩm này sử dụng
                                                    công nghệ Boost để mang lại cảm giác thoải mái tối đa và có đế cao su
                                                    đặc biệt cho độ bám tốt trên mọi bề mặt. Yeezy Boost 700 V2 Static được
                                                    yêu thích với thiết kế sạch sẽ và tối giản.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="nav-profile" role="tabpanel"
                                aria-labelledby="nav-profile-tab" tabindex="0">
                                <div class="container">
                                    <div class="comment-form">
                                        <div class="date-creat-comment row">
                                            <div class="d-flex gap-4 p-3 text-bg-dark">
                                                <span>ADMIN</span>
                                                <span>12:05 PM</span>
                                                <span>16/7/2024</span>
                                            </div>
                                            <div class="img-comt">
                                                <form >
                                                    @csrf
                                                    <input type="hidden" name="comment_product_id" class="comment_product_id"  value="{{ $product_detail->id }}">
                                                    <div id="comment_show"></div>

                                                    {{-- @if (count($check_comment)>5) --}}
                                                    <button type="button" id="load_more_button" class="btn btn-primary">Tải thêm</button> 
                                                    {{-- @endif --}}
                                                </form>
                                            </div>
                                        </div>
                                        <form class="comment-content">
                                            @csrf
                                            <input type="hidden" class="comment_product_id" value="{{ $product_detail->id }}">
                                            <div class="comt-content">
                                                <div class="m">
                                                    <h3 class="p-2">Đánh giá:</h3>
                                                <div class="d-flex gap-3">
                                                    <div class="form-group col-lg-3">
                                                        <label for="">Tên của bạn <span class="text-danger">*</span></label>
                                                        <input name="comment_name" class="comment_name input-group" type="text" placeholder="Nhập họ tên" required>
                                                    </div>
                                                    <div class="form-group col-lg-3">
                                                        <label for="">Email</label>
                                                        <input class="input-group" type="email" placeholder="Nhập địa chỉ email">
                                                    </div>
                                                </div>
                                                <div class="noidung">
                                                    <label for="content">Nhập nội dung <span class="text-danger">*</span></label><br>
                                                    <textarea id="content" name="comment_content" class="comment_content" maxlength="200" rows="3" cols="80"></textarea>
                                                </div>
                                                <button type="button"  id="liveToastBtn" class="send_comment btn btn-group btn-warning mt-2 mb-3">Gửi đánh giá</button>
                                                
                                            </div>
                                        </form>                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="toast-container position-fixed bottom-0 right-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
            <img src="{{ asset('img/icon-succsess.jpg') }}" width="10%" class="rounded me-2" alt="...">
            <strong class="me-auto">Thông báo</strong>
            <small> 5 mins ago </small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body bg-warning">
            <span>Thành công, Cảm ơn bạn đã quan tâm </span>
          </div>
        </div>
      </div>
    </div>    
    <section id="Product-Lienquan" class="pt-5">
        <div class="container">
            <div class="content-Pd pt-4 pb-4">
                <h5><strong>Sản Phẩm Liên Quan</strong></h5>
            </div>
            <div class="swiper-container">
                <div class="row">
                    @foreach ($related_products as $pd)
                        <div class="collums-me col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-5">
                            <div class="card">
                                @if ($pd->view > '50')
                                    <div class="icon-new bg-warning">
                                        <span>Hot</span>
                                    </div>
                                @elseif($pd->created_at->diffInDays(now()) <= 30)
                                    <div class="icon-new ">
                                        <span>mới</span>
                                    </div>
                                @endif
                                <img src="{{ asset('img/sp/' . $pd->image) }}" class="card-img-top" alt="...">
                                <div class="card-content">
                                    <a class="name" href="{{ route('product.product_detail',$pd->slug) }}">
                                        <p>{{ $pd->name }}</p>
                                    </a>
                                    <div class="caterory">
                                        <strong>Danh mục: </strong><span>{{ $pd->category->name }}</span>
                                    </div>
                                    <div class="items-cart-price">
                                        <div class="info-price">
                                            <strong>Giá:</strong>
                                            <strong class="add-items">{{ number_format($pd->price) }} đ</strong>
                                        </div>
                                        <div class="add-cart" data-bs-toggle="modal" data-bs-target="#modal{{ $pd->id }}">
                                            <span>Thêm</span>
                                            <i class="fa-solid fa-circle-plus add-items"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                    <div class="modal fade" id="modal{{ $pd->id }}" data-id="{{ $pd->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
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
                                                            <img class="img-feature img-fluid" src="{{ asset('img/sp/'.$pd->image)}}" id="anh">
                                                        </div>
                                                        <div class="list-image">
                                                            <div class="active_bd"> <img class="active-img img-fluid" src="{{ asset('img/sp/'.$pd->image)}}" alt=""></div>
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
                                                            <div class="bestseller-tag">{{ $pd->view > 50 ? '#Bán chạy' : '#Mua ngay' }}</div>
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
                                                                        <strong class="textPrice">{{ number_format($pd->price_sale) }} đ</strong>
                                                                    </div>
                                                                @else
                                                                    <div class="info-price">
                                                                        <strong class="textPrice">{{ number_format($pd->price) }} đ</strong>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="info-product-size">
                                                            <h3>Kích cỡ:</h3>
                                                            <div class="item-size">
                                                                @if (count($pd->productSizes)>0)
                                                                @foreach($pd->productSizes as $item)
                                                                    <button type="button" class="btn togtle default-size" data-size=" {{ $item->size }}">{{ $item->size }}</button>
                                                                @endforeach
                                                                @else
                                                                <button type="button" class="btn togtle default-size" data-size="39">39</button>
                                                                @endif
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
                                                                            <img src="{{ asset('img/huongdan.png') }}" alt="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="quantity">
                                                            <h3>Số lượng:</h3>
                                                            <div class="input-group">
                                                                <input type="number" class="form-control focus" name="quantity" id="quantityInput" value="1" min="1" max="10" required>
                                                            </div>
                                                        </div>
                                                        <div class="gioithieusp">
                                                            <h3>Giới thiệu: </h3>
                                                            <p>{{ $pd->desciption }}</p>
                                                        </div>
                                                        <div class="list-group-btn d-flex gap-3">
                                                            <button class="btn btn-dark add-to-cart" data-product-id="{{ $pd->id }}">
                                                                <i class="fa-solid fa-cart-plus"></i> Thêm giỏ hàng
                                                            </button>
                                                            <form action="{{ route('buyNow',$pd->id) }}" method="get" class="buy-now-form">
                                                                @csrf
                                                                <input type="hidden" name="size" class="size-input">
                                                                <input type="hidden" name="quantity" class="quantity-input">
                                                                <button class="btn bg-warning">Mua Ngay</button>
                                                            </form>
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
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
      $(document).ready(function() {
    // Khi chọn kích cỡ
    $('.item-size .btn').click(function() {
        $('.item-size .btn').removeClass('checked_cl');
        $(this).addClass('checked_cl');

        var selectedSize = $(this).data('size').trim();
        console.log('Size đã chọn:', selectedSize);
        
        // Cập nhật giá trị kích thước đã chọn vào input ẩn
        $('#hiddenSize').val(selectedSize);
    });

    // Khi thay đổi số lượng
    $('#quantityInput').on('input', function() {
        var quantity = $(this).val();
        
        // Cập nhật giá trị số lượng vào input ẩn
        $('#hiddenQuantity').val(quantity);
    });

    // Khi bấm nút "Mua Ngay"
    $('.buynow').click(function(e) {
        var size = $('#hiddenSize').val();
        var quantity = $('#hiddenQuantity').val();

        if (!size) {
            alert('Vui lòng chọn kích thước.');
            e.preventDefault();
            return;
        }

        if (!quantity) {
            alert('Vui lòng nhập số lượng.');
            e.preventDefault();
            return;
        }

        // Gửi form với các giá trị đã được cập nhật
        $('#buyNowForm').submit();
    });
});

    </script>

    <script>
        $(document).ready(function() {
            // Khi chọn kích cỡ
            $('.item-size .btn').click(function() {
                $('.item-size .btn').removeClass('checked_cl');
                $(this).addClass('checked_cl');

                var selectedSize = $(this).data('size').trim();
                // var selectedSize = $('#buyNowForm input[name="size"]').val();
                // Cập nhật kích thước đã chọn vào nút "Thêm giỏ hàng"
                console.log('Size đã chọn:', selectedSize);
                $(this).closest('.modal').find('.add-to-cart').data('size', selectedSize);
            });

            // Khi bấm nút "Thêm giỏ hàng"
            $('.add-to-cart').click(function(e) {
                e.preventDefault();

                var id = $(this).data('product-id');
                var size = $('.item-size .btn.checked_cl').data('size');
                var quantity = $('#quantityInput').val();
                var name = $('.product__details__text h1').text().trim();
                var image = $('.img-feature').attr('src');
                var price = $('.info-price strong').text().replace(/\D/g, '');
                if (!size) {
                    alert('Vui lòng chọn kích thước.');
                    return;
                }

                console.log({
                    id,
                    size,
                    quantity,
                    name,
                    image,
                    price
                });

                // Gửi yêu cầu AJAX tới máy chủ
                $.ajax({
                    type: 'POST',
                    url: '/add-to-cart',
                    data: {
                        id: id,
                        size: size,
                        name: name,
                        image: image,
                        price: price,
                        quantity: quantity,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Sản phẩm đã được thêm vào giỏ hàng thành công!');
                            // Cập nhật số lượng giỏ hàng hiển thị
                            $('.cart-count span').text(response.totalQuantity);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

@endsection
