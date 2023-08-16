@extends('admin.layout.main')

@section('content')
    <script src="{{asset('js/coupons.js')}}"></script>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add Coupon</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Coupon</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Coupon</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Coupon code</label>
                                    <input type="text" class="form-control" name="coupon_code"
                                           placeholder="e.g Coupon code" id="coupon_code">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Start Date</label>
                                    <input type="date" class="form-control" name="start_date"
                                           placeholder="e.g Start Date" id="start_date">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">End Date</label>
                                    <input type="date" class="form-control" name="end_date"
                                           placeholder="e.g End Date" id="end_date">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Discount</label>
                                    <input type="text" class="form-control" name="discount"
                                           placeholder="e.g Discount" id="discount">
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" onclick="save()" class="btn btn-primary">Add</button>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>





@endsection