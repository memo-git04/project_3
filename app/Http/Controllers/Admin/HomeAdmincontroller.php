<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product_variant;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HomeAdmincontroller extends Controller
{
    public function index(Request $request){
        // thống kê số lượng đơn hàng theo trạng thái
        $orders = Status::withCount('orders')->get();

        $chart = [];
//        $chart[] = []; // Tiêu đề cột
        foreach ($orders as $status) {
            $chart[] = [
                'label' => $status->status_name,
                'value' => $status->orders_count,
            ];
        }
        //Thống kê sản phẩm sắp hết hàng
        $products = Product_variant::with('product', 'color', 'size', 'product.category')
            ->where('stock_quantity', '<', 20)
            ->paginate(10);

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
            'labels' => $categories->pluck('category_name'),
            'data' => $categories->pluck('products_count')->toArray()
        ];
        //top10 products
        $year = $request->input('year', Carbon::now()->year);
        $month = $request->input('month', null);

        $query = DB::table('order_items')
            ->join('product_variants', 'order_items.product_variant_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->select(
                'products.id',
                'products.product_name',
                DB::raw('SUM(order_items.quantity) as total_quantity'),
                DB::raw('SUM(order_items.price * order_items.quantity) as total_revenue')
            )
            ->groupBy('products.id', 'products.product_name')
            ->orderByDesc('total_revenue')
            ->limit(10);

        $query->whereYear('order_items.created_at', $year);

        // Apply month filter if provided
        if ($month) {
            $query->whereMonth('order_items.created_at', $month);
        }
        // Execute the query
        $topProducts = $query->get();
        //get Daily Sales
        $dailySales = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->select(
                DB::raw('DATE(orders.order_date) as order_date'),
                DB::raw('SUM(order_items.quantity) as total_quantity'),
                DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue')
            )
            ->whereDate('orders.order_date', '>=', now()->subDays(7))
            ->groupBy(DB::raw('DATE(orders.order_date)'))
            ->orderBy('order_date', 'ASC')
            ->get();
//        dd($dailySales);
//        dd($chartData);
        return view('admin.index',[
            'data' => $data,
            'chartData' => $chartData,
            'chart' =>$chart,
            'products' => $products,
            'topProducts' =>$topProducts,
            'dailySales' => $dailySales,
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
