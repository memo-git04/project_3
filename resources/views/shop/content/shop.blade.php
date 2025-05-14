@extends('shop.layout.master')
@section('title', 'Shop')

@section('content')

<!--shop  area start-->
    <div class="shop_section shop_reverse">
        <div class="container" style="margin-top: 100px">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                   <!--sidebar widget start-->
                    <aside class="sidebar_widget">
                        <div class="widget_inner">
                            <div class="widget_list widget_categories">
                                <h2>Categories</h2>
                                <ul>
                                    @foreach($categories as $category)
                                        <li class="widget_sub_categories"><a href="javascript:void(0)" data-toggle="collapse" data-target="#women">{{$category->category_name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="widget_list widget_filter">
                                <h2>Filter By</h2>
                                 <div class="filter__list slider_range">
                                    <h3>price</h3>
                                    <form action="#">
                                        <div id="slider-range"></div>
                                        <span>Range:</span>
                                        <input type="text" name="text" id="amount" />
                                    </form>
                                 </div>

                                <div class="filter__list widget_size">
                                    <h3> size</h3>
                                    <ul>
                                        @foreach($sizes as $size)
                                            <li>
                                                <a href="javascript:void(0)">{{$size->size_name}} </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="filter__list widget_color">
                                    <h3>color</h3>
                                     <ul>
                                       <li>
                                            <input type="checkbox">
                                            <span class="checkmark color1"></span>
                                        </li>
                                        <li>
                                            <input type="checkbox">
                                            <span class="checkmark color2"></span>
                                        </li>
                                        <li>
                                            <input type="checkbox">
                                            <span class="checkmark color3"></span>
                                        </li>
                                        <li>
                                            <input type="checkbox">
                                            <span class="checkmark color4"></span>
                                        </li>
                                        <li>
                                            <input type="checkbox">
                                            <span class="checkmark color5"></span>
                                        </li>
                                        <li>
                                            <input type="checkbox">
                                            <span class="checkmark color6"></span>
                                        </li>

                                    </ul>
                                </div>
                                  <div class="filter__list widget_brands">
                                    <h3 data-toggle="collapse" data-target="#brands">brands</h3>
                                    <ul class="widget_dropdown_categories collapse show" id="brands">
                                        @foreach($brands as $brand)
                                            <li><a href="#"> {{$brand->brand_name}} <span>104</span></a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="widget_list">
                                <h2>Recent Product</h2>
                                <div class="recent_product">
                                    <div class="recent_product_list d-flex mb-25">
                                        <div class="recent_thumb">
                                            <a href=""><img src="{{asset('store/img/product/product4.jpg')}}" alt=""></a>
                                        </div>
                                        <div class="recent_content">
                                            <h4><a href="">Barbour T-shirt <br> International</a></h4>
                                            <span>$32.00</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </aside>
                    <!--sidebar widget end-->
                </div>
                <div class="col-lg-9 col-md-12">
                    <!--shop wrapper start-->

                    <!--breadcrumbs area start-->
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{route('home')}}">home</a></li>
                            <li>shop</li>
                        </ul>
                    </div>
                    <!--breadcrumbs area end-->

                    <div class="shop_banner d-flex align-items-center" data-bgimg="{{asset('store/img/bg/shop_bg.jpg')}}">
                        <div class="shop_banner_text">
                            <h2>essential <br> wears</h2>
                            <p>The collections basic items <br> essential for all girls</p>
                        </div>
                    </div>
                    <!--shop toolbar start-->
                    <div class="shop_toolbar_wrapper d-flex justify-content-between align-items-center">
                        <div class="page_amount">
                            <p><span>1.260</span> Products Found</p>
                        </div>
                        <div class=" sorting_by d-flex align-items-center">
                            <span>SORT BY :</span>
                            <form class="select_option" action="#">
                                <select name="orderby" id="short">

                                    <option selected value="1">NAME 3</option>
                                    <option  value="2">NAME  4</option>
                                    <option value="3">NAME  5</option>
                                    <option value="4">NAME  6</option>
                                    <option value="5">NAME  7</option>
                                    <option value="6">NAME  8</option>
                                </select>
                            </form>
                        </div>
                        <div class="toolbar_btn_wrapper d-flex align-items-center">
                            <div class="view_btn">
                                <a class="view" href="#">VIEW</a>
                            </div>
                            <div class="shop_toolbar_btn">
                                <ul class="d-flex align-items-center">
                                    <li><a href="#" class="active btn-grid-3" data-role="grid_3" data-tippy="3"  data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-placement="top"><i class="ion-grid"></i></a></li>

                                    <li><a href="#" class="btn-list" data-role="grid_list" data-tippy="List" data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-placement="top"><i class="ion-navicon"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                     <!--shop toolbar end-->
                     <div class="row shop_wrapper">
                         @foreach($variants as $variant)
                            <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        @foreach($variant->images as $image)
                                           @if($image->is_primary == 1)
                                                <a href="{{route('products.products-detail', $variant->product->id)}}" >
                                                    <img class="primary_img" src="{{ asset(\Illuminate\Support\Facades\Storage::url('images/') . $image->url) }}" alt="consectetur">
                                                </a>
                                            @endif
                                        @endforeach
                                        <div class="product_action">
                                            <ul>
                                                <li class="wishlist"><a href="#" data-tippy="Wishlist" data-tippy-inertia="true" data-tippy-delay="50"
                                                                        data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-heart icons"></i></a></li>

                                                <li class="quick_view"><a data-toggle="modal" data-target="#modal_box" data-tippy="Quick View" href="#" data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-size-fullscreen icons"></i></a></li>
                                                <li class="compare"><a data-tippy="Compare" href="#" data-tippy-inertia="true" data-tippy-delay="50"
                                                                       data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-refresh icons"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product_label">
                                            <span>-18%</span>
                                        </div>
                                    </div>
                                    <div class="product_content grid_content text-center">
                                        <div class="product_ratting">
                                            <ul class="d-flex justify-content-center">
                                                <li><a href="#"><i class="ion-android-star"></i></a></li>
                                                <li><a href="#"><i class="ion-android-star"></i></a></li>
                                                <li><a href="#"><i class="ion-android-star"></i></a></li>
                                                <li><a href="#"><i class="ion-android-star"></i></a></li>
                                                <li><a href="#"><i class="ion-android-star"></i></a></li>
                                                <li><span>(2)</span></li>
                                            </ul>
                                        </div>
                                        <h4 class="product_name"><a href="">{{$variant->product->product_name}}</a></h4>
                                        <div class="price_box">
                                            <span class="current_price">{{$variant->product->base_price}}</span>
                                            <span class="old_price">{{$variant->price}}</span>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="{{route('products.add-to-cart', $variant->product->id)}}" data-tippy="Add To Cart"  data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                        </div>
                                    </div>
                                    <div class="product_list_content">
                                        <h4 class="product_name"><a href="">{{$variant->product->product_name}}</a></h4>
                                        <p><a href="#">shows</a></p>
                                        <div class="price_box">
                                            <span class="current_price">{{$variant->product->base_price}}</span>
                                            <span class="old_price">{{$variant->price}}</span>
                                        </div>
                                        <div class="product_desc">
                                            <p>{{$variant->product->description}}</p>
                                        </div>
                                        <div class="add_to_cart">
                                            <a class="btn btn-primary" href="{{route('products.add-to-cart', $variant->product->id)}}" data-tippy="Add To Cart"
                                               data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-placement="top">
                                                Add To Cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         @endforeach
                    </div>
                    <div class="pagination_style pagination justify-content-center">
                        <ul class="d-flex">
                            {{ $variants->links() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--shop  area end-->

@endsection
