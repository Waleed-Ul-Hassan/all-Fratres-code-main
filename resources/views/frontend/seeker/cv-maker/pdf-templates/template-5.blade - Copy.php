<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('frontend/assets/lib/Bootstrap/css/bootstrap.min.css')}}">
    <!-- font-awesome CSS -->

    <!-- style CSS -->
    <link rel="stylesheet" href="{{url('pdf/assets/css/template-3.css')}}">
    <link rel="stylesheet" href="{{url('frontend/assets/css/responsive.css')}}">
    <link rel="stylesheet" href="{{url('frontend/assets/css/slick.css')}}">

    <link rel="stylesheet" href="{{url('frontend/assets/css/owl.css')}}">
    <link rel="stylesheet" href="{{url('frontend/assets/css/owltheme.css')}}">


    <script src="{{url('frontend/assets/lib/jquery/jquery-3.3.1.min.js')}}"></script>


</head>
<body>


<style>
    body {
        background-color: #fff;
    }

    #rso {
        background: transparent !important;
    }

    #rso:hover {
        background: transparent !important;
    }

    @page {
        margin: 15px 0px 0px 0px !important;
        padding: 0px 0px 0px 0px !important;
        background-color: #10266b !important;
    }

</style>

<div style="border:1px solid #ececec;position: fixed; bottom:70px;width:95%;left:2.5%;"></div>

<div class="col-md-3" style=" position:absolute;right:10px;top:30px;">

    <div class="skill_strength_resume_head" style="width:98%;background:#fff;">
        <h2 style="color:#373740;font-size:23px; ">Contact Info</h2>
        <p style="font-size: 12px;margin-left:25px;">{{show_phone($seeker->phone, 'phone')}}</p>
        <p style="font-size: 12px;margin-left:25px;">{{$seeker->email}}</p>
        <hr style="border-color: #E0F5FF;margin-left:10px;">
        <p style="font-size: 12px;margin-left:25px;">{{$seeker->city}}, {{$seeker->country}}</p>
    </div>

    <div class="skill_strength_resume_head" style="width:98%;background:#fff;">
        <h2 style="color:#373740;font-size:23px;">Academics</h2>
        <p style="font-size: 12px;margin-left:25px;">
            {{$education->degree}} | {{$education->year}} | {{$education->grade}}
        </p>
        <p style="font-size: 12px;margin-left:25px;">{{$education->school}}</p>

    </div>


    <div class="skill_strength_resume_head" style="width:98%;background:#fff;">
        <h2 style="color:#373740;font-size:23px;"> Industries</h2>
        <p style="font-size: 12px;margin-left:25px;">
            {{$seeker->industry->name}}
        </p>

    </div>

    <div class="skill_strength_resume_head" style="width:98%;background:#fff;">
        <h2 style="color:#373740;font-size:23px;"> Languages</h2>
        @if($seeker->languages != '')
            @php
                $languages = json_decode($seeker->languages);

            @endphp
            @foreach($languages as $language)
                <p style="font-size: 12px;margin-left:25px;">
                    {{$language->value}}
                </p>
            @endforeach
        @endif
    </div>

    <div class="skill_strength_resume_head" style="width:98%;background:#fff;">
        <h2 style="color:#373740;font-size:23px;"> Hobbies</h2>
        @if($seeker->hobbies != '')
            @php
                $hobbies = json_decode($seeker->hobbies);

            @endphp
            @foreach($hobbies as $hobby)
                <p style="font-size: 12px;margin-left:25px;">
                    {{$hobby->value}}
                </p>
            @endforeach
        @endif

    </div>


</div>


