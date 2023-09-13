@extends('frontend.main_master')
@section('content')
    @section('title')
        Sub - Subcategory Product
    @endsection

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    @foreach($breadsubsubcat as $item)
                        <li class='active'>{{ $item->category->category_name_en }}</li>
                    @endforeach

                    @foreach($breadsubsubcat as $item)
                        <li class='active'>{{ $item->subcategory->subcategory_name_en }}</li>
                    @endforeach

                    @foreach($breadsubsubcat as $item)
                        <li class='active'>{{ $item->subsubcategory_name_en }}</li>
                    @endforeach

                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row'>
                <div class='col-md-3 sidebar'>

                    <!-- ===== == TOP NAVIGATION ======= ==== -->
                    @include('frontend.common.vertical_menu')
                    <!-- = ==== TOP NAVIGATION : END === ===== -->


                    <div class="sidebar-module-container">
                        <div class="sidebar-filter">




                        </div>
                        <!-- /.sidebar-filter -->
                    </div>
                    <!-- /.sidebar-module-container -->
                </div>
                <!-- /.sidebar -->
                <div class='col-md-9'>


                    <!-- == ==== SECTION – HERO === ====== -->


                    @foreach($breadsubsubcat as $item)

                        <span class="badge badge-danger"
                              style="background: #808080">{{ $item->category->category_name_en }} </span>

                    @endforeach

                    @foreach($breadsubsubcat as $item)

                        <span class="badge badge-danger"
                              style="background: #808080">{{ $item->subcategory->subcategory_name_en }} </span>
                    @endforeach

                    @foreach($breadsubsubcat as $item)

                        <span class="badge badge-danger"
                              style="background: #FF0000">{{ $item->subsubcategory_name_en }} </span>
                    @endforeach


                    <div class="clearfix filters-container m-t-10">
                        <div class="row">
                            <div class="col col-sm-6 col-md-2">
                                <div class="filter-tabs">
                                    <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                        <li class="active"><a data-toggle="tab" href="#grid-container"><i
                                                    class="icon fa fa-th-large"></i>Grid</a></li>
                                        <li><a data-toggle="tab" href="#list-container"><i
                                                    class="icon fa fa-th-list"></i>List</a></li>
                                    </ul>
                                </div>
                                <!-- /.filter-tabs -->
                            </div>
                            <!-- /.col -->
                            <div class="col col-sm-12 col-md-6">
                                <div class="col col-sm-3 col-md-6 no-padding">
                                    <div class="lbl-cnt"><span class="lbl">Sort by</span>
                                        <div class="fld inline">
                                            <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                                <button data-toggle="dropdown" type="button"
                                                        class="btn dropdown-toggle"> Position <span
                                                        class="caret"></span></button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li role="presentation"><a href="#">position</a></li>
                                                    <li role="presentation"><a href="#">Price:Lowest first</a></li>
                                                    <li role="presentation"><a href="#">Price:Highest first</a></li>
                                                    <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- /.fld -->
                                    </div>
                                    <!-- /.lbl-cnt -->
                                </div>
                                <!-- /.col -->
{{--                                <div class="col col-sm-3 col-md-6 no-padding">--}}
{{--                                    <div class="lbl-cnt"><span class="lbl">Show</span>--}}
{{--                                        <div class="fld inline">--}}
{{--                                            <div class="dropdown dropdown-small dropdown-med dropdown-white inline">--}}
{{--                                                <button data-toggle="dropdown" type="button"--}}
{{--                                                        class="btn dropdown-toggle"> 1 <span class="caret"></span>--}}
{{--                                                </button>--}}
{{--                                                <ul role="menu" class="dropdown-menu">--}}
{{--                                                    <li role="presentation"><a href="#">1</a></li>--}}
{{--                                                    <li role="presentation"><a href="#">2</a></li>--}}
{{--                                                    <li role="presentation"><a href="#">3</a></li>--}}
{{--                                                    <li role="presentation"><a href="#">4</a></li>--}}
{{--                                                    <li role="presentation"><a href="#">5</a></li>--}}
{{--                                                    <li role="presentation"><a href="#">6</a></li>--}}
{{--                                                    <li role="presentation"><a href="#">7</a></li>--}}
{{--                                                    <li role="presentation"><a href="#">8</a></li>--}}
{{--                                                    <li role="presentation"><a href="#">9</a></li>--}}
{{--                                                    <li role="presentation"><a href="#">10</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!-- /.fld -->--}}
{{--                                    </div>--}}
{{--                                    <!-- /.lbl-cnt -->--}}
{{--                                </div>--}}
                                <!-- /.col -->
                            </div>
                            <!-- /.col -->
                            <div class="col col-sm-6 col-md-4 text-right">

                                <!-- /.pagination-container --> </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>


                    <!--    //////////////////// START Product Grid View  ////////////// -->

                    <div class="search-result-container ">
                        <div id="myTabContent" class="tab-content category-list">
                            <div class="tab-pane active " id="grid-container">
                                <div class="category-product">
                                    <div class="row">


                                        @foreach($products as $product)
                                            <div class="col-sm-6 col-md-4 wow fadeInUp">
                                                <div class="products">
                                                    <div class="product">
                                                        <div class="product-image">
                                                            <div class="image"><a
                                                                    href="{{ url('product/detail/'.$product->id ) }}"><img
                                                                        src="{{ asset($product->product_thumbnail) }}"
                                                                        alt=""></a></div>
                                                            <!-- /.image -->

                                                            @php
                                                                $amount = $product->selling_price - $product->discount_price;
                                                                $discount = ($amount/$product->selling_price) * 100;
                                                            @endphp

                                                            <div>
                                                                @if ($product->discount_price == NULL)
                                                                    <div class="tag new"><span>new</span></div>
                                                                @else
                                                                    <div class="tag hot">
                                                                        <span>{{ round($discount) }}%</span></div>
                                                                @endif
                                                            </div>


                                                        </div>
                                                        <!-- /.product-image -->

                                                        <div class="product-info text-left">
                                                            <h3 class="name"><a
                                                                    href="{{ url('product/detail/'.$product->id ) }}">
                                                                    {{ $product->product_name_en }} </a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="description"></div>


                                                            @if ($product->discount_price == NULL)
                                                                <div class="product-price"><span
                                                                        class="price"> ${{ $product->selling_price }} </span>
                                                                </div>

                                                            @else

                                                                <div class="product-price"><span
                                                                        class="price"> ${{ $product->discount_price }} </span>
                                                                    <span
                                                                        class="price-before-discount">$ {{ $product->selling_price }}</span>
                                                                </div>
                                                            @endif




                                                            <!-- /.product-price -->

                                                        </div>
                                                        <!-- /.product-info -->
                                                        <div class="cart clearfix animate-effect">
                                                            <div class="action">
                                                                <ul class="list-unstyled">
                                                                    <li class="add-cart-button btn-group">
                                                                        <button class="btn btn-primary icon"
                                                                                type="button"
                                                                                title="Add Cart" data-toggle="modal"
                                                                                data-target="#exampleModal"
                                                                                id="{{ $product->id }}"
                                                                                onclick="productView(this.id)"><i
                                                                                class="fa fa-shopping-cart"></i>
                                                                        </button>

                                                                    </li>
                                                                    <button class="btn btn-primary icon" type="button"
                                                                            title="Wishlist" id="{{ $product->id }}"
                                                                            onclick="addToWishList(this.id)"><i
                                                                            class="fa fa-heart"></i></button>


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


                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.category-product -->

                            </div>
                            <!-- /.tab-pane -->

                            <!--            //////////////////// END Product Grid View  ////////////// -->


                            <!--            //////////////////// Product List View Start ////////////// -->


                            <div class="tab-pane " id="list-container">
                                <div class="category-product">


                                    @foreach($products as $product)
                                        <div class="category-product-inner wow fadeInUp">
                                            <div class="products">
                                                <div class="product-list product">
                                                    <div class="row product-list-row">
                                                        <div class="col col-sm-4 col-lg-4">
                                                            <div class="product-image">
                                                                <div class="image"><img
                                                                        src="{{ asset($product->product_thumbnail) }}"
                                                                        alt=""></div>
                                                            </div>
                                                            <!-- /.product-image -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col col-sm-8 col-lg-8">
                                                            <div class="product-info">
                                                                <h3 class="name"><a
                                                                        href="{{ url('product/detail/'.$product->id ) }}">
                                                                        {{ $product->product_name_en }} </a></h3>
                                                                <div class="rating rateit-small"></div>


                                                                @if ($product->discount_price == NULL)
                                                                    <div class="product-price"><span
                                                                            class="price"> ${{ $product->selling_price }} </span>
                                                                    </div>
                                                                @else
                                                                    <div class="product-price"><span
                                                                            class="price"> ${{ $product->discount_price }} </span>
                                                                        <span
                                                                            class="price-before-discount">$ {{ $product->selling_price }}</span>
                                                                    </div>
                                                                @endif

                                                                <!-- /.product-price -->
                                                                <div class="description m-t-10">
                                                                    {{ $product->short_descp_en }} </div>
                                                                <div class="cart clearfix animate-effect">
                                                                    <div class="action">
                                                                        <ul class="list-unstyled">
                                                                            <li class="add-cart-button btn-group">
                                                                                <button class="btn btn-primary icon"
                                                                                        type="button"
                                                                                        title="Add Cart"
                                                                                        data-toggle="modal"
                                                                                        data-target="#exampleModal"
                                                                                        id="{{ $product->id }}"
                                                                                        onclick="productView(this.id)">
                                                                                    <i
                                                                                        class="fa fa-shopping-cart"></i>
                                                                                </button>

                                                                            </li>
                                                                            <button class="btn btn-primary icon"
                                                                                    type="button"
                                                                                    title="Wishlist"
                                                                                    id="{{ $product->id }}"
                                                                                    onclick="addToWishList(this.id)"><i
                                                                                    class="fa fa-heart"></i></button>


                                                                        </ul>
                                                                    </div>
                                                                    <!-- /.action -->
                                                                </div>
                                                                <!-- /.cart -->

                                                            </div>
                                                            <!-- /.product-info -->
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>


                                                    @php
                                                        $amount = $product->selling_price - $product->discount_price;
                                                        $discount = ($amount/$product->selling_price) * 100;
                                                    @endphp

                                                        <!-- /.product-list-row -->
                                                    <div>
                                                        @if ($product->discount_price == NULL)
                                                            <div class="tag new"><span>new</span></div>
                                                        @else
                                                            <div class="tag hot"><span>{{ round($discount) }}%</span>
                                                            </div>
                                                        @endif
                                                    </div>


                                                </div>
                                                <!-- /.product-list -->
                                            </div>
                                            <!-- /.products -->
                                        </div>
                                        <!-- /.category-product-inner -->
                                    @endforeach



                                    <!--            //////////////////// Product List View END ////////////// -->


                                </div>
                                <!-- /.category-product -->
                            </div>
                            <!-- /.tab-pane #list-container -->
                        </div>
                        <!-- /.tab-content -->
                        <div class="clearfix filters-container">
                            <div class="text-right">
                                <div class="pagination-container">
                                    <ul class="list-inline list-unstyled">
                                        {{ $products->links()  }}
                                    </ul>
                                    <!-- /.list-inline -->
                                </div>
                                <!-- /.pagination-container --> </div>
                            <!-- /.text-right -->

                        </div>
                        <!-- /.filters-container -->

                    </div>
                    <!-- /.search-result-container -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- /.logo-slider -->
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div>
        <!-- /.container -->

    </div>
    <!-- /.body-content -->

@endsection

