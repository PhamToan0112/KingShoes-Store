@extends('layout')

@section('title', 'Đăng nhập')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
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
            <form class="form_container" method="POST" action="{{ route('login') }}">
                @csrf
                <img class="logo_container" src="img/login.jpg" alt="">
                <div class="title_container">
                    <p class="title">Đăng nhập</p>
                    <span class="subtitle">
                        Đăng nhập ngay, nhận nhiều ưu đãi <span class="badge text-bg-danger">độc quyền</span> với các ưu đãi cực hấp dẫn
                    </span>
                </div>
                <br>
                <div class="input_container">
                    <label class="input_label" for="email">Email</label>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">@</span>
                        <input type="text" name="email" class="form-control focus" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping">
                    </div>
                </div>
                <div class="input_container">
                    <label class="input_label" for="password">Password</label>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-unlock"></i></span>
                        <input type="password" name="password" class="form-control focus" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping">
                    </div>
                </div>
                <div class="input_container">
                    <a href="{{ route('register') }}" class="btn-dk col-lg-6">Đăng ký thành viên?</a>
                    <a href="{{ route('reset_password') }}" class="col-lg-6">Quên mật khẩu</a>
                </div>
                <button type="submit" class="sign-in_btn">
                    <span>Đăng nhập tài khoản</span>
                </button>

                <div class="separator">
                    <hr class="line">
                    <span>Hoặc</span>
                    <hr class="line">
                </div>
                <button type="button" class="sign-in_btn gg">
                    <img src="img/google.webp" alt="">
                    <span>Đăng nhập bằng Google</span>
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
