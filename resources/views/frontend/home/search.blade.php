@extends('frontend.layouts.main')
@section('meta_info')
    @php
    if($custom_page){
        $seo = \App\Seo::where('page_key',$seo_key)->first();
        $title_page = "";

    }else{
        $seo = \App\Seo::where('page_key','search')->first();
        $title_page = str_replace("|", "", $seo->page_title);
    }
    @endphp

    @include('frontend.partials.seo', ['seo' => $seo] )

@endsection
@section('content')
    <link rel="stylesheet" href="{{url('frontend/autocomplete/easy-autocomplete.min.css')}}">
    <link rel="stylesheet" href="{{url('frontend/autocomplete/easy-autocomplete.themes.min.css')}}">
    <style>

        @media (max-width: 991px) {
            #desktopview {
                display: block;
                max-width: 95%;
                margin-left: 0px;
            }
            #mblview {
                display: none !important;
            }
        }
        /*@media (max-width: 1491px) {*/
            /*.eac-round {*/
                /*display: block;*/
                /*width: 100% !important;*/
            /*}*/
        /*}*/

    </style>

    <div id="desktopview">
        <!--header-->
    @include('frontend.partials.joblistingheader')
    <!--/header-->



        <div class="container">

            <div class="mobile-filter">
                <div id="accordion">
                    <div class="card no-shadow">
                        <button class="btn  btn-primary" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Apply Filter  <i class="fas fa-filter"></i>
                          </button>

                        <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <div id="f">
                                    <div class="h2 h2_sld">Salary
                                        <img src="{{asset('frontend/assets/img/preload_f.gif')}}" width="22" height="22" class="pr loader-salary" style="display: none;">
                                    </div>

                                    <div class="slider-box">
                                        <!-- <label for="priceRange">Price Range per annum:</label> -->
                                        <input type="text" id="priceRange" readonly >

                                        <div id="price-range" class="slider"></div>

                                        <ul class="scale">
                                            <li class="ticks"></li>
                                            <li class="l">{{$settings->symbol}}0</li>
                                            <li class="m">{{$settings->symbol}}50K</li>
                                            <li class="r">{{$settings->symbol}}100K+</li>
                                        </ul>


                                    </div>


                                    <div class="h2">Location</div>
                                    <ul class="pl-20">
                                        @foreach($cities as $city)
                                            <li>
                                                <a href="{{route('search', search_urls('location',$city->city_slug, $request))}}" title="{{$city->name}}">{{$city->name}}</a> <span>({{$city->total_jobs}})</span>
                                            </li>
                                        @endforeach

                                    </ul>


                                    <div class="h2">Industry</div>
                                    <ul  class="pl-20">
                                        @foreach($industries as $industry)

                                            <li><a href="{{route('search', search_urls('industry',$industry->industry_slug, $request))}}" title="{{$industry->name}}">{{$industry->name}} </a> <span>({{$industry->total_jobs}})</span></li>
                                        @endforeach
                                    </ul>

                                    <div class="h2">Contract Type</div>
                                    <ul  class="pl-20">
                                        <li><a href="{{route('search', search_urls('contract','permanent', $request))}}" title="Permanent">Permanent </a> <span>({{$permanent}})</span></li>
                                        <li><a href="{{route('search', search_urls('contract','temporary', $request))}}" title="Temporary">Temporary </a> <span>({{$temporary}})</span></li>
                                    </ul>

                                    <div class="h2">Hours</div>
                                    <ul  class="pl-20">
                                        <li><a href="{{route('search', search_urls('hours','full_time', $request))}}" title="Full Time">Full Time </a> <span>({{$full_time}})</span></li>
                                        <li><a href="{{route('search', search_urls('hours','part_time', $request))}}" title="Part Time">Part Time </a> <span>({{$part_time}})</span></li>
                                    </ul>
                                    <div class="rhs-covid-promo">
                                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                        <!-- Listings Add -->
                                        <ins class="adsbygoogle"
                                             style="display:block"
                                             data-ad-client="ca-pub-2879151983843561"
                                             data-ad-slot="9896601977"
                                             data-ad-format="auto"
                                             data-full-width-responsive="true"></ins>
                                        <script>
                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                        </script>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div class="crums-job">
                <ul>
                    <li>
                        <a href="{{url('search')}}">jobs</a>
                        »
                    </li>
                    <li>
                        <strong>Jobs in {{$settings->country_code}}</strong>
                    </li>
                </ul>
            </div>
            <!--jobsinuk-->
            <div class="job-ukmain">
                <div class="jobuk-item">
                    @if( $stats && $stats->total_jobs > 0 )
                        <span>{{nice_number($stats->total_jobs)}}</span>
                    @endif
                    <h1>Jobs in {{$settings->country_code}}</h1>
                    <p><b>Popular searches:</b>
                        @foreach($popular_searches as $popular_search)
                            <a href="{{url('/search?q='.strtolower($popular_search->search_keyword))}}">{{strtolower($popular_search->search_keyword)}}</a>,
                        @endforeach
                    </p>
                </div>

            </div>
            <!--/jobsinuk-->

            <!--maincontent-->
            <div class="joblist-maincontent">
                <div class="joblist-salary pad-top0">
                    <div id="f">
                        <div class="h2 h2_sld">Salary
                            <img src="{{asset('frontend/assets/img/preload_f.gif')}}" width="22" height="22" class="pr loader-salary" style="display: none;">
                        </div>

                        <div class="slider-box">
                            <!-- <label for="priceRange">Price Range per annum:</label> -->
                            <input type="text" id="priceRange" readonly >

                            <div id="price-range" class="slider"></div>

                            <ul class="scale">
                                <li class="ticks"></li>
                                <li class="l">{{$settings->symbol}}0</li>
                                <li class="m">{{$settings->symbol}}50K</li>
                                <li class="r">{{$settings->symbol}}100K+</li>
                            </ul>


                        </div>


                        <div class="h2">Location</div>
                        <ul class="pl-20">
                            @foreach($cities as $city)
                                <li>
                        <a href="{{route('search', search_urls('location',$city->city_slug, $request))}}" title="{{$city->name}}">{{$city->name}}</a> <span>({{$city->total_jobs}})</span>
                                </li>
                            @endforeach

                        </ul>


                        <div class="h2">Industry</div>
                        <ul  class="pl-20">
                            @foreach($industries as $industry)

                                <li><a href="{{route('search', search_urls('industry',$industry->industry_slug, $request))}}" title="{{$industry->name}}">{{$industry->name}} </a> <span>({{$industry->total_jobs}})</span></li>
                            @endforeach
                        </ul>

                        <div class="h2">Contract Type</div>
                        <ul  class="pl-20">
                            <li><a href="{{route('search', search_urls('contract','permanent', $request))}}" title="Permanent">Permanent </a> <span>({{$permanent}})</span></li>
                            <li><a href="{{route('search', search_urls('contract','temporary', $request))}}" title="Temporary">Temporary </a> <span>({{$temporary}})</span></li>
                        </ul>

                        <div class="h2">Hours</div>
                        <ul  class="pl-20">
                            <li><a href="{{route('search', search_urls('hours','full_time', $request))}}" title="Full Time">Full Time </a> <span>({{$full_time}})</span></li>
                            <li><a href="{{route('search', search_urls('hours','part_time', $request))}}" title="Part Time">Part Time </a> <span>({{$part_time}})</span></li>
                        </ul>

                        <div class="clearfix"><br></div>
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- Between Jobs -->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-2879151983843561"
                             data-ad-slot="5881674657"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>


                    </div>
                </div>
                <div class="joblist-jobsads">


                    @if($jobs->count() > 0)
                    <div class="show-head-section">
                        <div class="srt"><p>
                                @php
                                    $pageNo = $jobs->currentPage();
                                    $perPage = $jobs->count();

                                @endphp
                                Results
                                @if($pageNo == 1)
                                    1 - {{$perPage}} of {{$total}}
                                @else
                                    {{ ($perPage * $pageNo) - $perPage }} - {{$perPage * $pageNo}} of {{$total}}
                                @endif


                        </div>
                    </div>

                    @foreach($jobs as $job)
                     @if($loop->index%6==0)
                                <div class="ea">
                                    <form action="{{url('alert/create_alert')}}" class="newsletterForm" method="post">
                                        @csrf
                                        <div class="ea_form">
                                            <input type="hidden" name="ea_serialised" value="">
                                            <input type="hidden" name="ea_title" value="@if(isset($_GET['q'])) {{$_GET['q']}} jobs @else Jobs in {{$settings->country_code}} @endif">
                                            <label for="ea_srp_top"><strong>Receive the newest jobs for this search <a href="#" title="Click to learn more about setting up email alerts" class="alert_by_email" data-ga-track="job_alerts;shown;email-info-modal">by email</a>:</strong></label>
                                            <input type="email" name="email" id="ea_srp_top" class="save_email_input" placeholder="your.email@domain.com" value="">
                                            <button class="btn save_email" >Create alert</button>
                                        </div>
                                    </form>
                                    <div class="ea_gdpr">By creating an alert, you agree to our <a href="#" target="_blank">T&amp;Cs</a> and <a href="#" target="_blank">Privacy Notice</a>, and Cookie Use. </div>
                                </div>
                     @endif


                    <div class="job-ad-head" >
                        <div class="job-ad-capital">
                            <div class="job-ad-cap_item">
                                @if($job->is_external == 1)
                                 <a href="{{url('job/'.encrypt($job->id).'?isExternal=true')}}" onmousedown="{{mousedown($job)}}" target="_blank">
                                @else
                                 <a href="{{url('job/'.$job->slug)}}">
                                @endif
                                    <h4>
                                    {{$job->title}}
                                    @if($job->is_external == 0)
                                        <span class="badge badge-secondary">Easy Apply</span>
                                    @endif
                                    </h4>
                                </a>
                                <p>
                                    @if($job->is_external != 1)
                                        {{$job->company_name}} -
                                        <span>{{$job->name}}</span> -
                                        <span>{{$job->industry_name}}</span>
                                    @else
                               @if(!empty($job->company) && isset(json_decode($job->company)->name)) {{json_decode($job->company)->name}} - @endif
                                        <span>{{$job->location_string}}</span>
                                    @endif
                                </p>
                            </div>

                            <div class="job-heart">
                                <i class="@if($saved_jobs && in_array($job->id,$saved_jobs)) fas @else far @endif fa-heart save-btn" data-jobid="{{$job->id}}"></i>
                            </div>
                        </div>
                        <div class="jobad-wrp">
                            <div class="job-item-profile">
                                @if($job->is_external == 0)
                                <img src="{{asset('recruiters/profile/'.$job->company_logo)}}" width="60" class="img-fluid img-thumbnail">
                                @else
                                    <img src="{{asset('logo/'.return_logo($job->job_website))}}" width="60" class="img-fluid ">
                                @endif
                            </div>
                            <div class="jobad-details">
                                <p>
                                    {{ Str::limit(strip_tags(strtolower($job->description)), 230) }}
                                    <br>
                                    @if($job->is_external == 0 && $job->salary_min > 0)
                                    <b>{{$settings->symbol}}{{number_format($job->salary_min,2)}} - {{number_format($job->salary_max,2)}} / {{$job->salary_schedule}}</b>
                                    @else
                                        <b>{{$job->salary_string}} </b>
                                    @endif
                                </p>
                                <ul>

                                    <li>
                                    @if($job->is_external == 1)

                <a href="{{url('job/'.encrypt($job->id).'?isExternal=true')}}" target="_blank">more details »</a>
                                    @else
                                        <a href="{{url('job/'.$job->slug)}}">more details »</a>
                                    @endif


                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    @endforeach

                    @else
                        <div class="show-head-section">
                            <div class="srt text-center">
                                <br><br>
                                <i class="fas fa-search fa-4x"></i>
                                <h4>Your Search matches no jobs</h4>
                                <br><br>
                            </div>
                        </div>
                        <div class="show-head-section">
                            <div class="srt text-center">
                                <div class="job-ad-head">
                                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                    <!-- Between Jobs -->
                                    <ins class="adsbygoogle"
                                         style="display:block"
                                         data-ad-client="ca-pub-2879151983843561"
                                         data-ad-slot="5881674657"
                                         data-ad-format="auto"
                                         data-full-width-responsive="true"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                                </div>
                            </div>
                        </div>

                    @endif



                    <div class="clearfix search-pagination justify-content-center">
                        {{$jobs->appends(request()->except('page'))->links()}}
                    </div>

                </div>
                <div class="joblist-currency">
                    <div class="b b_ssc_rhs">
                        @if( $stats->total_jobs != 0 )
                        <div class="b_ssc_rhs_top">
                            <small><strong>{{$stats->total_jobs}}</strong></small>
                            <span>Jobs in {{$settings->country_code}}</span><br>
                        </div>
                        @endif
                        @if($stats->average_salary != 0)
                        <div class="b_ssc_rhs_bottom">
                            <strong style="font-size:20px;">{{$settings->symbol}}{{nice_number($stats->average_salary)}}</strong>
                            <span>Average salary for Jobs in {{$settings->country_code}}</span><br>
                        </div>
                            @endif
                        {{--<a href="#" class="btn b_ssc_cta" target="_blank">See More Stats<span></span></a>--}}
                    </div>

                    <div class="rhs-covid-promo">
                        <div class="b b_promo">
                            <h2>Cv Maker</h2>
                            <p>Search 1000's of remote jobs</p>
                            <img src="{{asset('frontend/assets/img/portfolio.png')}}" width="60" height="">
                            <div>
                                <a href="{{url('seeker/cv-maker/register')}}" class="btn btn-primary">Cv Maker »</a>
                            </div>
                        </div>
                    </div>


                    <div class="b mobile-app">

                        <h2>Get the mobile app<span class="badge">NEW!</span></h2>

                        <p>Continue your search from your iPhone or Android phone.</p>

                        <div><a href="#" class="btn btn-primary" data-track="mobile_promo" target="_blank">Download now</a></div>
                    </div>
                    <div class="b b_blog">
                        <h2>Latest blog posts</h2>

                        <p><a href="{{url('career-advice')}}" target="_blank" title="Click to visit our blog">Visit our blog »</a></p>
                    </div>
                    <div class="b b_shr">
                        <h2>Share this search</h2>
                        <ul>
                            <li><a href="mailto:your@email.com?subject=Fratres Job Search&body=Hi,I found this job search on Fratres and thought you might like it {{$request->fullUrl()}}" class="email" target="_blank" >Share via email</a></li>
                            <li><a href="#" class="fb" target="popup" onclick="window.open('https://www.facebook.com/sharer.php?t=&u={{$request->fullUrl()}}','popup','width=600,height=600'); return false;">Share on Facebook</a></li>
                            <li><a href="#" class="tw" target="popup" onclick="window.open('https://twitter.com/intent/tweet?text={{$title_page}}&url={{urlencode($request->fullUrl())}}','popup','width=600,height=600'); return false;">Share on Twitter</a></li>

                            {{--<li>--}}
                                {{--<a target="popup" href="https://twitter.com/share?ref_src=twsrc%5Etfw"  class="twitter-share-button" data-show-count="false">Tweet</a>--}}
                            {{--</li>--}}

                            <li><a href="#" class="in" target="popup" onclick="window.open('https://www.linkedin.com/shareArticle?title=Search For Jobs on Fratres&url={{$request->fullUrl()}}','popup','width=600,height=600'); return false;">Share on LinkedIn</a></li>
                        </ul>
                    </div>
                    <div class="rhs-covid-promo">
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- Listings Add -->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-2879151983843561"
                             data-ad-slot="9896601977"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>

                </div>
            </div>
            <!--/maincontent-->

            <!--footer-promo-->
            <div class="footer-promo">
                <br>
                {{--<a href="#">--}}
                    {{--<img src="{{asset('frontend/assets/img/app-store-badge.png')}}" class="img-fluid">--}}
                {{--</a>--}}
                {{--<a href="#">--}}
                    {{--<img src="{{asset('frontend/assets/img/app-store-badge.png')}}" class="img-fluid">--}}
                {{--</a>--}}
            </div>
            <!--/footer-promo-->


            <!--/footer-->
        </div>
    </div>

    <!--modal emojis rating-->
    <!-- Modal -->
    <div class="emoji-modal-head">
        <div class="modal fade" id="emojisfeedback" tabindex="-1" role="dialog" aria-labelledby="emojisfeedbackLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>

                            <div class="emojis-head">
                                <h2>1. How would your rate your search results?</h2>
                                <ul>
                                    <li>
                                        <img src="{{asset('frontend/assets/img/happ.png')}}" class="img-fluid" id="happyimg">

                                    </li>
                                    <li>
                                        <img src="{{asset('frontend/assets/img/sad.png')}}" class="img-fluid" id="sadimg">
                                    </li>
                                    <li>
                                        <img src="{{asset('frontend/assets/img/confu.png')}}" class="img-fluid" id="irrelv">
                                    </li>
                                    <li>
                                        <img src="{{asset('frontend/assets/img/angry.png')}}" class="img-fluid" id="virrelv">
                                    </li>
                                    <li>
                                        <img src="{{asset('frontend/assets/img/wink.png')}}" class="img-fluid" id="vrelv">
                                    </li>
                                </ul>
                                <span class="happyemo">happy</span>
                                <span class="sademo">Neutral</span>
                                <span class="irr">somewhat irrelevent</span>
                                <span class="virr">very irrelevent</span>
                                <span class="vr">very relevent</span>
                            </div>
                            <div class="emo-survey">
                                <div class=""><h2>2. What are the main reasons for your rating (select all that apply)?</h2><div class="relevance_survey_reasons"><label for="ability_to_refine_search"><input type="checkbox" id="ability_to_refine_search">Ability to refine your search with filters</label><label for="information_for_each_job"><input type="checkbox" id="information_for_each_job">Information shown for each job</label><label for="number_of_results"><input type="checkbox" id="number_of_results">Number of results</label><label for="match_job_title"><input type="checkbox" id="match_job_title">Match with your job title</label><label for="match_location"><input type="checkbox" id="match_location">Match with your location</label><label for="job_variety"><input type="checkbox" id="job_variety">Variety of jobs</label><label for="other"><input type="checkbox" id="other">Other (please specify):</label><input type="text" class="relevance_survey_other relevance_survey_form_element" placeholder="e.g. company information" disabled="" value=""></div></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .modal-body {

            padding-bottom: 20px;

        }
        .orange-bg{
            background: #868d9f;
            padding: 18px 16px;
        }
    </style>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-lg-popup" role="document">
            <div class="modal-content ">
                <div class="modal-header text-center" style="border-bottom:0px; ">

                    <h6 class="col modal-title text-center " >
                        Make the most of Fratres to find your dream job
                    </h6>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="orange-bg">

                        <div class="row">
                            <div class="col-2">
                                <img src="{{asset('frontend/assets/img/icon_email.svg')}}" alt="">
                            </div>
                            <div class="col-10">
                                <div class="pad-left-0 margin-b-10" >
                                    <p class="color-black">Create a free alert for the latest</p>
                                    <p><b class="color-black">Jobs in {{$settings->country_code}}</b></p>
                                </div>


                                <form action="{{url('alert/create_alert')}}" class="newsletterFormModal" method="post">
                                    @csrf
                                    <div class="ea_form">
                                        <input type="hidden" name="ea_serialised" value="">
                                        <input type="hidden" name="ea_title" value="@if(isset($_GET['q'])) {{strtoupper($_GET['q'])}} JOBS @else Jobs in {{strtoupper($settings->country_code)}} @endif">

                                        <label class="ea_gdpr color-black" for="ea_srp_top">
                                            <p>Enter your email address and we will email you</p>
                                            <p>whenever we find new jobs that match your search</p>
                                        </label>
                                        <input type="email" name="email" id="ea_srp_top" class="save_email_input ea_form_height" placeholder="your.email@domain.com">
                                        <button class="btn save_email btn-custom" >Create alert</button>
                                    </div>
                                </form>
                                <div class="ea_gdpr color-black">By creating an alert, you agree to our <a href="#" class="color-black" target="_blank">T&amp;Cs</a> and <a href="#" class="color-black" target="_blank">Privacy Notice</a>, and Cookie Use. </div>

                            </div>
                        </div>

                    </div>



                </div>

            </div>
        </div>
    </div>



    {{--<a target="_blank" href="https://uk.whatjobs.com" title="Job Search">jobs</a> by <a target="_blank" title="Job Search" href="https://uk.whatjobs.com"><img alt="WhatJobs job search" style="border: 0; vertical-align: middle;" src="https://uk.whatjobs.com/job-search.png"></a>--}}
