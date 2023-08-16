@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','seeker_dashboard')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')

    @include('frontend.partials.joblistingheader')
    <!---/header--->

    <!--main-->
    <div class="jobseeker-dashboard-main">
        <div class="container">

            <!--jobseeker-dashb-head-->
            <div class="jobseeker-dashb-head">
                <h2>My account</h2>
            </div>
            <!--/jobseeker-dashb-head-->

            <!--jobseeker-main-dashobard-content-->
            <div class="jobseeker-dashb-content-main">
                @include('frontend.seeker.partials.sidebar')

                <div class="jobseeker-dashb-item2">
                    <div class="jobseeker-dashb-item2-mainheadv1">
                        <h2>Jobs You Applied</h2>
                        @if(count($applied_jobs) > 0)
                        @foreach($applied_jobs as $applied_job)
                        <!--postjob1-->
                        <div class="jobseeker-dashb-item2-mainheadv1-main">
                            <div class="jobseeker-dashb-item2-mainheadv1-main-logo">
                                <img src="{{asset('recruiters/profile/square_'.$applied_job->company_logo)}}"  style="max-width:70px;">
                            </div>
                            <div class="jobseeker-dashb-item2-mainheadv1-main-details">
                                <a href="{{url('job/'.$applied_job->slug)}}">{{$applied_job->title}}</a>
                                <h5> {{$applied_job->company_name}}, {{$applied_job->name}}</h5>
                                <p><small class="gray">Applied : {{$applied_job->created_at->diffForHumans()}}</small></p>
                            </div>
                            <div class="jobseeker-dashb-item2-mainheadv1-main-btns">
                                <ul>
                                    <li>
                                        @if($applied_job->viewed_at != '')
                                            <p><span><b>viewed</b> : {{date("M d-Y", strtotime($applied_job->viewed_at))}}</span></p>
                                        @endif
                                            @if($applied_job->short_listed == 1)
                                        <p><span class="green"><b>shorlisted</b></span></p>
                                                @endif

                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--/postjob1-->
                        @endforeach
                        @else
                            <p><br> You haven't applied to any jobs</p>
                            <p class="text-center"><br> <a href="{{url('search')}}" class="btn btn-primary">Search Jobs</a></p>
                        @endif



                    </div>
                    <!--/end-->
                    {{--<div class="jobseeker-dashb-item2-mainheadv2">--}}
                        {{--<div class="container">--}}
                            {{--<div class="jobseeker-client-logo-slider">--}}
                                {{--<div>--}}
                                    {{--<img src="{{url('frontend/assets/img/owlcv1.png')}}" />--}}
                                {{--</div>--}}
                                {{--<div>--}}
                                    {{--<img src="{{url('frontend/assets/img/owlcv2.jpg')}}" />--}}
                                {{--</div>--}}
                                {{--<div>--}}
                                    {{--<img src="{{url('frontend/assets/img/owlcv3.jpg')}}" />--}}
                                {{--</div>--}}
                                {{--<div>--}}
                                    {{--<img src="{{url('frontend/assets/img/owlcv4.png')}}" />--}}
                                {{--</div>--}}
                                {{--<div>--}}
                                    {{--<img src="{{url('frontend/assets/img/owlcv2.jpg')}}" />--}}
                                {{--</div>--}}
                                {{--<div>--}}
                                    {{--<img src="{{url('frontend/assets/img/owlcv1.png')}}" />--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="jobseeker-slick-btns">--}}
                                {{--<div class="left"><span><i class="fas fa-chevron-left"></i></span></div>--}}
                                {{--<div class="right"><span><i class="fas fa-chevron-right"></i></span></div>--}}

                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}

                </div>
            </div>
            <!--/jobseeker-main-dashobard-content-->
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{url('/frontend/assets/js/custom/logos_slider_seeker.js')}}"></script>
@endsection