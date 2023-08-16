@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','homepage')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection

<link rel="stylesheet" href="{{url('frontend/tagify/tagify.css')}}">


    <script src="{{url('frontend/tagify/tagify.min.js')}}"></script>

    <script src="{{url('frontend/tagify/jQuery.tagify.min.js')}}"></script>

@section('content')
    <style>
        body{
            background-color: #f7f7f7;
        }
        #rso{
            background: transparent !important;
        }
        #rso:hover{
            background: transparent !important;
        }
        .fratres_resume_jobee_mainhead {
            word-break: break-all;
        }
        .width-60{
            width:60%;
        }
    </style>
    <br>
    <div class="col-md-11">


        <div class="fratres_resume_main">
            <div class="container-fluid">


                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="#">{{$seeker->first_name}} {{$seeker->last_name}}</a></li>

                    </ol>
                </nav>

                <br>

                <div class="fratres_resume_jobee_mainhead">
                    <div class="fratres_resume_item1">
                        <div class="fratres_resume_info_summary">
                            <div class="fratres_resume_info_logo">
                                <div class="resume_logo_fratres">
                                    @if($seeker->avatar != '')
                                        <img src="{{url('seekers/profile/'.getDomainRoot().$seeker->avatar)}}">
                                    @endif
                                </div>
                                <div class="resume_details_fratres">
                                    <h2>{{$seeker->first_name}} {{$seeker->last_name}} </h2>
                                    <h5>{{$seeker->current_job_title}} @if($seeker->current_job_title != '') at {{$seeker->current_company}} @endif</h5>
                                </div>
                            </div>
                            @if($seeker->summary != '')
                            <div class="resume_sumary_fulldetails">
                                <p>{!! strip_tags($seeker->summary) !!}</p>
                            </div>
                            @endif
                        </div>
                        <div class="skill_strength_resume_head">
                            <h2>
                                <span><i class="fas fa-signal"></i></span>Strength &amp; Skills
                            </h2>
                            <div class="row">
                                @if($skills != null)
                                    @foreach(explode(",", $skills) as $skill)
                                <div class="col-lg-4">
                                    <ul>
                                        <li>
                                            <span><i class="fas fa-check"></i></span>{{$skill}}
                                        </li>
                                    </ul>
                                </div>
                                    @endforeach
                                @else
                                    <div class="col-md-4">
                                        No Skills Added
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="expres_resume_mainhead">
                            <div class="exp_resume_head">
                                <h3 class="heading-border">
                                    <span><i class="far fa-check-square font-20"></i></span>Experience <strong>{{$seeker->experience_years}}</strong> years
                                </h3>

                            </div>
                            @if($experiences->count() > 0)
                            @foreach($experiences as $experience)
                            <div class="exp_history_main">
                                <div class="exp_his_item1 col-md-7">
                                    <h5 class="font-16"><b>{{$experience->job_title}}</b></h5>
                                    <h5>{{$experience->company}}</h5>
                                </div>
                                <div class="exp_his_item2 col-md-2">
                                    @php

                                        $date = Carbon\Carbon::parse($experience->date_end);
                                        $now = Carbon\Carbon::parse($experience->date_start);

                                        $diff = $date->DiffInMonths($now);
                                    @endphp
                                    <h5 class="font-16"><b class="font-color">{{showYears($diff)}}</b></h5>

                                </div>
                                <div class="exp_his_item3 col-md-3">
                                    <h5 class="font-16"><b>{{date("M Y", strtotime($experience->date_start))}} - {{date("M Y", strtotime($experience->date_end))}}</b></h5>

                                </div>
                            </div>
                                <hr class="hr">
                            @endforeach
                            @else
                                <div class="exp_history_main">
                                    Experience is not added
                                </div>
                            @endif

                        </div>
                        <div class="project_head_resume">
                            <div class="project_resume_fratres">
                                <h3 class="heading-border">
                                    <span><i class="fas fa-list font-color font-20"></i></span> projects
                                </h3>
                            </div>
                            <div class="project_list_resume">

                                    @foreach($projects as $project)
                                        <div class="exp_history_main">
                                            <div class="exp_his_item1 col-md-7">
                                                <h5 class="font-16"><b>{{$project->project_title}}</b></h5>
                                                <h5>{{$project->company}}</h5>
                                            </div>
                                            <div class="exp_his_item2 col-md-2">
                                                @php

                                                    $date = Carbon\Carbon::parse($project->date_end);
                                                    $now = Carbon\Carbon::parse($project->date_start);

                                                    $diff = $date->diffInMonths($now);
                                                @endphp
                                                <h5 class="font-16"><b class="font-color">{{showYears($diff)}}</b></h5>

                                            </div>
                                            <div class="exp_his_item3 col-md-3">
                                                <h5 class="font-16"><b class="">{{date("M Y", strtotime($project->date_start))}} - {{date("M Y", strtotime($project->date_end))}}</b></h5>