@endsection


@section('mblview')
    @include('frontend.mblview.joblisting')
@endsection
@section('scripts')


    <script type="text/javascript" src="https://uk.whatjobs.com/js/pub/tracking.js?publisher=2919&channel=&source=feed"></script>

    <!-- Optional JavaScript -->
    <script src="{{url('frontend/autocomplete/jquery.easy-autocomplete.min.js')}}"></script>
    <script src="{{url('frontend/assets/js/custom/joblisting.js')}}"></script>
    <script>

        // $(".pagination li:first").remove();
        // $(".pagination li:last").remove();

        var screen_width = $(window).width();
        if( screen_width > 700 ){
            $(".mobile-filter").remove()
        }




        @if( !Cookie::get('alert_created') )
            $("#exampleModalCenter").modal('show');
        @endif
        $('#exampleModalCenter').on('hide.bs.modal', function () {
            {{Cookie::queue('alert_created', true, 15)}}
        })

        var url_cities = '{{url("cities/")}}';
        console.log(url_cities);
        var options = {
            url: function(phrase) {
                if (phrase !== "") {
                    // alert(phrase);
                    // console.log("/cities/"/+phrase);
                    return url_cities+"/"+phrase;

                } else {
                    //duckduckgo doesn't support empty strings
                    // return url_cities+"/"+phrase;
                }
            },

            getValue: "name",

            list: {
                match: {
                    enabled: true
                }
            },
            requestDelay: 300,
            theme: "round"
        };
        console.log(options);
        $("#example-ddg").easyAutocomplete(options);



        @if(isset($_GET['salary']) && $_GET['salary'] != '')
        @php
            $salary  = explode("-",$_GET['salary']);
            if(count($salary) == 2){
                $min_salary = if_isset($salary,0);
                $max_salary = if_isset($salary,1);
            }else{
                $min_salary = 0;
                $max_salary = if_isset($salary,0);
            }
        @endphp
        @else
            @php
            $min_salary = 0;
            $max_salary = 100000;
        @endphp
        @endif
        $(function() {
            $("#price-range").slider({range: true, min: 0, max: 100000, values: [{{$min_salary}}, {{$max_salary}}], slide: function(event, ui) {
                    $("#priceRange").val("{{$settings->symbol}}" + ui.values[0] + " - $" + ui.values[1]);


                },
                change: function( event, ui ) {
                    $(".loader-salary").show();
                    var salary = ui.values[0]+"-"+ui.values[1];
                    // window.location.href = '/search?salary='+salary;
                    var currentUrl = window.location.href;
                    var url = new URL(currentUrl);
                    url.searchParams.set("salary", salary); // setting your param
                    var newUrl = url.href;


                    window.location.href = newUrl;

                }
            });

            $("#priceRange").val("{{$settings->symbol}}" + $("#price-range").slider("values", 0) + " - {{$settings->symbol}}" + $("#price-range").slider("values", 1));



        });
    </script>
@endsection
