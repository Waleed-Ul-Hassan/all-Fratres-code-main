@extends('admin.layout.main')

@section('content')
    <script src="{{asset('/js/recruiters.js')}}"></script>
    <div class="content-wrapper">
        <br>

        <br>
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Orders</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="" class="table table-bordered table-striped table-sm table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Title</th>
                                    <th>Price</th>
                                    <th>Tax Amount</th>
                                    <th>Total Amount</th>
                                    <th>Payment Status</th>
                                    <th>Created</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $counter = 1; @endphp
                                @foreach($orders as $orderss)

                                    <tr>
                                        <td>{{$counter}}</td>
                                        <td>{{$orderss->order_title}}</td>
                                        <td><b>{{$orderss->currency}}</b>{{$orderss->price_of_job}} </td>
                                        <td><b>{{$orderss->currency}}</b>{{$orderss->tax_amount}} </td>
                                        <td><b>{{$orderss->currency}}</b>{{$orderss->total_amount}}</td>
                                        <td>{{$orderss->payment_status}}</td>
                                        <td>{{$orderss->created_at->diffForHumans()}}</td>


                                    </tr>
                                    @php $counter++; @endphp
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr><th colspan="4">Total Amount</th><th rowspan="1" colspan="1">{{$orders->sum('total_amount')}} <b>{{$orderss->currency}}</b></th><th rowspan="1" colspan="1"></th></tr>
                                </tfoot>
                            </table>

                            {{$orders->links()}}
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
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
            });
        });
    </script>



@endsection