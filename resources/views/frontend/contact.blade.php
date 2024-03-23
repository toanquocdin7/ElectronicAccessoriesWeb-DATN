<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liên hệ</title>
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
        .main-text {
            margin-top: 50px;
            font-size: 30px;
            color: orange;
            font-weight: bolder;
        }
        .sub-text {
            margin-top: 15px;
            margin-bottom: 15px;
            font-size: 20px;
            color: orange;
            font-weight: bolder;
        }
    </style>
</head>
<body>
@extends("frontend.layout_home")
@section("do-du-lieu-vao-layout")
    <h1 class="main-text">Trụ sở chính</h1> <br>
    <p>
        <h2 class="sub-text">CÔNG TY TNHH TPHONES</h2>
        <p> Trụ sở chính: Toà nhà Viwaseen, 48 Tố Hữu, Nam Từ Liêm, Hà Nội</p> <br>
        <p>TP.HCM: Tòa nhà Lim Tower 3, 29A Nguyễn Đình Chiểu, Quận 1, TP. HCM</p> <br>
        <p>Singapore: 16 Collyer Quay, #12-00 Income@Raffles, Singapore 049318</p>
        <br>
        <p>Điện thoại : (84) 366 936 128</p>
    </p>
    <div class="row">
        <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.8659405900976!2d105.79186327510433!3d20.99801028064369!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acba7ddb0f43%3A0xe7d7c05f85f830a!2zNDggUC4gVOG7kSBI4buvdSwgVHJ1bmcgVsSDbiwgVOG7qyBMacOqbSwgSMOgIE7hu5lpIDEwMDAwLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1706460104738!5m2!1svi!2s" style="border:0; width: 100%; height: 500px; margin-top: 50px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
@endsection
</body>
</html>
