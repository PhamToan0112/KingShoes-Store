@extends('layout')
@section('title','Trang Giới thiệu')
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
                Giới Thiệu
              </a>
          </li>
        </ol>
      </nav>
    </div>
</section>
<section class="mt-3 mb-3 text-center" >
  <p class="p-5">Chào mừng bạn đến với trang giới thiệu. Chúng tôi là một website đơn giản với các sản phẩm mới nhất.</p>
</section>

@endsection