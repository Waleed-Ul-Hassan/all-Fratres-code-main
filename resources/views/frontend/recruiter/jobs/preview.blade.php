@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','recruiter_job_preview')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')
    <style>
        .recru-dash-headv1 {
            top: 0px;
        }
    </style>

    <!--main-->
    <div class="recruiter-main-dashboard">
        <div class="recru-dash-head">
            <div class="recru-dash-headv1">
                <p>bottom</p>
            </div>

            @include('frontend.recruiter.partials.sidebar')

            <div class="recru-dash-item2">

                <div class="recru-post-jobhead">
                    <div class="form-wizard">
                        <form action="{{url('recruiter/create_job')}}" method="post" role="form">
                            @csrf
                            <div class="form-wizard-header">

                                <ul class="list-unstyled form-wizard-steps clearfix">
                                    <li class="activated"><span>1</span>
                                        <p>Job details</p>
                                    </li>
                                    <li class="active"><span>2</span>
                                        <p>Preview</p>
                                    </li>
                                    <li><span>3</span>
                                        <p>Billing information</p>
                                    </li>
                                    <li><span>4</span>
                                        <p>Payment</p>
                                    </li>
                                    <li><span>5</span>
                                        <p>Confirmation</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="container">
                                <br><br>
                                    <div class="col-6 width-mob">
                                        <div class="recru-edit-post-head">
                                            <p>Job Title: {{$job->title}}</p>
                                            <h1>{{$job->recruiter->company_name}}</h1>
                                            <span>
                                              {{$job->get_city->name}} - {{$job->get_industry->name}}
                                            </span>
                                            <span>
                                              {{ucfirst($job->contract_type)}} - {{$job->time_available()}}
                                            </span>
                                            <div class="">
                                                {!! $job->description !!}
                                            </div>
                                            <div class="recru-edit-post-info">
                                                <p>
                                                <hr>
                                                  <b>SALARY :</b>{{$settings->symbol}}{{$job->salary_min}} - {{$job->salary_max}}
                                                </p>
                                                <div class="clearfix"></div>
                                                {{--<p class="pad-left-0">--}}
                                                    {{--<b class="labels-preview">Skills :</b>--}}
                                                    {{--@foreach($job->skills as $skill)--}}
                                                        {{--{{$skill->name}} |--}}
                                                    {{--@endforeach--}}
                                                {{--</p>--}}
                                            </div>
                                        </div>

                                        <div class="form-group clearfix">


                                            <div class="recru-fieldv2">
                                                <h5>Your job offer is ready to be posted!</h5>
                                                <h6>Only <span>{{$settings->symbol.$settings->single_job_price }} + {{$settings->tax}}% {{$settings->tax_unit}} </span> for <span> {{$settings->single_job_expiry_days}}</span> days</h6>
                                                @php $coupon = \App\Coupon::where('discount', 100)->first() @endphp
                                                @if($coupon)
                                                    <h6>OR USE COUPON TO POST FREE <span>{{$coupon->coupon_code}}</span></h6>
                                                @endif
                                                <a href="{{url('recruiter/job-billing/'.$job->unique_string)}}" class="form-wizard-next-btn">Pay to post</a>
                                                <ul>
                                                    <li>
                                                        <a href="#">
                                                            <img src="{{asset('frontend/assets/img/mastercard.gif')}}">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <img src="{{asset('frontend/assets/img/visa.gif')}}">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <img src="{{asset('frontend/assets/img/masterpass.gif')}}">
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>



                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div><!--END-->
    </div>
    </div>
@endsection

@section('scripts')

@endsection
