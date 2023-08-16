@extends('admin.layout.main')

@section('content')
    <!-- Facebook Pixel Code -->
    <style>
        #example12 td, #example12 th, .dataTables_info{
            font-size: 13px !important;
        }
    </style>
    <!-- End Facebook Pixel Code -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script>
    <script src="https://www.chartjs.org/samples/latest/utils.js"></script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    @if (\Illuminate\Support\Facades\Auth::guard('admin')->user()->type == 'admin')
        <input type="hidden" value="{{$seekers ?? '0'}}" name="seeker" id="seeker">
        <input type="hidden" value="{{$recruiter ?? '0'}}" name="recruiter" id="recruiter">
        <input type="hidden" value="{{$webstat->total_jobs ?? 0}}" name="jobs" id="jobs">
        <?php
        echo date('F, Y');
        for ($i = 0; $i < 6; $i++) {
            $month[] = date('M-Y', strtotime("-$i month"));
        }

        $months = json_encode($month);
        ?>
        <input type="hidden" value="{{$months}}" name="months" id="months">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-8">
                            <h1 class="m-0 text-dark"> </h1>


                        </div><!-- /.col -->
                        <form action="{{url('admin/home')}}" method="get" style="display: contents">
                        <div class="col-sm-4 float-sm-right">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2" name="dates" value="{{$weekStartDate->format('m/d/Y')}} - {{$weekEndDate->format('m/d/Y')}}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Filter</button>
                                </div>
                            </div>
                        </div><!-- /.col -->
                        </form>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Info boxes -->


                    <div class="row">


                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">


                                    <div class="row">

                                        <div class="col-12">
                                            <h4 class="float-left box-heading"><i class="fas fa-users fa-warning"></i>
                                                Seekers</h4>
                                            <p class="float-right">
                                            <h4 class="float-right">

                                                {{$seekers ?? '0'}}

                                            </h4>
                                            </p>
                                        </div>

                                        <div class="col-12 bordered-div"></div>
                                        <div class="col">
                                        <span class="info-box-number">
                                            @if(!isset($_GET['dates']))
                                              {{$thisWeekSeekers}}
                                            @else
                                                <a href="{{url('admin/seekers?dates='.$_GET['dates'])}}">{{$thisWeekSeekers ?? '0'}}</a>
                                            @endif
                                        </span>
                                            <p class="info-box-text text-green font-12"><b>@if(!isset($_GET['dates'])) This Week @endif</b></p>
                                        </div>
                                        <div class="col text-right">
                                            <span class="info-box-number">
                    {!! percentage_diff($thisWeekSeekers, $lastWeekSeekers) !!}
                                            </span>
                                            <span class="info-box-text font-12"> Last Week</span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">


                                    <div class="row">

                                        <div class="col-12">
                                            <h4 class="float-left box-heading"><i class="fas fa-users fa-info"></i>
                                                Recruiters</h4>
                                            <p class="float-right">
                                            <h4 class="float-right">{{$recruiter ?? '0'}}</h4>
                                            </p>
                                        </div>

                                        <div class="col-12 bordered-div"></div>
                                        <div class="col">
                                            <span class="info-box-number">
                                                @if(!isset($_GET['dates']))
                                                    {{$thisWeekRecruiter}}
                                                @else
                                                    <a href="{{url('admin/recruiter?dates='.$_GET['dates'])}}">{{$thisWeekRecruiter ?? '0'}}</a>
                                                @endif

                                            </span>
                                            <p class="info-box-text text-green font-12"><b>@if(!isset($_GET['dates'])) This Week @endif</b></p>
                                        </div>
                                        <div class="col text-right">
                                          <span class="info-box-number">
                                        {!! percentage_diff($thisWeekRecruiter, $lastWeekRecruiter) !!}
                                          </span>
                                            <span class="info-box-text font-12"> Last Week</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3" title="Total Jobs in our Database">
                            <div class="card">
                                <div class="card-body">


                                    <div class="row">

                                        <div class="col-12">
                                            <h4 class="float-left box-heading"><i
                                                        class="fas fa-briefcase fa-primary"></i> Jobs</h4>
                                            <p class="float-right">
                                            <h4 class="float-right">{{$webstat->total_jobs ?? '0'}}</h4>
                                            </p>
                                        </div>

                                        <div class="col-12 bordered-div"></div>
                                        <div class="col">
                                        <span class="info-box-number">
                                            @if(!isset($_GET['dates']))
                                                {{$thisWeekJob}}
                                            @else
                                                <a href="{{url('admin/jobs?dates='.$_GET['dates'])}}">{{$thisWeekJob ?? '0'}}</a>
                                            @endif

                                        </span>
                                            <p class="info-box-text text-green font-12"><b>@if(!isset($_GET['dates'])) This Week @endif</b></p>
                                        </div>
                                        <div class="col text-right">
                                            <span class="info-box-number">
                                              {!! percentage_diff($thisWeekJob, $lastWeekJob) !!}
                                            </span>
                                            <span class="info-box-text font-12"> Last Week</span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3" title="Total Orders Created by Recruiters/Seekers also Job Created using coupon will also counted as order">
                            <div class="card">
                                <div class="card-body">


                                    <div class="row">

                                        <div class="col-12">
                                            <h4 class="float-left box-heading"><i
                                                        class="fas fa-shopping-cart fa-danger"></i> Orders</h4>
                                            <p class="float-right">
                                            <h4 class="float-right">{{$orders ?? '0'}}</h4>
                                            </p>
                                        </div>

                                        <div class="col-12 bordered-div"></div>
                                        <div class="col">
                                        <span class="info-box-number">
                                            @if(!isset($_GET['dates']))
                                                {{$thisWeekOrder}}
                                            @else
                                                <a href="{{url('admin/orders?dates='.$_GET['dates'])}}">{{$thisWeekOrder ?? '0'}}</a>
                                            @endif

                                        </span>
                                            <p class="info-box-text text-green font-12"><b>@if(!isset($_GET['dates'])) This Week @endif</b></p>
                                        </div>
                                        <div class="col text-right">
                                            <span class="info-box-number">
                                              {!! percentage_diff($thisWeekOrder, $lastWeekOrder) !!}
                                            </span>
                                            <span class="info-box-text font-12"> Last Week</span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3" title="How Many Users are receiving Job Alerts">
                            <div class="card">
                                <div class="card-body">


                                    <div class="row">

                                        <div class="col-12">
                                        <h4 class="float-left box-heading"><i class="fas fa-briefcase fa-primary"></i> Job Alerts</h4>
                                            <p class="float-right">
                                            <h4 class="float-right">{{$jobAlerts}}</h4>
                                            </p>
                                        </div>

                                        <div class="col-12 bordered-div"></div>
                                        <div class="col">
                                        <span class="info-box-number">
                                            @if(!isset($_GET['dates']))
                                                {{$thisWeekalerts}}
                                            @else
                                                <a href="{{url('admin/job-alerts?dates='.$_GET['dates'])}}" target="_blank">{{$thisWeekalerts ?? '0'}}</a>
                                            @endif

                                        </span>
                                            <p class="info-box-text text-green font-12"><b>@if(!isset($_GET['dates'])) This Week @endif</b></p>
                                        </div>
                                        <div class="col text-right">
                                            <span class="info-box-number">
                                              {!! percentage_diff($thisWeekalerts, $lastWeekalerts) !!}
                                            </span>
                                            <span class="info-box-text font-12"> Last Week</span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3" title="Total CVs/Seekers present in our Database">
                            <div class="card">
                                <div class="card-body">


                                    <div class="row">

                                        <div class="col-12">
                                            <h4 class="float-left box-heading"><i class="fas fa-users fa-warning"></i>
                                                Total CVs</h4>
                                            <p class="float-right">
                                            <h4 class="float-right">{{$seekers ?? '0'}}</h4>
                                            </p>
                                        </div>

                                        <div class="col-12 bordered-div"></div>
                                        <div class="col">
                                        <span class="info-box-number">
                                          {{$thisWeekSeekers}}
                                        </span>
                                            <p class="info-box-text text-green font-12"><b>@if(!isset($_GET['dates'])) This Week @endif</b></p>
                                        </div>
                                        <div class="col text-right">
                                            <span class="info-box-number">
                    {!! percentage_diff($thisWeekSeekers, $lastWeekSeekers) !!}
                                            </span>
                                            <span class="info-box-text font-12"> Last Week</span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3" title="How Many Times Recruiter has Searched CVs">
                            <div class="card">
                                <div class="card-body">


                                    <div class="row">

                                        <div class="col-12">
                                            <h4 class="float-left box-heading"><i
                                                        class="fas fa-file fa-primary"></i> Searched CVs</h4>
                                            <p class="float-right">
                                            <h4 class="float-right">{{$cvs ?? '0'}}</h4>
                                            </p>
                                        </div>

                                        <div class="col-12 bordered-div"></div>
                                        <div class="col">
                                        <span class="info-box-number">
                                          {{$thisWeekcvs}}
                                        </span>
                                            <p class="info-box-text text-green font-12"><b>@if(!isset($_GET['dates'])) This Week @endif</b></p>
                                        </div>
                                        <div class="col text-right">
                                            <span class="info-box-number">
                                              {!! percentage_diff($thisWeekcvs, $lastWeekcvs) !!}
                                            </span>
                                            <span class="info-box-text font-12"> Last Week</span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3" title="How Many Times CV Maker has been Used?">
                            <div class="card">
                                <div class="card-body">


                                    <div class="row">

                                        <div class="col-12">
                                            <h4 class="float-left box-heading" ><i class="fas fa-clock fa-primary"></i> CV Maker Used</h4>
                                            <p class="float-right">
                                            <h4 class="float-right">
                                                @if ($experienceSeeker > $projectsSeeker)
                                                    {{$experienceSeeker}}
                                                @else
                                                    {{$projectsSeeker}}
                                                @endif
                                            </h4>
                                            </p>
                                        </div>

                                        <div class="col-12 bordered-div"></div>
                                        <div class="col">
                                        <span class="info-box-number">
{{--                                          {{$thisWeekJobAlert}}--}}
                                            0
                                        </span>
                                            <p class="info-box-text text-green font-12"><b>@if(!isset($_GET['dates'])) This Week @endif</b></p>
                                        </div>
                                        <div class="col text-right">
                                            <span class="info-box-number">
{{--                                              @if ($thisWeekJobAlert > $lastWeekJobAlert)--}}
                                                {{--                                                    @php $avgAlert = $thisWeekJobAlert - $lastWeekJobAlert;--}}

                                                {{--                                                    $avgavgAlert = ($avgAlert * 100)/$lastWeekJobAlert;--}}
                                                {{--                                                    @endphp--}}
                                                {{--                                                    {{$avgavgAlert}}--}}

                                                {{--                                                    <sup class="font-12 sup">%</sup>--}}
                                                {{--                                                    <small><i class="fas fa-arrow-up relate"></i></small>--}}
                                                {{--                                                @else--}}


                                                {{--                                                    @php $avgAlert = $thisWeekJobAlert - $lastWeekJobAlert;--}}

                                                {{--                                                    $avgavgAlert = ($avgAlert * 100)/isset($lastWeekJobAlert);--}}
                                                {{--                                                    @endphp--}}
                                                {{--                                                    {{$avgavgAlert}}--}}0
                                                    <sup class="font-12 sup">%</sup>
                                                    <small><i class="fas fa-arrow-down relate"></i></small>
{{--                                                @endif--}}
                                            </span>
                                            <span class="info-box-text font-12"> Last Week</span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

