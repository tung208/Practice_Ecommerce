@extends('frontend.main_master')
@section('content')

    @section('title')
        {{ $product->product_name_en }} Details
    @endsection

    <style>
        .checked {
            color: orange;
        }

    </style>


    <!-- ===== ======== HEADER : END ============================================== -->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Product</a></li>
                    <li class='active'>{{ $product->product_name_en }}</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row single-product'>
                <div class='col-md-12'>
                    <div class="detail-block">
                        <div class="row  wow fadeInUp">

                            <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                <div class="product-item-holder size-big single-product-gallery small-gallery">

                                    <div id="owl-single-product">

                                        @foreach($multiImag as $img)
                                            <div class="single-product-gallery-item" id="slide{{ $img->id }}">
                                                <a data-lightbox="image-1" data-title="Gallery"
                                                   href="{{ asset($img->photo_name ) }} ">
                                                    <img class="img-responsive" alt=""
                                                         src="{{ asset($img->photo_name ) }} "
                                                         data-echo="{{ asset($img->photo_name ) }} "/>
                                                </a>
                                            </div><!-- /.single-product-gallery-item -->
                                        @endforeach


                                    </div><!-- /.single-product-slider -->


                                    <div class="single-product-gallery-thumbs gallery-thumbs">

                                        <div id="owl-single-product-thumbnails">

                                            @foreach($multiImag as $img)
                                                <div class="item">
                                                    <a class="horizontal-thumb active" data-target="#owl-single-product"
                                                       data-slide="1" href="#slide{{ $img->id }}">
                                                        <img class="img-responsive" width="85" alt=""
                                                             src="{{ asset($img->photo_name ) }} "
                                                             data-echo="{{ asset($img->photo_name ) }} "/>
                                                    </a>
                                                </div>
                                            @endforeach


                                        </div><!-- /#owl-single-product-thumbnails -->


                                    </div><!-- /.gallery-thumbs -->

                                </div><!-- /.single-product-gallery -->
                            </div><!-- /.gallery-holder -->




                            <div class='col-sm-6 col-md-7 product-info-block'>
                                <div class="product-info">


                                    <h1 class="name" id="pname">
                                        {{ $product->product_name_en }}
                                    </h1>

                                    <div class="rating-reviews m-t-20">
                                        <div class="row">
                                            <div class="col-sm-3">

                                                @if($avarage == 0)
                                                    No Rating Yet
                                                @elseif($avarage == 1 || $avarage < 2)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                @elseif($avarage == 2 || $avarage < 3)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                @elseif($avarage == 3 || $avarage < 4)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>

                                                @elseif($avarage == 4 || $avarage < 5)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                @elseif($avarage == 5 || $avarage < 5)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                @endif


                                            </div>


                                            <div class="col-sm-8">
                                                <div class="reviews">
                                                    <a href="#" class="lnk">({{ count($reviewcount) }} Reviews)</a>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.rating-reviews -->

                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label">Availability :</span>
                                                </div>
                                            </div>
                                            @if($product->product_qty>0)
                                                <div class="col-sm-9">
                                                    <div class="stock-box">
                                                        <span class="value">{{$product->product_qty}} In Stock</span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-sm-9">
                                                    <div class="stock-box">
                                                        <span class="out-stock">Out of Stock</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div><!-- /.row -->
                                    </div><!-- /.stock-container -->

                                    <div class="description-container m-t-20">
                                        {{ $product->short_descp_en }}
                                    </div><!-- /.description-container -->

                                    <div class="price-container info-container m-t-20">
                                        <div class="row">


                                            <div class="col-sm-6">
                                                <div class="price-box">
                                                    @if ($product->discount_price == NULL)
                                                        <span class="price">${{ $product->selling_price }}</span>
                                                    @else
                                                        <span class="price">${{ $product->discount_price }}</span>
                                                        <span class="price-strike">${{ $product->selling_price }}</span>
                                                    @endif


                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="favorite-button m-t-10">
                                                    <button class="btn btn-primary icon" type="button"
                                                            title="Wishlist" id="{{ $product->id }}"
                                                            onclick="addToWishList(this.id)"><i
                                                            class="fa fa-heart"></i></button>
                                                    <a class="btn btn-primary" data-toggle="tooltip"
                                                       data-placement="right" title="Add to Compare" href="#">
                                                        <i class="fa fa-signal"></i>
                                                    </a>
                                                    <a class="btn btn-primary" data-toggle="tooltip"
                                                       data-placement="right" title="E-mail" href="#">
                                                        <i class="fa fa-envelope"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </div><!-- /.row -->
                                    </div><!-- /.price-container -->


                                    <!--     /// Add Product Color And Product Size ///// -->

                                    <div class="row">


                                        <div class="col-sm-6">

                                            <div class="form-group">

                                                <label class="info-title control-label">Choose Color
                                                    <span> </span></label>
                                                <select class="form-control unicase-form-control selectpicker"
                                                        style="display: none;" id="color">
                                                    @foreach($product_color_en as $color)
                                                        <option value="{{ $color }}">{{ ucwords($color) }}</option>
                                                    @endforeach
                                                </select>

                                            </div> <!-- // end form group -->

                                        </div> <!-- // end col 6 -->

                                        <div class="col-sm-6">

                                            <div class="form-group">
                                                @if($product->product_size_en == null)

                                                @else

                                                    <label class="info-title control-label">Choose Size
                                                        <span> </span></label>
                                                    <select class="form-control unicase-form-control selectpicker"
                                                            style="display: none;" id="size">
                                                        @foreach($product_size_en as $size)
                                                            <option value="{{ $size }}">{{ ucwords($size) }}</option>
                                                        @endforeach
                                                    </select>

                                                @endif

                                            </div> <!-- // end form group -->


                                        </div> <!-- // end col 6 -->

                                    </div><!-- /.row -->


                                    <!--     /// End Add Product Color And Product Size ///// -->


                                    <div class="quantity-container info-container">
                                        <div class="row">

                                            <div class="col-sm-2">
                                                <span class="label">Quantity :</span>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="cart-quantity">
                                                    <div class="quant-input">
                                                        <div class="arrows">
                                                            <div class="arrow plus gradient"><span class="ir"><i
                                                                        class="icon fa fa-sort-asc" onclick="upClick()"></i></span></div>
                                                            <div class="arrow minus gradient"><span class="ir"><i
                                                                        class="icon fa fa-sort-desc" onclick="downClick()"></i></span></div>
                                                        </div>
                                                        <input type="number" id="qty" value="1" min="1">
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" id="product_id" value="{{ $product->id }}" min="1">
                                            @if($product->product_qty>0)
                                            <div class="col-sm-7">
                                                <button type="submit" class="btn btn-primary mb-2" id="product_id"
                                                        onclick="addToCart(this.id)">Add to Cart
                                                </button>
                                            </div>
                                            @endif


                                        </div><!-- /.row -->
                                    </div><!-- /.quantity-container -->


                                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                    <div class="addthis_inline_share_toolbox_8tvu"></div>


                                </div><!-- /.product-info -->
                            </div><!-- /.col-sm-7 -->
                        </div><!-- /.row -->
                    </div>

                    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                        <div class="row">
                            <div class="col-sm-3">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                    <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                    <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                                </ul><!-- /.nav-tabs #product-tabs -->
                            </div>
                            <div class="col-sm-9">

                                <div class="tab-content">

                                    <div id="description" class="tab-pane in active">
                                        <div class="product-tab">
                                            <p class="text">{!! $product->long_descp_en !!}</p>
                                        </div>
                                    </div><!-- /.tab-pane -->

                                    <div id="review" class="tab-pane">
                                        <div class="product-tab">

                                            <div class="product-reviews">
                                                <h4 class="title">Customer Reviews</h4>



                                                <div class="reviews">

                                                    @foreach($reviews as $item)
                                                        @if($item->status == 0)

                                                        @else

                                                            <div class="review">

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <img style="border-radius: 50%"
                                                                             src="{{ (!empty($item->user->profile_photo_path))? url('storage/'.$item->user->profile_photo_path):url('upload/no_image.jpg') }}"
                                                                             width="40px;"
                                                                             height="40px;"><b> {{ $item->user->name }}</b>


                                                                        @if($item->rating == NULL)

                                                                        @elseif($item->rating == 1)
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                        @elseif($item->rating == 2)
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>

                                                                        @elseif($item->rating == 3)
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>

                                                                        @elseif($item->rating == 4)
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star"></span>
                                                                        @elseif($item->rating == 5)
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>
                                                                            <span class="fa fa-star checked"></span>

                                                                        @endif


                                                                    </div>

                                                                    <div class="col-md-6">

                                                                    </div>
                                                                </div> <!-- // end row -->


                                                                <div class="review-title"><span
                                                                        class="summary">{{ $item->summary }}</span><span
                                                                        class="date"><i
                                                                            class="fa fa-calendar"></i><span> {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </span></span>
                                                                </div>
                                                                <div class="text">"{{ $item->comment }}"</div>
                                                            </div>

                                                        @endif
                                                    @endforeach
                                                </div><!-- /.reviews -->


                                            </div><!-- /.product-reviews -->


                                            <div class="product-add-review">
                                                <h4 class="title">Write your own review</h4>
                                                <div class="review-table">

                                                </div><!-- /.review-table -->

                                                <div class="review-form">
                                                    @if(\Illuminate\Support\Facades\Auth::check()== false)
                                                        <p><b> For Add Product Review. You Need to Login First <a
                                                                    href="{{ route('login') }}">Login Here</a> </b></p>

                                                    @else

                                                        <div class="form-container">

                                                            <form role="form" class="cnt-form" method="post"
                                                                  action="{{ route('review.store') }}">
                                                                @csrf

                                                                <input type="hidden" name="product_id"
                                                                       value="{{ $product->id }}">


                                                                <table class="table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th class="cell-label">&nbsp;</th>
                                                                        <th>1 star</th>
                                                                        <th>2 stars</th>
                                                                        <th>3 stars</th>
                                                                        <th>4 stars</th>
                                                                        <th>5 stars</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td class="cell-label">Quality</td>
                                                                        <td><input type="radio" name="quality"
                                                                                   class="radio" value="1"></td>
                                                                        <td><input type="radio" name="quality"
                                                                                   class="radio" value="2"></td>
                                                                        <td><input type="radio" name="quality"
                                                                                   class="radio" value="3"></td>
                                                                        <td><input type="radio" name="quality"
                                                                                   class="radio" value="4"></td>
                                                                        <td><input type="radio" name="quality"
                                                                                   class="radio" value="5"></td>
                                                                    </tr>

                                                                    </tbody>
                                                                </table>


                                                                <div class="row">
                                                                    <div class="col-sm-6">

                                                                        <div class="form-group">
                                                                            <label for="exampleInputSummary">Summary
                                                                                <span class="astk">*</span></label>
                                                                            <input type="text" name="summary"
                                                                                   class="form-control txt"
                                                                                   id="exampleInputSummary"
                                                                                   placeholder="">
                                                                        </div><!-- /.form-group -->
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputReview">Review <span
                                                                                    class="astk">*</span></label>
                                                                            <textarea
                                                                                class="form-control txt txt-review"
                                                                                name="comment" id="exampleInputReview"
                                                                                rows="4" placeholder=""></textarea>
                                                                        </div><!-- /.form-group -->
                                                                    </div>
                                                                </div><!-- /.row -->

                                                                <div class="action text-right">
                                                                    <button type="submit"
                                                                            class="btn btn-primary btn-upper">SUBMIT
                                                                        REVIEW
                                                                    </button>
                                                                </div><!-- /.action -->

                                                            </form><!-- /.cnt-form -->
                                                        </div><!-- /.form-container -->

                                                    @endif


                                                </div><!-- /.review-form -->

                                            </div><!-- /.product-add-review -->

                                        </div><!-- /.product-tab -->
                                    </div><!-- /.tab-pane -->


                                </div><!-- /.tab-content -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.product-tabs -->

                    <!-- ===== ======= UPSELL PRODUCTS ==== ========== -->
                    <section class="section featured-product wow fadeInUp">
                        <h3 class="section-title">Related products</h3>
                        <div
                            class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">


                            @foreach($relatedProduct as $product)

                                <div class="item item-carousel">
                                    <div class="products">

                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image">
                                                    <a href="{{ url('product/detail/'.$product->id ) }}"><img
                                                            src="{{ asset($product->product_thumbnail) }}" alt=""></a>
                                                </div><!-- /.image -->

                                                <div class="tag sale"><span>sale</span></div>
                                            </div><!-- /.product-image -->


                                            <div class="product-info text-left">
                                                <h3 class="name"><a
                                                        href="{{ url('product/detail/'.$product->id) }}">
                                                        {{ $product->product_name_en }}</a></h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="description"></div>


                                                @if ($product->discount_price == NULL)
                                                    <div class="product-price">
				<span class="price">
					${{ $product->selling_price }}	 </span>
                                                    </div><!-- /.product-price -->
                                                @else

                                                    <div class="product-price">
				<span class="price">
					${{ $product->discount_price }}	 </span>
                                                        <span
                                                            class="price-before-discount">$ {{ $product->selling_price }}</span>
                                                    </div><!-- /.product-price -->
                                                @endif


                                            </div><!-- /.product-info -->
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
                                        </div><!-- /.product -->

                                    </div><!-- /.products -->
                                </div><!-- /.item -->

                            @endforeach


                        </div><!-- /.home-owl-carousel -->
                    </section><!-- /.section -->
                    <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

                </div><!-- /.col -->
                <div class="clearfix"></div>
            </div><!-- /.row -->

        </div>


        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <script type="text/javascript"
                src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e4b85f98de5201f"></script>
        <script type="text/javascript">
            var i=1;
            function upClick() {
                document.getElementById('qty').value = ++i ;
            }
            function downClick() {
                if(document.getElementById('qty').value >1) {
                    document.getElementById('qty').value = --i;
                }

            }
        </script>

@endsection
