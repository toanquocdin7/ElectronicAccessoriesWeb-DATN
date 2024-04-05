<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="{{ asset('Frontend/css/register.css') }}">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('frontend/images/logo_title.png') }}" type="image/png" class="favicon-image">
    <style type="text/css">
        .favicon-image{
            width: 80px;
        }
    </style>
</head>
<body>
    <!-- Form log in -->
    <div style="background-color: #333 ;" class="container" id="container">
        <div style="background-color: #FFCCCC;" class="form-container sign-up-container">
            <form method="post" style="background-color: #333 ;" action="{{ url('customers/register-post') }}">
            	@csrf
                <h1 style="color: orange;">Đăng kí</h1>
                <!-- <span>or use your email for registration</span> -->
                <input style="background-color: #FFF;" type="text" name="name" placeholder="Họ và tên" class="input-control" required/>
                <input style="background-color: #FFF;" type="text" name="email" placeholder="Email" class="input-control" required/>
                <input style="background-color: #FFF;" type="text" name="address" placeholder="Địa chỉ" class="input-control" required/>
                <input style="background-color: #FFF;" type="text" name="phone" placeholder="Số điện thoại" class="input-control" required/>
                <input style="background-color: #FFF;" type="password" name="password" placeholder="Password" class="input-control" required />
                <input style="background-color: orange; color: #fff ; font-size: 15px; cursor: pointer; border: 1px solid #CD2626; border-radius: 20px" type="submit" class="button" value="Đăng ký">
                <!-- <a style="background-color: #CD2626; border-radius: 20px" href="{{ url('customers/login') }}"><button class="ghost" id="signUp">Đăng nhập</button></a> -->

            </form>
        </div>
        <div  class="form-container sign-in-container">
            <form action="#">
                <h1 style="margin-left: 290px; margin-top: 200px !important; color: orange;">Đăng kí ngay nếu bạn chưa có tài khoản!</h1>
            </form>
        </div>

    </div>
</body>
</html>
