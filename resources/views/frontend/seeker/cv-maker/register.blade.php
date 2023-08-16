@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','signup_seeker')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')




    <div class="jobdetail-register">
        <div class="container">
            <div class="text-center">
                <h1>Sign up to create CV</h1>
            </div>
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="jobdetail-form-head">


                        <form class="needs-validation" action="{{url('/seeker/register_one')}}" method="post" >
                            @csrf
                            <input type="hidden" name="seeker_cvmaker_input" value="true">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">

                                        <input type="text" name="first_name" class="form-control" id="firstname"
                                               placeholder="Firstname" value="{{ old('first_name')}}" required >
                                        <div class="valid-feedback" >

                                        </div>
                                        @if ($errors->has('first_name'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('first_name')[0]}}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">

                                        <input type="text" name="last_name" value="{{ old('last_name')}}" class="form-control" id="lastname"
                                               placeholder="Lastname" required>
                                        <div class="valid-feedback">

                                        </div>
                                        @if ($errors->has('last_name'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('last_name')[0]}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">

                                <input type="email" name="email" class="form-control" value="{{ old('email')}}" id="email"
                                       placeholder="E-mail" required>
                                <div class="valid-feedback">

                                </div>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback" style="display: block;">
                                        {{$errors->get('email')[0]}}
                                    </div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">

                                        <input type="password" name="password" class="form-control"  id="password"
                                               placeholder="Password" required minlength="4">

                                        @if ($errors->has('password'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('password')[0]}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">

                                        <input type="password" name="password_confirmation" class="form-control" id="password"
                                               placeholder="Confirm Password" required >


                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">

                                        <input type="text" class="form-control" value="{{ old('postcode')}}" id="postcode"
                                               placeholder="Postcode" name="postcode" required>
                                        <div class="valid-feedback">

                                        </div>
                                        @if ($errors->has('postcode'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('postcode')[0]}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">

                                        <input type="text" class="form-control" value="{{ old('previous_job_title')}}" id="Currentpreviousjobtitle"
                                               placeholder="Current/previous job title" name="previous_job_title" required>
                                        <div class="valid-feedback">

                                        </div>
                                        @if ($errors->has('previous_job_title'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('previous_job_title')[0]}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">

                                        <label class="form-check-label">Date of birth</label>
                                        <input type="date" class="form-control" id="birthday" name="dob" placeholder="DD/MM/YY" required=""  max="2000-12-31">

                                    </div>

                                    @if ($errors->has('dob'))
                                        <div class="invalid-feedback" style="display: block;">
                                            {{$errors->get('dob')[0]}}
                                        </div>
                                    @endif

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-check-label">Willing to Relocate?</label>
                                        <select class="form-control" name="relocate" id="Relocate" title="Willing to Relocate?"  required="">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>

                                        </select>

                                    </div>
                                </div>
                            </div>




                            <div class="form-group mt-3">
                                <div class="text-center">
                                    <button class="btn btn-primary"  type="submit">Register!</button>
                                </div>
                            </div>
                            <div class="job-detailform-btm">
                                <p>By registering with Fratres you agree to our Privacy Policy and Terms & Conditions</p>
                            </div>
                            <div class="utf-social-login-separator-item"><span>or</span></div>
                            <div class="utf-social-login-buttons-block">
                                <a href="{{url('seeker/login/facebook')}}" class="facebook-login ripple-effect"><i class="fab fa-facebook-f"></i> Facebook</a>
                                <a  href="{{url('seeker/login/linkedin')}}" class="google-login ripple-effect"><i class="fab fa-linkedin-in"></i> Linkedin</a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection