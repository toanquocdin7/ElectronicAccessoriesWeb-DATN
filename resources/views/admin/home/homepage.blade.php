@extends("admin.layout")
@section("do-du-lieu-tu-view")
	<h2 style="text-align: center; padding-top: 50px; ">Chào mừng đến với trang Admin</h2>
    <!DOCTYPE HTML>
    <html>
    <head>
        <style>
            canvas.canvasjs-chart-canvas {
                width: 890px !important;
                height: 400px !important;
            }
        </style>
    </head>
    <body>
    <div style="margin-top: 50px; font-weight: bold">
        <p>Tổng số đơn hàng: {{ $totalOrders }}</p>
        <p>Tổng doanh thu các đơn hàng: {{ number_format($totalRevenue) }}đ</p>
    </div>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    </body>
    </html>
@endsection
