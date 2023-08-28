@php

    $categories = App\Models\Category::orderBy('category_name_en','ASC')->get();
@endphp


<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">


            @foreach($categories as $category)
                <li class="dropdown menu-item"><a href="{{route('list.product',$category->id)}}" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon {{ $category->category_icon }}" aria-hidden="true"></i>
                            {{ $category->category_name_en }}
                    </a>
                    <ul class="dropdown-menu mega-menu">
                        <li class="yamm-content">
                            <div class="row">

                                <!--   // Get SubCategory Table Data -->
                                @php
                                    $subcategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name_en','ASC')->get();
                                @endphp

                                @foreach($subcategories as $subcategory)
                                    <div class="col-sm-12 col-md-3">

                                        <a href="{{ url('subcategory/product/'.$subcategory->id ) }}">
                                            <h2 class="title">
                                                    {{ $subcategory->subcategory_name_en }}

                                            </h2></a>

                                        <!--   // Get SubSubCategory Table Data -->
                                        @php
                                            $subsubcategories = App\Models\SubSubCategory::where('subcategory_id',$subcategory->id)->orderBy('subsubcategory_name_en','ASC')->get();
                                        @endphp

                                        @foreach($subsubcategories as $subsubcategory)
                                            <ul class="links list-unstyled">
                                                <li>
                                                    <a href="{{ url('subsubcategory/product/'.$subsubcategory->id ) }}">

                                                            {{ $subsubcategory->subsubcategory_name_en }}
                                                       </a></li>

                                            </ul>
                                        @endforeach <!-- // End SubSubCategory Foreach -->

                                    </div>
                                    <!-- /.col -->
                                @endforeach  <!-- End SubCategory Foreach -->

                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- /.yamm-content -->
                    </ul>
                    <!-- /.dropdown-menu --> </li>
                <!-- /.menu-item -->
            @endforeach  <!-- End Category Foreach -->


        </ul>
        <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>
<div class="sidebar-module-container">
    <div class="sidebar-filter">

        <!-- ============================================== PRICE SILDER============================================== -->
        <div class="sidebar-widget wow fadeInUp">
            <div class="widget-header">
                <h4 class="widget-title">Price Slider</h4>
            </div>
            <div class="sidebar-widget-body m-t-10">
                <div class="price-range-holder"><span class="min-max"> <span class="pull-left">$200.00</span> <span
                            class="pull-right">$800.00</span> </span>
                    <input type="text" id="amount" style="border:0; color:#666666; font-weight:bold;text-align:center;">
                    <input type="text" class="price-slider" value="">
                </div>
                <!-- /.price-range-holder -->
                <a href="#" class="lnk btn btn-primary">Filter</a></div>
            <!-- /.sidebar-widget-body -->
        </div>
        <!-- /.sidebar-widget -->
        <!-- ============================================== PRICE SILDER : END ============================================== -->
        <!-- ============================================== MANUFACTURES============================================== -->
        <div class="sidebar-widget wow fadeInUp">
            <div class="widget-header">
                <h4 class="widget-title">Size</h4>
            </div>
            <div class="sidebar-widget-body">
                <ul class="list">
                    <li><a href="#">Small</a></li>
                    <li><a href="#">Medium</a></li>
                    <li><a href="#">Large</a></li>

                </ul>
                <!--<a href="#" class="lnk btn btn-primary">Show Now</a>-->
            </div>
            <!-- /.sidebar-widget-body -->
        </div>
        <!-- /.sidebar-widget -->
        <!-- ============================================== MANUFACTURES: END ============================================== -->
        <!-- ============================================== COLOR============================================== -->
        <div class="sidebar-widget wow fadeInUp">
            <div class="widget-header">
                <h4 class="widget-title">Colors</h4>
            </div>
            <div class="sidebar-widget-body">
                <ul class="list">
                    <li><a href="#">Red</a></li>
                    <li><a href="#">Blue</a></li>
                    <li><a href="#">Yellow</a></li>
                    <li><a href="#">Pink</a></li>
                    <li><a href="#">Brown</a></li>
                    <li><a href="#">Teal</a></li>
                </ul>
            </div>
            <!-- /.sidebar-widget-body -->
        </div>
        <!-- /.sidebar-widget -->
        <!-- ============================================== COLOR: END ============================================== -->
        <!-- ============================================== COMPARE============================================== -->
        <div class="sidebar-widget wow fadeInUp outer-top-vs">
            <h3 class="section-title">Compare products</h3>
            <div class="sidebar-widget-body">
                <div class="compare-report">
                    <p>You have no <span>item(s)</span> to compare</p>
                </div>
                <!-- /.compare-report -->
            </div>
            <!-- /.sidebar-widget-body -->
        </div>
        <!-- /.sidebar-widget -->
        <!-- ============================================== COMPARE: END ============================================== -->



    </div>
    <!-- /.sidebar-filter -->
</div>
