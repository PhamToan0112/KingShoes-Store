@extends('layout')
@section('title','Xác nhận email')
@section('content')
  @if($errors->any())
    <div class="alert alert-danger">
      @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
   </div>
  @endif
  @if(session('message'))
  <div class="alert alert-success">
      {{ session('message') }}
  </div>
  @endif
  <section id="form-user" class="py-3">
    <div class="container ">
      <div class="row justify-content-center">
        <form class="form_container" action="{{ route('reset_password') }}" method="POST">
          @csrf
            <img class="logo_container" src="{{ asset('img/login.jpg') }}" alt="">
            <div class="title_container">
              <p class="title">Quên mật khẩu</p>
              <span class="subtitle">
                Vui lòng nhập vào địa chỉ gmail cũ , Chúng tôi sẽ gửi hướng dẫn cho bạn tạo lại <span class="badge text-bg-danger">mật khẩu</span> để đăng nhập
              </span>
            </div>
            <br>
            <div class="input_container">
              <label class="input_label" for="email_field">Địa chỉ Email</label>
              <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">@</span>
                <input type="text" class="form-control focus" name="email" placeholder="Gmail" aria-label="Gmail" aria-describedby="addon-wrapping">
              </div>
            </div>
            <div class="input_container">
              <a href="{{ route('register') }}" class="btn-dk col-lg-6">Đăng ký thành viên?</a>
            </div>
            <button type="submit" class="sign-in_btn gg">
              <span class="m-4">Gửi mail</span><i class="fa-regular fa-paper-plane"></i>
            </button>
            
          </form>
      </div>
    </div>
  </section>
 
@endsection