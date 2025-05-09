<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order_item;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use function Laravel\Prompts\table;

class OrderController extends Controller
{

    public function checkout()
    {
        //get cart from session
        $value= session()->get('cart');
        return view('shop.content.checkout',[
            'cart' =>$value,
        ]);
    }

    public function orderHistory(Request $request)
    {
        $customer = $request->session()->get('customer'); // Lấy toàn bộ đối tượng Customer từ session
        $customerId = $customer->id;
//        dd($customerId);
        // Lấy tất cả thông tin đơn hàng và chi tiết các sản phẩm trong từng đơn hàng
        $orders = Order::with(['orderItems.productVariant.product', 'status', 'customer', 'paymentMethod'])
            ->where('customer_id', $customerId)
            ->get();
//        dd($orders);
        // Trả về view với dữ liệu đơn hàng
        return view('shop.content.order_history', [
            'orders' => $orders
        ]);
    }
    public function orderDetail($orderId)
    {
        $order = Order::with(['orderItems.productVariant.product', 'status'])
            ->findOrFail($orderId);

        // Trả dữ liệu về view
        return view('shop.content.order_item', [
            'order' => $order
        ]);

    }

    public function cancelOrder(Request $request, $orderId){
        $order = Order::findOrFail($orderId);
//        dd($order);

        //check
        if($order->status_id != 1){
            return Redirect::back()->with('error', 'Your order can not cancel!');
        }
        //update status for order
        $order->update([
            'status_id' => 5 //  "Canceled" -> ID = 5
        ]);
        return Redirect::back();
    }

    public function filterOrders(Request $request)
    {
        // Lấy trạng thái từ yêu cầu
        $statusId = $request->input('status_id');

        // Lọc đơn hàng theo trạng thái
        $orders = Order::with(['status', 'orderItems.productVariant.product'])
            ->where('status_id', $statusId)
            ->get();

        // Trả dữ liệu về view
        return view('shop.content.order_history', [
            'orders' => $orders,
            'status_id' => $statusId // Để giữ trạng thái đã chọn trên giao diện
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //get customer from session
        $customerID = session('customer.id');
        //get cart from session
        $cart = session('cart', []);

//        dd($customerID);
//        dd($cart);
        try{

            //get infor from form
            $recerverName = $request->input('fullname');
            $recerverPhone = $request->input('phone');
            $recerverAddress = $request->input('address');
            $paymentMethod = $request->input('payment');

//            dd($request->all());

            //calculate total price from cart
            $totalAmount = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
//            dd($totalAmount);
            //save order to DB
            $order = Order::create([
                'customer_id' => $customerID,
                'method_id' => $paymentMethod,
                'status_id' => 1, //default status 1. Waiting for confirmation
                'receiver_name' => $recerverName,
                'receiver_phone' => $recerverPhone,
                'receiver_address' => $recerverAddress,
                'total_amount' => $totalAmount,
            ]);
//            dd($order->id);
            //save order detail to DB
//            dd($cart);
            foreach ($cart as $item) {
//                dd($item);
                $order_item = Order_item::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $item['product_variant_id'], // ID của sản phẩm
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }
//            dd($order_item);
            //clear cart from session
            session()->forget('cart');
            //redirect to order history
//            return Redirect::route('orderHistory');
        }
        catch (\Exception $e){
             dd($e->getMessage());
//            return Redirect::back();
        }
        return Redirect::route('orderHistory');
    }

    public function applyCoupon(Request $request){
        //get value from Form Request
        $couponCode = $request->input('coupon_code');
//        $cartTotal = $request->input('cart_total');
        $cart = session('cart', []);

        // Tính tổng tiền giỏ hàng
        $cartTotal = 0;
        foreach ($cart as $item) {
            $cartTotal += $item['price'] * $item['quantity'];
        }

        //check promotion has exist
        $promotion = Promotion::where('code', $couponCode)->fisrt();

        if(!$promotion){
            return Redirect::back();
        }
        //check validation of promotion
        if($promotion->start_date >  now()  || $promotion->end_date < now() ){
            return Redirect::back();
        }
        //Check Min order Amount of order
        if($cartTotal < $promotion->min_order_amount){
            return Redirect::back();
        }
        //Check usage quantity
        if($promotion->current_usage >= $promotion->usage_limit){
            return Redirect::back();
        }
        //Check if customer used vouncher
        $customerID = session('customer.id');
        $used = DB::table('promotion_customers')
            ->where('customer_id', $customerID)
            ->where('promotion_id', $promotion->id)
            ->exists();
        if($used){
            return Redirect::back();
        }

        //Apply vouncher
        session()->put('coupon', [
            'code' =>$promotion->code,
            'discount' => $promotion->discount_amount,
        ]);
        //Add usage vouncher quantity
        $promotion->increment('current_usage');

        //save data into promotion_customers Table
        DB::table('promotion_customers')->insert([
            'customer_id' => $customerID,
            'promotion_id' => $promotion->id,
        ]);

        return Redirect::back();
    }
















    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }





}