<br><br>
<div class="col-md-9" style="display: inline-block;float:left;">


    <div class="fratres_resume_jobee_mainhead"
         style="display: inline-block;float:left;background-color: #fff !important;width:98%;max-width:98%;border-right:2px solid #e0e0e0;">
        <div class="fratres_resume_item1"
             style="display: inline-block;float:left;background-color: #ffff !important;border-right:2px solid #e0e0e0;">
            <div class="fratres_resume_info_summary"
                 style="width:90%;max-width:90%;background-color: #F74144 !important;">
                <div class="fratres_resume_info_logo">
                    <div class="resume_logo_fratres">
                        @if($seeker->avatar != '')
                            <img src="{{url('seekers/profile/'.$seeker->avatar)}}">
                        @endif
                    </div>
                    <div class="resume_details_fratres">
                        <h2 style="font-size: 22px;margin-left: 150px;">{{$seeker->first_name}} {{$seeker->last_name}} </h2>
                        <h5 style="font-size: 13px;margin-left: 150px;color:#e9e9f1;font-weight:normal;">{{$seeker->current_job_title}} @if($seeker->current_job_title != '')
                                at {{$seeker->current_company}} @endif</h5>
                    </div>
                </div>
                @if($seeker->summary != '')
                    <div class="resume_sumary_fulldetails" style="margin-top: -120px;font-size:13px;">
                        {!! strip_tags($seeker->summary) !!}
                    </div>
                @endif
            </div>
            <div class="fratres_resume_info_summary"
                 style="width:90%;max-width:90%;background-color: #F7F7F7 !important;height:auto !important;">
                <div class="fratres_resume_info_logo">
                    <div class="resume_logo_fratres" style="width:100%;">
                        <h3> Strengths & Skills</h3>
                    </div>
                    <div class="resume_details_fratres" style="width:90%;padding-bottom:20px; margin-bottom:40px;">


                        <ul style="padding-left: 0px !important;margin-left: 0px !important;margin-top: 10px !important;list-style-type: disc !important; width:90%;height: auto;padding-bottom: 0px; margin-bottom:0px !important;">
                            @foreach($skills as $skill)

                                <li style="display:inline-block;width:33%;margin-bottom:10px !important;">
                                    {{$skill->name}}
                                </li>
                                @if( ($loop->index+1) %3==0)
                                    <p></p>
                                @endif
                            @endforeach
                        </ul>


                    </div>
                </div>
            </div>


            <div class="fratres_resume_info_summary"
                 style="width:90%;max-width:90%;background-color: #fff !important;height:auto !important;border-top:2px solid #F74144;">
                <div class="fratres_resume_info_logo">
                    <div class="resume_logo_fratres" style="width:100%;">
                        <h3> Work Experience</h3>
                    </div>
                    <div class="resume_details_fratres" style="width:90%;padding-bottom:20px; margin-bottom:40px;">


                        @foreach($experiences as $experience)


                            <div class="exp_history_main" style="margin-left: -20px; width:100%;">
                                <div class="exp_his_item1" style="background: #F74144;padding:10px;">
                                    <h5 class="font-16" style="color:#e9e9f1;">{{$experience->job_title}}</h5>
                                    <h5>{{$experience->company}}</h5>
                                </div>

                                <div class="exp_his_item3" style="background: #EFEFEF;padding:10px;">
                                    <h5 style="color:#e9e9f1;float:right;font-size:11px;font-weight: normal;">
                                        ({{date("M Y", strtotime($experience->date_start))}}
                                        - {{date("M Y", strtotime($experience->date_end))}})</h5>
                                    <h5 style="color:#e9e9f1;float:right;font-size:11px;font-weight: normal;margin-top:20px;">
                                        ({{$experience->job_city}}, {{$experience->job_country}})</h5>

                                </div>

                            </div>
                            <div class="exp_his_item3" style="margin-left:-20px;font-size:12px;">
                                {!! strip_tags($experience->description) !!}
                            </div>
                            <p style="margin-top: 30px !important;"></p>

                        @endforeach


                    </div>
                </div>
            </div>


            <div class="fratres_resume_info_summary"
                 style="width:90%;max-width:90%;background-color: #fff !important;height:auto !important;border-top:2px solid #F74144;">
                <div class="fratres_resume_info_logo">
                    <div class="resume_logo_fratres" style="width:100%;">
                        <h3> Projects</h3>
                    </div>
                    <div class="resume_details_fratres" style="width:90%;padding-bottom:20px; margin-bottom:40px;">


                        @foreach($projects as $project)


                            <div class="exp_history_main" style="margin-left: -20px; width:100%;">
                                <div class="exp_his_item1" style="background: #F74144;padding:10px;">
                                    <h5 class="font-16" style="color:#e9e9f1;">{{$project->project_title}}</h5>
                                    <h5>{{$project->company}}</h5>
                                </div>

                                <div class="exp_his_item3" style="background: #EFEFEF;padding:10px;">
                                    <h5 style="color:#e9e9f1;float:right;font-size:11px;font-weight: normal;">
                                        ({{date("M Y", strtotime($project->date_start))}}
                                        - {{date("M Y", strtotime($project->date_end))}})</h5>
                                    <h5 style="color:#e9e9f1;float:right;font-size:11px;font-weight: normal;margin-top:20px;">
                                        (<a href="{{$project->project_url}}">{{$project->project_url}}</a>)</h5>

                                </div>

                            </div>
                            <div class="exp_his_item3" style="margin-left:-20px;font-size:12px;">
                                {!! strip_tags($experience->description) !!}
                            </div>
                            <p style="margin-top: 30px !important;"></p>

                        @endforeach


                    </div>
                </div>
            </div>


            <div class="fratres_resume_info_summary"
                 style="width:90%;max-width:90%;background-color: #fff !important;height:auto !important;border-top:2px solid #F74144;">
                <div class="fratres_resume_info_logo">
                    <div class="resume_logo_fratres" style="width:100%;">
                        <h3> Certifications</h3>
                    </div>
                    <div class="resume_details_fratres" style="width:90%;padding-bottom:20px; margin-bottom:40px;">


                        @foreach($certifications as $certification)


                            <div class="exp_history_main" style="margin-left: -20px; width:100%;">
                                <div class="exp_his_item1" style="background: #F74144;padding:10px;">
                                    <h5 class="font-16"
                                        style="color:#e9e9f1;">{{$certification->certification_name}}</h5>
                                    <h5>{{$certification->license_number}}</h5>
                                </div>

                                <div class="exp_his_item3" style="background: #EFEFEF;padding:10px;">
                                    <h5 style="color:#e9e9f1;float:right;font-size:11px;font-weight: normal;">
                                        ({{date("M Y", strtotime($certification->completion_date))}}
                                        - {{date("M Y", strtotime($certification->date_end))}})</h5>
                                    <h5 style="color:#e9e9f1;float:right;font-size:11px;font-weight: normal;margin-top:20px;">
                                        (<a href="{{$certification->certification_url}}">{{$certification->certification_url}}</a>)
                                    </h5>

                                </div>

                            </div>

                            <p style="margin-top: 30px !important;"></p>

                        @endforeach


                    </div>
                </div>
            </div>


        </div>
    </div>


</div>



