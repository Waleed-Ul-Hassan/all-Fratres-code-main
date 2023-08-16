@extends('admin.layout.main')

@section('content')
    <script src="{{asset('/js/coupons.js')}}"></script>
    <div class="content-wrapper">
        <br>

        <!-- Main content -->
        <div class="col-md-1">
            <a href="{{url('admin/add-coupons')}}" class="btn btn-block btn-info">Add</a>
        </div>
        <br>
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Coupon</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Coupon Code</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Discount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $counter = 1; @endphp
                                @foreach($coupon as $coupons)
                                    <tr>
                                        <td>{{$counter}}</td>
                                        <td>{{$coupons->coupon_code}}</td>
                                        <td>{{$coupons->start_date}}</td>
                                        <td>{{$coupons->end_date}}</td>
                                        <td>{{$coupons->discount}}%</td>
                                        <td>
                                            <a href="{{url('admin/edit-coupons',($coupons->id))}}"
                                               class="btn btn-info"> Edit</a>
                                            <a class="btn btn-danger delete" data-delete="{{$coupons->id}}"><i
                                                        class="fa fa-trash" aria-hidden="true"></i> Delete</a>

                                        </td>
                                    </tr>
                                    @php $counter++; @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>



@endsection