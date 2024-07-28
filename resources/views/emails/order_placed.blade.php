<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đơn hàng của bạn đã được đặt thành công</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            color: #555;
            margin-bottom: 20px;
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        ul li {
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #3eb8cd
            ;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cảm ơn bạn đã đặt hàng!</h1>
        <p>Thông tin đơn hàng của bạn:</p>
        <ul>
            <li><strong>Mã đơn hàng:</strong> {{ $bill->order_code }}</li>
            <li><strong>Họ tên:</strong> {{ $bill->name_cus }}</li>
            <li><strong>Địa chỉ:</strong> {{ $bill->diachi_cus }}</li>
            <li><strong>Điện thoại:</strong> {{ $bill->sdt_cus }}</li>
            <li><strong>Email:</strong> {{ $bill->email_cus }}</li>
            <li><strong>Tổng tiền:</strong> {{ number_format($bill->total) }}đ</li>
        </ul>
        <h2>Chi tiết sản phẩm:</h2>
        <table>
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Size</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ number_format($item['price']) }}đ</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ $item['size'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
