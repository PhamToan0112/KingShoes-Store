@extends('layout')
@section('title','Cập nhật mật khẩu')
@section('content')
  <section id="form-user" class="py-3">
    <div class="container ">
      <div class="row justify-content-center">
        <form class="form_container" method="POST" action="{{ route('handle_update_password') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <img class="logo_container" src="{{ asset('img/login.jpg') }}" alt="">
            <div class="title_container">
              <p class="title">Cập nhật mật khẩu</p>
              <span class="subtitle">
                Vui lòng đăng ký mật khẩu , Chúng tôi sẽ chuyển hướng bạn đến trang  <span class="badge text-bg-danger">Đăng nhập</span>
              </span>
            </div>
            <br>
            <div class="input_container">
              <label class="input_label" for="password">Nhập mật khẩu</label>
              <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-unlock"></i></span>
                <input type="password" class="form-control focus" name="password" placeholder="password" aria-label="password" aria-describedby="addon-wrapping">
              </div>
            </div>
            <div class="input_container">
              <label class="input_label" for="password_confirmation">Xác nhận mật khẩu</label>
              <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-unlock"></i></span>
                <input type="password" class="form-control focus" name="password_confirmation" placeholder="confilrm password" aria-label="password" aria-describedby="addon-wrapping">
              </div>
            </div>
            <div class="input_container">
              <a href="{{ route('register') }}" class="btn-dk col-lg-6">Đăng ký thành viên?</a>
            </div>
            <button type="submit" class="sign-in_btn gg">
              <span class="m-4">Đăng nhập ngay</span><i class="fa-regular fa-paper-plane"></i>
            </button>
          </form>
      </div>
    </div>
  </section>
 
@endsection