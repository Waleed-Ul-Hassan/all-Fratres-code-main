@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','homepage')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')

    @include('frontend.partials.joblistingheader')
    <!---/header--->

    <!--main-->
    <div class="jobseeker-dashboard-main">
        <div class="container">

        @include('frontend.seeker.partials.breadcrumb')

            <!--jobseeker-main-dashobard-content-->
            <div class="jobseeker-dashb-content-main">

                @include('frontend.seeker.partials.sidebar')

                <div class="jobseeker-dashb-item2">
                    <div class="jobseeker-settings-pas-head">
                        <form action="{{url('seeker/update-password')}}" method="post">
                            @csrf
                            <h2>Change password</h2>
                            <div class="jobseeker-changepswd-head">
                                <div class="jobseeker-changepswd-head-item1">
                                    <div class="form-group">
                                        <label for="old_pass">old Password</label>
                                        <input type="password" name="old_pass" class="form-control" id="old_pass" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">new Password</label>
                                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="cpass">confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" id="cpass" placeholder="Password">
                                    </div>
                                    @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $error }}
                                        </div>
                                    @endforeach
                                        @endif
                                </div>
                                <div class="jobseeker-changepswd-head-item2">
                                    <div class="passwordjobseekerchange">
                                        <h4>Password advice</h4>
                                        <p>We recommend using passwords Keeping format in mind</p>
                                        <p>Format is : 1 Capital Letter, 1 Small Letter, 1 Number, 1 Special Character</p>
                                        <p>Remember to note your new password down somewhere safe and consider changing it on a regular basis.</p>
                                    </div>
                                </div>

                            </div>
                            <div class="changejobseeker-btn">

                                <button type="submit" class="changejobseeker-botmbtn" >
                                    Save new password
                                </button>
                            </div>
                        </form>
                    </div>

                    {{--<div class="jobseeker-settings-pas-headv2">--}}
                        {{--<form>--}}
                            {{--<h2>My email preferences</h2>--}}
                            {{--<div class="jobseeker-changepswd-headv2">--}}
                                {{--<div class="jobseeker-changepswd-headv2-item1">--}}
                                    {{--<h4>Snooze from all emails for 6 months?</h4>--}}
                                    {{--<p>We hate goodbyes! Why not take a short break from our emails instead?</p>--}}
                                    {{--<div class="changejobseeker-btn">--}}


                                        {{--<a href="#" class="changejobseeker-botmbtn" >--}}
                                            {{--Snooze all emails for 6 months--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<p>Tick the boxes below to select which emails you wish to receive from CV-Library.co.uk. You may still receive emails up to 48 hours after updating your preferences.</p>--}}
                                {{--<div class="jobseeker-changepswd-togl">--}}
                                    {{--<div class="jobseeker-changpsw-toglehead">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-lg-6 col-md-6 col-sm-6 col-6">--}}
                                                {{--<p>CV-Library Emails</p>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-lg-6 col-md-6 col-sm-6 col-6">--}}
                                                {{--<p class="text-right"> CV-Library Emails</p>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="jobseeker-change-detailsv1">--}}
                                        {{--<div class="jobseeker-email-list-items">--}}

                                            {{--<label for="CAN_AAR" class="email-pref-labels">Abandoned applications reminder emails</label>--}}
                                            {{--<span class="yes">yes</span>--}}
                                            {{--<label class="switch">--}}
                                                {{--<input type="checkbox" checked>--}}
                                                {{--<span class="slider round"></span>--}}

                                            {{--</label>--}}

                                        {{--</div>--}}
                                        {{--<div class="jobseeker-email-list-items">--}}

                                            {{--<label for="CAN_AAR" class="email-pref-labels">Abandoned applications reminder emails</label>--}}
                                            {{--<span class="yes">yes</span>--}}
                                            {{--<label class="switch">--}}
                                                {{--<input type="checkbox" checked>--}}
                                                {{--<span class="slider round"></span>--}}
                                            {{--</label>--}}

                                        {{--</div>--}}
                                        {{--<div class="jobseeker-email-list-items">--}}

                                            {{--<label for="CAN_AAR" class="email-pref-labels">Abandoned applications reminder emails</label>--}}
                                            {{--<span class="yes">yes</span>--}}
                                            {{--<label class="switch">--}}
                                                {{--<input type="checkbox" checked>--}}
                                                {{--<span class="slider round"></span>--}}
                                            {{--</label>--}}

                                        {{--</div>--}}
                                        {{--<div class="jobseeker-email-list-items">--}}

                                            {{--<label for="CAN_AAR" class="email-pref-labels">Abandoned applications reminder emails</label>--}}
                                            {{--<span class="yes">yes</span>--}}
                                            {{--<label class="switch">--}}
                                                {{--<input type="checkbox" checked>--}}
                                                {{--<span class="slider round"></span>--}}
                                            {{--</label>--}}

                                        {{--</div>--}}
                                        {{--<div class="jobseeker-email-list-items">--}}

                                            {{--<label for="CAN_AAR" class="email-pref-labels">Abandoned applications reminder emails</label>--}}
                                            {{--<span class="yes">yes</span>--}}
                                            {{--<label class="switch">--}}
                                                {{--<input type="checkbox" checked>--}}
                                                {{--<span class="slider round"></span>--}}
                                            {{--</label>--}}

                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="changejobseeker-btn">--}}

                                    {{--<a href="#" class="changejobseeker-botmbtn" >--}}
                                        {{--Update email preferences--}}
                                    {{--</a>--}}
                                {{--</div>--}}

                                {{--<div class="jobseeker-changepswd-headv2-item1">--}}

                                    {{--<p>To stop receiving Job Alerts you need to either delete or deactivate your alerts accordingly. Manage Job Alerts</p>--}}

                                {{--</div>--}}
                                {{--<p>--}}
                                    {{--<strong> Please note:</strong> you will still receive emails regarding your job search and apply process, e.g enquiries from recruiters/employers or job application confirmation.--}}
                                {{--</p>--}}
                            {{--</div>--}}

                        {{--</form>--}}
                    {{--</div>--}}
                    {{--<!--end-->--}}
                    {{--<div class="jobseeker-settings-pas-headv2">--}}
                        {{--<form>--}}
                            {{--<h2>My current CV visibility/status</h2>--}}

                            {{--<div class="jobseeker-changepswd-headv2-item1">--}}

                                {{--<p>Your CV is currently visible to employers and recruiters</p>--}}

                            {{--</div>--}}
                            {{--<p>Hiding your CV will mean that employers and recruiters won't be able to find you. This will decrease your chances of finding a job, but you'll still be able to apply for jobs.</p>--}}

                            {{--<p>Hide CV benefits</p>--}}

                            {{--<ul class="cvl-list">--}}
                                {{--<li>You will still be able to search and apply for jobs</li>--}}
                                {{--<li>Your profile will be hidden from recruiters</li>--}}
                                {{--<li>You will still have access to all of CV-Library's services</li>--}}
                                {{--<li>You will still receive all email notifications (unless modified in your email preferences)</li>--}}
                            {{--</ul>--}}
                            {{--<div class="changejobseeker-btn">--}}

                                {{--<a href="#" class="changejobseeker-botmbtn" >--}}
                                    {{--Hide my CV now--}}
                                {{--</a>--}}
                            {{--</div>--}}


                            {{--<p>--}}
                                {{--<strong> Please note:</strong> you will still receive emails regarding your job search and apply process, e.g enquiries from recruiters/employers or job application confirmation.--}}
                            {{--</p>--}}


                        {{--</form>--}}
                    {{--</div>--}}
                    {{--<!--end-->--}}
                    {{--<div class="jobseeker-settings-pas-headv2">--}}
                        {{--<form>--}}
                            {{--<h2>Delete my CV-Library account</h2>--}}

                            {{--<div class="jobseeker-changepswd-headv2-item1">--}}

                                {{--<p>Your CV is currently visible to employers and recruiters</p>--}}

                            {{--</div>--}}
                            {{--<p>Deleting your CV-Library account will remove all of your details (including your CV) from our system. If you decide to return to CV-Library in the future you will need to go through the registration process again.</p>--}}

                            {{--<p>If you are deleting your account because you don't want others to see your CV, you can hide your CV (above) and still keep your account. If you're deleting your account because you want to update your CV, you can upload a new one here and still keep your account.</p>--}}

                            {{--<ul class="cvl-list">--}}
                                {{--<li style="font-weight:600;">Your CV and account history will be permanently deleted from our records</li>--}}
                                {{--<li>You will no longer receive any further services from CV-Library, including email notifications</li>--}}
                                {{--<li>You will need to re-register if you wish to return to CV-Library</li>--}}
                            {{--</ul>--}}
                            {{--<div class="changejobseeker-btn">--}}


                                {{--<a href="#" class="changejobseeker-botmbtn" >--}}
                                    {{--Delete my account--}}
                                {{--</a>--}}
                            {{--</div>--}}

                    {{--</div>--}}




                    </form>
                </div>

            </div>
        </div>
        <!--/jobseeker-main-dashobard-content-->
    </div>

@endsection