<a href="{{$project->project_url}}" class="float-right font-color">{{$project->project_url}}</a>
                                            </div>
                                        </div>


                                        <hr class="hr">
                                    @endforeach


                            </div>
                        </div>
                        <div class="project_head_resume">
                            <div class="project_resume_fratres">
                                <h3 class="heading-border">
                                    <span><i class="fas fa-graduation-cap font-color font-20"></i></span> Education
                                </h3>
                            </div>
                            <div class="project_list_resume">

                                    @if($education->count() > 0)
                                    @foreach($education as $education_is)
                                            <div class="exp_history_main">
                                                <div class="exp_his_item1 width-60">
                                                    <h5 class="font-16"><b>{{$education_is->school}}</b></h5>
                                                    <h5 class="font-color">{{$education_is->degree}} ({{$education_is->grade}})</h5>
                                                </div>

                                                <div class="exp_his_item3">
                                                    <h5 class="font-16"><b>{{$education_is->year}}</b></h5>
                                                    <a href="{{$education_is->project_url}}" class="float-right font-color">{{$education_is->project_url}}</a>
                                                </div>
                                            </div>

                                        <hr class="hr">
                                    @endforeach
                                        @else
                                        <span class="ml-5">not added</span>
                                        @endif


                            </div>
                        </div>

                        <div class="project_head_resume">
                            <div class="project_resume_fratres">
                                <h3 class="heading-border">
                                    <span><i class="fas fa-graduation-cap font-color font-20"></i></span> Certifications
                                </h3>
                            </div>
                            <div class="project_list_resume">

                                    @if($certifications->count() > 0)
                                    @foreach($certifications as $certification)
                                            <div class="exp_history_main">
                                                <div class="exp_his_item1 width-60">
                                                    <h5 class="font-16"><b>{{$certification->certification_name}}</b></h5>
                                                    <h5 class="font-color">{{$certification->certification_url}} </h5>
                                                </div>

                                                <div class="exp_his_item3">
                    <h5 class="font-16"><b>Completed On {{date("M Y", strtotime($certification->end_date))}}</b></h5>
                                                </div>
                                            </div>

                                        <hr class="hr">
                                    @endforeach
                                        @else
                                    <span class="ml-5">not added</span>
                                        @endif


                            </div>
                        </div>

                    </div>
                    <div class="clearfix"><br><br></div>
                    <div class="fratres_resume_item2">
                        <div class="contact_resume_info">
                            <h3 class="font-20">Contact info</h3>
                            <h5><span><i class="fas fa-mobile-alt"></i></span>
                                @if($seeker->phone != '')
                                    {{show_phone($seeker->phone, 'phone')}}
                                @endif
                            </h5>
                            <h5><span><i class="fas fa-envelope"></i></span>{{$seeker->email}}</h5>
                            <div class="contact_home_resume">
                                <h5><span><i class="fas fa-home"></i></span>{{$seeker->city}} , {{$seeker->country}}</h5>
                            </div>
                        </div>
                        <div class="academics_head_resume">
                            <h3  class="font-20"><span><i class="fas fa-graduation-cap font-20"></i></span>Career Level</h3>

                            <h5 class="font-14">
                                    {{$seeker->career_level}}
                            </h5>

                        </div>

                        <div class="academics_head_resume">
                            <h3 class="font-20"><span><i class="fas fa-cog font-20"></i></span>Industries</h3>
                            <ul>
                                <li>
                                    @if($seeker->industry != '')
                                        {{$seeker->industry->name}}
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <div class="academics_head_resume">
                            <h3 class="font-20"><span><i class="fas fa-sun font-20"></i></span>Available</h3>
                            <ul>
                                @if($seeker->available_job_type != '')
                                    @php
                                        $jobTypes = explode(",",$seeker->available_job_type);
                                    @endphp
                                    @if($jobTypes)
                                        @foreach($jobTypes as $jobType)
                                            <li>
                                                {{$jobType}}
                                            </li>
                                        @endforeach
                                    @endif
                                @else
                                    <li>not added</li>
                                @endif

                            </ul>
                        </div>
                        <div class="academics_head_resume">
                            <h3 class="font-20"><span><i class="fas fa-volume-up font-20"></i></span>Languages</h3>
                            <ul>
                                @if($seeker->languages != '')
                                    @php
                                        $languages = json_decode($seeker->languages);
                                    @endphp
                                    @if($languages)
                                        @foreach($languages as $language)
                                            <li>
                                                {{$language->value}}
                                            </li>
                                        @endforeach
                                    @endif
                                @else
                                    <li>not added</li>
                                @endif

                            </ul>
                        </div>
                        <div class="academics_head_resume">
                            <h3 class="font-20"><span><i class="far fa-star font-20"></i></span>Hobbies</h3>
                            <ul>
                                @if($seeker->hobbies != '')
                                    @php
                                    $hobbies = json_decode($seeker->hobbies);
                                    @endphp
                                @if($hobbies)
                                    @foreach($hobbies as $hobby)
                                    <li>
                                        {{$hobby->value}}
                                    </li>
                                        @endforeach
@endif
                                    @else
                                    <li>not added</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection