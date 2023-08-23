<header class="header-style-1">


    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-2 logo-holder">

                    @php
                        $setting = App\Models\SiteSetting::find(1);
                    @endphp


                        <!-- ============================================================= LOGO ============================================================= -->
                    <div class="logo"> <a href="{{ url('/') }}"> <img src="{{$setting->logo}}" alt="logo"> </a> </div>
                    <!-- /.logo -->
                    <!-- ============================================================= LOGO : END ============================================================= --> </div>
                <!-- /.logo-holder -->

                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                    <!-- /.contact-row -->
                    <!-- ============================================================= SEARCH AREA ============================================================= -->
                    <div class="search-area">
                        <form method="post" action="#">
                            @csrf
                            <div class="control-group">

                                <input class="search-field" onfocus="search_result_show()" onblur="search_result_hide()" id="search" name="search" placeholder="Search product..." />
                                <button class="search-button" type="submit"></button> </div>
                        </form>
                        <div id="searchProducts"></div>
                    </div>

                    <!-- /.search-area -->
                    <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
                <!-- /.top-search-holder -->

                <div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row">


                    <!-- ===== === SHOPPING CART DROPDOWN ===== == -->

                    <div class="dropdown dropdown-cart">

                        <div class="header-top-right">

                                    @if(\Illuminate\Support\Facades\Auth::check())
                                <div class="topbar-link">
                                    <a  href="{{route('profile.show')}}">
                                        <div class="topbar-link-toggle "></div>
                                    </a>
                                    <div class="topbar-link-wrapper">

                                        <div class="header-menu-links">
                                            <a href="{{route('profile.show')}}" class="header-link">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>

                                            <form method="POST" class="header-link text-decoration-none text-dark font-bold" action="{{ route('logout') }}">
                                                @csrf

                                                <a class="header-link text-decoration-none text-dark font-bold" href="{{ route('logout') }}"
                                                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                    {{ __('Logout') }}
                                                </a>
                                            </form>

                                        </div>
                                </div>
                            </div>
                            <a class="whislist-counter" href="{{route('get.wishlist')}}">
                                <div class="whislist-label"></div>
                            </a>
                        </div>
                                    @else
                            <div class="topbar-link">
                                <a  href="/login">
                                    <div class="topbar-link-toggle "></div>
                                </a>
                                <div class="topbar-link-wrapper">
                                        <div class="header-menu-links">
                                            <a href="/register" class="header-link text-decoration-none text-dark font-bold">
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
                               <i class="glyphicon glyphicon-shopping-cart" ></i>
                                </div>
                                <div class="basket-item-count"><span class="count" id="cartQty"></span></div>
                                <div class="total-price-basket"> <span class="lbl">Cart-</span>
                                    <span class="total-price"> <span class="sign"></span>
                <span class="value" id="cartSubTotal"></span> </span> </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <!--   // Mini Cart Start with Ajax -->

                                <div id="miniCart">

                                </div>

                                <!--   // End Mini Cart Start with Ajax -->


                                <div class="clearfix cart-total">
                                    <div class="pull-right"> <span class="text">Sub Total:</span>
                                        <span class='price'  id="cartSubTotal">  </span> </div>
                                    <div class="clearfix"></div>
                                    <a href="{{route('mycart')}}" class="btn btn-upper btn-primary btn-block m-t-20">View my cart</a>
                                    <a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> </div>
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
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            <ul class="nav navbar-nav">
                                <li class="active dropdown yamm-fw"> <a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Home</a> </li>
                                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Shop</a>
                                    <ul class="dropdown-menu pages">
                                        <li>
                                            <div class="yamm-content">
                                                <div class="row">
                                                    <div class="col-xs-12 col-menu">
                                                        <ul class="links">
                                                            <li><a href="home.html">Home</a></li>
                                                            <li><a href="category.html">Category</a></li>
                                                            <li><a href="detail.html">Detail</a></li>
                                                            <li><a href="shopping-cart.html">Shopping Cart Summary</a></li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Blog</a>
                                    <ul class="dropdown-menu pages">
                                        <li>
                                            <div class="yamm-content">
                                                <div class="row">
                                                    <div class="col-xs-12 col-menu">
                                                        <ul class="links">
                                                            <li><a href="home.html">Home</a></li>
                                                            <li><a href="category.html">Category</a></li>
                                                            <li><a href="detail.html">Detail</a></li>
                                                            <li><a href="shopping-cart.html">Shopping Cart Summary</a></li>
                                                            <li><a href="checkout.html">Checkout</a></li>
                                                            <li><a href="blog.html">Blog</a></li>
                                                            <li><a href="blog-details.html">Blog Detail</a></li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown yamm mega-menu"> <a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Media<span class="menu-label new-menu hidden-xs">new</span></a>
                                    <ul class="dropdown-menu container">
                                        <li>
                                            <div class="yamm-content ">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                        <h2 class="title">Gallery</h2>
                                                        <ul class="links">
                                                            <li><a href="#">Dresses</a></li>
                                                            <li><a href="#">Shoes </a></li>
                                                            <li><a href="#">Jackets</a></li>
                                                            <li><a href="#">Sunglasses</a></li>
                                                            <li><a href="#">Sport Wear</a></li>
                                                            <li><a href="#">Blazers</a></li>
                                                            <li><a href="#">Shirts</a></li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.col -->

                                                    <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                        <h2 class="title">Portfolio</h2>
                                                        <ul class="links">
                                                            <li><a href="#">Handbags</a></li>
                                                            <li><a href="#">Jwellery</a></li>
                                                            <li><a href="#">Swimwear </a></li>
                                                            <li><a href="#">Tops</a></li>
                                                            <li><a href="#">Flats</a></li>
                                                            <li><a href="#">Shoes</a></li>
                                                            <li><a href="#">Winter Wear</a></li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.col -->
                                                    <!-- /.col -->

                                                    <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image"> <img class="img-responsive" src="assets/images/banners/top-menu-banner.jpg" alt=""> </div>
                                                    <!-- /.yamm-content -->
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown mega-menu">
                                    <a href="category.html"  data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Shortcode <span class="menu-label hot-menu hidden-xs">hot</span> </a>
                                    <ul class="dropdown-menu container">
                                        <li>
                                            <div class="yamm-content">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                                                        <h2 class="title">Shortcode Page</h2>
                                                        <ul class="links">
                                                            <li><a href="#">Gaming</a></li>
                                                            <li><a href="#">Laptop Skins</a></li>
                                                            <li><a href="#">Apple</a></li>
                                                            <li><a href="#">Dell</a></li>
                                                            <li><a href="#">Lenovo</a></li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.col -->

                                                    <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                                                        <h2 class="title">Shortcode Page</h2>
                                                        <ul class="links">
                                                            <li><a href="#">Routers & Modems</a></li>
                                                            <li><a href="#">CPUs, Processors</a></li>
                                                            <li><a href="#">PC Gaming Store</a></li>
                                                            <li><a href="#">Graphics Cards</a></li>

                                                        </ul>
                                                    </div>
                                                    <!-- /.col -->


                                                    <div class="col-xs-12 col-sm-12 col-md-4 col-menu custom-banner"> <a href="#"><img alt="" src="assets/images/banners/banner-side.png"></a> </div>
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.yamm-content --> </li>
                                    </ul>
                                </li>
                                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Pages</a>
                                    <ul class="dropdown-menu pages">
                                        <li>
                                            <div class="yamm-content">
                                                <div class="row">
                                                    <div class="col-xs-12 col-menu">
                                                        <ul class="links">
                                                            <li><a href="home.html">FAQs</a></li>
                                                            <li><a href="category.html">Sitemap</a></li>
                                                            <li><a href="detail.html">Typography</a></li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown hidden-sm"> <a href="category.html">About Us </a> </li>
                                <li class="dropdown hidden-sm"> <a href="category.html">Contact Us</a> </li>


                                <li class="dropdown  navbar-right special-menu"> <a href="#">Call Us : {{$setting-> phone_one}}</a> </li>
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
