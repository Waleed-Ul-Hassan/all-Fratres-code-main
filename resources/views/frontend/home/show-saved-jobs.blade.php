@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','saved_jobs')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')

    <br><br><br>
    <div class="container">

        <div class="row justify-content-md-center">
            <div class="jobseeker-dashb-item2 col-md-8">
                <div class="jobseeker-dashb-item2-mainheadv1">
                    <h2>Saved Jobs</h2>

                    <!--postjob1-->
                    @foreach($jobs as $job)
                        @if($job->is_external == 0)
                    <div class="jobseeker-dashb-item2-mainheadv1-main">
                        <a href="{{url('save-job/delete/'.$job->id)}}"><i class="fas fa-times times_pos"></i></a>
                        <div class="jobseeker-dashb-item2-mainheadv1-main-logo">
                                <img src="{{url('recruiters/profile/'.getDomainRoot().$job->company_logo)}}" style="max-width:70px;">
                        </div>
                        <div class="jobseeker-dashb-item2-mainheadv1-main-details">
                            <a href="{{url('job/'.$job->slug)}}">{{$job->title}}</a>
                            <h5> {{$job->company_name}}, {{$job->name}}</h5>
                            <p><small class="gray">{{$settings->symbol}}{{$job->salary_min}} - {{$job->salary_max}}</small></p>
                            {{-- <p><small class="gray">Applied : {{$job->created_at->diffForHumans()}}</small></p> --}}
                        </div>
                    </div>
                        @else
                            <div class="jobseeker-dashb-item2-mainheadv1-main">
                                <a href="{{url('save-job/delete/'.$job->id)}}"><i class="fas fa-times times_pos"></i></a>
                                <div class="jobseeker-dashb-item2-mainheadv1-main-logo">
                                    <img src="{{asset('logo/'.return_logo($job->job_website))}}" width="70" class="img-fluid ">
                                </div>
                                <div class="jobseeker-dashb-item2-mainheadv1-main-details">
                                    <a href="{{url('job/'.encrypt($job->id).'?isExternal=true')}}">{{$job->title}}</a>
                                    <h5> {{$job->location_string}}</h5>
                                    <p><small class="gray">{{$job->salary_string}}</small></p>
                                    {{-- <p><small class="gray">Saved : {{$job->created_at->diffForHumans()}}</small></p> --}}
                                </div>
                            </div>

                        @endif
                    @endforeach
                    <!--/postjob1-->



                </div>
                <!--/end-->
            </div>
        </div>

    </div>
    <br><br><br>
@endsection