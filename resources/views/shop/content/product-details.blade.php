@extends('shop.layout.master')
@section('title', 'Product Detail')

@section('content')

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area breadcrumbs_product" style="margin-top: 100px">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="">home</a></li>
                            <li><a href="">shop</a></li>
                            <li>{{$title}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--product details start-->
    <section class="product_details mb-135">
        <div class="container">
            <form action="{{ route('products.add-to-cart.post', $product->id) }}" method="POST">
                @csrf
                <div class="row align-items-center">
                    @foreach($variants as $variant )
                        @if($loop->first)
                            <div class="col-lg-6 col-md-6">
                            <div class="product_zoom_gallery">
                               <div class="zoom_gallery_inner d-flex">
                                   <div class="zoom_tab_img">
                                       @foreach($variant->images as $image)
                                           @if($image->is_primary == 1)
                                               <a class="zoom_tabimg_list" href="javascript:void(0)">
                                                   <img src="{{ asset(\Illuminate\Support\Facades\Storage::url('images/') . $image->url) }}" alt="tab-thumb">
                                               </a>
                                           @endif
                                       @endforeach
                                   </div>
                                   <div class="product_zoom_main_img">
                                        <div class="product_zoom_thumb">
                                            <img data-image=""
                                                 src="{{ asset(\Illuminate\Support\Facades\Storage::url('images/') . $image->url) }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="product_d_right">
                                <input type="hidden" name="product_id" value="{{ $variant->product->id }}">
                                    <h1 class="product_name">{{$variant->product->product_name}}</h1>
                                    <div class="product_ratting_review d-flex align-items-center">
                                        <div class=" product_ratting">
                                            <ul class="d-flex">
                                                <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product_review">
                                            <ul class="d-flex">
                                                <li>4 reviews</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="price_box">
                                        <span class="current_price">{{$variant->price}}</span>
                                    </div>
                                    <div class="product_availalbe">
                                        <ul class="d-flex">
                                            <li><i class="icon-layers icons"></i> Only <span>15</span> left </li>
                                            <li>Availalbe: <span class="stock">In Stock</span></li>
                                            <li>SKU: <span id="demo"></span></li>
                                        </ul>
                                    </div>

                                    <div class="product_variant">
                                        <div class="filter__list widget_size d-flex align-items-center">
                                            <h3>Category</h3>
                                            <ul>
                                                @foreach($categories as $category)
                                                    <a href="javascript:void(0)">{{$category->category_name}}</a>
                                                @endforeach

                                            </ul>
                                        </div>
                                        <div class="filter__list widget_color d-flex align-items-center">
                                            <h3>select color</h3>
                                               <select id="color" name="color_id" onchange="selectColor()"
                                                       required style="position: relative; z-index: 10;">
                                                   @foreach($colors as $color)
                                                       <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                                   @endforeach
                                               </select>
                                        </div>
                                        <div class="filter__list widget_size d-flex align-items-center">
                                            <h3>select size</h3>
                                            <select id="size" name="size_id" required style="position: relative; z-index: 10;" >
                                                @foreach($sizes  as $size)
                                                    <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                                                @endforeach
                                            </select>
{{--                                            {{ $size->size_name }}--}}
                                        </div>

                                        <div class="variant_quantity_btn d-flex">
                                            <div class="pro-qty border">
                                                <input min="1" max="100" name="quantity" type="text" value="1">
                                            </div>
                                            <button class="button btn btn-primary" type="submit">
                                                <i class="ion-android-add"></i>
                                                    Add To Cart
                                            </button>
                                        </div>
                                    </div>
                                    <div class="priduct_social d-flex">
                                        <span>SHARE: </span>
                                        <ul>
                                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                            <li><a href="#"><i class="ion-social-googleplus-outline"></i></a></li>
                                            <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </form>
        </div>
    </section>
    <!--product details end-->
    <script>
        {{--const productVariants = @json($variantSizeColor);--}}
        function selectColor() {
            const selectedColorId = document.getElementById('color').value;
            const selectedSizeId = document.getElementById('size').value;

            document.getElementById('demo').innerHTML = 'color' + selectedColorId;


        }
    </script>

    <!--product info start-->
    <div class="product_d_info mb-118">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product_d_inner">
                        <div class="product_info_button border-bottom">
                            <ul class="nav" role="tablist">
                                <li >
                                    <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Product Description</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="info" role="tabpanel" >
                                <div class="product_info_content">
                                    {{$variant->product->description}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--product info end-->

    <!--product area start-->
    <section class="product_area related_products mb-118">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title mb-50">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="product_container row">
                <div class="product_container row">
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
    </section>
    <!--product area end-->
@endsection

