<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thông tin tài khoản</title>
    <!-- Load font awsome online -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
{{--    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('frontend/images/logo_title.png') }}" type="image/png" class="favicon-image">
    <style type="text/css">
        .favicon-image{
            width: 80px;
        }
    </style>
</head>
<body>
@extends("frontend.layout_home")
@section("do-du-lieu-vao-layout")
    <div class="panel panel-primary">
        <h1 class="panel-heading" style="font-size: 30px; padding-top: 30px; padding-bottom: 30px">Thông tin tài khoản</h1>
        <div class="panel-body">
            <table class="table" style="font-size: 18px;">
                <tr>
                    <th style="width:200px;">Tên khách hàng</th>
                    <td>{{ isset($customer->name) ? $customer->name : "" }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ isset($customer->email) ? $customer->email : "" }}</td>
                </tr>
                <tr>
                    <th>Địa chỉ</th>
                    <td>{{ isset($customer->address) ? $customer->address : "" }}</td>
                </tr>
                <tr>
                    <th>Số điện thoại</th>
                    <td>{{ isset($customer->phone) ? $customer->phone : "" }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="panel panel-primary">
        <h3 class="panel-heading" style="font-size: 30px; padding-top: 30px; padding-bottom: 30px">Đơn hàng gần đây</h3>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th style="width:130px;">Order Id</th>
                    <th style="width:130px;">Ảnh</th>
                    <th style="width:500px;">Tên sản phẩm</th>
                    <th style="width:80px;">Số lượng</th>
                    <th style="width:100px;">Giá tiền</th>
                    <th style="width:200px;">Địa chỉ nhận hàng</th>
                </tr>
                <hr>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if($product->photo != "" && file_exists('upload/products/'.$product->photo))
                                <img src="{{ asset('upload/products/'.$product->photo) }}" style="width:100px;">
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td style="text-align:center;">{{ $product->quantity }}</td>
                        <td>{{ number_format($product->price) }}</td>
                        <td style="text-align: center">{{ isset($customer->address) ? $customer->address : "" }}</td>
                    </tr>
                @endforeach

            </table>
            <hr>
        </div>
    </div>

@endsection

</body>
</html>

<script>
    function confirmCancelOrder(orderId) {
        if (confirm("Bạn có chắc chắn muốn hủy đơn hàng này?")) {
            // Nếu người dùng đồng ý, thực hiện request đến route backend để xóa đơn hàng
            cancelOrder(orderId);
        }
    }

    function cancelOrder(orderId) {
        // Sử dụng AJAX để gửi yêu cầu xóa đơn hàng đến backend
        $.ajax({
            url: "{{ route('cancelOrder') }}",
            method: "POST",
            data: {
                orderId: orderId,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                // Xóa đơn hàng khỏi giao diện
                $("#order_" + orderId).remove();
                alert("Đơn hàng đã được hủy thành công!");
            },
            error: function(xhr, status, error) {
                alert("Đã có lỗi xảy ra. Vui lòng thử lại sau.");
            }
        });
    }
</script>
