@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','recruiter_stat')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')
    <style>
        .recru-dash-headv1 {
            border-bottom: 0px;

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
                <br>
                <div class="container-fluid">
                    <div class="col-md-12 pad-left-0">
                        <h4>Job Details</h4>
                        <hr>
                        <table class="table table-sm table-bordered">
                            <thead>
                            <tr>
                                <td>
                                    <b>Title : </b> {{$job->title}}  <span class="badge badge-primary">{{strtoupper($job->job_status)}}</span>
                                </td>
                                {{--<td>--}}
                                    {{--<b>Skills : </b>--}}
                                    {{--@foreach($job->skills as $skill)--}}
                                        {{--<span class="badge badge-info">{{$skill->name}}</span> |--}}
                                    {{--@endforeach--}}
                                {{--</td>--}}
                                <td>
                                    <b>Industry : </b> {{$job->get_industry->name}}
                                </td>
                                <td>
                                    <b> Expiry Date : </b> {{date("d M Y", strtotime($job->expiry_date))}}
                                </td>
                            </tr>
                            <tr>

                                <td>
                                    <b>Salary : </b> {{$settings->symbol}}{{$job->salary_min}} - {{$job->salary_max}} / {{$job->salary_schedule}}
                                </td>
                                <td>
                                    <b>City : </b> {{$job->get_city->name}}
                                </td>
                                <td>
                                    <b>Contract Type : </b> {{$job->contract_type}}
                                </td>
                            </tr>


                            </thead>
                        </table>
                    </div>
                    <hr>
                </div>

                <div class="recur-item2-maincontent col-md-12">
                    <div class="row ">
                        <div class="col-sm-3">

                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-eye"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total Views</span>
                                    <span class="info-box-number">
                                         {{$job->views ?? 0}}
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-3">

                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-id-card"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Applications</span>
                                    <span class="info-box-number">
                                         {{$job->applicants->count()}}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">

                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Short Listed</span>
                                    <span class="info-box-number">
                                         {{$job->applicants->where('short_listed', 1)->count()}}
                                    </span>
                                </div>
                            </div>
                        </div>

<div class="col-sm-3">

                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-id-card"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Viewed Applications</span>
                                    <span class="info-box-number">
                                         {{$job->applicants()->whereRaw("viewed_at IS NOT NULL")->count()}}
                                    </span>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>


                <div class="recur-item2-maincontent container-fluid">

                    <div class="row pt-5">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <canvas id="myChart"></canvas>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <canvas id="browsers"></canvas>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div id="CVviews" style="height: 300px; width: 100%;"></div>
                        </div>

                    </div>
                </div>

            </div>






        </div><!--END-->



    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
@endsection

@section('scripts')
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: ['{{date("d M", strtotime('-7 days'))}}', '{{date("d M", strtotime("-6 days"))}}', '{{date("d M", strtotime("-5 days"))}}', '{{date("d M", strtotime("-4 days"))}}', '{{date("d M", strtotime("-3 days"))}}', '{{date("d M", strtotime("-2 days"))}}', '{{date("d M")}}'],
                datasets: [{
                    label: 'Last Week Views',
                    backgroundColor: '#ff8a008f',
                    borderColor: '#ff8a00f7',
                    data: [{{implode(",", $graph)}}]
                }]
            },

            // Configuration options go here
            options: {}
        });

        var ctx2 = document.getElementById('browsers').getContext('2d');
        var chart2 = new Chart(ctx2, {
            // The type of chart we want to create
            type: 'doughnut',

            // The data for our dataset
            data: {
                labels: [{!! $browsers !!}],
                datasets: [{
                    label: 'Last Week Views',
                    backgroundColor: ['#079BFE','#FF9226','#FF3F69','#BCBCBC','#23CECE','#FFC848','#FFC848','#FFC848','#FFC848'],
                    // borderColor: '#ff8a00f7',
                    data: [{!! implode(",", $browser_views) !!}]
                }]
            },

            // Configuration options go here
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Browsers'
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });





    </script>
@endsection
