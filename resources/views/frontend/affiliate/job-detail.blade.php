@extends('frontend.layouts.main')
@section('meta_info')

    <meta name="description" content="{!! strip_tags($job->description) !!}">
    <meta property="og:description" content="{!! strip_tags($job->description) !!}}">
    @if(count($skills)>0)
        <meta name="keywords" content="{!! $skills->pluck('name')->implode(', Jobs in ') !!}">
        <meta property="og:keywords" content="{!! $skills->pluck('name')->implode(', Jobs in ') !!}">
    @endif
    <meta name="title" content="{{$job->title}}">
    <meta property="og:title" content="{{$job->title}}">

    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5ef1cd1132ef500012dcd65d&product=inline-share-buttons" async="async"></script>

    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

    <meta property="og:type" content="jobs"/>

    <title>Fratres - {{$job->title}}</title>

@endsection
@section('content')

    @include('frontend.partials.joblistingheader')

    <style>
        .jobdetail-ad-fields{
            padding: 0px;
        }
        section.job-similar{
            margin:0px;
            margin-bottom:10px;
        }
        @media (max-width: 991px){
            .similar-jobdetail-head-mobile a {
                 background-color: transparent !important;
            }
            .similar-jobdetail-head-mobile > a {
                color: #131212 !important;
            }
        }
        a:hover {
            color: unset;
            text-decoration: none;
        }
    </style>
    @if($stats)
        <div class="jobdetail-header-top">
            <div class="container">
                <div class="jobdetail-company">
                    <div class="jobdetail-company-details">
                        <p><a href="{{url('search')}}">{{$stats->total_jobs}}</a> jobs for you </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="jobdetailmain">
        <div class="container">
            <div class="jobdetail-postjob">
                <ul class="breadcrums">
                    <li>
                        <a href="{{url('search')}}">Jobs <span><i class="fas fa-chevron-right"></i></span></a>
                    </li>
                    <li>
                        <a href="{{url('search?industry='.$job->get_industry->industry_slug)}}">{{$job->get_industry->name}} <span><i class="fas fa-chevron-right"></i></span></a>
                    </li>
                    <li>
                        <a href="#">{{$job->title}}</a>
                    </li>
                </ul>
                <div class="jobdetail-ad-main">
                    <div class="jobdetail-ad-fields">
                        <section class="job-similar">
                            <h2> Similar Jobs</h2>
                            <ul>
                                @if($relatedJobs)
                                @foreach($relatedJobs as $relatedJob)
                                <li>
                                    <a href="{{url('job/'.$relatedJob->slug)}}"><h3>{{$relatedJob->title}}</h3></a>
                                    <p>{{$job->recruiter->company_name}}</p>
                                    <p>{{number_format($relatedJob->salary_min,2)}} - {{number_format($relatedJob->salary_max,2)}}/{{$relatedJob->salary_schedule}}</p>
                                </li>
                                    @endforeach
                                    @endif
                            </ul>
                        </section>
                        <section class="job-similar">
                            <h2> Recently Viewed Jobs</h2>
                            <ul>
                                @foreach($recentJobs as $recentJob)
                                    <li>
                                        @if($recentJob->is_external == 1)
                                        <a href="{{url('job/'.encrypt($recentJob->id).'?isExternal=true')}}"><h3>{{$recentJob->title}}</h3></a>
                                            <p>{{$recentJob->location_string}}</p>

                                        @else
                                        <a href="{{url('job/'.$recentJob->slug)}}"><h3>{{$recentJob->title}}</h3></a>

                                            <p>{{$recentJob->recruiter->company_name}}</p>
                                            <p>{{number_format($recentJob->salary_min,2)}} - {{number_format($recentJob->salary_max,2)}}/{{$recentJob->salary_schedule}}</p>
                                        @endif

                                    </li>
                                @endforeach
                            </ul>
                        </section>
                        <section class="job-similar">
                            <h2> {{$job->recruiter->company_name}}</h2>
                            <ul>
                                @foreach($recruiterJobs as $recruiterJob)
                                <li>
                                    @if($recruiterJob->is_external == 1)
                                        <a href="{{url('job/'.encrypt($recruiterJob->id).'?isExternal=true')}}"><h3>{{$recruiterJob->title}}</h3></a>

                                        <p>{{$recruiterJob->location_string}}</p>
                                        <p>{{$recruiterJob->salary_string}} </p>
                                    @else
                                    <a href="{{url('job/'.$recruiterJob->slug)}}"><h3>{{$recruiterJob->title}}</h3></a>

                                        <p>{{$recruiterJob->recruiter->company_name}}</p>
                                        <p>{{number_format($recruiterJob->salary_min,2)}} - {{number_format($recruiterJob->salary_max,2)}}/{{$recruiterJob->salary_schedule}}</p>
                                    @endif


                                </li>
                                @endforeach
                            </ul>
                        </section>
                    </div>
                    <div class="jobdetail-ad-main-detail">
                        <div class="jobad-btnsave save-btn" data-jobid="{{$job->id}}">
                            <a href="#">save <span><i class="@if(in_array($job->id,$saved_jobs)) fas @else far @endif fa-heart"></i></span></a>
                        </div>
                        <div class="jobad-details-form">

                            <h1>{{$job->title}}</h1>
                            <div class="jobad-posted-main">
                                <div class="jobs-posted-left">
                                    <div class="jobad-posted-details">
                                        <p>
                                            Posted by
                                            <a href="{{url('company/'.encrypt($job->recruiter->id))}}">{{$job->recruiter->company_name}} </a>
                                            -  {{$job->created_at->diffForHumans()}}</p>
                                    </div>
                                    <div class="job-posted-location">
                                        <h4>
                                            <span><i class="fas fa-map-marker-alt"></i></span>
                                             {{$job->get_city->name}}
                                            <span class="margin-left-20"><i class="fas fa-money-bill-wave"></i></span>
                                            {{$settings->symbol}}{{number_format($job->salary_min,2)}} - {{number_format($job->salary_max,2)}} / {{$job->salary_schedule}}

                                        </h4>

                                    </div>
                                </div>
                                <div class="jobad-logo-main">
                                    <img src="{{asset('recruiters/profile/'.getDomainRoot().$job->recruiter->company_logo)}}" class="img-fluid" width="70">

                                </div>
                            </div>
                            @if($applied)
                                <div class="job-ad-apply-head" >
                                    <div class="job-ad-apply-item1"></div>
                                    <div class="job-ad-apply-item2-applied">
                                        Applied
                                    </div>
                                    <div class="job-ad-apply-item3"></div>
                                </div>
                            @else
                                <div class="job-ad-apply-head" data-toggle="modal" data-target="#exampleModalCenter">
                                    <div class="job-ad-apply-item1"></div>
                                    <div class="job-ad-apply-item2">
                                        <a href="#" >apply now</a>
                                    </div>
                                    <div class="job-ad-apply-item3"></div>
                                </div>
                            @endif


                            <div class="jobdetail-ad-details-full">

                                {!! $job->description !!}
                                <br>
                                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <!-- Job Detail Header -->
                                <ins class="adsbygoogle"
                                     style="display:block"
                                     data-ad-client="ca-pub-2879151983843561"
                                     data-ad-slot="4037662836"
                                     data-ad-format="auto"
                                     data-full-width-responsive="true"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>


                            </div>

                            <div class="job-ad-tech-head">
                                <div class="job-ad-tech-head-item1">
                                    <div class="job-ad-item1-a">
                                        <dt>Type:</dt>
                                        <dd>{{ucfirst($job->contract_type)}}</dd>
                                    </div>
                                    <div class="job-ad-item1-a">
                                        <dt> Availability:</dt>
                                        <dd> {{ucfirst(str_replace("_"," ", $job->time_available))}}</dd>
                                    </div>
                                    <div class="job-ad-item1-a">
                                        <dt> Views:</dt>
                                        <dd> {{$job->views}}</dd>
                                    </div>



                                </div>
                                <div class="job-ad-tech-head-item2">
                                    <div class="job-ad-item1-a">
                                        <dt>Salary:</dt>
                                        <dd>{{$settings->symbol}} {{number_format($job->salary_min,2)}} - {{number_format($job->salary_max,2)}} / {{$job->salary_schedule}} </dd>

                                    </div>
                                    <div class="job-ad-item1-a">
                                        <dt>Contact Name:</dt>
                                        <dd>{{$job->recruiter->company_name}}</dd>

                                    </div>

                                </div>
                            </div>
                            <br>
                            <div class="sharethis-inline-share-buttons"></div>

                        </div>
                        <div class="job-detail-btn-links">
                            <div class="jobdetail-btn1 save-btn" data-jobid="{{$job->id}}">
                                <a href="#"><span><i class="@if(in_array($job->id,$saved_jobs)) fas @else far @endif  fa-heart"></i></span>save</a>
                            </div>
                            <div class="jobdetail-btn2">
                                <a href="#" onclick="window.print()"><span><i class="fas fa-print"></i></span>print</a>
                            </div>

                        </div>

                        <ul class="breadcrums">
                            <li>
                                <a href="{{url('search')}}">Jobs <span><i class="fas fa-chevron-right"></i></span></a>
                            </li>
                            <li>
                                <a href="{{url('?industry='.$job->get_industry->industry_slug)}}">{{$job->get_industry->name}} <span><i class="fas fa-chevron-right"></i></span></a>
                            </li>
                            <li>
                                <a href="#">{{$job->title}}</a>
                            </li>

                        </ul>
                        <section class="create-alert">
                            <h1>Create new Job Alert</h1>
                            <p>Create a new Job Alert to make sure you see the best new jobs first!</p>
                            <form class="needs-validation" novalidate="">
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <label for="validationCustom01">Keywords/Job Title</label>
                                        <input type="text" class="form-control job_title" id="validationCustom01" placeholder="e.g. Sales" required="">

                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="validationCustomUsername">Industry</label>
                                        <select class="custom-select alert_industry" id="inlineFormCustomSelect">
                                            @foreach($industries as $industry)
                                                <option value="{{$industry->id}}">{{$industry->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="loc">Location</label>
                                        <select class="custom-select alert_location" name="location_detail_job_alert">
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-primary create-alert-job-detail" id="alertbtn-jobdetail">create alert</button>
                                    </div>
                                </div>

                            </form>

                        </section>
                        <section class="jobdetail-related">

                            <p>
                                Remember: You should never send cash or cheques to a prospective employer,
                                or provide your bank details or any other financial information.
                                We pay great attention to vetting all jobs that appear on our site,
                                but please <a href="mailto:info@fratres.net" >get in touch</a> if you see any roles asking for such payments or financial details from you.
                                For more information on conducting a safe job hunt online, visit <a href="https://fratres.net">fratres.net</a>

                            </p>
                        </section>
                        <section class="similar-jobdetail-mobile">
                            <div class="similar-jobdetail-head-mobile">
                                <a class="btn btn-primary" data-toggle="collapse" href="#similarjobsmmenu" role="button" aria-expanded="false" aria-controls="similarjobsmmenu">
                                    similar jobs <span class="text-right"><i class="fas fa-angle-down"></i></span>
                                </a>
                                <div class="collapse" id="similarjobsmmenu">
                                    <div class="card card-body">
                                        <ul>
                                            @if($relatedJobs)
                                                @foreach($relatedJobs as $relatedJob)
                                                    <li>
                                                        <a href="{{url('job/'.$relatedJob->slug)}}"><h3>{{$relatedJob->title}}</h3></a>
                                                        <p>{{$job->recruiter->company_name}}</p>
                                                        <p>
                        {{number_format($relatedJob->salary_min,2)}}
                                                             - {{number_format($relatedJob->salary_max,2)}}/{{$relatedJob->salary_schedule}}</p>
                                                    </li>
                                                @endforeach
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--modal for applying--}}


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content pad-10">
                <div class="modal-body pt-20">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{$job->title}}</h5>
                    <h6>{{$job->recruiter->company_name}} - <span class="font-color">{{$job->get_city->name}}</span></h6>
                    <hr>
                    <form id="apply-cv" action="{{url('apply-on-job')}}" method="post" enctype="multipart/form-data">
                        @csrf


                        @if(Auth::guard('seeker')->check())
                        <div class="form-group">
                            <div class="card" >
                                <div class="card-body">
                                    <h5 class="card-title"><b>{{Auth::guard('seeker')->user()->first_name}} {{Auth::guard('seeker')->user()->last_name}}</b>

                    <p class="float-right">
                    <a href="{{url('seeker/profile')}}" target="_blank" class="btn btn-primary btn-sm btn-rounded">Edit CV</a>


                    </p>
                                    </h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{Auth::guard('seeker')->user()->email}}</h6>
                                    <h6 class="card-subtitle mb-2 text-muted">{{show_phone(Auth::guard('seeker')->user()->phone,'phone')}}</h6>
                                    <h6 class="card-subtitle mb-2 text-muted">{{Auth::guard('seeker')->user()->city}}</h6>

                                    <p><small><span class="font-color">Not You?</span> <u><a class="font-color" href="{{url('logout')}}">Signout</a></u></small></p>

                                </div>
                            </div>
                            <small class="card-text">Your full online resume will be submitted.</small>
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number </label>
                            <input type="text" class="form-control" readonly id="phone_number" value="{{show_phone(Auth::guard('seeker')->user()->phone,'phone')}}" name="phone_number">
                        </div>

                         <div class="form-group">
                            <label for="additional_docs">Attach additional documents (optional)</label>
                            <input type="file" name="additional_docs" id="additional_docs" class="form-control" />
                        </div>
                         <div class="form-group">
                            <label for="exampleFormControlInput1">Cover Letter (optional)</label>
                             <textarea name="cover_letter" class="form-control" rows="4" ></textarea>
                        </div>
                         <div class="form-group">
                             <input type="checkbox" id="notify" name="notify_seeker"> <label for="notify">Notify me when similar jobs are available</label>
                             <p class="privacy-text pl-17">By checking this box and clicking continue, you agree to our Terms, and you agree to receive similar jobs via email. You can change your consent settings at any time by unsubscribing or as detailed in our terms.</p>
                             <p class="privacy-text">
                                 By pressing continue, you will see questions from the employer that are part of this application. For your convenience, information you provided on your Indeed CV will be used to pre-fill these questions, but you may change the answers in any field.
                             </p>
                        </div>



                        @else

                            <div class="form-group">
                                <label for="name">Name * </label>
                                <input type="text" class="form-control"  id="name" value="" name="name">
                            </div>

                            <div class="form-group">
                                <label for="email">Email * </label>
                                <input type="email" class="form-control"  id="email" value="" name="email">
                            </div>

                            <div class="form-group">
                                <label for="password">Password * </label>
                                <input type="password" class="form-control"  id="password" value="" name="password">
                            </div>
                            <div class="form-group">
                                <label for="cpassword">Confirm Password * </label>
                                <input type="password" class="form-control"  id="cpassword" value="" name="password_confirmation">
                            </div>

                            <div class="form-group">
                                <label for="cv_resume">Attach CV *</label>
                                <input type="file" name="cv_resume" id="cv_resume" class="form-control" accept="application/pdf,image/x-eps" />
                                <small class="card-text">pdfs only</small>
                            </div>


                            <div class="form-group">
                                <label for="exampleFormControlInput1">Cover Letter (optional)</label>
                                <textarea name="cover_letter" class="form-control" rows="4" ></textarea>
                            </div>

                        @endif
                        <input type="hidden" name="boj_value" value="{{encrypt($job->id)}}">
                    </form>

                </div>
                @if(Auth::guard('seeker')->check())
                    @if(seeker_logged('profile_complete') < 100 && seeker_logged('cv_resume') == '')
                        <div class="alert alert-danger">
                            Your Profile is not 100% complete and you have not uploaded any CV as well. Please <a href="{{url('seeker/cv-maker')}}">complete your profile</a> or
                            <a href="{{url('seeker/profile')}}">upload resume</a>
                        </div>
                    @else
                    <div class="row pb-20">
                        <div class="col-md-3 ml-30">
                            <button type="button" class="btn btn-primary btn-rounded btn-lg btn-submit">Apply</button>
                        </div>
                        <div class="col-md-2 ml-30 mt-10">
                            <a href="#" data-dismiss="modal">Cancel</a>
                        </div>

                        <div class="print-error-msg col-md-10" style="display:none;padding: 20px">
                            <p></p>
                            <ul class="pl-20 errors"></ul>
                        </div>
                        <div class="print-success-msg col-md-10" style="display:none;padding: 20px">
                            <p></p>
                            <p class="pl-20 success-para"></p>
                        </div>
                    </div>
                    @endif
                @else
                    <div class="row pb-20">
                        <div class="col-md-3 ml-30">
                            <button type="button" class="btn btn-primary btn-rounded btn-lg btn-submit">Apply</button>
                        </div>
                        <div class="col-md-2 ml-30 mt-10">
                            <a href="#" data-dismiss="modal">Cancel</a>
                        </div>

                        <div class="print-error-msg col-md-10" style="display:none;padding: 20px">
                            <p></p>
                            <ul class="pl-20 errors"></ul>
                        </div>
                        <div class="print-success-msg col-md-10" style="display:none;padding: 20px">
                            <p></p>
                            <p class="pl-20 success-para"></p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {{--modal for applying--}}

