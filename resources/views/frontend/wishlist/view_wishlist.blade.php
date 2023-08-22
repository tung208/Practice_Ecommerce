@extends('frontend.main_master')
@section('content')

    @section('title')
        Wish List Page
    @endsection


    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li class='active'>Wishlist</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="my-wishlist-page">
                <div class="row">
                    <div class="col-md-12 my-wishlist">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($wishlist as $item)
                                    <tr>
                                        <td><img src="{{ asset($item->product->product_thumbnail) }}"
                                                 style="width: 100px; height: 100px;"></td>
                                        <td>{{ $item->product->product_name_en}}</td>
                                        <td>{{ $item->product->selling_price }} $</td>

                                        <td>
                                            @if($item->product->discount_price == NULL)
                                                <span class="badge badge-pill badge-danger">No Discount</span>

                                            @else
                                                @php
                                                    $amount = $item->product->selling_price - $item->product->discount_price;
                                                    $discount = ($amount/$item->product->selling_price) * 100;
                                                @endphp
                                                <span
                                                    class="badge badge-pill badge-danger">{{ round($discount)  }} %</span>

                                            @endif


                                        </td>

                                        <td>
                                            @if($item->product->status == 1)
                                                <span class="badge badge-pill badge-success"> Active </span>
                                            @else
                                                <span class="badge badge-pill badge-danger"> InActive </span>
                                            @endif

                                        </td>


                                        <td width="30%">
                                            <a href="{{ route('add.toCart',$item->id) }}" class="btn btn-primary"
                                               title="Product Details Data"><i class="fa fa-cart-plus"></i> </a>
                                            <a href="{{ route('edit.product',$item->id) }}" class="btn btn-primary"
                                               title="Product Details Data"><i class="fa fa-eye"></i> </a>
                                            <a href="{{ route('remove.wishlist',$item->id) }}" class="btn btn-danger"
                                               title="Delete Data" id="delete">
                                                <i class="fa fa-trash"></i></a>


                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->


            <br>
            @include('frontend.body.brands')
        </div>

@endsection
