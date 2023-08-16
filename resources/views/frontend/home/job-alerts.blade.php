@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','job_alert')->first();@endphp

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
                <h3>Create Job Alert</h3>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="jobsalert_main_center">
                        <div class="main_jobsalert_form">
                        @if(isset($_GET['job_title']))
                            <div class="alert alert-info alert-dismissible fade show alert-div" role="alert">
                                <strong>Please complete your alert !</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                            <form name="myForm" method="post" action="{{url('create-job-alerts')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">job Title</label>
                                    <input type="text" class="form-control" id="job_title" placeholder="Enter Title" name="job_title" value="{{old('job_title')}}">
                                    @if ($errors->has('job_title'))
                                        <span class="error-messgae_jobalert" >
                                            {{$errors->get('job_title')[0]}}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Your name</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter your name" name="name" value="{{old('name')}}">
                                    @if ($errors->has('name'))
                                        <span class="error-messgae_jobalert" >
                                            {{$errors->get('name')[0]}}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Email address</label>
                                    @if(Auth::guard('seeker')->check())
                                        <input type="email" name="email" class="form-control" id="exampleFormControlInput1" value="{{Auth::guard('seeker')->user()->email}}" readonly>
                                    @else
                                        <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Enter a valid email addres" value="{{old('email')}}">
                                    @endif

                                    @if ($errors->has('email'))
                                        <span class="error-messgae_jobalert" >
                                            {{$errors->get('email')[0]}}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">industry</label>
                                    <select class="form-control selectpicker industry_is" name="industry" id="industrymain">
                                        @foreach($industries as $industry)
                                            <option value="{{$industry->id}}" @if(old('industry')== $industry->id) selected @endif>{{$industry->name}}</option>
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
                                            <option value="{{$skill->id}}">{{$skill->name}}</option>
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
                                    <select class="form-control selectpicker alert_location" name="city" id="Locationmain">
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}" @if(old('city')==$city->id) selected @endif >{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('city'))
                                        <span class="error-messgae_jobalert" >
                                            {{$errors->get('city')[0]}}
                                        </span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                        </div>
                                     
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                        @endif

                                    </div>
                                </div>

                                {{--<div class="form-group">--}}
                                    {{--<label for="exampleFormControlSelect1">Sending Date Frequency </label>--}}
                                    {{--<select class="form-control selectpicker" name="sending_frequency" id="SendingDateFrequencymain">--}}
                                        {{--<option value="3">3 Days</option>--}}
                                        {{--<option value="7">7 Days</option>--}}
                                        {{--<option value="15">15 Days</option>--}}
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

        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
        };

        $(document).ready(function () {

            $('.select2').select2();

            var job_title = getUrlParameter('job_title');
            var alert_industry = getUrlParameter('industry');
            var alert_location = getUrlParameter('location');


            job_title != undefined ? $("#job_title").val(job_title) : '';
            alert_industry != undefined ? $('.industry_is').val(alert_industry) : '';
            alert_location != undefined ? $('.alert_location').val(alert_location) : '';

            $('.industry_is').trigger('change');
            $('.alert_location').trigger('change');





        });
    </script>
    @endsection
