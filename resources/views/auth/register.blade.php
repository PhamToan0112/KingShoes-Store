@extends('layout')
@section('title','Đăng ký')
@section('content')
@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</div>
@endif
<section id="form-user" class="py-3">
    <div class="container ">
      <div class="row justify-content-center">
        <form class="form_container" action="{{ route('register') }}" method="POST">
          @csrf
            <img class="logo_container" src="{{ asset('img/register.jpg') }}" alt="">
            <div class="title_container">
              <p class="title">Đăng Ký Thành Viên</p>
              <span class="subtitle">
                Đăng Ký ngay , trở thành thành viên của Shop với những <span class="badge text-bg-warning text-light">Voucher</span> Hấp dẫn
              </span>
            </div>
            <br>
            <div class="input_container">
                {{-- <div class="row">
                    <div class="col-md-6">
                        <label class="input_label" for="email_field">First Name</label>
                        <input type="text" class="form-control focus" id="validationDefault01" placeholder=".."  required>
                      </div>
                      <div class="col-md-6">
                        <label class="input_label" for="email_field">Last Name</label>
                        <input type="text" class="form-control focus" id="validationDefault02" required placeholder=".." >
                      </div>
                </div> --}}
                <label class="input_label" for="username">Username</label>
              <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-user"></i></span>
                <input type="text" class="form-control focus" name="username" placeholder="Enter username" aria-label="username" aria-describedby="addon-wrapping">
              </div>
            </div>
            <div class="input_container">
              <label class="input_label" for="email_field">Email</label>
              <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">@</span>
                <input type="text" class="form-control focus" name="email" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping">
              </div>
            </div>
            <div class="input_container">
              <label class="input_label" for="password_field">Password</label>
              <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-unlock"></i></span>
                <input type="password" class="form-control focus" name="password" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping">
              </div>
            </div>
            <div class="input_container">
              <label class="input_label" for="password_field">Confirm Password</label>
              <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-unlock"></i></span>
                <input class="form-control focus" type="password" name="password_confirmation" id="password_confirmation" placeholder="Xác nhận mật khẩu" required>
              </div>
            </div>
            <div class="input_container">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                  <label class="form-check-label" for="flexCheckChecked">
                      Đồng ý với các điều khoản và điều kiện
                  </label>
                </div>
            </div>
            <button type="submit" class="sign-in_btn">
              <span>Đăng Ký</span>
            </button>
            <div class="separator">
              <hr class="line">
              <span>Bạn đã có tài khoản</span>
              <hr class="line">
            </div>
            <a href="{{ route('login') }}" class=" btn sign-in_btn gg ">
              <div class="get_url_dangnhap">
                <img src="img/google.webp" alt="">
                <span>Đăng nhập ngay</span>
              </div>
            </a>
          </form>
      </div>
    </div>
  </section>
    
@endsection