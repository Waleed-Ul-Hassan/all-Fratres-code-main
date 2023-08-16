@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','view_job_alert')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')

    <style>
        .btn:not(:disabled):not(.disabled) {
            cursor: pointer;
            border-color: #dfdfdf !important;
        }
    </style>

    <div class="main_jobsalert">
        <div class="container">
            <div class="main_heading_jobsalert">
                <h3>Manage Job Alerts</h3>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="jobsalert_main_center">
                        <div class="main_jobsalert_form">
                            <form name="myForm" method="post" action="{{url('create-job-alerts')}}">
                                <input type="hidden" name="__update__" value="{{encrypt($job_alert->id)}}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">job Title</label>
                                    <input type="text" class="form-control" id="job_title" placeholder="Enter Title" name="job_title" value="{{$job_alert->job_title}}">
                                    @if ($errors->has('job_title'))
                                        <span class="error-messgae_jobalert" >
                                            {{$errors->get('job_title')[0]}}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Your name</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter your name" name="name" value="{{$job_alert->name}}">
                                    @if ($errors->has('name'))
                                        <span class="error-messgae_jobalert" >
                                            {{$errors->get('name')[0]}}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Email address</label>
                                    <input type="email" name="" class="form-control" disabled value="{{$job_alert->email}}">

                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">industry</label>
                                    <select class="form-control selectpicker" name="industry" id="industrymain">
                                        @foreach($industries as $industry)
                                            <option value="{{$industry->id}}" @if($job_alert->industry_id == $industry->id) selected @endif>{{$industry->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('industry'))
                                        <span class="error-messgae_jobalert" >
                                            {{$errors->get('industry')[0]}}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Skills</label>
                                    <select class="form-control selectpicker" name="skills[]" multiple id="skills">
                                        @foreach($skills as $skill)
                                            <option value="{{$skill->id}}" @if($job_alert->skills) @if(in_array($skill->id, $job_alert->skills->pluck('id')->toArray())) selected @endif @endif>{{$skill->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('skills'))
                                        <span class="error-messgae_jobalert" >
                                            {{$errors->get('skills')[0]}}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Location </label>
                                    <select class="form-control selectpicker" name="city" id="Locationmain">
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}" @if($job_alert->city_id ==$city->id) selected @endif >{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('city'))
                                        <span class="error-messgae_jobalert" >
                                            {{$errors->get('city')[0]}}
                                        </span>
                                    @endif
                                </div>
                                {{--<div class="form-group">--}}
                                    {{--<label for="exampleFormControlSelect1">Sending Date Frequency </label>--}}
                                    {{--<select class="form-control selectpicker" name="sending_frequency" id="SendingDateFrequencymain">--}}
                                        {{--<option value="3" @if($job_alert->sending_frequency==3) selected @endif>3 Days</option>--}}
                                        {{--<option value="7" @if($job_alert->sending_frequency==7) selected @endif>7 Days</option>--}}
                                        {{--<option value="15" @if($job_alert->sending_frequency==15) selected @endif>15 Days</option>--}}
                                    {{--</select>--}}
                                    {{--@if ($errors->has('sending_frequency'))--}}
                                        {{--<span class="error-messgae_jobalert" >--}}
                                            {{--{{$errors->get('sending_frequency')[0]}}--}}
                                        {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                                <div class="main_jobsalert_submit_btn">
                                    <button type="submit" class="btn btn-primary btn-lg" id="savejobalert">save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function () {

            $('.select2').select2();
        });
    </script>
@endsection