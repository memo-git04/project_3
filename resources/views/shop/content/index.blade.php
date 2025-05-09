@extends('shop.layout.master')
@section('title', 'Store')

@section('content')

    <!--slider area start-->
    <section class="slider_section mb-63">
        <div
            class="slider_area slick_slider_activation"
            data-slick='{
            "slidesToShow": 1,
            "slidesToScroll": 1,
            "arrows": true,
            "dots": true,
            "autoplay": false,
            "speed": 300,
            "infinite": true
        }'
        >
            <div
                class="single_slider d-flex align-items-center"
                data-bgimg="{{asset('store/img/slider/slider1.jpg')}}"
            >
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <div class="slider_text">
                                <span>Lookbook</span>
                                <h1>fashion trend for autum girls with vibes</h1>
                                <p>
                                    We love seeing how our Aslam wearers like <br />
                                    to wear their Norda
                                </p>
                                <a class="btn btn-primary" href="shop.html">Explore Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="single_slider d-flex align-items-center"
                data-bgimg="{{asset('store/img/slider/slider1.jpg')}}"
            >
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <div class="slider_text">
                                <span>Lookbook</span>
                                <h1>fashion trend for autum girls with vibes</h1>
                                <p>
                                    We love seeing how our Aslam wearers like <br />
                                    to wear their Norda
                                </p>
                                <a class="btn btn-primary" href="">Explore Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="single_slider d-flex align-items-center"
                data-bgimg="{{asset('store/img/slider/slider1.jpg')}}"
            >
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <div class="slider_text">
                                <span>Lookbook</span>
                                <h1>fashion trend for autum girls with vibes</h1>
                                <p>
                                    We love seeing how our Aslam wearers like <br />
                                    to wear their Norda
                                </p>
                                <a class="btn btn-primary" href="shop.html">Explore Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--slider area end-->

    <!--shipping section start-->
    <section class="shipping_section mb-102">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="shipping_inner d-flex justify-content-between">
                        <div class="single_shipping d-flex align-items-center">
                            <div class="shipping_icon">
                                <i class="icon-cursor icons"></i>
                            </div>
                            <div class="shipping_text">
                                <h3>Free Shipping</h3>
                                <p>Orders over $100</p>
                            </div>
                        </div>
                        <div class="single_shipping d-flex align-items-center">
                            <div class="shipping_icon">
                                <i class="icon-reload icons"></i>
                            </div>
                            <div class="shipping_text">
                                <h3>Free Returns</h3>
                                <p>Within 30 days</p>
                            </div>
                        </div>
                        <div class="single_shipping d-flex align-items-center">
                            <div class="shipping_icon">
                                <i class="icon-lock icons"></i>
                            </div>
                            <div class="shipping_text">
                                <h3>100% Payment Secure</h3>
                                <p>Payment Online</p>
                            </div>
                        </div>
                        <div class="single_shipping d-flex align-items-center">
                            <div class="shipping_icon">
                                <i class="icon-tag icons"></i>
                            </div>
                            <div class="shipping_text">
                                <h3>Affordable Price</h3>
                                <p>Guaranteed</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--shipping section end-->

    <!-- banner section start -->
    <section class="banner_section mb-109">
        <div class="container">
            <div class="section_title mb-60">
                <h2>featured collections</h2>
            </div>
            <div class="banner_container d-flex">
                <figure class="single_banner position-relative mr-30">
                    <img src="{{asset('store/img/bg/bg1.jpg')}}" alt="" />
                    <figcaption class="banner_text position-absolute">
                        <h3>
                            Zara Pattern <br />
                            backpacks
                        </h3>
                        <p>
                            Stretch, fresh-cool help you alway <br />
                            comfortable
                        </p>
                        <a class="btn btn-primary" href="{{route('shop')}}">Shop Now</a>
                    </figcaption>
                </figure>
                <figure class="single_banner position-relative">
                    <img src="{{asset('store/img/bg/bg1.jpg')}}" alt="" />
                    <figcaption class="banner_text position-absolute">
                        <h3 class="text-white">Basic Color Caps</h3>
                        <p class="text-white">
                            Minimalist never cool, choose and make <br />
                            the simple great again!
                        </p>
                    </figcaption>
                </figure>
            </div>
        </div>
    </section>
    <!-- banner section end -->

    <!-- product section start -->
    <section class="product_section mb-96">
        <div class="container">
            <div class="product_header d-flex justify-content-between mb-50">
                <div class="section_title">
                    <h2>best selling items</h2>
                </div>
            </div>
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
    </section>
    <!-- product section end -->

    <!-- banner section start -->



    <!-- banner section end -->

    <!-- product section start -->
    <section class="product_section mb-80">
        <div class="container">
            <div class="product_header d-flex justify-content-between mb-60">
                <div class="section_title">
                    <h2>new arrivals</h2>
                </div>
            </div>
            <div class="product_container row">

            </div>
        </div>
    </section>
    <!-- product section end -->

    <!-- blog section start -->
    <section class="blog_section mb-140">
        <div class="container">
            <div
                class="product_header border-top d-flex justify-content-between mb-60"
            >
                <div class="section_title">
                    <h2>press & look</h2>
                </div>
                <div class="all_articles">
                    <a href="">All articles</a>
                </div>
            </div>
            <div class="blog_container row">
                <div
                    class="blog_slick slick_slider_activation"
                    data-slick='{
                        "slidesToShow": 3,
                        "slidesToScroll": 1,
                        "arrows": false,
                        "dots": false,
                        "autoplay": false,
                        "speed": 300,
                        "infinite": true,
                        "responsive":[
                          {"breakpoint":992, "settings": { "slidesToShow": 2 } },
                          {"breakpoint":768, "settings": { "slidesToShow": 2 } },
                          {"breakpoint":576, "settings": { "slidesToShow": 1 } }
                        ]
                    }'
                >
                    <article class="col single_blog">
                        <figure>
                            <div class="blog_thumb">
                                <a href=""
                                ><img src="{{asset('store/img/blog/blog1.jpg')}}" alt=""
                                    /></a>
                            </div>
                            <figcaption class="blog_content">
                                <div class="blog_meta">
                                    <ul class="d-flex">
                                        <li><span class="meta_tag">News</span></li>
                                        <li><span>May 25, 2020</span></li>
                                    </ul>
                                </div>
                                <h3>
                                    <a href=""
                                    >Five things you only know if you’re at Chanel's Hamburg
                                        Show</a
                                    >
                                </h3>
                            </figcaption>
                        </figure>
                    </article>

                </div>
            </div>
        </div>
    </section>
    <!-- blog section end -->

@endsection
