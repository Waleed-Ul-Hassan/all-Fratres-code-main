@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','recruiter_stat_index')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')

    <!--main-->
    <div class="recruiter-main-dashboard">
        <div class="recru-dash-head">
            <div class="recru-dash-headv1">
                <p>bottom</p>
            </div>

            @include('frontend.recruiter.partials.sidebar')

            <div class="recru-dash-item2">
                <div class="recru-dash-item2-v1">
                    <div class="recru-dash-item2-v1-title">
                        <h3>Jobs Stats</h3>
                    </div>
                    <div class="recru-dash-item2-v1-action">
                        <div class="recru-dash-item2-v1-action-head">
                            <div class="recru-dash-item2-v1-action-head-item1">
                                <h3>{{recruiter_logged('job_credits') ?? 0}}</h3>
                            </div>
                            <div class="recru-dash-item2-v1-action-head-item2">
                                <h2>job credits</h2>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="recur-item2-maincontent">
                    <br><br><br>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-active" role="tabpanel" aria-labelledby="pills-home-tab">


                            @if(count($jobs)>0)

                                <div class="topactive-recru-post col-md-12">

                                    <table class="table  table-hover">
                                        <thead>
                                        <tr>
                                            <th>Expiry Date</th>
                                            <th class="width-70">Title</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($jobs as $job)

                                                <tr>
                                                    <th scope="col" class="days_left">

                                                        <span>{{date("d M Y", strtotime($job->expiry_date))}}</span>


                                                    </th>
                                                    <th scope="col">
                                                        <h4 class="job_title">{{$job->title}}</h4>
                                                        <h6 class="job_loc">{{$job->name}}</h6>
                                                    </th>
                                                    <th scope="col">

                                                        <a href="{{url('recruiter/job-stats/'.$job->unique_string)}}" class="btn btn-primary btn-sm"><i class="fa fa-chart-bar"></i> Stats</a>


                                                    </th>
                                                </tr>

                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            @else
                                <br><br>
                                <div class="text-center">
                                    <img src="{{asset('frontend/assets/img/fratreslogofinal.png')}}">
                                    <div class="topactive-recru-post">
                                        <p>You have no active jobs</p>
                                        <a href="{{url('recruiter/job_post')}}" class="btn btn-primary">
                                            post a new job
                                        </a>
                                    </div>
                                </div>
                            @endif



                        </div>




                    </div>



                </div>
            </div>


        </div><!--END-->
    </div>
    </div>

@endsection

