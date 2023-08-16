<!doctype html>
<html lang="en">
<head>

    <title>{{$settings->website_title}}</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{$settings->website_title}}">
    <meta name="author" content="Fratres">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('frontend/assets/lib/Bootstrap/css/bootstrap.min.css')}}">
    <!-- font-awesome CSS -->

    <!-- style CSS -->
    <link rel="stylesheet" href="{{url('pdf/assets/css/template-3.css')}}">



    <style>
        @font-face {
            /*font-family: 'Montserrat', sans-serif !important;*/
            font-family: 'Varela Round', sans-serif !important;
            src: url({{ asset('pdf/assets/gfonts/VarelaRound-Regular.ttf') }}) format("truetype");
            font-weight: 400;
            font-style: normal;
        }
        body,h1,h2,h3,h4,h5,h6,p,span{
            /*font-family: 'Montserrat', sans-serif !important;*/
            font-family: 'Varela Round', sans-serif !important;
        }
        @page{
            margin:0px 0px 20px 0px;
        }
    </style>

</head>
<body>



<div style="position: fixed;bottom:30px;z-index:999;border-top:2px solid #000; width:100%;">
    <a href="{{url('/')}}">
        <img src="{{asset('logo/'.$settings->public_logo) ?? '' }}" alt="" style="width:70px;margin-left:20px; margin-top:3px;">
    </a>
</div>


<div class="col-md-3" style=" position:absolute;right:10px;top:30px; ">

    <div class="skill_strength_resume_head" style="width:98%;background:#fff;margin-left:5px;">
        <div style="color:#74BEE5;font-size:23px;margin-left:15px; ">Contact Info</div>
        <p style="font-size: 12px;margin-left:25px;">{{show_phone($seeker->phone, 'phone')}}</p>
        <p style="font-size: 12px;margin-left:25px;">{{$seeker->email}}</p>
        <hr style="border-color: #E0F5FF;margin-left:10px;">
        <p style="font-size: 12px;margin-left:25px;">{{$seeker->city}}, {{$seeker->country}}</p>
    </div>

    <div class="skill_strength_resume_head" style="width:98%;background:#fff;margin-left:5px;">
        <div style="color:#74BEE5;font-size:23px;margin-left:15px;">Academics</div>
        <p style="font-size: 12px;margin-left:25px;">
            {{$education->degree}} | {{$education->year}} | {{$education->grade}}
        </p>
        <p style="font-size: 12px;margin-left:25px;">{{$education->school}}</p>

    </div>


    <div class="skill_strength_resume_head" style="width:98%;background:#fff;margin-left:5px;">
        <div style="color:#74BEE5;font-size:23px;margin-left:15px;"> Industries</div>
        <p style="font-size: 12px;margin-left:25px;">
            {{$seeker->industry->name}}
        </p>

    </div>

    <div class="skill_strength_resume_head" style="width:98%;background:#fff;margin-left:5px;">
        <div style="color:#74BEE5;font-size:23px;margin-left:15px;"> Languages</div>
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

    <div class="skill_strength_resume_head" style="width:98%;background:#fff;margin-left:5px;">
        <div style="color:#74BEE5;font-size:23px;margin-left:15px;"> Hobbies</div>
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




