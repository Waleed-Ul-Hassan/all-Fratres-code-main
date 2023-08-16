@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','recruiter_index')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')



    <style>
        .recru-dash-headv1{
            width:15.7%;
        }
        .recru-dash-headv1 {
            top: 0px;
        }
    </style>
    <!--main-->
    <div class="recruiter-main-dashboard">
        <div class="recru-dash-head">
            <div class="recru-dash-headv1">
                <p>bottom</p>
            </div>

            @include('frontend.recruiter.partials.sidebar')

            <div class="recru-dash-item2">

                <div class="recru-dash-item2-v1-list">

                </div>
                <div class="recur-item2-maincontent col-md-12">
                    <br>

                    <div class="row">
                        <div class="col-sm-3">

                            <div class="info-box cursor" onclick="window.location.href = '/recruiter/manage-jobs'">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                                <div class="info-box-content ">
                                    <span class="info-box-text">Total Jobs</span>
                                    <span class="info-box-number">
                                         {{App\Job::where('job_status', '!=', 'deleted')->where('recruiter_id', recruiter_logged('id'))->count()}}

                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>

                        </div>
                        <div class="col-sm-3">

                            <div class="info-box cursor" >
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total Applicants</span>
                                    <span class="info-box-number">
                                         {{$total_applicants}}
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>

                        </div>
                        <div class="col-sm-3">

                            <div class="info-box cursor" onclick="window.location.href = '/recruiter/invoices'">
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total Orders</span>
                                    <span class="info-box-number">
                                         {{$orders->count()}}
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>

                        </div>

                        <div class="col-sm-3">

                            <div class="info-box cursor" >
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Amount Paid</span>
                                    <span class="info-box-number">
                                         {{$settings->symbol}} {{$total_amount}}
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-6">

                            <div class="card">
                                <div class="card-header border-0">
                                    <h4 class="card-title card-title-rem">Applicants</h4>

                                </div>
                                <div class="card-body table-responsive p-0 @if(!$applicants->count() > 0) text-center @endif">
                                   @if($applicants->count() > 0)
                                    <table class="table table-striped table-valign-middle">
                                        <thead>
                                        <tr>
                                            <th>Candidate</th>
                                            <th>Job</th>
                                            <th>Applied</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($applicants as $applicant)
                                        <tr>
                                            <td><a href="/recruiter/applicants/{{$applicant->job->unique_string}}?applicant_id={{$applicant->id}}">{{$applicant->seeker->first_name}}</a> </td>
                                            <td><a href="/recruiter/applicants/{{$applicant->job->unique_string}}">{{$applicant->job->title}}</a></td>

                                            <td>
                                                {{$applicant->created_at->diffForHumans()}}
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                   @else
                                       <i class="fas fa-users fa-2x  mb-5 mt-5"></i> No Applicants yet
                                   @endif

                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-lg-6">

                            <div class="card">
                                <div class="card-header border-0">
                                    <h4 class="card-title card-title-rem">Latest Orders</h4>

                                </div>
                                <div class="card-body table-responsive p-0 @if(!$orders->count() > 0) text-center @endif">
                                    @if($orders->count() > 0)
                                        <table class="table table-striped table-valign-middle">
                                        <thead>
                                        <tr>
                                            <th>Order Type</th>
                                            <th>Amount Paid</th>
                                            <th>Status</th>
                                            <th>Order Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $order)
                                            @continue($order->order_type=='single_job_credit')
                                            @break($loop->index==5)
                                        <tr>
                                            <td>{{$order->order_title}} </td>
                                            <td>{{$settings->symbol}}{{$order->total_amount}}</td>
                                            <td>{{$order->payment_status}}</td>
                                            <td>{{$order->created_at->diffForHumans()}}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                        <i class="fas fa-shopping-cart fa-2x mb-5 mt-5"></i> No Orders
                                    @endif
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>

                    </div>

                </div>
            </div>


        </div><!--END-->
    </div>
    </div>

@endsection

@section('scripts')
    <script>



        $(function() {
            $( '.recru-dash-item2-v1-list ul.nav li' ).on( 'click', function() {
                $( this ).parent().find( 'li.active' ).removeClass( 'active' );
                $( this ).addClass( 'active' );
            });
        });

        $(document).on("click",".list-group-item-action", function (e) {
            e.preventDefault();
            var status = $(this).attr("data-status");
            var job_id = $(this).attr("data-job-id");


            $(this).closest("div").find('.list-group-item-action').removeClass("active");
            var list_item =  $(this);

            $.ajax({
                url: "/recruiter/job-status/"+job_id+"?status="+status,
                type:'GET',
                success: function(data) {
                    if(data == 'ok'){
                        list_item.addClass("active");
                        swal({
                            position: 'top-end',
                            icon: 'success',
                            title: "Updated Successfully",
                            showConfirmButton: false,
                            timer: 2500
                        })
                    }

                }
            });

        });
    </script>
    @endsection