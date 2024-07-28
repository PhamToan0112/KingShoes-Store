<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-touch="true">
  <div class="carousel-indicators">
      @foreach ($View_banner as $index => $item)
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" @if($index == 0) class="active" aria-current="true" @endif aria-label="Slide {{ $index + 1 }}"></button>
      @endforeach
  </div>
  <div class="carousel-inner">
      @foreach ($View_banner as $index => $item)
          <div class="carousel-item @if($index == 0) active @endif">
              <img src="{{ asset('img/banner/'.$item->image) }}" class="d-block w-100" alt="Banner Image {{ $index + 1 }}">
          </div>
      @endforeach
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
  </button>
</div>

<section id="Service" class="pt-5 pb-4">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-4">
            <div class="box-icon">
              <div class="icon-header">
                  <span class="icon-box-icon icon-shipping">
                    <i class="fa-solid fa-wallet"></i>
                  </span>
                  <h3>CAM KẾT CHÍNH HÃNG</h3>
                  <p>100 % Authentic</p>
              </div>
              <div class="icon-content">
                  <p>Cam kết sản phẩm chính hãng từ Châu Âu, Châu Mỹ...</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-4">
            <div class="box-icon">
              <div class="icon-header">
                  <span class="icon-box-icon icon-shipping">
                    <i class="fa-solid fa-truck-fast"></i>
                  </span>
                  <h3>Giao hàng hỏa tốc</h3>
                  <p>Express delivery</p>
              </div>
              <div class="icon-content">
                  <p>SHIP hỏa tốc 1h nhận hàng trong nội thành HCM</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-4">
            <div class="box-icon">
              <div class="icon-header">
                  <span class="icon-box-icon icon-shipping">
                    <i class="fa-solid fa-headset"></i>
                  </span>
                  <h3>Hỗ  trợ 24/24</h3>
                  <p>Supporting 24/24</p>
              </div>
              <div class="icon-content">
                <p>Gọi ngay <a href="tel:0909300746"><strong>0909300746</strong></a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>