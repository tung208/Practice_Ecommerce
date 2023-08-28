@extends('backend.admin_master')
@section('admin')


    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">



                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cancel Orders List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Date </th>
                                        <th>Invoice </th>
                                        <th>Amount </th>
                                        <th>Payment </th>
                                        <th>Reason </th>
                                        <th>Status </th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $item)
                                        <tr>
                                            <td> {{ $item->order_date }}  </td>
                                            <td> {{ $item->invoice_no }}  </td>
                                            <td> ${{ $item->amount }}  </td>

                                            <td> {{ $item->payment_method }}  </td>
                                            <th>{{$item-> cancel_reason}} </th>
                                            <td>
                                                @if($item->cancel_status == 1)
                                                    <span class="badge badge-pill badge-primary">Request Pending </span>
                                                @elseif($item->cancel_status == 2)
                                                    <span class="badge badge-pill badge-success">Cancel Success </span>
                                                @endif

                                            </td>
                                                <td width="25%">

                                                    <a href="{{ route('pending.order.details',$item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-eye"></i> </a>
                                                    @if($item->cancel_status == 1)
                                                    <a href="{{ route('cancel.approve',$item->id) }}" class="btn btn-danger">Approve </a>
                                                    @endif
                                                    <a target="_blank" href="{{ route('invoice.download',$item->id) }}" class="btn btn-danger" title="Invoice Download">
                                                        <i class="fa fa-download"></i></a>
                                                </td>

                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col -->






            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>




@endsection
