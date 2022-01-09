<!DOCTYPE html>
<html>
<head>
    <title>Phone Store</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <span>Ngày đặt hàng: {{ date('d-m-Y H:i:s', strtotime($details['date'])); }}</span>
    <table style="width:100%">
        <thead>
            <tr>
                <td style="font-weight: bold">Tên</td>
                <td style="font-weight: bold">Ảnh</td>
                <td style="font-weight: bold">Màu</td>
                <td style="font-weight: bold">Đơn giá</td>
                <td style="font-weight: bold">Số lượng</td>
                <td style="font-weight: bold">Thành tiền</td>
            </tr>
        </thead>
        <tbody>
        @foreach ($details['body'] as $d) 
        <tr>
            <td>{{$d->name}}</td>
            <td><img src="{{ $message->embed(asset('public/backend/uploads/product-images/'.$d->options->photo)) }}" height="50" width="50"></td>
            <td>{{$d->options->color}}</td>
            <td>{{number_format($d->price)}}₫</td>
            <td>{{$d->qty}}</td>
            <td>{{number_format($d->qty * $d->price)}}₫</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <h3>Tổng tiền hóa đơn: {{ $details['total'] }}₫</h3>

    <span>Địa chỉ nhận hàng: {{ $details['address'] }}</span><br>
    <span>Ghi chú: {{ $details['note'] }}</span>
    <h2>Cảm ơn bạn đã đặt hàng !</h2>
</body>
</html>