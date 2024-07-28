<header class="header navigation--sticky" style="margin-top: 0px">
        <div class="header__top">
            <div class="container-fluid mb-0" style="display: flex;flex-direction: row-reverse">
              <div style="display:inline;">
                  <p class="user-check d-inline">
                    <a href="king-and-queen">👑 King and Queen</a>
                  </p>
                  <p class="user-check d-inline">
                    @if (Auth::check())
                        <a href="{{ route('home') }}">
                            <i class="fa fa-users" aria-hidden="true"></i> {{ Auth::user()->username }}
                        </a>
                            <a href="{{ route('logout') }}">
                              <i class="fa fa-users" aria-hidden="true"></i> LogOut
                          </a>
                    @else
                        <a href="{{ route('login') }}">
                            <i class="fa fa-users" aria-hidden="true"></i> My Account
                        </a>
                    @endif
                  </p>                
                  <p class="hotline-top d-inline">
                    <i class="fas fa-phone-alt"></i>
                    <span class="d-none d-lg-inline-block">Hotline:</span>
                    <a href="tel:0909300746">0909300746</a>
                  </p>
              </div>
            </div>
          </div>
          <nav class=" scroll-window navigation navbar navbar-expand-xl shadow-sm ">
            <div class="container-fluid">
                <div class="col-lg-2 navigation__column left ">
                  <div class="header__logo">
                      <a class="ps-logo" href="/">
                          <img src="{{ asset('img/Logo_web.png') }}" alt="Cửa Hàng Giày Sneaker Chính Hãng Tại TpHcm - KING SHOES">
                      </a>
                  </div>
                </div>
                <div class="input-group form-search d-none">
                  <input type="text" class="form-control" placeholder="Tìm kiếm..." aria-label="Dollar amount (with dot and two decimal places)">
                  <span class="input-group-text">
                    <i class="fa-solid fa-magnifying-glass"></i>
                  </span>
                </div>
                <div class="col-lg-8 navigation__column d-xl-block offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                  <div class="offcanvas-header shadow-lg">
                    <h5 class="offcanvas-title" id="offcanvasRightLabel">Danh mục</h5>
                    <button type="button" class="cart-items" data-bs-dismiss="offcanvas" aria-label="Close">
                      <i class="fa-solid fa-xmark"></i>
                    </button>
                  </div>
                  <div class="collslapse navbar-collapse offcanvas-body" id="navbarNavDropdown">
                    <ul class="menu navbar-nav justify-content-center " >
                      <div class="input-group form-search-mobile d-none">
                        <input type="text" class="form-control" placeholder="Tìm kiếm..." aria-label="Dollar amount (with dot and two decimal places)">
                        <span class="input-group-text">
                          <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                      </div>
                      @foreach ($categories as $item)
                        <li class="nav-item ">
                          <a class="nav-link" href="{{ route('category.name_url',$item->name_cate_Url)}}" id="">{{ $item->name }}</a>
                          <!-- <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                          </ul> -->
                        </li>
                      @endforeach
                      <li class="nav-item"><a class="nav-link" href="/contact">Liên hệ</a></li>
                      <li class="nav-item">
                        <a class="nav-link" href="/about">Giới thiệu</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-2 navigation__column right d-flex align-items-center justify-content-flex-end">
                    <div class="items d-flex align-items-center ">
                        <a href="{{ route('viewcart') }}">
                          <div class="cart-items cart-count">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span>0</span>
                          </div>
                        </a>                        
                        <a href="/view-heart">
                        <div class="cart-items">
                            <i class="fa-regular fa-heart"></i>
                            <span>1</span>
                        </div>
                        </a>
                    </div>
                    <div class="menulist d-none">
                        <i class="fa-solid fa-bars" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"></i>
                    </div>
                </div>
            </div>
          </nav>
    </header>
