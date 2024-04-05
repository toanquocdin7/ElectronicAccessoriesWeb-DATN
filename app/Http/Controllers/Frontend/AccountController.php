<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AccountController extends Controller
{
    public function details($id)
    {
        // Get the order details
        $order = DB::table("orders")->where("customer_id", $id)->first();

        if($order) {
            // Get the customer information
            $customer = DB::table("customers")->where("id", $order->customer_id)->first();
        }

        // Get the products in the order
        $products = DB::table("orderdetails")
            ->join("products", "products.id", "=", "orderdetails.product_id")
            ->select("products.*", "orderdetails.quantity", "orderdetails.price")
            ->where("orderdetails.customer_detail_id", $id)
            ->get();

        if($order) {
            return view("frontend.account", compact('order', 'customer', 'products'));
        } else {
            return view("frontend.account", compact('order', 'products'));
        }
    }

    public function cancelOrder(Request $request)
    {
        $orderId = $request->input('orderId');

        // Xóa đơn hàng khỏi cơ sở dữ liệu
        DB::table('orders')->where('id', $orderId)->delete();
        DB::table('orderdetails')->where('order_id', $orderId)->delete();

        // Trả về kết quả thành công
        return response()->json(['success' => true]);
    }
}
