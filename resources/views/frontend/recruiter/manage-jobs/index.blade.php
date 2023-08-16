@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','recruiter_manage_job_index')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('style')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>

@endsection
@section('content')

    <style>
        .recru-dash-headv1 {
            top: 111px;
            width: 100%;
            left: 0px;
        }
    </style>
    <!--main-->
    <div class="recruiter-main-dashboard">
        <div class="recru-dash-head">
            <div class="recru-dash-headv1">
                <p>bottom</p>
            </div>

            {{--@include('frontend.recruiter.partials.sidebar')--}}

            <div class="recru-dash-item2">
                <div class="recru-dash-item2-v1">
                    <div class="recru-dash-item2-v1-title">
                        <h3><a href="{{url('recruiter/dashboard')}}" class="font-14"> <i class="fa fa-arrow-left"></i>
                                Dashboard </a>&nbsp;&nbsp;&nbsp;&nbsp; Manage your jobs</h3>
                    </div>


                </div>
                <div class="recru-dash-item2-v1-list">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link recruiter-tab active" id="pills-home-tab" data-toggle="pill"
                               href="#pills-active" role="tab" aria-controls="pills-active" aria-selected="true">Active
                                Jobs ({{$activeJobs}})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link recruiter-tab" id="pills-profile-tab" data-toggle="pill"
                               href="#pills-paused" role="tab" aria-controls="pills-paused" aria-selected="false">Paused
                                Jobs ({{$pausedJobs}})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link recruiter-tab" id="pills-contact-tab" data-toggle="pill"
                               href="#pills-expired" role="tab" aria-controls="pills-expired" aria-selected="false">Expired
                                Jobs ({{$expiredJobs}})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link recruiter-tab" id="pills-contact-tab" data-toggle="pill"
                               href="#pills-draft" role="tab" aria-controls="pills-draft" aria-selected="false">Draft
                                Jobs ({{$draftJobs}})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link recruiter-tab" id="pills-contact-tab" data-toggle="pill"
                               href="#pills-closed" role="tab" aria-controls="pills-closed" aria-selected="false">Closed
                                Jobs ({{$closedJobs}})</a>
                        </li>


                    </ul>

                </div>
                <div class="recur-item2-maincontent">

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-active" role="tabpanel"
                             aria-labelledby="pills-home-tab">


                            @if($activeJobs>0)

                                <div class="topactive-recru-post col-md-12">

                                    <table class="table table-align table-bordered table-no-border">
                                        <thead>
                                        <tr class="table-tr">
                                            <th scope="col">Job Title</th>
                                            <th scope="col">Candidates</th>
                                            {{--<th scope="col">Sponsorship Status</th>--}}
                                            <th scope="col">Job Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($jobs as $job)
                                            @if($job->job_status == 'active')
                                                <tr>


                                                    <td scope="col">

                                                        <a href="{{url('recruiter/job-stats/'.$job->unique_string)}}"
                                                           class="external-url">
                                                            <h4 class="job_title">{{$job->title}}</h4>
                                                        </a>

                                                        <h6 class="job_loc">{{$job->name}}</h6>
                                                        <h6 class="job_loc">
                                                            <small>Created: {{$job->created_at->diffForHumans()}}</small>
                                                        </h6>
                                                    </td>
                                                    <td scope="col" class="text-center">

                                                        <div class="CandidateBreakdown">
                                                            <div class="CandidateBreakdown-total">
                                                                <a class="CandidateBreakdown-total-link"
                                                                   href="{{url('recruiter/applicants/'.$job->unique_string)}}">
                                                                    {{$job->applications('job_id')->count()}} Active
                                                                    Candidates
                                                                </a>
                                                            </div>
                                                            <div class="CandidateBreakdown-counts">
                                                                <div class="CandidateTotal awaiting-review">
                                                                    <a class="CandidateTotal-link" href="#">
                                                                        <h4>{{$job->application_awaiting('job_id')->count()}}</h4>
                                                                        <div class="CandidateTotal-label"><h6>
                                                                                Awaiting</h6></div>
                                                                    </a>
                                                                </div>
                                                                <div class="CandidateTotal reviewed">
                                        <span class="CandidateTotal-link">
                                            <h4>{{$job->application_reviewed('job_id')->count()}}</h4>
                                    <div class="CandidateTotal-label"><h6>Reviewed</h6>
                                    </div>
                                        </span>
                                                                </div>
                                                                <div class="CandidateTotal contacting">
                                        <span class="CandidateTotal-link">
                                            <h4>{{$job->application_shortlisted('job_id')->count()}}</h4>
                                    <div class="CandidateTotal-label"><h6>Shortlisted</h6></div>
                                        </span>
                                                                </div>
                                                                <div class="CandidateTotal hired ">
                                        <span class="CandidateTotal-link"><h4>0</h4>
                                            <div class="CandidateTotal-label"><h6>Hired</h6></div>
                                        </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>


                                                    {{-- <td class="width-300">--}}

                                                    {{-- <b>Free Post</b> - <a href="#" class="text-blue"><b>Sponsor job</b></a>--}}
                                                    {{-- <div class="clearfix"></div>--}}
                                                    {{-- ~40 (est) more candidates if you sponsor.--}}
                                                    {{-- <div class="clearfix"></div>--}}
                                                    {{-- <b><a href="#" class="text-blue">Learn more</a></b>--}}

                                                    {{-- </td>--}}

                                                    <td class=" text-center">

                                                        <div class="list-group inline-block listgroup">
                                                            <a href="#" data-status="active"
                                                               data-job-id="{{encrypt($job->job_id)}}"
                                                               class="list-group-item list-group-item-action @if($job->job_status == 'active') active @endif">
                                                                Active</a>
                                                            <a href="#" data-status="paused"
                                                               data-job-id="{{encrypt($job->job_id)}}"
                                                               class="list-group-item list-group-item-action @if($job->job_status == 'paused') active @endif">Pause</a>
                                                            <a href="#" data-status="closed"
                                                               data-job-id="{{encrypt($job->job_id)}}"
                                                               class="list-group-item list-group-item-action @if($job->job_status == 'closed') active @endif">Close</a>

                                                        </div>

                                                    </td>


                                                    <td>

                    <a href="{{url('job/'.$job->slug)}}?modeView=true" target="_blank" class="btn btn-xs btn-info block" ><i class="fa fa-eye"></i></a>
                    <a href="{{url('recruiter/job-stats/'.$job->unique_string)}}" class="btn btn-xs btn-info block" data-block="1"><i class="fa fa-chart-bar"></i> Stats</a>
                                                        <a href="{{url('recruiter/job-edit/'.$job->unique_string)}}"
                                                           class="btn btn-xs btn-primary block" data-block="1"><i
                                                                    class="fa fa-edit"></i> Edit</a>
                                                        <a href="{{url('recruiter/job-delete/'.$job->unique_string)}}"
                                                           onclick="return confirm('Are you sure u want to delete  this job?')"
                                                           class="btn btn-xs btn-danger block" data-block="1"><i
                                                                    class="fa fa-trash"></i> Delete</a>


                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            @else
                                <div class="text-center mb-5">
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
                        <div class="tab-pane fade" id="pills-paused" role="tabpanel"
                             aria-labelledby="pills-profile-tab">

                            @if($pausedJobs>0)

                                <div class="topactive-recru-post col-md-12">

                                    <table class="table table table-align table-bordered table-no-border">
                                        <thead class="bold">
                                        <tr class="table-tr">
                                            <th scope="col">Job Title</th>
                                            <th scope="col">Candidates</th>
                                            {{--<th scope="col">Sponsorship Status</th>--}}
                                            <th scope="col">Job Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($jobs as $job)
                                            @if($job->job_status == 'paused')
                                                <tr>

                                                    <td scope="col">
                                                        <a href="{{url('job/'.$job->slug)}}?modeView=true" target="_blank" class="btn btn-xs btn-info block" ><i class="fa fa-eye"></i></a>
                                                        <a href="{{url('recruiter/job-stats/'.$job->unique_string)}}"
                                                           class="external-url">
                                                            <h4 class="job_title">{{$job->title}}</h4>
                                                        </a>

                                                        <h6 class="job_loc">{{$job->name}}</h6>
                                                        <h6 class="job_loc">
                                                            <small>Created: {{$job->created_at->diffForHumans()}}</small>
                                                        </h6>
                                                    </td>
                                                    <td scope="col" class="text-center">

                                                        <div class="CandidateBreakdown">
                                                            <div class="CandidateBreakdown-total">
                                                                <a class="CandidateBreakdown-total-link"
                                                                   href="{{url('recruiter/applicants/'.$job->unique_string)}}">
                                                                    {{$job->applications('job_id')->count()}} Active
                                                                    Candidates
                                                                </a>
                                                            </div>
                                                            <div class="CandidateBreakdown-counts">
                                                                <div class="CandidateTotal awaiting-review">
                                                                    <a class="CandidateTotal-link" href="#">
                                                                        <h4>{{$job->application_awaiting('job_id')->count()}}</h4>
                                                                        <div class="CandidateTotal-label"><h6>
                                                                                Awaiting</h6></div>
                                                                    </a>
                                                                </div>
                                                                <div class="CandidateTotal reviewed">
                                        <span class="CandidateTotal-link">
                                            <h4>{{$job->application_reviewed('job_id')->count()}}</h4>
                                    <div class="CandidateTotal-label"><h6>Reviewed</h6>
                                    </div>
                                        </span>
                                                                </div>
                                                                <div class="CandidateTotal contacting">
                                        <span class="CandidateTotal-link">
                                            <h4>{{$job->application_shortlisted('job_id')->count()}}</h4>
                                    <div class="CandidateTotal-label"><h6>Shortlisted</h6></div>
                                        </span>
                                                                </div>
                                                                <div class="CandidateTotal hired ">
                                        <span class="CandidateTotal-link"><h4>0</h4>
                                            <div class="CandidateTotal-label"><h6>Hired</h6></div>
                                        </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>


                                                    {{--                                                <td class="width-300">--}}

                                                    {{--                                                    <b>Free Post</b> - <a href="#" class="text-blue"><b>Sponsor job</b></a>--}}
                                                    {{--                                                    <div class="clearfix"></div>--}}
                                                    {{--                                                    ~40 (est) more candidates if you sponsor.--}}
                                                    {{--                                                    <div class="clearfix"></div>--}}
                                                    {{--                                                    <b><a href="#" class="text-blue">Learn more</a></b>--}}

                                                    {{--                                                </td>--}}

                                                    <td class=" text-center">

                                                        <div class="list-group inline-block listgroup">
                                                            <a href="#" data-status="active"
                                                               data-job-id="{{encrypt($job->job_id)}}"
                                                               class="list-group-item list-group-item-action  @if($job->job_status == 'active') active @endif">
                                                                Active</a>
                                                            <a href="#" data-status="paused"
                                                               data-job-id="{{encrypt($job->job_id)}}"
                                                               class="list-group-item list-group-item-action @if($job->job_status == 'paused') active @endif">Pause</a>
                                                            <a href="#" data-status="closed"
                                                               data-job-id="{{encrypt($job->job_id)}}"
                                                               class="list-group-item list-group-item-action @if($job->job_status == 'closed') active @endif">Close</a>

                                                        </div>

                                                    </td>


                                                    <td scope="col">
                                                        <a href="{{url('job/'.$job->slug)}}?modeView=true" target="_blank" class="btn btn-xs btn-info block" ><i class="fa fa-eye"></i></a>
                                                        <a href="{{url('recruiter/job-stats/'.$job->unique_string)}}"
                                                           class="btn btn-xs btn-info block" data-block="1"><i
                                                                    class="fa fa-chart-bar"></i> Stats</a>
                                                        <a href="{{url('recruiter/job-edit/'.$job->unique_string)}}"
                                                           class="btn btn-primary btn-xs block"><i
                                                                    class="fa fa-edit"></i> Edit</a>
                                                        <a href="{{url('recruiter/job-delete/'.$job->unique_string)}}"
                                                           onclick="return confirm('Are you sure u want to delete this job?')"
                                                           class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                                            Delete</a>


                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            @else
                                <div class="text-center mb-5">
                                    <img src="{{asset('frontend/assets/img/fratreslogofinal.png')}}">
                                    <div class="topactive-recru-post">
                                        <p>You have no Pending jobs</p>
                                        <a href="{{url('recruiter/job_post')}}" class="btn btn-primary">
                                            post a new job
                                        </a>
                                    </div>
                                </div>
                            @endif

                        </div>


                        <div class="tab-pane fade show" id="pills-closed" role="tabpanel"
                             aria-labelledby="pills-home-tab">


                            @if($closedJobs>0)

                                <div class="topactive-recru-post col-md-12">

                                    <table class="table table-align table-bordered table-no-border">
                                        <thead>
                                        <tr class="table-tr">
                                            <th scope="col">Job Title</th>
                                            <th scope="col">Candidates</th>
                                            {{--<th scope="col">Sponsorship Status</th>--}}
                                            <th scope="col">Job Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($jobs as $job)
                                            @if($job->job_status == 'closed')
                                                <tr>


                                                    <td scope="col">

                                                        <a href="{{url('job/'.$job->slug)}}" class="external-url">
                                                            <h4 class="job_title">{{$job->title}}</h4>
                                                        </a>

                                                        <h6 class="job_loc">{{$job->name}}</h6>
                                                        <h6 class="job_loc">
                                                            <small>Created: {{$job->created_at->diffForHumans()}}</small>
                                                        </h6>
                                                    </td>
                                                    <td scope="col" class="text-center">

                                                        <div class="CandidateBreakdown">
                                                            <div class="CandidateBreakdown-total">
                                                                <a class="CandidateBreakdown-total-link"
                                                                   href="{{url('recruiter/applicants/'.$job->unique_string)}}">
                                                                    {{$job->applications('job_id')->count()}} Active
                                                                    Candidates
                                                                </a>
                                                            </div>
                                                            <div class="CandidateBreakdown-counts">
                                                                <div class="CandidateTotal awaiting-review">
                                                                    <a class="CandidateTotal-link" href="#">
                                                                        <h4>{{$job->application_awaiting('job_id')->count()}}</h4>
                                                                        <div class="CandidateTotal-label"><h6>
                                                                                Awaiting</h6></div>
                                                                    </a>
                                                                </div>
                                                                <div class="CandidateTotal reviewed">
                                        <span class="CandidateTotal-link">
                                            <h4>{{$job->application_reviewed('job_id')->count()}}</h4>
                                    <div class="CandidateTotal-label"><h6>Reviewed</h6>
                                    </div>
                                        </span>
                                                                </div>
                                                                <div class="CandidateTotal contacting">
                                        <span class="CandidateTotal-link">
                                            <h4>{{$job->application_shortlisted('job_id')->count()}}</h4>
                                    <div class="CandidateTotal-label"><h6>Shortlisted</h6></div>
                                        </span>
                                                                </div>
                                                                <div class="CandidateTotal hired ">
                                        <span class="CandidateTotal-link"><h4>0</h4>
                                            <div class="CandidateTotal-label"><h6>Hired</h6></div>
                                        </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>


                                                    {{--                                                    <td class="width-300">--}}

                                                    {{--                                                        <b>Free Post</b> - <a href="#" class="text-blue"><b>Sponsor job</b></a>--}}
                                                    {{--                                                        <div class="clearfix"></div>--}}
                                                    {{--                                                        ~40 (est) more candidates if you sponsor.--}}
                                                    {{--                                                        <div class="clearfix"></div>--}}
                                                    {{--                                                        <b><a href="#" class="text-blue">Learn more</a></b>--}}

                                                    {{--                                                    </td>--}}

                                                    <td class=" text-center">

                                                        <div class="list-group inline-block listgroup">
                                                            <a href="#" data-status="active"
                                                               data-job-id="{{encrypt($job->job_id)}}"
                                                               class="list-group-item list-group-item-action @if($job->job_status == 'active') active @endif">
                                                                Active</a>
                                                            <a href="#" data-status="paused"
                                                               data-job-id="{{encrypt($job->job_id)}}"
                                                               class="list-group-item list-group-item-action @if($job->job_status == 'paused') active @endif">Pause</a>
                                                            <a href="#" data-status="closed"
                                                               data-job-id="{{encrypt($job->job_id)}}"
                                                               class="list-group-item list-group-item-action @if($job->job_status == 'closed') active @endif">Close</a>

                                                        </div>

                                                    </td>


                                                    <td>
                                                        <a href="{{url('job/'.$job->slug)}}?modeView=true" target="_blank" class="btn btn-xs btn-info block" ><i class="fa fa-eye"></i></a>
                                                        <a href="{{url('recruiter/job-stats/'.$job->unique_string)}}"
                                                           class="btn btn-xs btn-info block" data-block="1"><i
                                                                    class="fa fa-chart-bar"></i> Stats</a>
                                                        <a href="{{url('recruiter/job-edit/'.$job->unique_string)}}"
                                                           class="btn btn-xs btn-primary block" data-block="1"><i
                                                                    class="fa fa-edit"></i> Edit</a>
                                                        <a href="{{url('recruiter/job-delete/'.$job->unique_string)}}"
                                                           onclick="return confirm('Are you sure u want to delete  this job?')"
                                                           class="btn btn-xs btn-danger block" data-block="1"><i
                                                                    class="fa fa-trash"></i> Delete</a>


                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            @else
                                <div class="text-center mb-5">
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

                        <div class="tab-pane fade" id="pills-expired" role="tabpanel"
                             aria-labelledby="pills-contact-tab">

                            @if($expiredJobs>0)

                                <div class="topactive-recru-post col-md-12">

                                    <table class="table table table-align table-bordered table-no-border">
                                        <thead>
                                        <tr class="table-tr">
                                            <th scope="col">Job Title</th>
                                            <th scope="col">Candidates</th>
                                            {{--<th scope="col">Sponsorship Status</th>--}}
                                            <th scope="col">Job Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($jobs as $job)
                                            @if($job->job_status == 'expired')
                                                <tr>

                                                    <td scope="col">

                                                        <a href="{{url('job/'.$job->slug)}}" class="external-url">
                                                            <h4 class="job_title">{{$job->title}}</h4>
                                                        </a>

                                                        <h6 class="job_loc">{{$job->name}}</h6>
                                                        <h6 class="job_loc">
{{--                                                            <small>Expired: {{$job->expiry_date->diffForHumans()}}</small>--}}
                                                        </h6>
                                                    </td>
                                                    <td scope="col" class="text-center">

                                                        <div class="CandidateBreakdown">
                                                            <div class="CandidateBreakdown-total">
                                                                <a class="CandidateBreakdown-total-link"
                                                                   href="{{url('recruiter/applicants/'.$job->unique_string)}}">
                                                                    {{$job->applications('job_id')->count()}} Active
                                                                    Candidates
                                                                </a>
                                                            </div>
                                                            <div class="CandidateBreakdown-counts">
                                                                <div class="CandidateTotal awaiting-review">
                                                                    <a class="CandidateTotal-link" href="#">
                                                                        <h4>{{$job->application_awaiting('job_id')->count()}}</h4>
                                                                        <div class="CandidateTotal-label"><h6>
                                                                                Awaiting</h6></div>
                                                                    </a>
                                                                </div>
                                                                <div class="CandidateTotal reviewed">
                                        <span class="CandidateTotal-link">
                                            <h4>{{$job->application_reviewed('job_id')->count()}}</h4>
                                    <div class="CandidateTotal-label"><h6>Reviewed</h6>
                                    </div>
                                        </span>
                                                                </div>
                                                                <div class="CandidateTotal contacting">
                                        <span class="CandidateTotal-link">
                                            <h4>{{$job->application_shortlisted('job_id')->count()}}</h4>
                                    <div class="CandidateTotal-label"><h6>Shortlisted</h6></div>
                                        </span>
                                                                </div>
                                                                <div class="CandidateTotal hired ">
                                        <span class="CandidateTotal-link"><h4>0</h4>
                                            <div class="CandidateTotal-label"><h6>Hired</h6></div>
                                        </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>


                                                    <td class="width-300">

                                                        N/A

                                                    </td>

                                                    <td class=" text-center">

                                                        N/A


                                                    </td>

                                                    <th scope="col">
                                                        <a href="{{url('recruiter/applicants/'.$job->unique_string)}}"
                                                           class="btn btn-success btn-sm"><i
                                                                    class="fa fa-chart-bar"></i> Applicants</a>


                                                    </th>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            @else
                                <div class="text-center mb-5">
                                    <img src="{{asset('frontend/assets/img/fratreslogofinal.png')}}">
                                    <div class="topactive-recru-post">
                                        <p>You have no expired jobs</p>
                                        <a href="{{url('recruiter/job_post')}}" class="btn btn-primary">
                                            post a new job
                                        </a>
                                    </div>
                                </div>
                            @endif

                        </div>


                        <div class="tab-pane fade" id="pills-draft" role="tabpanel" aria-labelledby="pills-contact-tab">

                            {{--draft jobs--}}

                            @if($draftJobs>0)

                                <div class="topactive-recru-post col-md-12">

                                    <table class="table table table table-align table-bordered table-no-border">
                                        <thead>
                                        <tr class="table-tr">
                                            <th scope="col">Job Title</th>

                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                                                                @foreach($jobs as $job)
                                                                                    @if($job->job_status == 'draft')
                                                                                    <tr>
                                                                                        <th scope="col" class="">

                                                                                            <a href="{{url('job/'.$job->slug)}}" class="external-url">
                                                                                                <h4 class="job_title">{{$job->title}}</h4>
                                                                                            </a>

                                                                                            <h6 class="job_loc">{{$job->name}}</h6>
                                                                                            <h6 class="job_loc"><small>Created: {{$job->created_at->diffForHumans()}}</small></h6>


                                                                                        </th>

                                                                                        <th scope="col">
                                                                                        @if($isPaid)
                                                                                        @if($job->job_id != NULL)
                                                                                            <a href="{{url('recruiter/job-post/pay/'.$job->unique_string)}}" class="btn btn-primary btn-sm"><i class="fa fa-check"></i>  Publish</a>
                                                                                        @else
                                                                                                <a href="{{url('recruiter/job-billing/'.$job->unique_string)}}" class="btn btn-primary btn-sm"><i class="fa fa-check"></i>  Publish</a>
                                                                                        @endif
                                                                                        @endif

                                                                                            <a href="{{url('recruiter/job-edit/'.$job->unique_string)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>  Edit</a>
                                                                                            <a href="{{url('recruiter/job-delete/'.$job->unique_string)}}" onclick="return confirm('Are you sure u want to delete  this job?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>


                                                                                        </th>
                                                                                    </tr>
                                                                                    @endif
                                                                                @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            @else
                                <div class="text-center mb-5">
                                    <img src="{{asset('frontend/assets/img/fratreslogofinal.png')}}">
                                    <div class="topactive-recru-post">
                                        <p>You have no Draft jobs</p>
                                        <a href="{{url('recruiter/job_post')}}" class="btn btn-primary">
                                            post a new job
                                        </a>
                                    </div>
                                </div>
                            @endif

                            {{--draft jobs--}}

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
        $(function () {
            $('.recru-dash-item2-v1-list ul.nav li').on('click', function () {
                $(this).parent().find('li.active').removeClass('active');
                $(this).addClass('active');
            });
        });

        $(document).on("click", ".list-group-item-action", function (e) {
            e.preventDefault();
            var status = $(this).attr("data-status");
            var job_id = $(this).attr("data-job-id");


            $(this).closest("div").find('.list-group-item-action').removeClass("active");
            var list_item = $(this);

            $.ajax({
                url: "/recruiter/job-status/" + job_id + "?status=" + status,
                type: 'GET',
                success: function (data) {
                    if (data == 'ok') {
                        list_item.addClass("active");
                        swal({
                            position: 'top-end',
                            icon: 'success',
                            title: "Updated Successfully",
                            showConfirmButton: false,
                            timer: 2500
                        })
                    }
                    location.reload();
                }

            });

        });
    </script>
@endsection
