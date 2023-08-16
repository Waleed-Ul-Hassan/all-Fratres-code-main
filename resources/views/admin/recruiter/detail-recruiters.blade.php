@extends('admin.layout.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <!-- Widget: user widget style 2 -->
                        <div class="card card-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-warning">
                                <div class="widget-user-image">
                                    <img class="img-circle elevation-2"
                                         src="{{asset('/recruiters/profile/'.$recruiter->company_logo)}}"
                                         alt="User Avatar">
                                </div>
                                <!-- /.widget-user-image -->
                                <h3 class="widget-user-username">{{$recruiter->first_name}}</h3>
                                <h5 class="widget-user-desc">{{$recruiter->company_name}}</h5>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>

                    <div class="col-sm-6" style="font-size: 10px;">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Jobs</h3>
                            </div>


                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-hover table-md">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>City</th>
                                        <th>Contract</th>
                                        <th>Time</th>
                                        <th>Salary</th>
                                        <th>Status</th>
                                        <th>Views</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $counter = 1; @endphp
                                    @if(isset($recruiter->jobs))
                                        @foreach ($recruiter->jobs as $recruiters)
                                            <tr>
                                                <td>{{$recruiters->id}}</td>
                                                <td>{{$recruiters->title}}
                                                    <div class="clearfix"></div>
                                                    <a class="btn btn-danger btn-xs"
                                                       data-toggle="collapse"
                                                       href="#collapseExample{{$recruiters->id}}" role="button"
                                                       aria-expanded="false"
                                                       aria-controls="collapseExample{{$recruiters->id}}">
                                                        Description
                                                    </a>
                                                    <div class="collapse" id="collapseExample{{$recruiters->id}}"
                                                         style="position: absolute;z-index:999;border:2px solid #000;">
                                                        <div class="card card-body">
                                                            {!! $recruiters->description !!}
                                                        </div>
                                                    </div>

                                                </td>

                                                <td>
                                                    <span class="badge badge-success">{{$recruiters->get_city->name}}
                                                                </span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">{{$recruiters->contract_type}}
                                                                </span>
                                                </td>
                                                <td><span
                                                            class="badge badge-success">{{$recruiters->time_available}}
                                                                </span></td>
                                                <td><span class="badge badge-success">{{$recruiters->salary}}
                                                                /{{$recruiters->salary_schedule}}
                                                                </span></td>
                                                <td><span class="badge badge-@if($recruiters->job_status == 'active'){{'success'}}
                                                    @elseif($recruiters->job_status == 'paused'){{'warning'}}
                                                    @elseif($recruiters->job_status == 'draft'){{'secondary'}}
                                                    @elseif($recruiters->job_status == 'reject'){{'danger'}}
                                                    @endif ">
                                                {{$recruiters->job_status}}
                                            </span></td>
                                                <td><span class="badge badge-success">{{$recruiters->views}} </span>
                                                </td>

                                            </tr>

                                            @php $counter++; @endphp
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
                    <div class="col-sm-6" style="font-size: 10px;">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Orders</h3>
                            </div>


                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-striped table-hover table-md">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order Title</th>
                                        <th>Price</th>
                                        <th>Tax Amount</th>
                                        <th>Total Amount</th>
                                        <th>Payment Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $counter = 1; @endphp
                                    @if(isset($orders))
                                        @foreach ($orders as $order)
                                            {{--                                            {{$orders}}--}}
                                            <tr>
                                                <td>{{$counter}}</td>
                                                <td>{{$order->order_title}}</td>
                                                <td><span class="badge badge-success">
                                                                {{$order->price_of_job}} <b>{{$order->currency}}</b></span>
                                                </td>
                                                <td><span class="badge badge-success">{{$order->tax_amount}} <b>{{$order->currency}}</b></span></td>
                                                <td><span class="badge badge-success">{{$order->total_amount}} <b>{{$order->currency}}</b></span></td>
                                                <td><span class="badge badge-success">{{$order->payment_status}}</span></td>


                                            </tr>

                                            @php $counter++; @endphp
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>


                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
                "pageLength": 6,
            });
            $('#example2').DataTable({
                "pageLength": 6,
                "autoWidth": false,
                "responsive": true,

            });
        });
    </script>

@endsection