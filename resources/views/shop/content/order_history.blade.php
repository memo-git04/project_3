@extends('shop.layout.master')
@section('title', 'Order History')

@section('content')



    <div class="container" id="cart" style="margin-top: 150px">
        <div class="row">
            <div class="text-center border-bottom">
                <h3>Your order</h3>
            </div>
        </div>

        <div class="row mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <td>
                            <a href="{{ route('orders.filter', ['status_id' => 3]) }}"><button type="button" class="btn btn-warning btn-sm">Order is being delivered</button></a>
                            <a href="{{ route('orders.filter', ['status_id' => 2]) }}"><button type="button" class="btn btn-success btn-sm">Order has been Confirmed</button></a>
                            <a href="{{ route('orders.filter', ['status_id' => 5]) }}"><button type="button" class="btn btn-danger btn-sm">Order has been cancelled</button></a>
                        </td>
                    </div>
                    <table class="table  table-striped table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Total order</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Act</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td>{{$loop->parent->iteration}}</td>
                                    <td>{{ $item->productVariant->product->product_name ?? 'N/A' }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>
                                        <span class="text text-primary">
                                            {{ $order->status->status_name}}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('orderDetail', ['order' => $order->id]) }}">
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#orderDetail">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- product cards -->

@endsection
