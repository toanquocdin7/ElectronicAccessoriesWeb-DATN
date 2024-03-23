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

        return view('admin.home.homepage', compact('totalOrders', 'totalRevenue'));
    }
}
