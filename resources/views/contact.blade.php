@extends('layout')
@section('title','Trang Liên Hệ')
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
              Liên hệ
              </a>
          </li>
        </ol>
      </nav>
    </div>
</section>
<section id="about" class="mt-3 mb-3">
    <div class="container">
        <div class="row">
            <div class="select_maps col-md-4 col-sm-12 col-xs-12">
                <div class="aa mid_fot_h contact_r">
                    <ul class="contact padding-0">
                        <li class="li_footer_h">
                            <span class="txt_content_child">
                                <i class="fas fa-map-marker-alt"></i>
                                <span class="add">
                                    Công Viên Phần Mềm Quang Trung Tân Chánh Hiệp, Quận 12, Thành phố Hồ Chí Minh                                  
                                </span>
                            </span>
                        </li>
                        <li class="li_footer_h">
                            <i class="fas fa-mobile-alt"></i>
                            <a href="tel:0379 993 712">0379 993 712</a>                                    
                        </li>
                        <li class="li_footer_h">
                            <i class="far fa-envelope"></i>
                            <a href="mailto:thetoan.011204@gmail.com"> thetoan.011204@gmail.com</a>                                    
                        </li>
                    </ul>
                </div>

                <div class="page-login page_cotact">
                    <h1 class="title-head-contact a-left"><span>Liên hệ với chúng tôi</span></h1>
                    <div id="pagelogin" class="margin-top-0">
                        <form method="post" action="/postcontact" id="contact" accept-charset="UTF-8">
                            <div class="form-signup clearfix">
                                <div class="row group_contact">
                                    <div class="form-group mb-0 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input placeholder="Họ và tên" type="text" class="form-control  form-control-lg" required="" value="" name="contact[Name]">
                                    </div>
                                    <div class="form-group mb-0 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input placeholder="Email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="" id="email1" class="form-control form-control-lg" value="" name="contact[email]">
                                    </div>
                                    <div class="form-group mb-0 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <textarea placeholder="Nội dung" name="contact[body]" id="comment" class="form-control content-area form-control-lg" rows="5" required=""></textarea>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-group-btn">
                                        <button type="submit" class="btn btn-dark btn-comment button_gradient">Gửi liên hệ</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="select_maps col-md-8 col-sm-12 col-xs-12">
                <div class="section_mapss margin-bottom-50">
                    <div class="box-maps">
                        <div class="iFrameMap">
                            <div class="google-map">
                                <div id="contact_map" class="map">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.443661489921!2d106.62525347480609!3d10.853821089299668!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752bee0b0ef9e5%3A0x5b4da59e47aa97a8!2zQ8O0bmcgVmnDqm4gUGjhuqduIE3hu4FtIFF1YW5nIFRydW5n!5e0!3m2!1svi!2s!4v1715529286714!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>
<section id="subscribe">
    <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 ">
        <h3><i class="fa fa-envelope"></i>Đăng ký NHẬN CODE </h3>
      </div>
      <div class="col-lg-5 col-md-7 col-sm-6 col-xs-12 ">
        <form class="ps-subscribe__form" method="post" name="form-enewsletter" id="form-enewsletter" action="">
          <input type="email" class="form-control" name="femail-enewsletter" id="femail-enewsletter" placeholder="Địa chỉ mail của bạn" required="" onclick="enterCheckEmail('#femail-enewsletter');">
          <button type="submit">Đăng ký</button>
        </form>
      </div>
      <div class="col-lg-4 col-md-2 col-sm-12 col-xs-12 ">
        <p>...Nhận Ngay  <span> VOUCHER 100k </span> từ chúng tôi.</p>
      </div> 
  </div>
    </div>
  </section>
@endsection