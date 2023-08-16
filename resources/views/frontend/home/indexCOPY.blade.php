@extends('frontend.layouts.main')

@section('meta_info')
    @php $seo = \App\Seo::where('page_key','homepage')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')
    <link rel="stylesheet" href="{{url('frontend/autocomplete/easy-autocomplete.min.css')}}">
    <link rel="stylesheet" href="{{url('frontend/autocomplete/easy-autocomplete.themes.min.css')}}">

    <div class="homepagemain">

        <!--homepagemain-sldier-->
        <div class="homepageslider">

            <div class="container valuemycvcon">

            </div>
            <ul>
                <li class="recruhomepage">
                    <a href="{{url('recruiter/login')}}"><span><i class="fas fa-briefcase"></i></span> Recruiting</a>
                </li>

                <li class="jobseekerhomepage">
                    <a href="{{url('seeker/login')}}"><span><i class="fas fa-user"></i></span>Register CV</a>
                </li>
            </ul>
        </div>
        <!--homepagemain-sldierend-->

        <!--homepageslider-form-->
        <div class="homepagesldier-form">
            <div class="container">
                <div class="homepageslider-form-title">
                    <h2>Get The Job You Want</h2>
                </div>
                <form action="{{url('search')}}" method="get">
                    <div class="homepageslider-form-head ">
                        <div class="homepagesldier-v1top ">
                            <div class="form-group">
                                <input type="text" class="form-control" name="q" id="" placeholder="keywords , skills">
                            </div>
                        </div>
                        <div class="homepagesldier-v2top ">
                            <div class="form-group">

                                <input type="text" id="example-ddg" name="location" class="form-control"
                                       placeholder="locaiton / city / country" style="border-radius: 0px;">
                            </div>
                        </div>
                        <div class="homepagesldier-v2top " style="margin-left: -10px;">
                            <div class="homepagesldier-v4top ">
                                <div class="form-group">
                                    @php $currency = $settings->symbol @endphp
                                    <select class="form-control" name="salary" id="tophomepagecountries"
                                            style="height: calc(2.15rem + 2px);">
                                        <option value="">Please Choose Salary</option>
                                        <option value="0-2000">{{$currency}}0-2000</option>
                                        <option value="2000-4000">{{$currency}}2000-4000</option>
                                        <option value="4000-6000">{{$currency}}4000-6000</option>
                                        <option value="6000-8000">{{$currency}}6000-8000</option>
                                        <option value="8000-10000">{{$currency}}8000-10000</option>
                                        <option value="10000-12000">{{$currency}}10000-12000</option>
                                        <option value="12000-14000">{{$currency}}12000-14000</option>
                                        <option value="14000-20000">{{$currency}}14000-20000</option>
                                        <option value="20000-30000">{{$currency}}20000-30000</option>
                                        <option value="30000-40000">{{$currency}}30000-40000</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="homepagesldier-v2top " style="">
                            <div class="homepage_moreoptions_v4">
                                <select class="form-control" id="homepagejobtype" style="height: calc(2.15rem + 2px);"
                                        name="contract">
                                    <option value="">--Select Job Type--</option>
                                    <option value="p">Part Time</option>
                                    <option value="f">Full Time</option>
                                </select>
                            </div>
                        </div>


                        <div class="homepagesldier-v3top">
                            <button type="submit" class="btn btn-primary btn-black width-100">Search</button>
                        </div>
                    </div>

                    {{--<div class="homepage_moreoptions_head" id="moreoptionscontent">--}}


                    {{--<div class="homepage_moreoptions_v4">--}}
                    {{--<select class="form-control" id="homepagejobtype">--}}
                    {{--<option value="">--Select Job Type--</option>--}}
                    {{--<option>1</option>--}}
                    {{--<option>2</option>--}}
                    {{--<option>3</option>--}}
                    {{--<option>4</option>--}}
                    {{--<option>5</option>--}}
                    {{--</select>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="homepage-moreoptions" id="moresearch">--}}
                    {{--<p>More search options--}}
                    {{--<span><i class="fa fa-chevron-down rtoate180"></i></span>--}}
                    {{--</p>--}}
                    {{--</div>--}}

                </form>
            </div>

        </div>
        <!--/end homepageslider-form--->


        <section class="homepage-jobcate">
            <div class="container">
                <div class="homepage-jobcate-head">
                    <ul class="nav nav-pills " id="pills-tab" role="tablist">
                        <li class="nav-item ">
                            <a class="nav-link tabs-homepage active" id="pills-home-tab" data-toggle="pill"
                               href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Jobs by
                                Sector </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tabs-homepage" id="pills-profile-tab" data-toggle="pill"
                               href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Jobs
                                by Location </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tabs-homepage" id="pills-contact-tab" data-toggle="pill"
                               href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Jobs
                                by Company </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tabs-homepage" id="pills-fratres-tab" data-toggle="pill"
                               href="#pills-fratres" role="tab" aria-controls="pills-contact" aria-selected="false">Fratres
                                Worldwide </a>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="homepage-tabbg">
                <div class="container">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                             aria-labelledby="pills-home-tab">
                            <div class="homepage-cate-subhead">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6">
                                        <ul class="category">
                                            @foreach($industries as $indsutry)
                                                <li>
                                                    <a href="{{url('search?industry='.$indsutry->industry_slug)}}" class="link">
                                                        <span class="filter-name">{{$indsutry->name}} </span>
                                                    </a>
                                                    <span class="filter-count"> ({{$indsutry->total_jobs}})</span>
                                                </li>
                                                @break($loop->index == 10)
                                            @endforeach

                                        </ul>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <ul class="category">
                                            @foreach($industries as $indsutry)
                                                @continue($loop->index <= 10)
                                                <li>
                                                    <a href="{{url('search?industry='.$indsutry->industry_slug)}}" class="link">
                                                        <span class="filter-name"> {{$indsutry->name}} </span>
                                                    </a>
                                                    <span class="filter-count"> ({{$indsutry->total_jobs}})</span>
                                                </li>

                                                @break($loop->index == 21)
                                            @endforeach

                                        </ul>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <ul class="category">
                                            @foreach($industries as $indsutry)
                                                @continue($loop->index <= 21)
                                                <li>
                                                    <a href="{{url('search?industry='.$indsutry->industry_slug)}}" class="link">
                                                        <span class="filter-name"> {{$indsutry->name}} </span>
                                                    </a>
                                                    <span class="filter-count"> ({{$indsutry->total_jobs}})</span>
                                                </li>

                                                @break($loop->index == 32)
                                            @endforeach

                                        </ul>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <ul class="category">
                                            @foreach($industries as $indsutry)
                                                @continue($loop->index <= 32)
                                                <li>
                                                    <a href="{{url('search?industry='.$indsutry->industry_slug)}}" class="link">
                                                        <span class="filter-name"> {{$indsutry->name}} </span>
                                                    </a>
                                                    <span class="filter-count"> ({{$indsutry->total_jobs}})</span>
                                                </li>

                                                @break($loop->index == 43)
                                            @endforeach

                                        </ul>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                             aria-labelledby="pills-profile-tab">
                            <div class="homepage-cate-subhead">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6">
                                        <ul class="category">
                                            @foreach($cities as $city)

                                                <li>
                                                    <a href="{{url('search?location='.$city->city_slug)}}" class="link">
                                                        <span class="filter-name"> {{$city->name}} </span>
                                                    </a>
                                                    <span class="filter-count"> ({{$city->total_jobs}})</span>
                                                </li>

                                                @break($loop->index == 10)
                                            @endforeach


                                        </ul>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <ul class="category">
                                            @foreach($cities as $city)
                                                @continue($loop->index <= 10)
                                                <li>
                                                    <a href="{{url('search?location='.$city->city_slug)}}" class="link">
                                                        <span class="filter-name"> {{$city->name}} </span>
                                                    </a>
                                                    <span class="filter-count"> ({{$city->total_jobs}})</span>
                                                </li>

                                                @break($loop->index == 21)
                                            @endforeach


                                        </ul>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <ul class="category">
                                            @foreach($cities as $city)
                                                @continue($loop->index <= 21)
                                                <li>
                                                    <a href="{{url('search?location='.$city->city_slug)}}" class="link">
                                                        <span class="filter-name"> {{$city->name}} </span>
                                                    </a>
                                                    <span class="filter-count"> ({{$city->total_jobs}})</span>
                                                </li>

                                                @break($loop->index == 32)
                                            @endforeach


                                        </ul>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <ul class="category">
                                            @foreach($cities as $city)
                                                @continue($loop->index <= 32)
                                                <li>
                                                    <a href="{{url('search?location='.$city->city_slug)}}" class="link">
                                                        <span class="filter-name"> {{$city->name}} </span>
                                                    </a>
                                                    <span class="filter-count"> ({{$city->total_jobs}})</span>
                                                </li>

                                                @break($loop->index == 43)
                                            @endforeach


                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                             aria-labelledby="pills-contact-tab">
                            <div class="homepage-cate-subhead">
                                <div class="col-md-3 col-sm-6">
                                    <ul class="category">
                                        @foreach($companies as $company)
                                            <li>
                                                <a href="{{url('search?company='.$company->company_name)}}"
                                                   class="link">
                                                    <span class="filter-name">{{$company->company_name}}</span>
                                                </a>
                                                <span class="filter-count"> ({{$company->total_jobs}})</span>
                                            </li>
                                            @break($loop->index == 10)
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <ul class="category">
                                        @foreach($companies as $company)
                                            @continue($loop->index <= 10)
                                            <li>
                                                <a href="{{url('search?company='.$company->company_name)}}"
                                                   class="link">
                                                    <span class="filter-name">{{$company->company_name}}</span>
                                                </a>
                                                <span class="filter-count"> ({{$company->total_jobs}})</span>
                                            </li>
                                            @break($loop->index == 21)
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <ul class="category">
                                        @foreach($companies as $company)
                                            @continue($loop->index <= 21)
                                            <li>
                                                <a href="{{url('search?company='.$company->company_name)}}"
                                                   class="link">
                                                    <span class="filter-name">{{$company->company_name}}</span>
                                                </a>
                                                <span class="filter-count"> ({{$company->total_jobs}})</span>
                                            </li>
                                            @break($loop->index == 32)
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <ul class="category">
                                        @foreach($companies as $company)
                                            @continue($loop->index <= 32)
                                            <li>
                                                <a href="{{url('search?company='.$company->company_name)}}"
                                                   class="link">
                                                    <span class="filter-name">{{$company->company_name}}</span>
                                                </a>
                                                <span class="filter-count"> ({{$company->total_jobs}})</span>
                                            </li>
                                            @break($loop->index == 43)
                                        @endforeach
                                    </ul>
                                </div>


                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-fratres" role="tabpanel"
                             aria-labelledby="pills-fratres-tab">
                            <div class="homepage-cate-subhead">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6">
                                        <div class="country-heading">
                                            <strong>Europe</strong>
                                        </div>
                                        <ul class="category">

                                            <li><a href="https://at.fratres.net">Jobs in Austria </a></li>
                                            <li><a href="https://bl.fratres.net/">Jobs in Belgium </a></li>
                                            <li><a href="https://bg.fratres.net">Jobs in Bulgaria </a></li>
                                            <li><a href="https://fr.fratres.net">Jobs in France </a></li>
                                            <li><a href="https://de.fratres.net">Jobs in Germany </a></li>
                                            <li><a href="https://ie.fratres.net">Jobs in Ireland </a></li>
                                            <li><a href="https://it.fratres.net">Jobs in Italy </a></li>
                                            <li><a href="https://lt.fratres.net">Jobs in Lithuania </a></li>
                                            <li><a href="https://lu.fratres.net">Jobs in Luxembourg </a></li>
                                            <li><a href="https://no.fratres.net">Jobs in Norway </a></li>
                                            <li><a href="https://pl.fratres.net">Jobs in Poland </a></li>
                                            <li><a href="https://prt.fratres.net">Jobs in Portugal </a></li>
                                            <li><a href="https://ro.fratres.net">Jobs in Romania </a></li>
                                            <li><a href="https://ru.fratres.net">Jobs in Russia </a></li>
                                            <li><a href="https://sk.fratres.net">Jobs in Slovakia </a></li>
                                            <li><a href="https://es.fratres.net">Jobs in Spain </a></li>
                                            <li><a href="https://se.fratres.net">Jobs in Sweden </a></li>
                                            <li><a href="https://sw.fratres.net">Jobs in Switzerland </a></li>
                                            <li><a href="https://uk.fratres.net">Jobs in United Kingdom </a></li>


                                        </ul>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="country-heading">
                                            <strong>Asia</strong>
                                        </div>
                                        <ul class="category">
                                            <li><a href="https://bd.fratres.net">Jobs in Bangladesh</a></li>
                                            <li><a href="https://cn.fratres.net">Jobs in China</a></li>
                                            <li><a href="https://in.fratres.net">Jobs in India</a></li>
                                            <li><a href="https://jp.fratres.net">Jobs in Japan</a></li>
                                            <li><a href="https://kr.fratres.net">Jobs in Korea</a></li>
                                            <li><a href="https://my.fratres.net">Jobs in Malaysia</a></li>
                                            <li><a href="https://pk.fratres.net">Jobs in Pakistan</a></li>
                                            <li><a href="https://ph.fratres.net">Jobs in Philippines</a></li>
                                            <li><a href="https://sg.fratres.net">Jobs in Singapore</a></li>
                                            <li><a href="https://lka.fratres.net">Jobs in Sri Lanka</a></li>
                                            <li><a href="https://th.fratres.net">Jobs in Thailand</a></li>
                                            <li><a href="https://tr.fratres.net">Jobs in Turkey</a></li>
                                            <li><a href="https://vn.fratres.net">Jobs in Vietnam</a></li>


                                        </ul>

                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="country-heading">
                                            <strong>Middles East</strong>
                                        </div>
                                        <ul class="category">
                                            <li><a href="https://bh.fratres.net"><span class="filter-name">Jobs in Bahrain</span></a>
                                            </li>
                                            <li><a href="https://kw.fratres.net"><span class="filter-name">Jobs in Kuwait</span></a>
                                            </li>
                                            <li><a href="https://qa.fratres.net"><span
                                                            class="filter-name">Jobs in Qatar</span></a></li>
                                            <li><a href="https://ksa.fratres.net"><span class="filter-name">Jobs in Saudi Arabia</span></a>
                                            </li>
                                            <li><a href="https://ae.fratres.net"><span
                                                            class="filter-name">Jobs in UAE</span></a></li>

                                        </ul>
                                        <div class="country-heading">
                                            <strong>North and South America</strong>
                                        </div>
                                        <ul class="category">
                                            <li><a href="https://br.fratres.net"><span class="filter-name">Jobs in Brazil </span></a>
                                            </li>
                                            <li><a href="https://ca.fratres.net"><span class="filter-name">Jobs in Canada </span></a>
                                            </li>
                                            <li><a href="https://cl.fratres.net"><span
                                                            class="filter-name">Jobs in Chile </span></a></li>
                                            <li><a href="https://co.fratres.net"><span class="filter-name">Jobs in Colombia </span></a>
                                            </li>
                                            <li><a href="https://mx.fratres.net"><span class="filter-name">Jobs in Mexico </span></a>
                                            </li>
                                            <li><a href="https://us.fratres.net"><span class="filter-name">Jobs in United States</span></a>
                                            </li>
                                            <li><a href="https://ve.fratres.net"><span class="filter-name">Jobs in Venezuela</span></a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="country-heading">
                                            <strong>Africa</strong>
                                        </div>
                                        <ul class="category">
                                            <li><a href="https://eg.fratres.net" class="link"><span class="filter-name">Jobs in Egypt</span></a>
                                            </li>
                                            <li><a href="https://mr.fratres.net" class="link"><span class="filter-name">Jobs in Morocco</span></a>
                                            </li>
                                            <li><a href="https://ng.fratres.net" class="link"><span class="filter-name">Jobs in Nigeria</span></a>
                                            </li>
                                            <li><a href="https://sa.fratres.net" class="link"><span class="filter-name">Jobs in South Africa</span></a>
                                            </li>
                                        </ul>
                                        <div class="country-heading">
                                            <strong>Oceania</strong>
                                        </div>
                                        <ul class="category">

                                            <li><a href="https://au.fratres.net" class="link"><span class="filter-name">Jobs in Australia</span></a>
                                            </li>
                                            <li><a href="https://nz.fratres.net" class="link"><span class="filter-name">Jobs in New Zealand</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--owl client-->
        @if($companies->count() > 0)
        <section class="homepage-clientslogo">
            <div class="container">
                <div class="homepage-clientlogo-title">
                    <h3> Featured recruiters and employers</h3>
                </div>
                <div class="homepage-client-logo-wrapper">
                    <div id="owl-demo" class="owl-carousel owl-theme">

                            @foreach($companies as $company)
                            @break($loop->index == 6)
                            <div class="item">
                                <img src="{{asset('recruiters/profile/'.getDomainRoot().'square_'.$company->company_logo)}}" class="">
                            </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endif


        <!--new-->
        <div class="section padding-top-65 padding-bottom-50 homepage_how_its">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="utf-section-headline-item centered margin-top-0 margin-bottom-40">
                            <h3> How It Works?</h3>

                            <p class="utf-slogan-text">Find & apply for jobs on Fratres</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-12">

                        <div class="icon-box with-line">
                            <div class="utf-icon-box-circle">
                                <div class="utf-icon-box-circle-inner"><i class="fas fa-user"></i></div>
                            </div>
                            <h3>CV Maker</h3>
                            <p>Tired of applying to jobs with useless CVs? Don't Worry we will help you stand out with
                                our professional CV Maker</p>
                        </div>

                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-12">
                        <div class="icon-box with-line">
                            <div class="utf-icon-box-circle">
                                <div class="utf-icon-box-circle-inner"><i class="fas fa-tachometer-alt"></i></div>
                            </div>
                            <h3>Create Account</h3>
                            <p>Post a job in seconds and We'll help you match with the right candidates of your
                                choice.</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-12">
                        <div class="icon-box">
                            <div class="utf-icon-box-circle">
                                <div class="utf-icon-box-circle-inner"><i class="fas fa-search"></i></div>
                            </div>
                            <h3>Search Jobs</h3>
                            <p>Search your dream job. Our powerful Algorithms will help you land to your next big
                                career.</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-12">
                        <div class="icon-box">
                            <div class="utf-icon-box-circle">
                                <div class="utf-icon-box-circle-inner"><i class="fas fa-save"></i></div>
                            </div>
                            <h3>Save &amp; Apply</h3>
                            <p>Save Your CV and generate public link to show to recruiters or Download CV in different
                                Templates as well</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!---end-->

        <!--recruiter-->
        <section class="homepagerec-head">
            <div class="homepage-rec-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10">
                            <h3>Recruiting?</h3>
                            <p><a href="{{url('recruiter/login')}}">Advertise your jobs</a> to millions of monthly users
                                and search 15.1 million
                                CVs in our database.</p>
                        </div>
                        <div class="col-lg-2">
                            <div class="homepage-rec-startbtn">
                                <a href="{{url('recruiter/login')}}" class="btn btn-outline-primary">
                                    Start recruiting
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--end-->

    </div>

