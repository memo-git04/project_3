@extends('shop.layout.master')
@section('title', 'Cart')

@section('content')
      <!--breadcrumbs area start-->
    <div class="breadcrumbs_area breadcrumbs_other" style="margin-top: 50px">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content text-center">

                        <h3>Shopping Cart</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->
     <div class="text-center text-2xl">
         @if (!session()->has('cart') || count(session('cart')) == 0)
             <h3 class="text-success" style="margin-bottom: 200px">Your cart is empty. <a href="{{ route('shop') }}"><button>Continue shopping</button></a>.</h3>
         @else
     </div>
     <!--shopping cart area start -->
    <div class="shopping_cart_area">
        <div class="container">
            <form action="{{route('products.update_cart')}}" method="post">
                @method('PUT')
            @csrf
                <div class="cart_page_inner mb-60">
                    <div class="row">
                        <div class="col-12">
                            <div class="cart_page_tabel">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>product </th>
                                            <th>information</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <div class="hidden">{{$total = 0}}</div>
                                    @foreach($cart as $item)
{{--                                        {{dd($item)}}--}}

                                        <tr class="border-top">
                                            <td>
                                                <div class="cart_product_thumb">
                                                    <img src="{{ asset(\Illuminate\Support\Facades\Storage::url('images/') . $item['image']) }}" alt="">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="cart_product_text">
                                                    <h4>{{$item['name']}}</h4>
                                                    <ul>
                                                        <li><i class="ion-ios-arrow-right"></i> Color : <span>{{$item['color_name']}}</span></li>
                                                        <li><i class="ion-ios-arrow-right"></i> Size : <span>{{$item['size_name']}}</span></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="cart_product_price">
                                                    <span >{{$item['price']}}</span>
                                                </div>
                                            </td>
                                            <td class="product_quantity">
                                                <div class="cart_product_quantity">
                                                    <input min="1" max="100" value="{{$item['quantity']}}" type="number" name="quantity[{{$item['product_id']}}]">

                                                </div>
                                            </td>
                                            <td>
                                                <div class="cart_product_price">
                                                    <span>{{$item['price'] * $item['quantity']}}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="cart_product_remove text-right">
                                                    <a href="{{route('products.remove_a_product', $item['product_id'])}}"><i class="ion-android-close"></i></a>
                                                </div>
                                            </td>

                                        </tr>
                                        <div class="hidden">{{$total += $item['price'] * $item['quantity']}}</div>

                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="cart_page_button border-top d-flex justify-content-between">
                                <div class="shopping_cart_btn">
                                    <a href="{{route('products.remove_cart')}}" class="btn btn-primary border">CLEAR SHOPPING CART</a>
                                    <button class="btn btn-primary border" type="submit">UPDATE YOUR CART</button>
                                </div>
                                <div class="shopping_continue_btn">
                                    <a class="btn btn-primary" href="{{route('shop')}}">CONTINUE SHOPPING</a>
                                </div>
                            </div>
                         </div>
                     </div>
                 </div>
                 <!--coupon code area start-->
                <div class="cart_page_bottom">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="shopping_coupon_calculate">
                                <h3 class="border-bottom">Coupon Discount   </h3>
                                <p>Enter your coupon code if you have one.</p>
                                <form action="{{ route('cart.apply_coupon') }}" method="POST">
                                    @csrf
{{--                                    <input type="hidden" name="cart_total" value="{{ $total }}">--}}
                                    <input class="border" name="coupon_code" placeholder="Enter your code" type="text">
                                    <button class="btn btn-primary" type="submit">Apply Coupon</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-8">
                            <div class="grand_totall_area">
                               <div class="grand_totall_inner border-bottom">
                                   <div class="cart_subtotal d-flex justify-content-between">
                                       <p>sub total </p>
                                       <span>${{$total}}</span>
                                   </div>
                                   @if(session()->has('coupon'))
                                       <div class="cart_discount d-flex justify-content-between">
                                           <p>Discount ({{session('coupon')['code']}})</p>
                                           <span class="text-danger">-{{ session('coupon')['discount'] }}</span>
                                       </div>
                                       <div class="cart_grandtotal d-flex justify-content-between">
                                           <p>Final total</p>
                                           <span>${{ $total - session('coupon')['discount'] }}</span>
                                       </div>
                                   @else
                                       <div class="cart_grandtotal d-flex justify-content-between">
                                           <p>grand total</p>
                                           <span>${{$total}}</span>
                                       </div>
                                   @endif
                               </div>
                               <div class="proceed_checkout_btn">
                                   <a class="btn btn-primary" href="{{route('checkout')}}">Proceed to Checkout</a>
                               </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--coupon code area end-->
            </form>
        </div>
    </div>
     <!--shopping cart area end -->
        @endif

@endsection
