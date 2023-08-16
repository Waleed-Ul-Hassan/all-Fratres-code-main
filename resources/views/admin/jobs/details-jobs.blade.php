@extends('admin.layout.main')

@section('content')
    <style>
        .info-box-number{
            font-size:15px;
        }
    </style>
    <script src="{{asset('/js/jobs.js')}}"></script>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Jobs Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Jobs Detail</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Jobs Detail</h3>

                    <div class="card-tools">
                        @if($jobs->job_status== 'pending' ||$jobs->job_status== 'reject' ||$jobs->job_status== 'draft' || $jobs->job_status== 'expired')
                            <a class="btn btn-xs btn-primary block" data-block="{{$jobs->id}}"><i
                                        class="fa fa-check" aria-hidden="true"></i> Active</a>

                        @elseif ($jobs->job_status== 'active')
                            <a class="btn btn-xs btn-secondary block" data-block="{{$jobs->id}}"><i
                                        class="fa fa-pause" aria-hidden="true"></i> Pause</a>
                        @elseif ($jobs->job_status== 'pause')

                            <a class="btn btn-xs btn-primary block" data-block="{{$jobs->id}}"><i
                                        class="fa fa-check" aria-hidden="true"></i> Active</a>

                        @endif
                        <a class="btn btn-xs btn-danger reject" data-toggle="modal" data-target="#exampleModal" data-reject="{{$jobs->id}}"><i
                                    class="fa fa-check" aria-hidden="true"></i> Reject</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                            <span class="info-box-text text-center text-bold">Posted by : {{$jobs->recruiter->creator_name}} </span>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Salary</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{$settings->symbol}}{{$jobs->salary_min}} - {{$jobs->salary_max}}/{{$jobs->salary_schedule}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">City</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{$jobs->get_city->name}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Time Available</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{$jobs->time_available}} <span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Industry</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{$jobs->get_industry->name}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Contract Type</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{$jobs->contract_type}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Job Status</span>

                                            <span class="text-center mb-0 badge badge-@if($jobs->job_status == 'active'){{'success'}}
                                            @elseif($jobs->job_status == 'pause'){{'warning'}}
                                            @elseif($jobs->job_status == 'draft'){{'secondary'}}
                                            @elseif($jobs->job_status == 'reject'){{'danger'}}
                                            @endif ">
                                                {{$jobs->job_status}}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Applicants</span>
                                            <span class="info-box-number text-center text-muted mb-0">{{count($jobs->applications) ?? 0}}</span>
                                        </div>
                                    </div>
                                </div>



                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h4>Skills</h4>
                                    <div class="post">
                                        <div class="user-block">
                                            <span class="username">
                          <a href="#">

                              @foreach($jobs->skills as $skill)
                                  <span class="text-center mb-0 badge badge-success">
                                                {{$skill->name}}
                                            </span>

                              @endforeach </a>
                        </span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>

                                        </p>

                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h4>Description</h4>
                                    <div class="post">
                                        <div class="user-block">
                                            <span class="username">
                          <a href="#">{{$jobs->title}}</a>
                        </span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            {!! $jobs->description !!}
                                        </p>

                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <h4>Created at</h4>
                                    <div class="post">
                                        <div class="user-block">
                                            {{$jobs->created_at->diffForHumans()}}
                                        </div>


                                    </div>

                                </div>


                                <div class="col-6">
                                    <h4>Expires at</h4>
                                    <div class="post">
                                        <div class="user-block">
                                            {{date("F jS, Y", strtotime($jobs->expiry_date))}}
                                        </div>

                                    </div>

                                </div>
                            </div>


                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Reason to Pause Job</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">


                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Message:</label>
                                            <textarea class="form-control" name="job_reject_reason" id="job_reject_reason"></textarea>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary rejects">Send message</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                            <h3 class="text-primary"><i class="fas fa-paint-brush"></i> Order Details</h3>

                            @if (isset($jobs->order->billing_info))
                                @php  $orderss = json_decode($jobs->order->billing_info, true); @endphp



                                <div class="text-muted">
                                    <p class="text-sm">First Name
                                        <b class="d-block">{{$orderss['billing_first_name']}}</b>
                                    </p>
                                    <p class="text-sm">Last Name
                                        <b class="d-block">{{$orderss['billing_sur_name']}}</b>
                                    </p>
                                </div>

                                <div class="text-muted">
                                    <p class="text-sm">Company Name
                                        <b class="d-block">{{$orderss['billing_company_name']}}</b>
                                    </p>
                                    <p class="text-sm">Billing Address
                                        <b class="d-block">{{$orderss['billing_address']}}</b>
                                    </p>
                                </div>

                                <div class="text-muted">
                                    <p class="text-sm">City
                                        <b class="d-block">{{$orderss['city']}}</b>
                                    </p>
                                    <p class="text-sm">Province
                                        <b class="d-block">{{$orderss['province']}}</b>
                                    </p>
                                    <p class="text-sm">Phonr Number
                                        <b class="d-block">{{$orderss['phone_number']}}</b>
                                    </p>
                                </div>

                            @else

                                Order Not created yet
                            @endif

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>

@endsection