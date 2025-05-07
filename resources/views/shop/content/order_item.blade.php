@extends('shop.layout.master')
@section('title', 'Order Item Details')

@section('content')
    <!-- Massage Completed the order -->
    <div class="container" id="cart" style="margin-top: 150px; margin-bottom: 150px">

        <div class="row">
            <div class="text-center">
                <h3>Your order detail</h3>
                @if (session('error'))
                    <span class="text-danger">{{ session('error') }}</span>
                @endif
                @if (session('success'))
                    <span class="text-success">{{ session('success') }}</span>
                @endif
            </div>
        </div>
        <div class="mt=5">
        <span class="mt-5 text text-danger">

        </span>
        </div>
        <div class="card">
            <div class="row mt-5">
                <div class="card-body">
                    <table class="table  table-striped table-hover">
                        <!-- <div class="modal-body p-lg-4"> -->
                        <h5 class="">Order Detail</h5>
                        <hr>
                        <p>Order ID: {{ $order->id }}</p>
                        <p>Customer: {{ $order->receiver_name }}</p>
                        <p>Phone: {{ $order->receiver_phone }}</p>
                        <p>Address: {{ $order->receiver_address }}</p>
                        <p>Order Date: {{ $order->order_date }}</p>
                        <p>Status:
                            <span class="text text-primary">
                                {{ $order->status->status_name ?? 'Waiting for confirmation' }}
                            </span>
                        </p>
                        <hr>
                        <div class="row">
                            <h4 class="text">Product</h4>
                            <table class="table  table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Img</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->orderItems as $item)
                                        <tr>
                                            <td>
                                                <img width="70px" height="100px"
                                                     style="width: 100px;"
                                                     src="{{asset(\Illuminate\Support\Facades\Storage::url('images/'). $item->productVariant->images->first()->url ?? '#') }}" alt="">
                                            </td>
                                            <td>{{ $item->productVariant->product->product_name ?? 'N/A' }}</td>
                                            <td>$ {{ number_format($item->price, 2) }}</td>
                                            <td>
                                                {{ $item->quantity }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="text-md-end me-3">
                            <p class="text-danger text-2xl" style="margin-right: 155px">Total price: $ {{ number_format($order->total_amount, 2) }}</p>
                        </div>
                    </table>
                </div>
            </div>
            <div>
                <a href="{{route('orderHistory')}}">
                    <button style="margin-left: 1000px; margin-top: 10px;"
                                   type="button" class="btn btn-success">
                        Back
                    </button>
                </a>
{{--                Cancel order if status is wait for confirmation--}}
                @if($order->status_id == 1)
                    <form action="{{ route('order.cancel', ['order' => $order->id]) }}" method="POST" style="display: inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-primary mt-2">
                            Cancel the order
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

@endsection
