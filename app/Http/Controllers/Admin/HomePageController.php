<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

class HomePageController extends Controller
{
    public function index()
    {
        $totalOrders = DB::table("orders")->orderBy("id", "desc")->count();
        $totalRevenue = DB::table("orders")->orderBy("id", "desc")->sum('price');
        $recentOrders = DB::table("orders")->orderBy("id", "desc")->take(3)->get();

        $topSellingProducts = DB::table('orderdetails')
            ->select('product_id', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(quantity * price) as total_amount'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->take(5)
            ->get();

        // Duyệt qua các sản phẩm bán chạy nhất
        $topSellingProductsData = [];
        foreach ($topSellingProducts as $product) {
            $productId = $product->product_id;
            $totalQuantity = $product->total_quantity;
            $totalAmount = $product->total_amount;

            // Lấy thông tin chi tiết của sản phẩm từ bảng products
            $productInfo = DB::table('products')
                ->where('id', $productId)
                ->first();

            // Kiểm tra xem sản phẩm có tồn tại hay không
            if ($productInfo) {
                // Sản phẩm tồn tại, bạn có thể truy cập các trường thông tin của sản phẩm ở đây
                $productName = $productInfo->name;

                // Thêm thông tin của sản phẩm vào mảng
                $topSellingProductsData[] = [
                    'name' => $productName,
                    'quantity' => $totalQuantity,
                    'total_amount' => $totalAmount
                ];
            }
        }

        // Số lượng đơn hàng theo từng tháng
        $ordersByMonth = DB::table("orders")
            ->select(DB::raw('YEAR(date) as year'), DB::raw('MONTH(date) as month'), DB::raw('COUNT(*) as total'))
            ->groupBy(DB::raw('YEAR(date)'), DB::raw('MONTH(date)'))
            ->get();

        return view('admin.home.homepage', compact('totalOrders', 'totalRevenue', 'recentOrders', 'topSellingProductsData', 'ordersByMonth'));
    }
}
