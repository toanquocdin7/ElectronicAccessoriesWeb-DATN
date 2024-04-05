<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use DB;

class OrdersController extends Controller
{
    //danh sách đơn hàng
    public function read(){
        $data = DB::table("orders")->orderBy("id","desc")->paginate(50);
        return view("admin.orders.read",["data"=>$data]);
    }

    //chi tiết đơn hàng
    public function detail($id){
        //lấy đơn hàng
        $order = DB::table("orders")->where("id","=",$id)->first();
        //lấy thông tin khách hàng
        $customer = DB::table("customers")->where("id","=",$order->customer_id)->first();
        //lấy danh sách các sản phẩm thuộc đơn hàng
        $products = DB::table("orderdetails")->where("order_id","=",$id)->get();
        return view("admin.orders.detail",["order_id"=>$id]);
    }

    public function update(Request $request, $id){
        // Lấy thông tin đơn hàng
        $order = DB::table("orders")->where("id","=",$id)->first();

        // Kiểm tra và cập nhật trạng thái đơn hàng
        if($order->status == 0) {
            // Chưa giao hàng -> Đang vận chuyển
            DB::table("orders")->where("id","=",$id)->update(["status"=>1]);
            return redirect(url('backend/orders/detail/'.$id))->with('success', 'Đơn hàng đã chuyển sang trạng thái Đang vận chuyển.');
        } elseif ($order->status == 1) {
            // Đang vận chuyển -> Đã giao hàng
            DB::table("orders")->where("id","=",$id)->update(["status"=>2]);
            return redirect(url('backend/orders/detail/'.$id))->with('success', 'Đơn hàng đã chuyển sang trạng thái Đã giao hàng.');
        } elseif ($order->status == 2) {
            // Đã giao hàng -> Hoàn trả
            DB::table("orders")->where("id","=",$id)->update(["status"=>3]);
            return redirect(url('backend/orders/detail/'.$id))->with('success', 'Đơn hàng đã chuyển sang trạng thái Hoàn trả.');
        } elseif ($order->status == 3) {
            // Đã giao hàng -> Hoàn trả
            DB::table("orders")->where("id","=",$id)->update(["status"=>0]);
            return redirect(url('backend/orders/detail/'.$id))->with('success', 'Đơn hàng đã chuyển sang trạng thái Hoàn trả.');
        }
        else {
            return redirect(url('backend/orders/detail/'.$id))->with('error', 'Không thể cập nhật trạng thái đơn hàng.');
        }
    }


    //delete order
    public function delete($id){
        // Xóa đơn hàng từ cơ sở dữ liệu
        DB::table("orders")->where("id", $id)->delete();

        // Chuyển hướng người dùng đến trang danh sách đơn hàng
        return redirect(url('backend/orders'))->with('success', 'Đơn hàng đã được xóa thành công.');
    }

    public function filterOrders(Request $request) {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $formattedStartDate = Carbon::parse($startDate)->format('d-m-Y');
        $formattedEndDate = Carbon::parse($endDate)->format('d-m-Y');

        $orders = DB::table("orders")->whereBetween('date', [$startDate, $endDate])->get();

        return view('admin.orders.read', compact('orders','formattedStartDate', 'formattedEndDate'));
    }
}
