@extends('frontend.main_master')
@section('content')
    @section('title')
        All Product
    @endsection

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



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


                            <!-- == ====== PRODUCT TAGS ==== ======= -->
                            @include('frontend.common.product_tags')
                            <!-- /.sidebar-widget -->
                            <!-- == ====== END PRODUCT TAGS ==== ======= -->


                        </div>
                        <!-- /.sidebar-filter -->
                    </div>
                    <!-- /.sidebar-module-container -->
                </div>
                <!-- /.sidebar -->
                <div class='col-md-9'>


                    <!-- == ==== SECTION – HERO === ====== -->





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
                                    <div class="row" id="grid_view_product">


                                        @include('frontend.product.grid_view_product')


                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.category-product -->

                            </div>
                            <!-- /.tab-pane -->

                            <!--            //////////////////// END Product Grid View  ////////////// -->


                            <!--            //////////////////// Product List View Start ////////////// -->


                            <div class="tab-pane " id="list-container">
                                <div class="category-product" id="list_view_product">


                                    @include('frontend.product.list_view_product')



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


                <div class="ajax-loadmore-product text-center" style="display: none;">
                    <img src="{{ asset('frontend/assets/images/loader.svg') }}" style="width: 120px; height: 120px;">

                </div>


            </div>
            <!-- /.row -->
            @include('frontend.body.brands')
            <!-- /.container -->

        </div>
        <!-- /.body-content -->


        <script>
            function loadmoreProduct(page) {
                $.ajax({
                    type: "get",
                    url: "?page=" + page,
                    beforeSend: function (response) {

                        $('.ajax-loadmore-product').show();
                    }

                })


                    .done(function (data) {
                        if (data.grid_view == " " || data.list_view == " ") {
                            return;
                        }
                        $('.ajax-loadmore-product').hide();

                        $('#grid_view_product').append(data.grid_view);
                        $('#list_view_product').append(data.list_view);
                    })

                    .fail(function () {
                        alert('Something Went Wrong');
                    })

            }


            var page = 1;
            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                    page++;
                    loadmoreProduct(page);
                }

            });


        </script>

@endsection