<div class="col-md-9" style="display: inline-block;float:left;">


    <div class="fratres_resume_jobee_mainhead" style="display: inline-block;float:left;background-color: #fff !important;width:97% !important;">
        <div class="fratres_resume_item1" style="display: inline-block;float:left;background-color: #ffff !important;">
            <div class="fratres_resume_info_summary" style="width:92% !important;max-width:92% !important;background-color: #F7F7F7 !important;">
                <div class="fratres_resume_info_logo">
                    <div class="resume_logo_fratres">
                        @if($seeker->avatar != '')
                            <img src="{{url('seekers/profile/'.getDomainRoot().$seeker->avatar)}}" style="border-radius:50%;width:140px !important;">
                        @endif
                    </div>
                    <div class="resume_details_fratres" style="margin-top: -10px;width:90%;">
                        <div style="font-size: 22px;margin-left: 150px;">{{$seeker->first_name}} {{$seeker->last_name}} </div>
                        <div style="font-size: 13px;margin-left: 150px;color:#000;font-weight:normal;">{{$seeker->current_job_title}} @if($seeker->current_job_title != '') at {{$seeker->current_company}} @endif</div>
                    </div>
                </div>
                @if($seeker->summary != '')
                    <div class="resume_sumary_fulldetails" style="margin-top: -150px;font-size:13px;word-wrap: break-word;">
                        {!! strip_tags($seeker->summary) !!}
                    </div>
                @endif
            </div>
            <div class="fratres_resume_info_summary" style="width:90%;max-width:90%;background-color: #E0F5FF !important;height:auto !important;">
                <div class="">
                    <div class="resume_logo_fratres" style="width:100%;">
                        <div style="font-size: 22px; font-weight:bold;"> Strengths & Skills</div>

                    </div>

                    <div class="" style="width:90%; margin-top: 15px !important; ">


                        <ul style="padding-left: 0px !important;margin-left: 0px !important;margin-top: 10px !important;list-style-type: disc !important; width:90%;height: auto;padding-bottom: 0px; margin-bottom:0px !important;">
                            @if($skills != '')
                            @foreach(explode(",", $skills) as $skill)

                                <li style="display:inline-block;width:33%;margin-bottom:10px !important;">
                                    {{$skill}}
                                </li>
                                @if( ($loop->index+1) %3==0)
                                    <p></p>
                                @endif
                            @endforeach
                            @endif
                        </ul>



                    </div>
                </div>
            </div>



            <div class="fratres_resume_info_summary" style="width:100%;background-color: #fff !important;height:auto !important;border-top:2px solid #ececec;padding:5px;page-break-inside: auto;">
                <div class="">
                    <div class="" style="width:100%;">
                        <div style="font-size: 22px; font-weight:bold;"> Work Experience</h3>
                        </div>
                        <div class="" style="width:100%;margin-top:10px;">



                            @foreach($experiences as $experience)


                                <div class="exp_history_main" style="margin-left: -5px; width:100%;page-break-inside: auto;word-wrap: break-word;">
                                    <div class="exp_his_item1" style="background: #E0F5FF;padding:10px;border-radius:50%;page-break-inside: auto;">
                                        <div class="font-16" style="color:#000;font-size:16px;font-weight:bold;">{{$experience->job_title}}</div>
                                        <div style="font-size: 14px;">{{$experience->company}}</div>
                                    </div>

                                    <div class="exp_his_item3" style="background: #E0F5FF;padding:10px;">
                                        <h5  style="color:#000;float:right;font-size:11px;font-weight: normal;">({{date("M Y", strtotime($experience->date_start))}} - {{date("M Y", strtotime($experience->date_end))}})</h5>
                                        <h5  style="color:#000;float:right;font-size:11px;font-weight: normal;margin-top:20px;">({{$experience->job_city}}, {{$experience->job_country}})</h5>

                                    </div>

                                </div>
                                <div class="exp_his_item3" style="margin-left:-5px;font-size:12px;page-break-inside: auto;word-wrap: break-word;">
                                    {!! strip_tags($experience->description) !!}
                                </div>
                                <p style="margin-top: 30px !important;"></p>

                            @endforeach



                        </div>
                    </div>
                </div>

                <div style="width:100%;"><hr></div>
                <div class="fratres_resume_info_summary" style="width:100%;max-width:100%;background-color: #fff !important;height:auto !important;padding:0px !important;">
                    <div class="">
                        <div class="resume_logo_fratres" style="width:100%;">
                            <div style="font-size: 22px; font-weight:bold;"> Projects</div>
                        </div>
                        <div class="resume_details_fratres" style="width:97%;padding-bottom:20px; margin-bottom:10px;">



                            @foreach($projects as $project)


                                <div class="exp_history_main" style="margin-left: -20px; width:100%;">
                                    <div class="exp_his_item1" style="background: #E0F5FF;padding:10px;border-radius:50%;">
                                        <div class="font-16" style="color:#000;font-size:16px;font-weight:bold;">{{$project->project_title}}</div>
                                        <div style="font-size:14px;">{{$project->company}}</div>
                                    </div>

                                    <div class="exp_his_item3" style="background: #E0F5FF;padding:10px;">
                                        <h5  style="color:#000;float:right;font-size:11px;font-weight: normal;">({{date("M Y", strtotime($project->date_start))}} - {{date("M Y", strtotime($project->date_end))}})</h5>
                                        <h5  style="color:#000;float:right;font-size:11px;font-weight: normal;margin-top:20px;">(<a href="{{$project->project_url}}">{{$project->project_url}}</a>)</h5>

                                    </div>

                                </div>
                                <div class="exp_his_item3" style="margin-left:-20px;font-size:12px;word-wrap: break-word;">
                                    {!! strip_tags($experience->description) !!}
                                </div>
                                <p style="margin-top: 30px !important;"></p>

                            @endforeach



                        </div>
                    </div>
                </div>


                <div class="fratres_resume_info_summary" style="width:100%;max-width:100%;background-color: #fff !important;height:auto !important;padding:0px !important;">
                    <div class="fratres_resume_info_logo">
                        <div class="resume_logo_fratres" style="width:100%;">
                            <div style="font-size: 22px; font-weight:bold;"> Certifications</div>
                        </div>
                        <div class="resume_details_fratres" style="width:100%;padding-bottom:20px; margin-bottom:10px;">



                            @foreach($certifications as $certification)


                                <div class="exp_history_main" style="margin-left: -20px; width:100%;border-radius:50%;">
                                    <div class="exp_his_item1" style="background: #E0F5FF;padding:10px;border-radius:50%;">
                                        <div class="" style="color:#000;font-size:14px;max-width:70%">{{$certification->certification_name}}</div>
                                        <div style="color:#000;font-size:11px;">{{$certification->license_number}}</div>
                                    </div>

                                    <div class="exp_his_item3" style="background: #E0F5FF;padding:10px;">
                                        <h5  style="color:#000;float:right;font-size:11px;font-weight: normal;">({{date("M Y", strtotime($certification->completion_date))}} - {{date("M Y", strtotime($certification->end_date))}})</h5>
                                        <h5  style="color:#000;float:right;font-size:11px;font-weight: normal;margin-top:20px;">(<a href="{{$certification->certification_url}}">{{$certification->certification_url}}</a>)</h5>

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

</div>


</body>
</html>