{{--                        <div class="col-sm-2">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-body">--}}


{{--                                    <div class="row">--}}

{{--                                        <div class="col-12">--}}
{{--                                            <h4 class="float-left box-heading"><i--}}
{{--                                                        class="fas fa-shopping-cart fa-danger"></i> Orders</h4>--}}
{{--                                            <p class="float-right">--}}
{{--                                            <h4 class="float-right">{{count($orders) ?? '0'}}</h4>--}}
{{--                                            </p>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-12 bordered-div"></div>--}}
{{--                                        <div class="col">--}}
{{--                                        <span class="info-box-number">--}}
{{--                                          {{$thisWeekOrder}}--}}
{{--                                        </span>--}}
{{--                                            <p class="info-box-text text-green font-12"><b>@if(!isset($_GET['dates'])) This Week @endif</b></p>--}}
{{--                                        </div>--}}
{{--                                        <div class="col text-right">--}}
{{--                                            <span class="info-box-number">--}}
{{--                                              @if ($thisWeekOrder > $lastWeekOrder)--}}
{{--                                                    @php $avgOrder = $thisWeekOrder - $lastWeekOrder;--}}

{{--                                                    $avgavgOrder1 = ($avgOrder * 100)/$lastWeekOrder;--}}
{{--                                                    @endphp--}}
{{--                                                    {{$avgavgOrder1}}--}}
{{--                                                    <sup class="font-12 sup">%</sup>--}}
{{--                                                    <small><i class="fas fa-arrow-up relate"></i></small>--}}
{{--                                                @else--}}


{{--                                                    @php $avgOrder = $thisWeekOrder - $lastWeekOrder;--}}

{{--                                                    $avgavgOrder1 = ($avgOrder * 100)/isset($lastWeekOrder);--}}
{{--                                                    @endphp--}}
{{--                                                    {{$avgavgOrder1}}--}}
{{--                                                    <sup class="font-12 sup">%</sup>--}}
{{--                                                    <small><i class="fas fa-arrow-down relate"></i></small>--}}
{{--                                                @endif--}}
{{--                                            </span>--}}
{{--                                            <span class="info-box-text font-12"> Last Week</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}


{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}



                        <div class="col-md-12">
                            {{--all jobs stats--}}

                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="far fa-chart-bar"></i>
                                        Jobs Postings
                                    </h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="all_jobs"></canvas>
                                </div>
                                <!-- /.card-body-->
                            </div>
                            {{--all jobs stats--}}
                        </div>

                        <div class="col-md-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="far fa-save"></i>
                                       CV Templates Downloads
                                    </h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Donut chart -->
                                    <canvas id="myChart1"></canvas>
                                    <!-- /.card -->
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="far fa-save"></i>
                                        Searched CVS
                                    </h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Donut chart -->
                                    <canvas id="myChart2"></canvas>
                                    <!-- /.card -->
                                </div>
                            </div>

                        </div>




                        <div class="col-md-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="far fa-shopping-cart"></i>
                                        Orders Chart
                                    </h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Alerts Sent - Last 5 Days ({{count($sent_jobs)}})
                                    </h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="example12" class="table table-bordered table-striped table-hover table-sm">
                                        <thead>
                                        <tr>
                                            <th>Email</th>
                                            <th>Alerts Sent</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $counter = 1; @endphp
                                        @foreach ($sent_jobs as $sent_job)
                                            <tr>


                                        <td>{{$sent_job->email}}</td>
                                        <td>{{$sent_job->sent}}</td>

                                        </tr>

                                            @php $counter++; @endphp
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>




                        <!-- /.col -->
                    </div>
                    <!-- /.row -->


                    <div class="row">
                        <div class="col-sm-6" style="font-size: 10px;">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Jobs Import Logs</h3>
                                </div>


                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped table-hover table-md">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Log</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $counter = 1; @endphp
                                        @foreach ($activity as $activityies)
                                            <tr>
                                                <td>{{$counter}}</td>
                                                <td>@if ($activityies->log_type == 'success')
                                                        <span class="badge bg-success">{{$activityies->log_type}}</span>
                                                    @else
                                                        <span class="badge bg-danger">{{$activityies->log_type}}</span>
                                                    @endif
                                                </td>
                                                <td>{{$activityies->message}}</td>
                                                <td>{{$activityies->created_at->format("d M Y")}}</td>

                                            </tr>

                                            @php $counter++; @endphp
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>

                        </div>

                        <div class="col-sm-6" style="font-size: 10px;">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"> Most Viewed Jobs </h3>
                                </div>


                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-hover table-md">
                                        <thead>
                                        <tr>
                                            <th>Job Title</th>
                                            <th>Views</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $counter = 1; @endphp
                                        @foreach($jobs as $job)
                                        @break($loop->index >= 9)
                                            <tr>
                                                <td>
                                                    @if($job->is_external == 1)
                                                        <a href="{{$job->slug}}" target="_blank">{{$job->title}}</a>
                                                    @else
                                                        <a href="{{url('job/'.$job->slug)}}" target="_blank">{{$job->title}}</a>
                                                    @endif
                                                </td>
                                                <td>{{$job->views}}</td>
                                                <td>
                                            <span class="badge badge-@if($job->job_status == 'active'){{'success'}}
                                            @elseif($job->job_status == 'pause'){{'warning'}}
                                            @elseif($job->job_status == 'draft'){{'secondary'}}
                                            @elseif($job->job_status == 'paused'){{'danger'}}
                                            @endif ">
                                                {{$job->job_status}}
                                            </span>
                                                </td>

                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>

                        </div>
                    </div>
                    <!-- /.row -->
                </div><!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <script>

            $('input[name="dates"]').daterangepicker();

            //all jobs will display with this below graph
            function generateData() {
                var unit = 'day';

                function unitLessThanDay() {
                    return unit === 'second' || unit === 'minute' || unit === 'hour';
                }

                function beforeNineThirty(date) {
                    return date.hour() < 9 || (date.hour() === 9 && date.minute() < 30);
                }

                // Returns true if outside 9:30am-4pm on a weekday
                function outsideMarketHours(date) {
                    if (date.isoWeekday() > 5) {
                        return true;
                    }
                    if (unitLessThanDay() && (beforeNineThirty(date) || date.hour() > 16)) {
                        return true;
                    }
                    return false;
                }



                function randomBar(date, lastClose) {

                    return {
                        t: date.valueOf(),
                        y: lastClose
                    };
                }

                var date = moment('Aug 1 2020', 'MMM DD YYYY');
                var now = moment();
                var date_stats = {!! $all_stats !!};
                var data = [];
                var lessThanDay = unitLessThanDay();
                for (; data.length < 600 && date.isBefore(now); date = date.clone().add(1, unit).startOf(unit)) {
                    if (outsideMarketHours(date)) {
                        if (!lessThanDay || !beforeNineThirty(date)) {
                            date = date.clone().add(date.isoWeekday() >= 5 ? 8 - date.isoWeekday() : 1, 'day');
                        }
                        if (lessThanDay) {
                            date = date.hour(9).minute(30).second(0);
                        }
                    }

                    // [date.format("YYYY-MM-DD")]
                    console.log(date.format("YYYY-MM-DD"));
                    console.log(date_stats);
                    if( date_stats.hasOwnProperty(date.format("YYYY-MM-DD")) ){
                        var jobs_this_date = date_stats[date.format("YYYY-MM-DD")];
                    }else{
                        var jobs_this_date = date_stats[date.format("YYYY-MM-DD")];
                    }
                    data.push(randomBar(date, jobs_this_date));
                    // data.push(randomBar(date, data.length > 0 ? data[data.length - 1].y : 30));
                }

                return data;

            }

            // console.log(date.format("YYYY-MM-DD"));
            // console.log(generateData());
            {{--console.log({!! $all_stats !!});--}}
            // console.log(date['2020-08-15']);


            var ctx_all_jobs = document.getElementById('all_jobs').getContext('2d');
            ctx_all_jobs.canvas.width = 1000;
            ctx_all_jobs.canvas.height = 300;

            var color = Chart.helpers.color;
            var cfg_all_jobs = {
                data: {
                    datasets: [{
                        label: 'Jobs Stats',
                        backgroundColor: 'rgb(1.00, 0.63, 0.71)',
                        borderColor: 'rgb(1.00, 0.63, 0.71)',
                        data: {!! $all_stats !!},
                        // data: generateData(),
                        type: 'bar',
                        pointRadius: 0,
                        fill: false,
                        lineTension: 0,
                        borderWidth: 2
                    }]
                },
                options: {
                    animation: {
                        duration: 0
                    },
                    scales: {
                        xAxes: [{
                            type: 'time',
                            distribution: 'series',
                            offset: true,
                            ticks: {
                                major: {
                                    enabled: true,
                                    fontStyle: 'bold'
                                },
                                source: 'data',
                                autoSkip: true,
                                autoSkipPadding: 75,
                                maxRotation: 0,
                                sampleSize: 100
                            },
                            // afterBuildTicks: function(scale, ticks) {
                            //     var majorUnit = scale._majorUnit;
                            //     var firstTick = ticks[0];
                            //     var i, ilen, val, tick, currMajor, lastMajor;
                            //
                            //     val = moment(ticks[0].value);
                            //     if ((majorUnit === 'minute' && val.second() === 0)
                            //         || (majorUnit === 'hour' && val.minute() === 0)
                            //         || (majorUnit === 'day' && val.hour() === 9)
                            //         || (majorUnit === 'month' && val.date() <= 3 && val.isoWeekday() === 1)
                            //         || (majorUnit === 'year' && val.month() === 0)) {
                            //         firstTick.major = true;
                            //     } else {
                            //         firstTick.major = false;
                            //     }
                            //     lastMajor = val.get(majorUnit);
                            //
                            //     for (i = 1, ilen = ticks.length; i < ilen; i++) {
                            //         tick = ticks[i];
                            //         val = moment(tick.value);
                            //         currMajor = val.get(majorUnit);
                            //         tick.major = currMajor !== lastMajor;
                            //         lastMajor = currMajor;
                            //     }
                            //     return ticks;
                            //
                            // }
                        }],
                        yAxes: [{
                            gridLines: {
                                drawBorder: false
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Number of Jobs'
                            }
                        }]
                    },
                    tooltips: {
                        intersect: false,
                        mode: 'index',
                        callbacks: {
                            label: function(tooltipItem, myData) {
                                var label = myData.datasets[tooltipItem.datasetIndex].label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += parseFloat(tooltipItem.value).toFixed(2);
                                return label;
                            }
                        }
                    }
                }
            };

            console.log( cfg_all_jobs );
            var chart_all_jobs = new Chart(ctx_all_jobs, cfg_all_jobs);

        </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

        <script>


            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',

                data: {
                    labels: {!! $orders_months !!},
                    datasets: [{
                        label: 'Order Chart ({{$settings->symbol}})',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: {!! $orders_total !!}
                    }]
                },

                // Configuration options go here
                options: {}
            });
            $(function () {
                $("#example1").DataTable({
                    "responsive": true,
                    "autoWidth": false,
                    "pageLength": 6,
                });
                $("#example12").DataTable({
                    "responsive": true,
                    "autoWidth": false,
                    "pageLength": 6,
                    "searching" : false,
                    "lengthChange": false
                });

                $('#example2').DataTable({
                    "pageLength": 6,
                    "autoWidth": false,
                    "responsive": true,

                });
            });





        </script>

    @endif

    <script>
        $(function () {

            var seeker = jQuery('#seeker').val();
            var recruiter = jQuery('#recruiter').val();
            var jobs = jQuery('#jobs').val();







            var ctx = document.getElementById('myChart1').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',

                // The data for our dataset
                data: {
                    labels: {!! $templates_months !!},
                    datasets: [{
                        label: 'Downloaded Cv templates',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: {!! $templates_total !!}
                    }]
                },

                // Configuration options go here
                options: {}
            });

            var ctx = document.getElementById('myChart2').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',

                // The data for our dataset
                data: {
                    labels: {!! $cv_months !!},
                    datasets: [{
                        label: 'Searched CVS',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: {!! $cv_sums !!}
                    }]
                },

                // Configuration options go here
                options: {}
            });

        })

        /*
         * Custom Label formatter
         * ----------------------
         */
        function labelFormatter(label, series) {
            return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
                + label
                + '<br>'
                + Math.round(series.percent) + '%</div>'
        }
    </script>




@endsection