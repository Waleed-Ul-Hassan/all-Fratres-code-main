@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','seeker_alert')->first();@endphp

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
                        <h2>Alerts You have created so far <a href="{{url('create-job-alerts')}}" class="btn btn-primary btn-xs float-right">Create Alert</a> </h2>

@foreach($alerts as $alert)
                        <!--postjob1-->
                            <div class="jobseeker-dashb-item2-mainheadv1-main">
                                <div class="col-md-5 jobseeker-dashb-item2-mainheadv1-main-details col-md-6">
                                   <span style="color: #ff8a00"> Title : </span><a href="{{url('search?q='.$alert->job_title)}}">{{$alert->job_title}}</a>
                                    <p>
                                    @if($alert->city != '')
                                         <small class="gray"> {{$alert->city->name}},
                                     @endif
                                    @if($alert->industry != '')
                                        {{$alert->industry->name}}</small>
                                    @endif
                                    </p>

                                    <p><small class="gray">Created : {{$alert->created_at->diffForHumans()}}</small></p>
                                    <p><small class="gray">Skills : <b class="red">{{$alert->skills->pluck('name')->implode(',')}}</b></small></p>
                                </div>


                                <div class="jobseeker-dashb-item2-mainheadv1-main-btns col-md-3">
                                    <a href="{{url('email-preferences/view/'.$alert->random_id)}}" class="btn btn-primary btn-sm">Manage</a>

                                    <a href="{{url('seeker/alerts/delete/'.$alert->random_id)}}" class="btn btn-danger btn-sm">Delete</a>



                                </div>
                            </div>
                            <!--/postjob1-->
@endforeach


                    </div>

                </div>
            </div>
            <!--/jobseeker-main-dashobard-content-->
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{url('/frontend/assets/js/custom/logos_slider_seeker.js')}}"></script>
@endsection