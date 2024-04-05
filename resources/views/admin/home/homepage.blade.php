@extends("admin.layout")
@section("do-du-lieu-tu-view")
	<h3 style="text-align: center; font-size: 30px; color: black; font-weight: bold">Trang Admin</h3>
    <!DOCTYPE HTML>
    <html>
    <head>
        <style>
            canvas.canvasjs-chart-canvas {
                width: 890px !important;
                height: 400px !important;
            }

            .main-panel {
                height: 150vh !important;
            }

            h3, .h3 {
                font-size: 1.4rem;
            }
        </style>
    </head>
    <body>
    <div style="color: black">
        <p style="color: black; font-weight: 400;">- Tổng số đơn hàng: {{ $totalOrders }}</p><hr>
        <p style="color: black; font-weight: 400;">- Tổng doanh thu các đơn hàng: {{ number_format($totalRevenue) }}đ</p><hr>
            <p style="color: black; font-weight: 400;">- Danh sách các tháng có đơn hàng:</p>
        <ul>
            @foreach($ordersByMonth as $order)
                <li>Tháng {{ $order->month }}/{{ $order->year }}: {{ $order->total }} đơn hàng</li>
            @endforeach
        </ul>
        <hr>
        <p style="color: black; font-weight: 400;">- Các đơn hàng gần đây:</p><hr>
        <ul>
            @foreach($recentOrders as $order)
                <li>OrderID #{{ $order->id }} - ({{ date("d/m/Y", strtotime($order->date)) }}): Tổng tiền {{ number_format($order->price) }}đ</li>
                <hr>
            @endforeach
        </ul>
    </div>

    <hr>
    <p class="panel-heading" style="color: black; font-weight: 400;">Top Sản phẩm bán chạy nhất</p>
    <div class="panel-body">
        <table class="table table-bordered table-hover">
            <tr>
                <th style="font-weight: 400;">#</th>
                <th style="font-weight: 400;">Tên sản phẩm</th>
                <th style="font-weight: 400;">Số lượng bán</th>
                <th style="font-weight: 400;">Tổng tiền</th>
            </tr>
            @php
                $count = 1;
            @endphp
            @foreach($topSellingProductsData as $product)
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>{{ number_format($product['total_amount']) }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    </body>
    </html>
@endsection
