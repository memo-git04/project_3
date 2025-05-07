@extends('shop.layout.master')
@section('title', 'Checkout')

@section('content')


<!--Checkout page section-->
    <div class="checkout_section" style="padding-top: 200px; margin-bottom: 50px" id="accordion">
       <div class="container" style="padding-bottom: 150px">
           <div class="row">
               <div class="text-center border-bottom">
                   <h3>Checkout</h3>
               </div>
           </div>
            <div class="returning_coupon_area">
                <div class="row">
                    <div class="col-lg-7 col-md-6">
                        <div class="user-actions">

                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">

                    </div>
                </div>
            </div>
            <div class="checkout_form">
                <div class="row">
                    <div class="col-lg-7 col-md-6">
                        <form action="{{ route('storeCheckout') }}" method="POST">
                            @csrf
                            <h3>Billing Details</h3>

                            <div class="checkout_form_input">
                                <label>Full Name <span>*</span></label>
                                <input type="text" name="fullname" value="{{session('customer.fullname')}}">
                            </div>

                            <div class="checkout_form_input">
                               <label>Email  <span>*</span></label>
                                <input type="text" name="email" value="{{session('customer.email')}}">
                            </div>

                            <div class="checkout_form_input">
                                <label>Address   <span>*</span></label>
                                <input  type="text" name="address" value="{{session('customer.address')}}">
                            </div>
                            <div class="checkout_form_input">
                                <label> Phone <span>*</span></label>
                                <input  type="text" name="phone" value="{{session('customer.phone')}}">
                            </div>

                            <label > Payment Method </label>
                            <div class="checkout_form_input mt-2">
                                <select class="form-select" name="payment" >
                                    <option  value="0">Mobile-banking</option>
                                    <option selected value="1">Payment on delivery</option>
                                </select>
                            </div>
                            <div class="float-end check-out__btn" style="float: inline-end">
                                <button style="width: 300px;" type="submit" name="checkout" class="btn btn-danger text-center">
                                    <i class="fa-solid fa-check me-2"></i>
                                         Place order
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="order_table_right">
                            <h3>Your order</h3>
                            <div class="order_table table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
{{--                                         @dd(session('cart') )--}}
                                        @foreach($cart as $item)
                                            <tr>
                                                <td>{{ $item['name'] }} ({{ $item['color_name'] }} - {{ $item['size_name'] }})</td>
                                                <td class="text-right">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td>Cart Subtotal  </td>
                                        <td class="text-right">${{ number_format(collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']), 2) }}</td>
                                    </tr>
                                    <tr class="order_total">
                                        <th>Order Total</th>
                                        <td class="text-right">${{ number_format(collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']), 2) }}</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Checkout page section end-->
@endsection
