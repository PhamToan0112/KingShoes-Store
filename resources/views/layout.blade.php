<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <link rel="icon" href="{{ asset('img/register.jpg') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
</head>
<body >
    @include('/partial/header')
     
    @yield('content')

    @include('/partial/footer')
  <script src="{{ asset('/js/bootstrap.bundle.js') }}"></script>
  <script src="{{ asset('/js/script.js') }}"></script>
 
  <script src="https://kit.fontawesome.com/d22cbf7e70.js" crossorigin="anonymous"></script>
   <!-- Bootstrap JS and dependencies -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    // Khi chọn kích cỡ
    $('.item-size .btn').click(function() {
        $('.item-size .btn').removeClass('checked_cl');
        $(this).addClass('checked_cl');

        var selectedSize = $(this).data('size').trim();
        console.log('Size đã chọn:', selectedSize);
        $(this).closest('.modal').find('.add-to-cart').data('size', selectedSize);
        $(this).closest('.modal').find('.size-input').val(selectedSize); // Update hidden input in form
    });

    // Khi bấm nút "Thêm giỏ hàng"
    $('.add-to-cart').click(function(e) {
        e.preventDefault();

        var modal = $(this).closest('.modal');
        var id = $(this).data('product-id');
        var size = $(modal).find('.item-size .btn.checked_cl').data('size').trim();
        var quantity = $(modal).find('#quantityInput').val();
        var name = $(modal).find('.product__details__text h1').text();
        var image = $(modal).find('.img-feature').attr('src');
        var price = $(modal).find('.info-price strong').text().replace(/\D/g, '');
        if (!size) {
            alert('Vui lòng chọn kích thước.');
            return;
        }

        console.log({id, size, quantity, name, image, price});

        // Gửi yêu cầu AJAX tới máy chủ
        $.ajax({
            type: 'POST',
            url: '/add-to-cart',
            data: {
                id: id,
                size: size,
                name: name,
                image: image,
                price: price,
                quantity: quantity,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    alert('Sản phẩm đã được thêm vào giỏ hàng thành công!');
                    // Cập nhật số lượng giỏ hàng hiển thị
                    $('.cart-count span').text(response.totalQuantity);
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Khi bấm nút "Mua Ngay"
    $('.buy-now-form').submit(function(e) {
        var modal = $(this).closest('.modal');
        var size = $(modal).find('.item-size .btn.checked_cl').data('size').trim();
        var quantity = $(modal).find('#quantityInput').val();

        if (!size) {
            alert('Vui lòng chọn kích thước.');
            e.preventDefault();
            return;
        }

        $(this).find('.size-input').val(size); // Update hidden input in form
        $(this).find('.quantity-input').val(quantity); // Update hidden input in form
    });
});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
       
       $(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function load_comment(url = "{{ url('/load-comment') }}", append = false) {
        var product_id = $('.comment_product_id').val();

        $.ajax({
            url: url,
            method: "POST",
            data: { product_id: product_id },
            success: function(data){
                if (append) {
                    $('#comment_show').append(data.comments);
                } else {
                    $('#comment_show').html(data.comments);
                }
                // Lưu URL của trang tiếp theo vào button
                $('#load_more_button').data('next-page-url', data.next_page_url);
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    $('.send_comment').click(function(e){
        e.preventDefault();
        var product_id = $('.comment_product_id').val();
        var comment_name = $('input[name="comment_name"]').val();
        var comment_content = $('textarea[name="comment_content"]').val();
        
        $.ajax({
            url: "{{ url('/send-comment') }}",
            method: "POST",
            data: {
                product_id: product_id,
                comment_name: comment_name,
                comment_content: comment_content
            },
            success: function(data){
                $('#notify_comment').html('<p class="text-bg-success">Thêm bình luận thành công</p>');

                var newComment = `
                    <div class="comt-content">
                        <div class="m">
                            <div class="d-flex gap-3 p-3 bg-cmt">
                                <img src="' . url('./img/sp/hinh2.jpeg') . '" alt="" style="max-height: 80px; background-position: center">
                                <div class="info-user-comt">
                                    <p class="textPrice">@ ${comment_name}</p>
                                    <p class="noidung">${comment_content}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                $('#comment_show').prepend(newComment);

                $('input[name="comment_name"]').val('');
                $('textarea[name="comment_content"]').val('');
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    $('#load_more_button').click(function() {
        var nextPageUrl = $(this).data('next-page-url');
        if (nextPageUrl) {
            load_comment(nextPageUrl, true);
        }
    });

    load_comment();
});

</script>

</body>
</html>


