<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
        // Lấy dữ liệu số lượng sản phẩm theo danh mục
        $categories = Category::withCount(['products' => function ($query) {
            $query->where('is_deleted', 0); // Lọc sản phẩm không bị xóa
        }])->where('is_deleted', 1) // Lọc category không bị xóa
        ->get();

        // Chuẩn bị dữ liệu cho biểu đồ
        $chartData = [
            'labels' => $categories->pluck('category_name'), // Tên danh mục
            'data' => $categories->pluck('products_count')->toArray()  // Số lượng sản phẩm
        ];
//        dd($chartData);
        return view('admin.index',[
            'data' => $data,
            'chartData' => $chartData,
        ]);
    }
    public function orderManage(){
        $orders = Order::with(['orderItems.productVariant.product', 'status', 'paymentMethod'])->get();
//        dd($orders);
        return view('admin.modules.orders.order',[
            'orders' => $orders
        ]);
    }
    public function orderItem($orderId){

        $order = Order::with(['orderItems.productVariant.product', 'status'])
//            ->where('is_deleted', 0)
            ->findOrFail($orderId);

//        dd($order);
        $validStatuses = [];
        $showUpdateForm = true;
        switch ($order->status_id) {
            case 1: // Wait for confirmation
                $validStatuses = [2, 5]; // Confirmed, Cancel
                break;
            case 2: // Confirmed
                $validStatuses = [3]; // In transit
                break;
            case 3: // In transit
                $validStatuses = [4]; // Delivered
                break;
            case 4: // Delivered
            case 5: // Cancel
                $showUpdateForm = false; // Không hiển thị form nếu đã giao hàng
                break;
            default:
                $validStatuses = []; // Không cho phép thay đổi trạng thái
                break;
        }

        $statuses = Status::all();

        return view('admin.modules.orders.order_detail', [
            'order' => $order,
            'statuses' => $statuses,
            'validStatuses' => $validStatuses,
            'showUpdateForm' => $showUpdateForm,
        ]);
    }

    public function updateStatusOrder(Request $request, $orderId){
        // Lấy thông tin đơn hàng
        $order = Order::findOrFail($orderId);
        // Không cho phép cập nhật khi trạng thái là Cancel hoặc Delivered
        if (in_array($order->status_id, [4, 5])) {
            return Redirect::back();
        }

        // Danh sách trạng thái hợp lệ dựa trên trạng thái hiện tại
        $validStatuses = [];
        switch ($order->status_id) {
            case 1: $validStatuses = [2, 5]; break; // Wait for confirmation
            case 2: $validStatuses = [3]; break;   // Confirmed
            case 3: $validStatuses = [4]; break;   // In transit
            default: $validStatuses = []; break;
        }

        // Kiểm tra nếu trạng thái mới hợp lệ
        if (!in_array($request->order_status, $validStatuses)) {
            return Redirect::back();
        }

        // Cập nhật trạng thái đơn hàng
        $order->status_id = $request->order_status;
        $order->save();

        return Redirect::back();
    }

    public function deleteOrder(Request $request, $orderId)
    {
        // Tìm đơn hàng theo ID
        $order = Order::findOrFail($orderId);

        // Cập nhật cột is_deleted thành 1 (đã xóa)
        $order->is_deleted = 1;
        $order->save();

        // Chuyển hướng lại danh sách đơn hàng với thông báo
        return Redirect::back();
    }
    public function filterOrders($status)
    {
        // Lấy danh sách đơn hàng theo trạng thái
        $orders = Order::with(['orderItems.productVariant.product', 'status'])
            ->where('status_id', $status) // Lọc theo trạng thái
            ->get();

        // Trả về view danh sách đơn hàng với dữ liệu đã lọc
        return view('admin.modules.orders.order', [
            'orders' => $orders,
        ]);
    }
}
