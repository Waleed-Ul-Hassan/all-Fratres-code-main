@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','recruiter_applications_index')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('style')
    <link rel="stylesheet" href="{{url('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

    <!-- AdminLTE App -->
    <script src="{{url('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>

@endsection
@section('content')
    <style>
        .btn-light{
            width:320px !important;
        }
        @media screen and (max-width: 980px) {
            .footer-cookie{
                width: 125%;
            }
            .bootstrap-select .dropdown-menu{
                left: 77px !important;

            }
        }
    </style>
    <!--main-->
    <div class="recruiter-main-dashboard">
        <div class="recru-dash-head">


            {{--@include('frontend.recruiter.partials.sidebar')--}}

            <div class="recru-dash-item2 container-fluid">
                <br>

                <div class="recur-item2-maincontent">

                    <div class="col-md-12">

                        <a href="{{url('recruiter/manage-jobs')}}"> <b> <i class="fa fa-arrow-left"></i> Manage Jobs </b> </a>
                        <div> <br></div>

                    <div class="card">

                        <div class="card-header">

                            <div class="row">
                                <div class="col-md-4 d-c-small">
                                    <select name="jobs" id="" class="selectpicker jobs_search_applicant" data-live-search="true">
                                        <optgroup label="Total : {{count($jobs)}}" data-max-options="2"></optgroup>
                                        @foreach($jobs as $jobes)
                                            <option value="{{$jobes->unique_string}}" @if($jobes->id == $job->id) selected @endif data-subtext="{{$jobes->get_city->name}}">{{$jobes->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <ul class="list-group list-group-horizontal status-boxes">
                                        <a href="{{url('recruiter/applicants/'.$job->unique_string)}}" class="list-group-item @if(!isset($_GET['status'])) active @endif">
                                            <span>{{$job->applicants->where('short_listed', '!=', 2)->count()}}</span> Active
                                        </a>
                                        <a href="{{url('recruiter/applicants/'.$job->unique_string.'?status=awaiting')}}" class="list-group-item {{getActive('status','awaiting')}}">
                                            <span>{{$job->application_awaiting('id')->count()}}</span>  Awaiting Review
                                        </a>
                                        <a href="{{url('recruiter/applicants/'.$job->unique_string.'?status=reviewed')}}" class="list-group-item {{getActive('status','reviewed')}}">
                                            <span>{{$job->application_reviewed('id')->count()}}</span>  Reviewed
                                        </a>
                                        <a href="{{url('recruiter/applicants/'.$job->unique_string.'?status=shortlist')}}" class="list-group-item {{getActive('status','shortlist')}}">
                                            <span>{{$job->application_shortlisted('id')->count()}}</span>  Short Listed
                                        </a>
                                        <a href="{{url('recruiter/applicants/'.$job->unique_string.'?status=rejected')}}" class="list-group-item {{getActive('status','rejected')}}">
                                            <span>{{$job->application_rejected('id')->count()}}</span>  Rejected
                                        </a>

                                    </ul>
                                </div>

                                <div class="col-md-2">
                {{--<select name="orderby" class="form-control orderby" >--}}
                    {{--<option value="">Sort By</option>--}}
                    {{--<option value="a-z" {{getActive('orderBy','a-z','selected')}}>Alphabatical A-Z</option>--}}
                    {{--<option value="z-a" {{getActive('orderBy','z-a','selected')}}>Alphabatical Z-A</option>--}}
                    {{--<option value="new" {{getActive('orderBy','new','selected')}}>Apply Date (newest first)</option>--}}
                    {{--<option value="old" {{getActive('orderBy','old','selected')}}>Apply Date (oldest first)</option>--}}

                {{--</select>--}}
                                </div>
                            </div>

                        </div>

                    </div>

                    </div>
                    <br>

                    <div class="tab-content" id="pills-tabContent">


                                <div class="topactive-recru-post col-md-12">

                                    <table class="table table-striped table-hover table-valign-middle table-align table-bordered table-no-border">
                                        <thead>
                                        <tr class="table-tr">
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Apply Date</th>
                                            <th>ShortList?</th>
                                            <th>Available Resumes</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($applicants as $applicant)
                                            @php
                                                $applicant->update(["viewed_at" => date("Y-m-d") ]);
                                                $seeker = App\Seeker::find($applicant->seeker_id);
                                                $job = App\Job::find($applicant->job_id);

                                            @endphp
                                            <tr>
                                                <td scope="col applicants-seeker">
                                                    <p class="name-seeker no-padding">{{$seeker->first_name}} {{$seeker->last_name}} </p>
                                                <p class="text-muted no-padding">{{$seeker->current_job_title}}
                                                {{--<span class="float-right"><i class="fas fa-check-circle" style="color: #39da39;"></i>--}}
                                                    {{--{{count($matched_skills)}} of {{$job->skills->count()}} </span>--}}
                                                        {{--<span class="clearfix"></span>--}}
                                                        {{--<span class="float-right"><b>skills matched</b> </span>--}}

                                                    </p>

                                                    <div>
                                                        <br>
                                                    @if( $applicant->cover_letter != '' )
                                                        <a class="btn btn-primary btn-xs" data-toggle="collapse" href="#collapseExample_{{$loop->index}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                            Cover Letter
                                                        </a>
                                                        <div class="collapse" id="collapseExample_{{$loop->index}}" style="width:70%;margin-top: 10px;position: absolute;z-index:99;border:2px solid #000;">
                                                        <div class="card card-body">
                                                            <b>Cover Letter : </b>{{$applicant->cover_letter}}
                                                        </div>
                                                    @endif
                                                    </div>
                                                    </div>
                                                </td>
                                                <td scope="col">

                                                    @if( $applicant->IsShortlisted() )
                                                        <span class="badge badge-success">Shortlisted</span>
                                                    @else

                                                    @if( $applicant->IsAwaiting() )
                                                        <span class="badge badge-warning">Awaiting Review</span>
                                                    @endif
                                                    @if( $applicant->IsReviewed()  )
                                                        <span class="badge badge-info">Reviewed</span>
                                                    @endif

                                                    @endif


                                                </td>
                                                <td scope="col">
                                                    <p>{{date("d M", strtotime($applicant->created_at))}}</p>

                                                </td>

                                                <td scope="col">

                                                    <ul class="list-group list-group-horizontal">
                                                        <a href="#" class="list-group-item interested interested-yes @if($applicant->short_listed == 1) active @endif" data-val="1" data-id="{{$applicant->id}}">
                                                            <i class="fas fa-check"></i>
                                                        </a>
                                                        @if($applicant->Rejected())
                                                        <a href="#" class="list-group-item interested interested-no" data-val="0" data-id="{{$applicant->id}}" style="background-color: red;color:#fff;border-color:red;"><b>Rejected</b>
                                                        </a>
                                                        @else
                                                            <a href="#" class="list-group-item interested interested-no @if($applicant->Rejected()) active @endif" data-val="2" data-id="{{$applicant->id}}"><b>Reject</b>
                                                            </a>
                                                        @endif

                                                    </ul>

                                                </td>
                                                <td scope="col">
                        @if($seeker->profile_complete == 100)
                            <a href="{{url('view-seeker/'.encrypt($seeker->id))}}" class="btn btn-info btn-xs" target="_blank">View CV</a>
                        @endif
                        @if($seeker->cv_resume != '')
                            <a href="{{url('view-seeker-cv/'.encrypt($seeker->id))}}" class="btn btn-primary btn-xs" target="_blank">Uploaded CV</a>
                        @endif
                        @if($applicant->additional_docs != '')
                            <a href="{{asset('/applicants/' . getDomainRoot().$applicant->additional_docs)}}" download class="btn btn-primary btn-xs" target="_blank">Additional Docs</a>
                        @endif


                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>


                    </div>



                </div>
            </div>


        </div><!--END-->
    </div>
    </div>

@endsection

@section('scripts')

    <script src="{{asset('js/recruiter/applicants.js')}}"></script>
    <script>
        $(document).on("change", ".orderby", function () {

            var url = '';
            var orderBy = $(this).val();
            @if(isset($_GET['status']))
                url = "?status={{$_GET['status']}}&orderBy="+orderBy;
            @else
                url = "?orderBy="+orderBy;
            @endif

            window.location.href = '{{url("/recruiter/applicants/".$job->unique_string)}}'+url;
        });
    </script>
@endsection