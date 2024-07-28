<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ từ khách hàng</title>
</head>
<body>
    <h2>Thông tin liên hệ</h2>
    <p><strong>Họ và tên:</strong> {{ $contactData['Name'] }}</p>
    <p><strong>Email:</strong> {{ $contactData['email'] }}</p>
    <p><strong>Nội dung:</strong></p>
    <p>{{ $contactData['body'] }}</p>
</body>
</html>
