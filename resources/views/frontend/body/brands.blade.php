@php
   $brands=  \App\Models\Brand::all();
 @endphp

<div id="brands-carousel" class="logo-slider wow fadeInUp">
    <div class="logo-slider-inner">
        <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
            @foreach($brands as $brand)
                <div class="item m-t-15"> <a href="#" class="image"> <img style="height: 150px; width: 150px" data-echo="{{ asset($brand-> brand_image) }}" src="{{ asset('frontend/assets/images/blank.gif') }}" alt=""> </a> </div>
                <!--/.item-->
            @endforeach

        </div>
        <!-- /.owl-carousel #logo-slider -->
    </div>
    <!-- /.logo-slider-inner -->

</div>