@endsection

@section('scripts')
    <script src="{{url('frontend/autocomplete/jquery.easy-autocomplete.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js"></script>
    <script>

        var url_cities = '{{url("cities/")}}';
        console.log(url_cities);
        var options = {
            url: function (phrase) {
                if (phrase !== "") {
                    // alert(phrase);
                    // console.log("/cities/"/+phrase);
                    return url_cities + "/" + phrase;

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

        $('#moreoptionscontent').hide();
        $(document).ready(function () {
            $("#moresearch").click(function () {
                $("#moresearch .fa-chevron-down").toggleClass("rtoate1802");
                $("#moreoptionscontent").toggle("slow");

            });
        });

        $('.counting').each(function () {
            var $this = $(this),
                countTo = $this.attr('data-count');

            $({countNum: $this.text()}).animate({
                    countNum: countTo
                },
                {
                    duration: 3000,
                    easing: 'linear',
                    step: function () {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function () {
                        $this.text(this.countNum);
                        //alert('finished');
                    }
                });
        });

        $(document).ready(function () {

            $("#owl-demo").owlCarousel({
                dots: false,
                autoplay: true,
                lazyLoad: true,
                loop: true,
                margin: 2,
                responsiveClass: true,
                autoHeight: true,
                autoplayTimeout: 1800,
                smartSpeed: 800,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },

                    600: {
                        items: 2
                    },

                    1024: {
                        items: 3
                    },

                    1366: {
                        items: 4
                    }

                }
            });

        });
    </script>
@endsection