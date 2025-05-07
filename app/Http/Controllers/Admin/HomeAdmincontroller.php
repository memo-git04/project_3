<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeAdmincontroller extends Controller
{
    public function index(){
        //get admin dashboard
        //get quantity of orders, customers, products
        $data = [
            'productsCount' => \App\Models\Product::count(),
            'ordersCount' => \App\Models\Order::count(),
            'customersCount' => \App\Models\Customer::count(),
            'totalRevenue' => \App\Models\Order::sum('total_amount'),
        ];
        return view('admin.index',[
            'data' => $data,
        ]);
    }
    public function orderManage(){
        $orders = Order::with(['orderItems.productVariant.product', 'status', 'paymentMethod'])
//            ->where('customer_id', auth()->id()) // Lọc theo khách hàng đã đăng nhập (nếu có hệ thống auth)
//            ->orderBy('order_date', 'desc') // Sắp xếp theo ngày đặt hàng mới nhất
            ->get();
//        dd($orders);
        return view('admin.modules.orders.order',[
            'orders' => $orders
        ]);
    }
    public function orderItem(){
        return view('admin.modules.orders.order_detail');
    }
}
