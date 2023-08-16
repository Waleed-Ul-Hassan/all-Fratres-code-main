<!DOCTYPE html>
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



    <!-- FontAwesome JS-->
    <script defer src="{{asset('pdf/assets/fontawesome/js/all.min.js')}}"></script>
    {{--<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Varela+Round&display=swap" rel="stylesheet">--}}

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="{{asset('pdf/assets/css/pillar-1.css')}}">
    <link  rel="stylesheet" href="{{asset('pdf/assets/css/fontawesome/css/all.css')}}">
    <style>
        @page {
            /*margin: 20px 0px 0px 0px !important;*/
            padding: 0px 0px 0px 0px !important;
            background-color: #10266b !important;
        }
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
    </style>

</head>

<body>


<div class="page-end" style="border: 2px solid #000000;position: fixed;bottom:60px;z-index:999;page-break-before: after;"></div>

<div style="position: fixed;bottom:30px;z-index:999;">
    <a href="{{url('/')}}">
        <img src="{{asset('logo/'.$settings->public_logo) ?? '' }}" alt="" style="width:70px;">
    </a>
</div>

<div class="resume-wrapper text-center position-relative" style="width:100%;float:left;display:block;">
    <div class=" mx-auto text-left bg-white ">
        <header class="resume-header pt-md-0" style="height:200px; background: #FC8B3A;">
            <div class="media flex-column flex-md-row">

                <div style="width:30% !important; float:left;">
                    <img class="mr-3 img-fluid picture mx-auto" src="{{url('seekers/profile/'.getDomainRoot().$seeker->avatar)}}" alt="" style="width:150px; border-radius:50%; margin-left: 10px;padding: 20px !important;">
                </div>

                <div class="media-body p-4 d-flex flex-column flex-md-row mx-auto mx-lg-0" style="width:70% !important;float:right; margin-left: 170px !important;padding: 20px !important;max-width:300px !important;">
                    <div class="primary-infosd" style="margin-top: 10px !important;">
                        <div style="margin-top: 10px !important; font-size:18px; font-weight:bold; ">{{$seeker->first_name}} {{$seeker->last_name}} </div>
                        <div class="title mb-3" style="font-size: 16px;margin-bottom:-5px;">{{$seeker->current_job_title}}</div>
                        <hr style="padding-bottom: 4px;margin-bottom:0px; color:#fc8b3a54;border-color:#ececec;">
                        <ul class="list-unstyled list-white">
                            <li style="margin-bottom:-10px;padding-bottom:1px;"><a href="#">{{$seeker->email}}</a></li>
                            <li style="margin-bottom:-10px;"><a href="#">{{show_phone($seeker->phone,"phone")}}</a></li>
                            <li style="color:#fff;">{{$seeker->city}}, {{$seeker->country}}</li>
                        </ul>
                    </div><!--//primary-info-->

                </div><!--//media-body-->

                <div class="media-body p-4 d-flex flex-column flex-md-row mx-auto mx-lg-0" style="width:70% !important;float:right; margin-left: 500px !important;padding: 20px !important;border-left:2px solid #ececec !important;max-width:250px !important;">
                    <div style="border:1px solid #ececec;right:210px; height:100px;position:absolute;top:50px;"></div>
                    <div class="primary-infosd" style="margin-top: 10px !important;">
                        <div style="margin-top: 10px !important;font-size:16px; font-weight:bold;">Academics </div>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" style="font-size: 12px !important;color:#fff;"><i class="far fa-envelope fa-fw mr-2" data-fa-transform="grow-3"></i>{{$education->degree}} | {{$education->year}} | {{$education->grade}}</a></li>
                            <li class="mb-2" style="font-size: 12px !important; ">{{$education->school}}</li>
                        </ul>

                       <div style="margin-top: 10px !important;font-size:16px; font-weight:bold;"> Industries </div>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" style="color:#fff;"><i class="far fa-envelope fa-fw mr-2" data-fa-transform="grow-3"></i>{{$industry->name}}</a></li>

                        </ul>

                    </div><!--//primary-info-->
                </div><!--//media-body-->






            </div><!--//media-->
        </header>
        <div class="resume-body " style="margin-top: 20px; ">

            <section class="resume-section summary-section mb-5">
                <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Career Summary</h2>
                <div class="resume-section-content">
                    <p class="mb-0" style="font-size:13px;word-wrap: break-word;">{!! strip_tags($seeker->summary) !!}</p>
                </div>
            </section><!--//summary-section-->
            <section class="resume-section summary-section mb-5 col-md-12" style="background: #FC8B3A;padding:10px;">
                <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-2" style="color:#fff;">Skills</h2>
                <div class="resume-section-content">

                    <ul style="padding-left: 0px !important;margin-left: 0px !important;margin-top: 10px !important;list-style-type: disc !important; width:90%;height: auto;padding-bottom: 0px; margin-bottom:0px !important;">
                        @if($skills != '')
                        @foreach(explode(",", $skills) as $skill)
                        <li style="display:inline-block;width:33%;margin-bottom:10px !important;">
                            <span class="badge badge-light">{{$skill}}</span>
                        </li>
                            @if( ($loop->index+1) %3==0)
                                <p></p>
                            @endif
                        @endforeach
                        @endif
                    </ul>
                    <br>
                </div>
            </section><!--//summary-section-->

            <hr>
            <div class="row">
                <div class="col-lg-9">
                    <section class="resume-section experience-section mb-5">
                        <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Work Experience</h2>
                        <div class="resume-section-content">
                            <div class="resume-timeline position-relative">

                                @foreach($experiences as $experience)
                                <article class="resume-timeline-item position-relative pb-5" style="page-break-after: never;">

                                    <div class="resume-timeline-item-header mb-2" style="min-height:100px;">
                                        <div class="d-flex flex-column flex-md-row">
                                            <h3 class="resume-position-title font-weight-bold " style="max-width:300px;">{{$experience->job_title}}</h3>
                                            <div class=" ml-auto" style="margin-left:470px !important;font-size:12px;">
                                                {{$experience->job_city}}, {{$experience->job_country}}
                                            </div>
                                        </div><!--//row-->
                                        <div class="resume-position-time ml-auto" style="margin-top: -30px !important;font-size:13px;width:100% !important;display:block;margin-bottom:20px;">{{date("M-Y", strtotime($experience->date_start))}} - {{date("M-Y", strtotime($experience->date_end))}}</div>
                                    </div><!--//resume-timeline-item-header-->
                                    <div class="resume-timeline-item-desc" style="margin-top: 20px !important;">
                                        <p style="margin-top: 10px !important;word-wrap: break-word;">{{ strip_tags($experience->description)  }}</p>


                                    </div><!--//resume-timeline-item-desc-->

                                </article><!--//resume-timeline-item-->
                            @endforeach


                            </div><!--//resume-timeline-->


                        </div>

                    </section><!--//experience-section-->
                    <hr>
                    <section class="resume-section experience-section mb-5">
                        <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Projects</h2>
                        <div class="resume-section-content">
                            <div class="resume-timeline position-relative">

                                @foreach($projects as $project)
                                <article class="resume-timeline-item position-relative pb-5">

                                    <div class="resume-timeline-item-header mb-2" style="min-height:100px;">
                                        <div class="d-flex flex-column flex-md-row">
                                            <h3 class="resume-position-title font-weight-bold " style="max-width:300px;">{{$project->project_title}} <span style="font-size: 13px;">({{$project->project_url}})</span></h3>
                                            <div class=" ml-auto" style="margin-left:470px !important;font-size:12px;">
                                                {{$project->company}}
                                            </div>
                                        </div><!--//row-->
                                        <div class="resume-position-time ml-auto" style="margin-top: -30px !important;font-size:13px;width:100% !important;display:block;margin-bottom:20px;">{{date("M-Y", strtotime($project->date_start))}} - {{date("M-Y", strtotime($project->date_end))}}</div>
                                    </div><!--//resume-timeline-item-header-->
                                    <div class="resume-timeline-item-desc" style="margin-top: 20px !important;">
                                        <p style="margin-top: 10px !important;word-wrap: break-word;">{{ strip_tags($project->description)  }}</p>


                                    </div><!--//resume-timeline-item-desc-->

                                </article><!--//resume-timeline-item-->
                            @endforeach


                            </div><!--//resume-timeline-->


                        </div>

                    </section><!--//experience-section-->
                    <hr>
                    @if($certifications->count() > 0)
                        <section class="resume-section experience-section mb-5">
                        <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Certifications</h2>
                        <div class="resume-section-content">
                            <div class="resume-timeline position-relative">

                                @foreach($certifications as $certification)
                                <article class="resume-timeline-item position-relative pb-5">

                                    <div class="resume-timeline-item-header mb-2" style="min-height:100px;">
                                        <div class="d-flex flex-column flex-md-row">
                                            <h3 class="resume-position-title font-weight-bold " style="max-width:300px;font-size:14px;word-wrap: break-word;">{{$certification->certification_name}} <span style="font-size: 13px;">({{$certification->certification_url}})</span></h3>
                                            <div class=" ml-auto" style="margin-left:470px !important;font-size:12px;">
                                                {{$certification->certification_authority}}
                                            </div>
                                        </div><!--//row-->
                                        <div class="resume-position-time ml-auto" style="margin-top: -30px !important;font-size:13px;width:100% !important;display:block;margin-bottom:20px;">{{date("M-Y", strtotime($certification->completion_date))}} - {{date("M-Y", strtotime($certification->end_date))}}</div>
                                    </div><!--//resume-timeline-item-header-->

                                </article><!--//resume-timeline-item-->
                            @endforeach


                            </div><!--//resume-timeline-->


                        </div>

                    </section><!--//experience-section-->
                     @endif
                    <hr>

                <section class="resume-section summary-section mb-5" style="background: #FC8B3A;padding:10px;display:block;width:100%;page-break-before: always;margin-top: 0px;">

                    <div style="width:100%; max-width:100%;display:block;margin-top: 20px;">

                        <h2 class="resume-section-title text-uppercase font-weight-bold " style="color:#fff;"> Languages</h2>
                        <div class="resume-section-content">
                            <br>
                            <ul class="list-inline">
                                @if($seeker->languages != '')
                                    @php
                                        $languages = json_decode($seeker->languages);

                                    @endphp
                                    @foreach($languages as $language)
                                        <li class="list-inline-item"><span class="badge badge-light">{{$language->value}}</span></li>
                                    @endforeach
                                @endif
                            </ul>
                            <br>
                        </div>

                    </div>
                    <div style="width:100%; max-width:100%;display:block;margin-top: 25px;">

                        <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3" style="color:#fff;">Hobbies/Activities</h2>
                        <div class="resume-section-content">
                            <br>
                            <ul class="list-inline">
                                @if($seeker->hobbies != '')
                                    @php
                                        $hobbies = json_decode($seeker->hobbies);

                                    @endphp
                                    @foreach($hobbies as $hobby)
                                        <li class="list-inline-item"><span class="badge badge-light">{{$hobby->value}}</span></li>
                                    @endforeach
                                @endif
                            </ul>
                            <br>
                        </div>

                    </div>



                </section><!--//summary-section-->

                    <hr>
                    @if($certifications->count() > 0)
                        <section class="resume-section experience-section mb-5">
                            <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">References</h2>
                            <div class="resume-section-content">
                                <div class="resume-timeline position-relative">

                                    @foreach($references as $reference)
                                        <article class="resume-timeline-item position-relative pb-5" style="padding-bottom: 20px; margin-bottom:20px;">

                                            <div class="resume-timeline-item-header mb-2" style="min-height:200px;">
                                                <div class="d-flex flex-column flex-md-row">
                                                    <h3 class="resume-position-title font-weight-bold " style="max-width:300px;font-size:14px;">{{$reference->name}} </h3>
                                                    <div class=" ml-auto" style="margin-left:470px !important;font-size:12px;">
                                                        {{$reference->company}}
                                                    </div>
                                                </div><!--//row-->
                                                <div class="resume-position-time ml-auto" style="margin-top: -30px !important;font-size:13px;width:100% !important;display:block;margin-bottom:20px;">{{$reference->email}}</div>
                                            </div><!--//resume-timeline-item-header-->

                                        </article><!--//resume-timeline-item-->
                                    @endforeach


                                </div><!--//resume-timeline-->


                            </div>

                        </section><!--//experience-section-->
                    @endif



                </div>

            </div><!--//row-->
        </div><!--//resume-body-->


    </div>




</div>




</body>
</html>
