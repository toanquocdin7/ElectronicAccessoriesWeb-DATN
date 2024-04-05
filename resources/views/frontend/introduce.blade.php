<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giới thiệu</title>
    <!-- Load font awsome online -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
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
    <div class="row">
        <div>
            <h1 class="introduce-header">
                Thế Giới Phụ Kiện - Thương hiệu bán điện thoại, phụ kiện uy tín số 1 Việt Nam.
            </h1>
            <p class="introduce-text">
                Được biết đến như một trong những hệ thống phân phối các sản phẩm điện thoại, phụ kiện nhập khẩu chính đầu tiên ở Việt Nam, chúng tôi đã ghi dấu ấn đậm nét trong lòng bao thế hệ Genz Việt với những sản phẩm cao cấp.
            </p>
            <div class="intro-image">
                <img src="frontend/images/sub_banner1.jpg" alt="">
            </div>
            <p class="introduce-text">
                Text
            </p>
        </div>
    </div>
    <style>
        .row {
            width: 900px;
            margin: auto;
        }
        .introduce-header {
            text-align: center;
            font-size: 30px;
            color: #cd2626;
            font-weight: bolder;
            margin-top: 50px;
        }
        .introduce-text {
            color: #3C4858;
            margin-top: 15px;
            font-size: 20px;
        }
        .intro-image img{
            width: 900px;
            margin-top: 20px;
        }
        .last-text {
            float: right;
            padding-bottom: 20px;
        }
    </style>
@endsection

</body>
</html>
