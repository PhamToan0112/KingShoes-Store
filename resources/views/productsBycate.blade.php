@foreach ($products_byCate as $pd)
    <div class="collums-me col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-5">
        <div class="card">
            @if ($pd->view > 80)
                <div class="icon-new">
                    <span>Hot</span>
                </div>
            @elseif ($pd->updated_at->diffInDays(now()) <= 60)
                <div class="icon-new bg-warning">
                    <span>Mới</span>
                </div>
            @elseif ($pd->category->name == 'Sale')
                <div class="icon-new">
                    <span>Sale Off</span>
                </div>
            @endif
            <img src="{{ asset('img/sp/' . $pd->image) }}" class="card-img-top">
            <div class="card-content">
                <a href="{{ route('product.product_detail', $pd->slug) }}" class="name">
                    <p>{{ $pd->name }}</p>
                </a>
                <div class="category">
                    <strong>Danh mục: </strong><span>{{ $pd->category->name }}</span>
                </div>
                <div class="items-cart-price">
                    <div id="price">
                        @if ($pd->category->name == 'Sale' && $pd->price_sale)
                            <del class="old-price">{{ number_format($pd->price) }}</del>
                            <div class="info-price textPrice">{{ number_format($pd->price_sale) }}</div>
                        @elseif ($pd->price_sale)
                            <strong>{{ number_format($pd->price_sale) }}</strong>
                        @else
                            <div class="info-price">
                                <strong>{{ number_format($pd->price) }}</strong>
                            </div>
                        @endif
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
                                            <img class="img-feature img-fluid" src="{{ asset('img/sp/' . $pd->image) }}" id="anh">
                                        </div>
                                        <div class="list-image">
                                            <div class="active_bd">
                                                <img class="active-img img-fluid" src="{{ asset('img/sp/' . $pd->image) }}" alt="">
                                            </div>
                                            <div>
                                                <img class="active-img img-fluid" src="{{ asset('img/sp/hinh2.jpeg') }}" alt="">
                                            </div>
                                            <div>
                                                <img class="active-img img-fluid" src="{{ asset('img/sp/hinh3.jpeg') }}" alt="">
                                            </div>
                                            <div>
                                                <img class="active-img img-fluid" src="{{ asset('img/sp/hinh4.jpeg') }}" alt="">
                                            </div>
                                            <div>
                                                <img class="active-img img-fluid" src="{{ asset('img/sp/hinh5.jpeg') }}" alt="">
                                            </div>
                                            <div>
                                                <img class="active-img img-fluid" src="{{ asset('img/sp/hinh6.jpeg') }}" alt="">
                                            </div>
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
                                                    @elseif($pd->status == 'inactive')
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
                                                    <div class="textPrice">
                                                        {{ number_format($pd->price_sale) }} đ
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
                                                @if (count($pd->productSizes) > 0)
                                                    @foreach($pd->productSizes as $item)
                                                        <button type="button" class="btn togtle default-size" data-size="{{ $item->size }}">{{ $item->size }}</button>
                                                    @endforeach
                                                @else
                                                    <button type="button" class="btn togtle default-size" data-size="M">M</button>
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
                                            <p>{{ $pd->description }}</p>
                                        </div>
                                        <div class="list-group-btn d-flex gap-3">
                                            <button class="btn btn-dark add-to-cart" data-product-id="{{ $pd->id }}">
                                                <i class="fa-solid fa-cart-plus"></i> Thêm giỏ hàng
                                            </button>
                                            <form action="{{ route('buyNow', $pd->id) }}" method="get" class="buy-now-form">
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
