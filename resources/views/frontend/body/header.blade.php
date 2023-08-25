<header class="header-style-1">


    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-2 logo-holder">

                    @php
                        $setting = App\Models\SiteSetting::find(1);
                    @endphp


                            <!-- ============================================================= LOGO ============================================================= -->
                    <div class="logo"><a href="{{ url('/') }}"> <img src="{{url($setting->logo)}}" alt="logo"> </a></div>
                    <!-- /.logo -->
                    <!-- ============================================================= LOGO : END ============================================================= -->
                </div>
                <!-- /.logo-holder -->

                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                    <!-- /.contact-row -->
                    <!-- ============================================================= SEARCH AREA ============================================================= -->
                    <div class="search-area">
                        <form method="post" action="#">
                            @csrf
                            <div class="control-group">

                                <input class="search-field" onfocus="search_result_show()" onblur="search_result_hide()"
                                       id="search" name="search" placeholder="Search product..."/>
                                <button class="search-button" type="submit"></button>
                            </div>
                        </form>
                        <div id="searchProducts"></div>
                    </div>

                    <!-- /.search-area -->
                    <!-- ============================================================= SEARCH AREA : END ============================================================= -->
                </div>
                <!-- /.top-search-holder -->

                <div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row">


                    <!-- ===== === SHOPPING CART DROPDOWN ===== == -->

                    <div class="dropdown dropdown-cart">

                        <div class="header-top-right">

                            @if(\Illuminate\Support\Facades\Auth::check())
                                <div class="topbar-link">
                                    <a href="{{route('user.dashboard')}}">
                                        <div class="topbar-link-toggle "></div>
                                    </a>
                                    <div class="topbar-link-wrapper">

                                        <div class="header-menu-links">
                                            <a href="{{route('user.dashboard')}}"
                                               class="header-link">{{\Illuminate\Support\Facades\Auth::user()->name}}</a><br>
                                            <a href="{{route('my.orders')}}" class="header-link"> My Order</a><br>
                                            <a href="{{route('user.logout')}}" class="header-link"> Logout</a>


                                        </div>
                                    </div>
                                </div>
                                <a class="whislist-counter" href="{{route('get.wishlist')}}">
                                    <div class="whislist-label"></div>
                                </a>
                        </div>
                        @else
                            <div class="topbar-link">
                                <a href="/login">
                                    <div class="topbar-link-toggle "></div>
                                </a>
                                <div class="topbar-link-wrapper">
                                    <div class="header-menu-links">
                                        <a href="/register"
                                           class="header-link text-decoration-none text-dark font-bold">
                                            Register
                                        </a>
                                    </div>
                                    <div class="header-menu-links">
                                        or
                                        <a href="/login" class="header-link text-decoration-none text-dark font-bold">
                                            Login
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <a class="whislist-counter" href="{{route('get.wishlist')}}">
                                <div class="whislist-label"></div>
                            </a>
                    </div>
                    @endif


                    <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">

                        <div class="items-cart-inner">
                            <div class="basket">
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                            </div>
                            <div class="basket-item-count"><span class="count" id="cartQty"></span></div>
                            <div class="total-price-basket"><span class="lbl">Cart-</span>
                                <span class="total-price"> <span class="sign"></span>
                <span class="value" id="cartSubTotal"></span> </span></div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <!--   // Mini Cart Start with Ajax -->

                            <div id="miniCart">

                            </div>

                            <!--   // End Mini Cart Start with Ajax -->


                            <div class="clearfix cart-total">
                                <div class="pull-right"><span class="text">Sub Total:</span>
                                    <span class='price' id="cartSubTotal">  </span></div>
                                <div class="clearfix"></div>
                                <a href="{{route('mycart')}}" class="btn btn-upper btn-primary btn-block m-t-20">View my
                                    cart</a>
                                <a href="{{route('checkout')}}" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>
                            </div>
                            <!-- /.cart-total-->

                        </li>
                    </ul>
                    <!-- /.dropdown-menu-->
                </div>
                <!-- /.dropdown-cart -->

                <!-- == === SHOPPING CART DROPDOWN : END=== === --> </div>

            <!-- /.top-cart-row -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    </div>
    <!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <div class="yamm navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                            class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                                class="icon-bar"></span> <span class="icon-bar"></span></button>
                </div>
                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            <ul class="nav navbar-nav">
                                <li class="active dropdown yamm-fw"><a href="home.html" data-hover="dropdown"
                                                                       class="dropdown-toggle" data-toggle="dropdown">Home</a>
                                </li>
                                @php

                                    $categories = App\Models\Category::orderBy('category_name_en','ASC')->take(4)->get();
                                    $subcat = \Illuminate\Support\Facades\DB::table('sub_categories')
                 ->select('category_id', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
                 ->groupBy('category_id')
                 ->orderBy('total','DESC')
                 -> take(4)
                 ->get();


                                @endphp
                                @foreach($subcat as $cat)
                                    @php
                                        $category = \App\Models\Category::findOrFail($cat-> category_id);
                                    @endphp
                                    <li class="dropdown yamm mega-menu"><a href="home.html" data-hover="dropdown"
                                                                           class="dropdown-toggle"
                                                                           data-toggle="dropdown">{{$category-> category_name_en}}</a>
                                        <ul class="dropdown-menu container">
                                            <li>
                                                <div class="yamm-content ">
                                                    <div class="row">
                                                        @php
                                                            $subcategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name_en','ASC')->get();
                                                        @endphp
                                                        @foreach($subcategories as $subcategory)
                                                            <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                                <a href="{{ url('subcategory/product/'.$subcategory->id) }}">
                                                                    <h2 class="title">{{ $subcategory->subcategory_name_en }}</h2></a>
                                                                <ul class="links">
                                                                    @php
                                                                        $subsubcategories = App\Models\SubSubCategory::where('subcategory_id',$subcategory->id)->orderBy('subsubcategory_name_en','ASC')->get();
                                                                    @endphp
                                                                    @foreach($subsubcategories as $subsubcategory)
                                                                        <li>
                                                                            <a href="{{ url('subsubcategory/product/'.$subsubcategory->id) }}"> {{ $subsubcategory->subsubcategory_name_en }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endforeach
                                                        <!-- /.col -->


                                                        <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image">
                                                            <img class="img-responsive"
                                                                 src="{{asset($category-> category_icon)}}" alt="">
                                                        </div>
                                                        <!-- /.yamm-content -->
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                @endforeach

                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-hover="dropdown"
                                                        data-toggle="dropdown">Blog</a>
                                    <ul class="dropdown-menu pages">
                                        <li>
                                            <div class="yamm-content">
                                                <div class="row">
                                                    <div class="col-xs-12 col-menu">
                                                        @php
                                                        $blogs = \App\Models\BlogPostCategories::orderBy('blog_category_name_en','ASC')-> get();
                                                                @endphp
                                                        <ul class="links">
                                                            @foreach($blogs as $blog)
                                                            <li><a href="blog.html">{{$blog->blog_category_name_en}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown hidden-sm"><a href="category.html">About Us </a></li>
                                <li class="dropdown hidden-sm"><a href="category.html">Contact Us</a></li>


                                <li class="dropdown  navbar-right special-menu"><a href="#">Call Us
                                        : {{$setting-> phone_one}}</a> </li>
                            </ul>
                            <!-- /.navbar-nav -->
                            <div class="clearfix"></div>
                        </div>
                        <!-- /.nav-outer -->
                    </div>
                    <!-- /.navbar-collapse -->

                </div>
                <!-- /.nav-bg-class -->
            </div>
            <!-- /.navbar-default -->
        </div>
        <!-- /.container-class -->

    </div>
    <!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

    <!-- Order Traking Modal -->
    <div class="modal fade" id="ordertraking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Track Your Order </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="#">
                        @csrf
                        <div class="modal-body">
                            <label>Invoice Code</label>
                            <input type="text" name="code" required="" class="form-control" placeholder="Your Order Invoice Number">
                        </div>

                        <button class="btn btn-danger" type="submit" style="margin-left: 17px;"> Track Now </button>

                    </form>


                </div>

            </div>
        </div>
    </div>


</header>


<style>

    .search-area{
        position: relative;
    }

    #searchProducts {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: #ffffff;
        z-index: 999;
        border-radius: 8px;
        margin-top: 5px;
    }


</style>


<script>
    function search_result_hide(){
        $("#searchProducts").slideUp();
    }

    function search_result_show(){
        $("#searchProducts").slideDown();
    }


</script>
