@extends('layout')
@section('title', 'Cảm ơn bạn đã đặt hàng')
@section('content')
<section class="thank-you-section p-5">
    <div class="container text-center">
        <h1 class="textPrice">Cảm ơn bạn đã đặt hàng!</h1>
        <p>Đơn hàng của bạn đã được đặt thành công. Vui lòng kiểm tra email để xem chi tiết.</p>
        <a href="{{ route('home') }}" class="btn text-bg-warning">Về trang chủ</a>
    </div>
</section>
@endsection