@endsection

@section('scripts')
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script>


        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
        function getOS() {
            var userAgent = window.navigator.userAgent,
                platform = window.navigator.platform,
                macosPlatforms = ['Macintosh', 'MacIntel', 'MacPPC', 'Mac68K'],
                windowsPlatforms = ['Win32', 'Win64', 'Windows', 'WinCE'],
                iosPlatforms = ['iPhone', 'iPad', 'iPod'],
                os = null;

            if (macosPlatforms.indexOf(platform) !== -1) {
                os = 'Mac OS';
            } else if (iosPlatforms.indexOf(platform) !== -1) {
                os = 'iOS';
            } else if (windowsPlatforms.indexOf(platform) !== -1) {
                os = 'Windows';
            } else if (/Android/.test(userAgent)) {
                os = 'Android';
            } else if (!os && /Linux/.test(platform)) {
                os = 'Linux';
            }

            return os;
        }

        navigator.saysWho = (() => {
            const { userAgent } = navigator
            let match = userAgent.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || []
            let temp

            if (/trident/i.test(match[1])) {
                temp = /\brv[ :]+(\d+)/g.exec(userAgent) || []

                return `IE ${temp[1] || ''}`
            }

            if (match[1] === 'Chrome') {
                temp = userAgent.match(/\b(OPR|Edge)\/(\d+)/)

                if (temp !== null) {
                    return temp.slice(1).join(' ').replace('OPR', 'Opera')
                }

                temp = userAgent.match(/\b(Edg)\/(\d+)/)

                if (temp !== null) {
                    return temp.slice(1).join(' ').replace('Edg', 'Edge (Chromium)')
                }
            }

            match = match[2] ? [ match[1], match[2] ] : [ navigator.appName, navigator.appVersion, '-?' ]
            temp = userAgent.match(/version\/(\d+)/i)

            if (temp !== null) {
                match.splice(1, 1, temp[1])
            }

            return match.join(' ')
        })()

        sessionStorage.setItem("clicks", 0);
        sessionStorage.setItem("time", 0);
        setInterval(function(){
            var time = parseInt(sessionStorage.getItem("time")) + parseInt(1);
            sessionStorage.setItem("time", time);
            // $("#time").html( sessionStorage.getItem("time") )

        }, 1000);
        // console.log("mouse location:", e.clientX, e.clientY)
        var sendData = [];
        onmousemove = function(e){
            sendData.push({x:e.clientX, y:e.clientY});
        }
        var clicks = 0;
        $( document.body ).click(function() {

            sessionStorage.getItem("clicks");
            clicks++;
            sessionStorage.setItem("clicks", clicks);

        });

        var dataIS = {
            mouseDetails : {
                movement : sendData,
                clicks : 0,
                TimeSpent : 0,
                OS : "",
            },
            cookie : document.cookie,
            localStorage : window.localStorage,
        };

        window.onbeforeunload = function() {
            console.log('Good bye');

            dataIS.mouseDetails.movement = sendData.length;
            dataIS.mouseDetails.clicks = sessionStorage.getItem("clicks");
            dataIS.mouseDetails.TimeSpent = sessionStorage.getItem("time");
            dataIS.mouseDetails.OS = getOS();

            $.ajax({
                url: "/api/updateStats",
                type:'POST',
                dataType: 'json',
                data: JSON.stringify({ mouse_movement : dataIS.mouseDetails.movement , clicks : dataIS.mouseDetails.clicks , timespent : dataIS.mouseDetails.TimeSpent , OS : dataIS.mouseDetails.OS , cookie : '{{$cookie}}' , cid : '{{$cid}}' }),
                processData: false,
                contentType: 'application/json',
                CrossDomain:true,
            });
        };

        {{--setInterval(function () {--}}

            {{--// event.preventDefault();--}}

            {{--dataIS.mouseDetails.movement = sendData.length;--}}
            {{--dataIS.mouseDetails.clicks = sessionStorage.getItem("clicks");--}}
            {{--dataIS.mouseDetails.TimeSpent = sessionStorage.getItem("time");--}}
            {{--dataIS.mouseDetails.OS = getOS();--}}

            {{--$.ajax({--}}
                {{--url: "/api/updateStats",--}}
                {{--type:'POST',--}}
                {{--dataType: 'json',--}}
                {{--data: JSON.stringify({ mouse_movement : dataIS.mouseDetails.movement , clicks : dataIS.mouseDetails.clicks , timespent : dataIS.mouseDetails.TimeSpent , OS : dataIS.mouseDetails.OS , cookie : '{{$cookie}}' , cid : '{{$cid}}' }),--}}
                {{--processData: false,--}}
                {{--contentType: 'application/json',--}}
                {{--CrossDomain:true,--}}


            {{--});--}}

        {{--}, 5000)--}}


        $(document).ready(function() {
            $(document).on("click",".btn-submit",function(e){

                var form = $('#apply-cv')[0];
                console.log(form);

                $.ajax({
                    url: "/apply-on-job",
                    type:'POST',
                    data: new FormData(form),
                    processData: false,
                    contentType:false,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){

                            $(".print-error-msg").css('display','none');
                            $(".print-success-msg").css('display','block');
                            $(".success-para").html(data.success);
                            location.reload();
                        }else{
                            console.log(data);
                            printErrorMsg(data.error);

                        }
                    }
                });

            });


            function printErrorMsg (msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-success-msg").css('display','none');
                $(".print-error-msg").css('display','block');
                $.each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
            }

            $(document).on("click",".create-alert-job-detail",function(){

                 var job_title = $(".job_title").val();
                 var alert_industry = $(".alert_industry option:selected").val();
                 var alert_location = $(".alert_location option:selected").val();

                window.location.href='/create-job-alerts?job_title='+job_title+'&industry='+alert_industry+'&location='+alert_location;
            });


            $(document).on("click", ".save-btn", function () {
                var job_id = $(this).attr("data-jobid");

                var element = $(".save-btn").find('.fa-heart');


                $.ajax({
                    url: "/save-job?job_id="+job_id,
                    type:'GET',
                    data: {job_id: job_id},
                    processData: false,
                    contentType:false,
                    success: function(data) {
                        element.toggleClass("far fas");
                        var messgae = "Job is removed from saved";
                        if(data == 'added'){
                            messgae = "Job is saved";
                        }
                        swal({
                            position: 'top-end',
                            icon: 'success',
                            title: messgae,
                            showConfirmButton: false,
                            timer: 2500
                        })

                    }
                });
            });

        });
    </script>

@endsection