@extends('backend.admin_master')
@section('admin')


    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">





                <!--   ------------ Add Category Page -------- -->


                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Category </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('update.category',$category->id) }}" >
                                    @csrf



                                    <div class="form-group">
                                        <h5>Category Name  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text"  name="category_name_en" class="form-control" value="{{ $category->category_name_en }}" >
                                            @error('category_name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <h5>Category Icon  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" id="image" name="category_icon" class="form-control"  value="{{ $category->category_icon }}" >
                                            @error('category_icon')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="controls">
                                             <img id="showImage" src="{{(!empty($category-> category_icon))? url($category-> category_icon): url('upload/no_image.jpg')}}" style=" width: 100px; height: 100px;">
                                        </div>
                                    </div>


                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
                                    </div>
                                </form>





                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>




            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>




@endsection
