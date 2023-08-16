{{--    @foreach ($jobs as $job)--}}
{{--        <url>--}}
{{--            @if($job->is_external == 1)--}}
{{--                <loc>{{url('job/'.encrypt($job->id).'?isExternal=true')}}</loc>--}}
{{--            @else--}}
{{--                <loc>{{url('job/'.$job->slug)}}</loc>--}}
{{--            @endif--}}
{{--            <lastmod>{{ $job_date }}</lastmod>--}}
{{--            <changefreq>daily</changefreq>--}}
{{--            <priority>0.9</priority>--}}
{{--        </url>--}}

@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','homepage')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')

    <br>
    <div class="container">

        <h3>Site Map</h3>

        <hr>
        <h3 style="
    font-size: 18px;
    font-weight: 600;
">
            Popular Job Titles
        </h3>
        <div class="homepage-cate-subhead">
            <div class="row">
                @foreach($industries as $industriess)
                    <div class="col-md-3 col-sm-6">
                        <ul class="category">


                            <a href=" " class="link">
                                <span class="filter-name"> {{$industriess->name}} </span>
                            </a>
                            <span class="filter-count"> ({{$industriess->total_jobs}})</span>


                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
        <hr>
        <h3 style="
    font-size: 18px;
    font-weight: 600;
">Seekers/Candidates</h3>
        <div class="homepage-cate-subhead">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <ul class="category">


                        <a href="https://uk.fratres.net/seeker/login" class="link">
                            <span class="filter-name"> Login</span>
                        </a>

                    </ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <ul class="category">

                        <a href="https://uk.fratres.net/seeker/register" class="link">
                            <span class="filter-name"> Signup</span>
                        </a>

                    </ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <ul class="category">

                        <a class="link" href="https://uk.fratres.net/seeker/cv-maker/register">
                            <span class="filter-name"> CV Maker</span></a>


                    </ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <ul class="category">

                        <a href="https://uk.fratres.net/create-job-alerts" class="link">
                            <span class="filter-name"> Job Alerts</span>
                        </a>


                    </ul>
                </div>


            </div>
        </div>
        <hr>
        <br>
        <h3 style="
    font-size: 18px;
    font-weight: 600;
">Recruiters/Employers</h3>
        <div class="homepage-cate-subhead">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <ul class="category">


                        <a href="https://uk.fratres.net/recruiter/login" class="link">
                            <span class="filter-name"> Login</span>
                        </a>

                    </ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <ul class="category">

                        <a href="https://uk.fratres.net/recruiter/register" class="link">
                            <span class="filter-name"> Signup</span>
                        </a>

                    </ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <ul class="category">

                        <a href="https://uk.fratres.net/companies" class="link">
                            <span class="filter-name"> Companies</span>
                        </a>


                    </ul>
                </div>


            </div>
        </div>


        <hr>
        <h3 style="
    font-size: 18px;
    font-weight: 600;
">Career Advice</h3>
        <div class="homepage-cate-subhead">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <ul class="category">


                        <a href="https://uk.fratres.net/recruiter/login" class="link">
                        </a><a href="https://uk.fratres.net/category/start" class="link">
                            <span class="filter-name"> Getting Started</span>
                        </a>


                    </ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <ul class="category">


                        <a href="https://uk.fratres.net/recruiter/login" class="link">
                        </a><a href="https://uk.fratres.net/category/cv" class="link">
                            <span class="filter-name"> CVs</span>
                        </a>


                    </ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <ul class="category">


                        <a href="https://uk.fratres.net/recruiter/login" class="link">
                        </a><a href="https://uk.fratres.net/category/cover-letters" class="link">
                            <span class="filter-name"> Cover Letters</span>
                        </a>


                    </ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <ul class="category">


                        <a href="https://uk.fratres.net/recruiter/login" class="link">
                        </a><a href="https://uk.fratres.net/category/interviews" class="link">
                            <span class="filter-name"> Interviews</span>
                        </a>


                    </ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <ul class="category">


                        <a href="https://uk.fratres.net/recruiter/login" class="link">
                        </a><a href="https://uk.fratres.net/category/work-life" class="link">
                            <span class="filter-name"> Work Life</span>
                        </a>


                    </ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <ul class="category">


                        <a href="https://uk.fratres.net/recruiter/login" class="link">
                        </a><a href="https://uk.fratres.net/category/development" class="link">
                            <span class="filter-name"> Career Development</span>
                        </a>


                    </ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <ul class="category">


                        <a href="https://uk.fratres.net/recruiter/login" class="link">
                        </a><a href="https://uk.fratres.net/category/graduate" class="link">
                            <span class="filter-name"> Graduates</span>
                        </a>


                    </ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <ul class="category">


                        <a href="https://uk.fratres.net/recruiter/login" class="link">
                        </a><a href="https://uk.fratres.net/category/apprenticeships" class="link">
                            <span class="filter-name"> Apprenticeships</span>
                        </a>


                    </ul>
                </div>


            </div>
        </div>


        <hr>
        <h3 style="
    font-size: 18px;
    font-weight: 600;
">
            General Links
        </h3>
        <div class="homepage-cate-subhead">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <ul class="category">


                        <a href="https://uk.fratres.net" class="link">
                            <span class="filter-name"> Home</span>
                        </a>

                    </ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <ul class="category">


                        <a href="https://uk.fratres.net/search" class="link">
                            <span class="filter-name"> All Jobs</span>
                        </a>

                    </ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <ul class="category">

                        <a href="mailto:info@fratres.net" class="link"> <span class="filter-name">Contact Us </span></a>


                    </ul>
                </div>


            </div>

        </div>


    </div>
@endsection
