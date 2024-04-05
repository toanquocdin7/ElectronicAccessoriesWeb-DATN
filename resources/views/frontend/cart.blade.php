<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- Load font awsome online -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('Frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/css/cart.css') }}">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('frontend/images/logo_title.png') }}" type="image/png" class="favicon-image">
    <style type="text/css">
        .favicon-image{
            width: 80px;
        }
    </style>
</head>
<body>
        <!-- Load header của trang web vào đây -->
        @include("frontend.header")
        @php
          //để sử dụng các hàm bên trong trait Cart thì phải khai báo ở đây
          use \App\Http\ShoppingCart\Cart;
        @endphp
        @if(isset($cart))
        <!-- container -->
        <h1 style="font-size: 40px; padding-top: 30px; padding-left: 100px;">Shopping Cart: {{ Cart::cartNumber() }} sản phẩm</h1>
        <form action="{{ url('cart/update') }}" method="post" style="margin-left: 50px; margin-top: 30px;">
            @csrf
            <div class="table-responsive">
              <table class="table table-cart">
                <thead>
                  <tr>
                    <th class="image">Ảnh sản phẩm</th>
                    <th class="name">Tên sản phẩm</th>
                    <th class="price">Giá bán lẻ</th>
                    <th class="quantity">Số lượng</th>
                    <th class="price">Thành tiền</th>
                    <th>Xóa</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($cart as $product)
                  <tr>
                    <td><img src="{{ asset('upload/products/'.$product['photo']) }}" class="img-responsive" /></td>
                    <td><a  style="color:#000; text-decoration: none !important;" href="{{ url('products/detail/'.$product['id']) }}"><h1>{{ $product['name'] }}</h1></a></td>
                    <td> {{ number_format($product['price']) }}₫ </td>
                    <td><input style="width: 50px" type="number" id="qty" min="1" class="input-control" value="{{ $product['quantity'] }}" name="product_{{ $product['id'] }}" required="Không thể để trống"></td>
                    <td><p style="color: orange"><b>{{ number_format($product['quantity'] * ($product['price'] - ($product['price'] * $product['discount'])/100)) }}₫</b></p></td>
{{--                    <td><a href="{{ url('cart/delete/'.$product['id']) }}" data-id="2479395"><i class="fa-solid fa-trash" style="color: orange;"></i></a></td>--}}
                      <td><a href="javascript:void(0);" onclick="confirmDeleteProduct({{ $product['id'] }})"><i class="fa-solid fa-trash" style="color: orange;"></i></a></td>

                  </tr>
                 @endforeach
                </tbody>
                @if(Cart::cartNumber()>0)
                <tfoot>
                  <tr>
{{--                    <td colspan="6"><a href="{{ url('cart/destroy') }}" class="button-pull-left">Xóa toàn bộ sản phẩm</a> <a href="{{ asset('') }}" class="button-pull-left black">Tiếp tục mua hàng</a>--}}
{{--                      <input type="submit" class="button-pull-right" value="Cập nhật"></td>--}}
                      <td colspan="6"><a href="javascript:void(0);" onclick="confirmDeleteAll()" class="button-pull-left">Xóa toàn bộ sản phẩm</a>
                          <a href="{{ asset('') }}" class="button-pull-left black">Tiếp tục mua hàng</a>
                          <input type="submit" class="button-pull-right" value="Cập nhật"></td>
                  </tr>
                </tfoot>
                @endif
                @else
                      <!-- Thông báo giỏ hàng trống -->
                      <div style="margin-left: 50px; margin-top: 30px; font-size: 24px;">
                          <b style="font-size: 40px; padding-bottom: 40px">Giỏ hàng đang chưa có sản phẩm nào.</b><br>
                          <hr>
                      </div>
                    <div>
                        <a style="margin-left: 50px; margin-top: 30px; font-size: 24px;" href="{{ asset('') }}" class="button-black">Tiếp tục mua hàng</a>
                    </div>
                @endif
              </table>
            </div>
          </form>
        <!-- Thêm mã JavaScript để hiển thị modal xác nhận -->
        <script>
            function confirmDeleteProduct(productId) {
                if (confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng không?')) {
                    window.location.href = "{{ url('cart/delete') }}/" + productId;
                }
            }

            function confirmDeleteAll() {
                if (confirm('Bạn có chắc muốn xóa toàn bộ sản phẩm khỏi giỏ hàng không?')) {
                    window.location.href = "{{ url('cart/destroy') }}";
                }
            }
        </script>

        @if(Cart::cartNumber()>0)
          <div style="margin-left:50px; margin-top: 30px; font-size: 24px;" class="total-cart"><b style="color: orange;">Tổng tiền thanh toán:
            {{ number_format(Cart::cartTotal()) }}₫ </b><br><br>
              <br>
{{--            <a href="{{ url('cart/order') }}" class="button-black">Thanh toán</a>--}}
          </div>
        </div>
          <form action="{{ route('payment') }}" method="post">
              <div style="padding-left: 260px; font-size: 20px; line-height: 40px; font-weight: bold">
                  @csrf
                  <label style="color: orange;" for="payment_method">Chọn phương thức thanh toán:</label><br>
                  <input type="radio" id="online_payment" name="payment_method" value="0">
                  <label for="online_payment">Thanh toán Online</label><br>
                  <input type="radio" id="cash_on_delivery" name="payment_method" value="1">
                  <label for="cash_on_delivery">Thanh toán khi nhận hàng</label><br>
                  <input style="margin-top: 20px; width: 150px; font-size: 20px;" class="button-black" type="submit" value="Thanh toán">
              </div>
          </form>
        @endif


        {{--        @endif--}}
        <!-- /container -->
        <style type="text/css">
            .button-black{
                margin-right: 20px;
                padding: 5px;
                height: 50px;
                border: 2px solid orange;
                border-radius: 10px;
                background-color: orange;
                color: #fff;
                text-decoration: none;
                line-height: 40px;
            }
            .button-black:hover{
                cursor: pointer;
                color: orange;
                background-color: #fff;
            }
            .button-pull-left{
                margin-left: 10px;
                margin-top: 5px;
                padding: 15px 10px 5px 10px;
                float: left;
                height: 30px;
                text-decoration: none;
                color: orange;
                border: 1px solid orange;
                border-radius: 5px;
            }
            .button-pull-left:hover{
                cursor: pointer;
                color: #fff;
                background-color: orange;
            }
            .button-pull-right{
                margin: 15px;
                float: right;
                border: 1px solid orange;
                height: 30px;
                background-color: #fff;
                color: orange;
            }
            .button-pull-right:hover{
                cursor: pointer;
                color: #fff;
                background-color: orange;
            }
        </style>
    <!-- Footer -->
    <div class="footer">
        <div class="info">
            <ul><h2>THÔNG TIN CÔNG TY</h2>
                <li><a href="#">Trang chủ</a></li>
                <li><a href="#">Giới thiệu</a></li>
                <li><a href="#">Sản phẩm</a></li>
                <li><a href="#">Tin tức</a></li>
                <li><a href="#">Liên hệ</a></li>
            </ul>

            <ul><h2>HỖ TRỢ KHÁCH HÀNG</h2>
                <li><a href="#">Trang chủ</a></li>
                <li><a href="#">Giới thiệu</a></li>
                <li><a href="#">Sản phẩm</a></li>
                <li><a href="#">Tin tức</a></li>
                <li><a href="#">Liên hệ</a></li>
            </ul>

            <ul><h2>CHÍNH SÁCH MUA HÀNG</h2>
                <li><a href="#">Trang chủ</a></li>
                <li><a href="#">Giới thiệu</a></li>
                <li><a href="#">Sản phẩm</a></li>
                <li><a href="#">Tin tức</a></li>
                <li><a href="#">Liên hệ</a></li>
            </ul>

            <ul class="footer4"><h2>KÊNH THÔNG TIN</h2>
                <li>TPHONES là thương hiệu cung cấp <br> điện thoại & phụ kiện điện thoại nổi tiếng tại Hà Nội và <br> TP Hồ Chí Minh</li>
                <div class="logo-footer"><a href="#"><i class="fa-brands fa-square-facebook fa-2xl" style="color: #346fd5;"></i></a></div>
                <div class="logo-footer"><a href="#"><i class="fa-brands fa-square-google-plus fa-2xl" style="color: #d83b3b;"></i></a></div>
                <div class="logo-footer"><a href="#"><i class="fa-brands fa-square-twitter fa-2xl" style="color: #0ea2e1;"></i></a></div>
                <div class="logo-footer logo-footer__logo-bct"><img src="{{ asset('frontend/images/bct.png') }}" alt=""></div>

        </div>
        <div class="raw-company">
            <ul><h2>CÔNG TY TNHH THPONES</h2>
            <li>Trụ sở chính : Tầng 4 - Tòa nhà Hanoi Group - 442 Đội Cấn - Ba Đình - Hà Nội <br> Điện thoại : (04) 6674 2332 - (04) 3786 8904</li>
            <li>Văn phòng đại diện : Lầu 3 - Tòa nhà Lữ Gia - Số 70 Lữ Gia - P.15 - Q.11 - TP. HCM <br> Điện thoại : (08) 6680 9686 - (04) 3866 6276</li>
            </ul>
        </div>

        <div class="last-footer">
            © Bản quyền thuộc về Tphones | Cung cấp bởi <a href="#" style="color: orange;">TPHONES</a>
        </div>
    </div>

</body>
</html>
