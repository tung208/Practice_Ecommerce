@extends('frontend.main_master')
@section('content')

    @section('title')
        Shopping Website
    @endsection


    <div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
            <div class="row">

                <!-- ============================================== CONTENT ============================================== -->
                <div class="col-xs-12 col-sm-12 col-md-12 homebanner-holder">
                    <!-- ========================================== SECTION – HERO ========================================= -->
                    @php
                        $sliders= App\Models\Slider::all();
                    @endphp
                    <div id="hero">
                        <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                            @foreach($sliders as $slider)
                                <div class="item"
                                     style="background-image: url({{$slider-> slider_img}}); float: right; width: 1140px  ">
                                    <div class="container-fluid">
                                        <div class="caption bg-color vertical-center text-left">
                                            <div
                                                class="slider-header fadeInDown-1">{{$slider-> short_description}}</div>
                                            <div class="big-text fadeInDown-1"> {{$slider-> description}} </div>
                                            <div class="excerpt fadeInDown-2 hidden-xs"><span>{{$slider-> title}}</span>
                                            </div>
                                            <div class="button-holder fadeInDown-3"><a
                                                    href="{{route('all.product')}}"
                                                    class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop
                                                    Now</a></div>
                                        </div>
                                        <!-- /.caption -->
                                    </div>
                                    <!-- /.container-fluid -->
                                </div>
                                <!-- /.item -->
                            @endforeach

                            <!-- /.item -->

                        </div>
                        <!-- /.owl-carousel -->
                    </div>

                    <!-- ========================================= SECTION – HERO : END ========================================= -->


                    <!-- ============================================== SCROLL TABS ============================================== -->
                    <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                        <div class="more-info-tab clearfix ">
                            <h3 class="new-product-title pull-left">Shop By Category</h3>
                        </div>

                        <!-- /.nav-tabs -->

                        @php
                            $category = \App\Models\Category::all();
                        @endphp


                        <div class="tab-content outer-top-xs">
                            <div class="tab-pane in active" id="all">
                                <div class="product-slider">

                                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="6">
                                        @foreach($category as $item)
                                            <div class="item item-carousel">
                                                <div class="products">
                                                    <div class="product">
                                                        <div class="product-image">
                                                            <div class="image"><a
                                                                    href="{{route('list.product',$item->id)}}"><img
                                                                        src="{{$item -> category_icon}}" alt=""></a>
                                                            </div>
                                                            <!-- /.image -->

                                                            {{--                                                    <div class="tag new"><span>new</span></div>--}}
                                                        </div>
                                                        <!-- /.product-image -->

                                                        <div class="product-info text-left">
                                                            <h3 class="name"><a
                                                                    href="{{route('list.product',$item->id)}}">{{$item -> category_name_en}}</a>
                                                            </h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="description"></div>
                                                            @php $count = \App\Models\Product::where('category_id',$item->id)-> get(); @endphp
                                                            <div class="product-price"><span class="price">({{count($count)}} items) </span> {{--<span class="price-before-discount">$ 800</span>--}}
                                                            </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                        <!-- /.product-info -->

                                                        <!-- /.cart -->
                                                    </div>
                                                    <!-- /.product -->

                                                </div>
                                                <!-- /.products -->
                                            </div>
                                            <!-- /.item -->
                                        @endforeach

                                        <!-- /.item -->


                                        <!-- /.item -->
                                    </div>
                                    <!-- /.home-owl-carousel -->
                                </div>
                                <!-- /.product-slider -->
                            </div>
                            <!-- /.tab-pane -->


                            <!-- ============================================== SCROLL TABS : END ============================================== -->
                            <!-- ============================================== WIDE PRODUCTS ============================================== -->
                            <div class="wide-banners wow fadeInUp outer-bottom-xs">
                                <h2 style="font-weight: bold">Deal Of The Day</h2>
                                @php
                                    $dealOfDay= \App\Models\Product::where('special_deals',1) ->get()-> take(2);
                                @endphp
                                <div class="row">

                                    @foreach($dealOfDay as $product)
                                        <div class="item item-carousel col-md-4 col-sm-4">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image"><a
                                                                href="{{route('product.detail',$product -> id)}}"><img
                                                                    src="{{$product-> product_thumbnail}}" alt=""></a>
                                                        </div>
                                                        <!-- /.image -->

                                                        <div class="tag hot"><span>sale</span></div>
                                                    </div>
                                                    <!-- /.product-image -->

                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a
                                                                href="{{route('product.detail',$product -> id)}}">{{$product-> product_name_en}}</a>
                                                        </h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="description"></div>
                                                        <div class="product-price"><span
                                                                class="price"> ${{$product-> discount_price}} </span>
                                                            <span
                                                                class="price-before-discount">${{$product-> selling_price}}</span>
                                                        </div>
                                                        <!-- /.product-price -->

                                                    </div>
                                                    <!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <li class="add-cart-button btn-group">
                                                                    <button class="btn btn-primary icon" type="button"
                                                                            title="Add Cart" data-toggle="modal"
                                                                            data-target="#exampleModal"
                                                                            id="{{ $product->id }}"
                                                                            onclick="productView(this.id)"><i
                                                                            class="fa fa-shopping-cart"></i></button>

                                                                </li>
                                                                <button class="btn btn-primary icon" type="button"
                                                                        title="Wishlist" id="{{ $product->id }}"
                                                                        onclick="addToWishList(this.id)"><i
                                                                        class="fa fa-heart"></i></button>

                                                                <li class="lnk"><a class="add-to-cart"
                                                                                   href="detail.html"
                                                                                   title="Compare"> <i
                                                                            class="fa fa-signal"
                                                                            aria-hidden="true"></i> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /.action -->
                                                    </div>
                                                    <!-- /.cart -->
                                                </div>
                                                <!-- /.product -->

                                            </div>
                                            <!-- /.products -->
                                        </div>

                                    @endforeach
                                    <!-- /.col -->
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.wide-banners -->

                            <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
                            <!-- ============================================== WIDE PRODUCTS ============================================== -->
                            <div class="wide-banners wow fadeInUp outer-bottom-xs">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="wide-banner cnt-strip">
                                            <div class="image"><a href="{{route('all.product')}}"><img
                                                        class="img-responsive"
                                                        src="{{asset('upload/products/banner2.png')}}"
                                                        alt=""></a></div>

                                            <div class="new-label">
                                                <div class="text">NEW</div>
                                            </div>
                                            <!-- /.new-label -->
                                        </div>
                                        <!-- /.wide-banner -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wide-banner cnt-strip">
                                            <div class="image"><a href="{{route('all.product')}}"><img
                                                        class="img-responsive"
                                                        src="{{asset('upload/products/banner1.png')}}"
                                                        alt=""></a></div>
                                            {{--                                    <div class="strip strip-text">--}}
                                            {{--                                        <div class="strip-inner">--}}
                                            {{--                                            <h2 class="text-right">New Mens Fashion<br>--}}
                                            {{--                                                <span class="shopping-needs">Save up to 40% off</span></h2>--}}
                                            {{--                                        </div>--}}
                                            {{--                                    </div>--}}
                                            <div class="new-label">
                                                <div class="text">NEW</div>
                                            </div>
                                            <!-- /.new-label -->
                                        </div>
                                        <!-- /.wide-banner -->
                                    </div>
                                    <!-- /.col -->

                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.wide-banners -->
                            <!-- ============================================== WIDE PRODUCTS : END ============================================== -->

                            <!-- ============================================== NEW PRODUCTS ============================================== -->
                            @php
                                $new_product = \App\Models\Product::orderBy('id','DESC')-> get() -> take(6);
                            @endphp
                            <section class="section featured-product wow fadeInUp">
                                <h3 class="section-title">New products</h3>
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                                    @foreach($new_product as $product)
                                        <div class="item item-carousel">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image"><a
                                                                href="{{route('product.detail',$product -> id)}}"><img
                                                                    src="{{$product-> product_thumbnail}}" alt=""></a>
                                                        </div>
                                                        <!-- /.image -->

                                                        <div class="tag new"><span>new</span></div>
                                                    </div>
                                                    <!-- /.product-image -->

                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a
                                                                href="{{route('product.detail',$product -> id)}}">{{$product-> product_name_en}}</a>
                                                        </h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="description"></div>
                                                        <div class="product-price"><span
                                                                class="price"> ${{$product-> discount_price}} </span>
                                                            <span
                                                                class="price-before-discount">${{$product-> selling_price}}</span>
                                                        </div>
                                                        <!-- /.product-price -->

                                                    </div>
                                                    <!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <li class="add-cart-button btn-group">
                                                                    <button class="btn btn-primary icon" type="button"
                                                                            title="Add Cart" data-toggle="modal"
                                                                            data-target="#exampleModal"
                                                                            id="{{ $product->id }}"
                                                                            onclick="productView(this.id)"><i
                                                                            class="fa fa-shopping-cart"></i></button>
                                                                </li>
                                                                <button class="btn btn-primary icon" type="button"
                                                                        title="Wishlist" id="{{ $product->id }}"
                                                                        onclick="addToWishList(this.id)"><i
                                                                        class="fa fa-heart"></i></button>

                                                                <li class="lnk"><a class="add-to-cart"
                                                                                   href="detail.html"
                                                                                   title="Compare"> <i
                                                                            class="fa fa-signal"
                                                                            aria-hidden="true"></i> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /.action -->
                                                    </div>
                                                    <!-- /.cart -->
                                                </div>
                                                <!-- /.product -->

                                            </div>
                                            <!-- /.products -->
                                        </div>
                                        <!-- /.item -->
                                    @endforeach

                                    <!-- /.products -->

                                    <!-- /.item -->
                                </div>
                                <!-- /.home-owl-carousel -->
                            </section>
                            <!-- /.section -->
                            <!-- ============================================== NEW PRODUCTS : END ============================================== -->

                            <!-- ============================================== Policy ============================================== -->

                            <div class="wide-banners wow fadeInUp outer-bottom-xs xxxxxxx">
                                <div class="row policy-banner">
                                    <div class="col-md-12">
                                        <div class="col-md-3" style="text-align: center; margin-top: 4%">
                                            <div><img class="policy_item" style="width: 100px; height: 100px"
                                                      src="{{asset('upload/free-delivery_4947265.png')}}"></div>
                                            <div>
                                                <h4 style="font-weight: bold">Fast Free Shipping</h4>
                                            </div>
                                            <div>
                                                <h5>On Orders $50 or More</h5>
                                            </div>


                                        </div>
                                        <div class="col-md-3" style="text-align: center; margin-top: 4%">
                                            <div><img class="policy_item" style="width: 100px; height: 100px"
                                                      src="{{asset('upload/customer-service_4947176.png')}}"></div>
                                            <div>
                                                <h4 style="font-weight: bold">Best Online Support</h4>
                                            </div>
                                            <div>
                                                <h5>24/7 amazing service</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="text-align: center; margin-top: 4%">
                                            <div><img class="policy_item" style="width: 100px; height: 100px"
                                                      src="{{asset('upload/cashback_4947118.png')}}"></div>
                                            <div>
                                                <h4 style="font-weight: bold">Easy Money Back</h4>
                                            </div>
                                            <div>
                                                <h5>Return With in 30 days</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-3"
                                             style="text-align: center; margin-top: 4%;border-radius: 50%">
                                            <div><img class="policy_item" style="width: 100px; height: 100px;"
                                                      src="{{asset('upload/discount.png')}}"></div>
                                            <div>
                                                <h4 style="font-weight: bold">Get 20% Off 1 Item</h4>
                                            </div>
                                            <div>
                                                <h5>When you First Sign up</h5>
                                            </div>
                                        </div>
                                        {{--                                        <div class="policy-banner">--}}
                                        {{--                                            <div class="image"><img class="img-responsive"--}}
                                        {{--                                                                    src="{{asset('upload/products/banner2.png')}}"--}}
                                        {{--                                                                    alt=""></div>--}}


                                        {{--                                            <!-- /.new-label -->--}}
                                        {{--                                        </div>--}}
                                        <!-- /.wide-banner -->
                                    </div>
                                </div>
                            </div>
                            <!-- /.wide-banners -->
                            <!-- ============================================== policy: END ============================================== -->


                            <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                            @php
                                $feature_product = \App\Models\Product::where('featured',1)-> get();
                            @endphp
                            <section class="section featured-product wow fadeInUp">
                                <h3 class="section-title">Featured products</h3>
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                                    @foreach($feature_product as $product)
                                        <div class="item item-carousel">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image"><a
                                                                href="{{route('product.detail',$product -> id)}}"><img
                                                                    src="{{$product-> product_thumbnail}}" alt=""></a>
                                                        </div>
                                                        <!-- /.image -->

                                                        <div class="tag hot"><span>hot</span></div>
                                                    </div>
                                                    <!-- /.product-image -->

                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a
                                                                href="{{route('product.detail',$product -> id)}}">{{$product-> product_name_en}}</a>
                                                        </h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="description"></div>
                                                        <div class="product-price"><span
                                                                class="price"> ${{$product-> discount_price}} </span>
                                                            <span
                                                                class="price-before-discount">${{$product-> selling_price}}</span>
                                                        </div>
                                                        <!-- /.product-price -->

                                                    </div>
                                                    <!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <li class="add-cart-button btn-group">
                                                                    <button class="btn btn-primary icon" type="button"
                                                                            title="Add To Cart" data-toggle="modal"
                                                                            data-target="#exampleModal"
                                                                            id="{{ $product->id }}"
                                                                            onclick="productView(this.id)"><i
                                                                            class="fa fa-shopping-cart"></i></button>

                                                                </li>
                                                                <button class="btn btn-primary icon" type="button"
                                                                        title="Wishlist" id="{{ $product->id }}"
                                                                        onclick="addToWishList(this.id)"><i
                                                                        class="fa fa-heart"></i></button>

                                                                <li class="lnk"><a class="add-to-cart"
                                                                                   href="detail.html"
                                                                                   title="Compare"> <i
                                                                            class="fa fa-signal"
                                                                            aria-hidden="true"></i> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /.action -->
                                                    </div>
                                                    <!-- /.cart -->
                                                </div>
                                                <!-- /.product -->

                                            </div>
                                            <!-- /.products -->
                                        </div>
                                        <!-- /.item -->
                                    @endforeach

                                    <!-- /.products -->

                                    <!-- /.item -->
                                </div>
                                <!-- /.home-owl-carousel -->
                            </section>
                            <!-- /.section -->
                            <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->


                            <!-- ============================================== BLOG SLIDER ============================================== -->
                            @php
                                $blogs = \App\Models\BlogPost::all();
                            @endphp

                            <section class="section latest-blog outer-bottom-vs wow fadeInUp">
                                <h3 class="section-title">From Our Blog</h3>
                                <div class="blog-slider-container outer-top-xs">
                                    <div class="owl-carousel blog-slider custom-carousel">
                                        @foreach($blogs as $blog)
                                            <div class="item">
                                                <div class="blog-post">
                                                    <div class="blog-post-image">
                                                        <div class="image"><a href="blog.html"><img
                                                                    src="{{asset($blog-> post_image)}}" alt=""></a>
                                                        </div>
                                                    </div>
                                                    <!-- /.blog-post-image -->

                                                    <div class="blog-post-info text-left">
                                                        <h3 class="name"><a href="#">{{$blog-> post_title_en}}</a></h3>
                                                        <span
                                                            class="info">&nbsp; {{date("F j, Y, g:i a",strtotime($blog -> updated_at))}} </span>
                                                        <p class="text">{!! Str::limit($blog-> post_details_en,100)!!}</p>
                                                        <a href="#" class="lnk btn btn-primary">Read more</a></div>
                                                    <!-- /.blog-post-info -->

                                                </div>
                                                <!-- /.blog-post -->
                                            </div>
                                            <!-- /.item -->
                                        @endforeach



                                        <!-- /.item -->

                                    </div>
                                    <!-- /.owl-carousel -->
                                </div>
                                <!-- /.blog-slider-container -->
                            </section>
                            <!-- /.section -->
                            <!-- ============================================== BLOG SLIDER : END ============================================== -->


                        </div>
                        <!-- /.homebanner-holder -->
                        <!-- ============================================== CONTENT : END ============================================== -->
                    </div>
                    <!-- /.row -->
                    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
                    @include('frontend.body.brands')
                    <!-- /.logo-slider -->
                    <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
                </div>
                <!-- /.container -->
            </div>
            <!-- /#top-banner-and-menu -->
@endsection
