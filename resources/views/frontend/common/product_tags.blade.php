@php

$tags_en = App\Models\Product::groupBy('product_tags_en')->select('product_tags_en')->get();

@endphp




     <div class="sidebar-widget product-tag wow fadeInUp">
          <h3 class="section-title">Product tags</h3>
          <div class="sidebar-widget-body outer-top-xs">

<div class="tag-list">


@foreach($tags_en as $tag)
    @php
    $str= explode(',',$tag->product_tags_en);
 @endphp

            @foreach($str as $s)
            <a class="item active" title="Phone" href="{{ url('product/tag/'.$tag->product_tags_en) }}">{{$s}}</a>
            @endforeach

@endforeach


	 </div>
<!-- /.tag-list -->
</div>
          <!-- /.sidebar-widget-body -->
        </div>
        <!-- /.sidebar-widget -->
