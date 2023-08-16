@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','homepage')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')


    @php
        use App\WebStat;
        $stats = WebStat::first();
    @endphp
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


    <div class="jobdetail-register">
        <div class="container">
            <div class="text-center">
                <h1>Just a few more details…</h1>
                <p>These will help us match you with your next job!</p>

            </div>
            <div class="row">
                <div class="col-lg-6 offset-lg-3">



                    <form id="selecttest">
                        <p>
                            <div class="abctest">
                                <h6>Work preferences
                                </h6>
                                <div class="form-group mb-4">

                                    <label class="form-check-label">Date of birth</label>
                                    <input type="date" class="form-control" id="birthday" name="birthday"
                                           placeholder="DD/MM/YY" required>

                                </div>


                                <div class="form-group mb-4">

                                    <label class="form-check-label">Willing to Travel...</label>
                                    <select class="form-control" id="travel"  name="agerange" required>
                                        <option value=""></option>
                                        <option value="1">upto 20 miles</option>
                                        <option value="2">upto 30 miles</option>
                                        <option value="3">upto 40 miles</option>
                                        <option value="4">upto 50 miles</option>
                                        <option value="5">upto 60 miles4</option>
                                    </select>


                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Willing to Relocate?</label>
                                    <select class="form-control" id="Relocate" title="Please select your age range"
                                            placeholder="Please select your age range" name="Relocate" required>
                                        <option value=""></option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>

                                    </select>

                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Driving Licence?</label>
                                    <select class="form-control" id="Driving" title="Please select your age range"
                                            placeholder="Please select your age range" name="Driving" required>
                                        <option value=""></option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>

                                    </select>
                                </div>
                                <div class="form-group">
                        <p>
                            <span id="SuccessMessage" class="success">Hurray! Your have successfully entered the captcha.</span>
                            <input type="text" id="UserCaptchaCode" class="form-control CaptchaTxtField" placeholder='Enter Captcha - Case Sensitive'>
                            <span id="WrongCaptchaError" class="error"></span>
                        <div class='CaptchaWrap'>
                            <div id="CaptchaImageCode" class="CaptchaTxtField">
                                <canvas id="CapCode" class="capcode" width="300" height="80"></canvas>
                            </div>
                            <input type="button" class="ReloadBtn" onclick='CreateCaptcha();'>
                        </div>
                        <!-- <input type="button" class="btnSubmit" onclick="CheckCaptcha();" value="Submit"> -->
                        </p>
                </div>
            </div>
            </p>





            <div class="text-center pb-4">
                <input type="submit" value="Complete profile" onclick="CheckCaptcha();" id="completebtn">
            </div>
            </form>
        </div>
    </div>
    </div>
    </div>


@endsection