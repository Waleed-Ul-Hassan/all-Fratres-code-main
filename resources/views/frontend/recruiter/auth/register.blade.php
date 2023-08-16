@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','signup_recruiter')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')
{{--    {!! NoCaptcha::renderJs() !!}--}}
    <link rel="stylesheet" href="{{asset('frontend/assets/plugins/dropify/css/dropify.min.css')}}">

        <div class="jobdetail-register">
        <div class="container">
            <div class="text-center">
                <h1>Employer Registration</h1>
            </div>
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="jobdetail-form-head">
                        <h3>Please Provide Details below</h3>
                        <h6>Already Registered?
                            <a href="{{url('recruiter/login')}}">Log in Here</a>
                        </h6>

                        <form class="needs-validation" action="{{url('/recruiter/register')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group ">
                                        <label for="company_name" class="form-check-label">Company Name <span class="star">*</span></label>
                                <input type="text" name="company_name" class="form-control" id="company_name"
                               placeholder="Company Name" value="{{ old('company_name')}}" required >
                                        <div class="valid-feedback" >

                                        </div>
                                        @if ($errors->has('company_name'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('company_name')[0]}}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group ">
                                        <label for="company_url" class="form-check-label">Company URL <span class="star">*</span></label>
                                        <input type="text" name="company_url" value="{{ old('company_url')}}" class="form-control" id="company_url"
                                               placeholder="ie. http://fratres.net" required>
                                        <div class="valid-feedback">

                                        </div>
                                        @if ($errors->has('company_url'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('company_url')[0]}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group ">
                                        <label for="company_size" class="form-check-label">Company Size <span class="star">*</span></label>
                <select name="company_size" id="" class="form-control" required>
                    <option value="">Company Size</option>
                    <option value="10" @if(old('company_size')==10) selected @endif>Less than 10</option>
                    <option value="20" @if(old('company_size')==20) selected @endif>Less than 20</option>
                    <option value="50" @if(old('company_size')==50) selected @endif>Less than 50</option>
                    <option value="200" @if(old('company_size')==200) selected @endif>Less than 200</option>
                    <option value="300" @if(old('company_size')==300) selected @endif>Less than 300</option>
                    <option value="500" @if(old('company_size')==500) selected @endif>500+</option>
                </select>
                                        <div class="valid-feedback" >

                                        </div>
                                        @if ($errors->has('company_size'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('company_size')[0]}}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group ">
                                        <label for="phone" class="form-check-label">Contact No <span class="star">*</span></label>
                                        <input type="tel" name="phone" value="{{ old('phone')}}" class="form-control" id="phone"
                                               placeholder="Contact No" required>
                                        <div class="valid-feedback">

                                        </div>
                                        @if ($errors->has('phone'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('phone')[0]}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group ">
                                        <label for="company_size" class="form-check-label">Company Industry <span class="star">*</span></label>
                                        <select name="industry" id="industry" class="form-control" required>
                                            <option value="">Please Choose Industry</option>
                                            @foreach($industries as $industry)
                                            <option value="{{$industry->id}}" @if(old('industry') == $industry->id) selected @endif>{{$industry->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="valid-feedback" >

                                        </div>
                                        @if ($errors->has('industry'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('industry')[0]}}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group ">
                                        <label for="city" class="form-check-label">Company Location <span class="star">*</span></label>
                                        <select name="city" id="city" class="form-control" required>
                                            <option value="">Company Location</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}" @if(old('city') == $city->id) selected @endif>{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="valid-feedback">

                                        </div>
                                        @if ($errors->has('company_location'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('company_location')[0]}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="phone" class="form-check-label">Company Email <span class="star">*</span></label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email')}}" id="email"
                                               placeholder="Company E-mail" required>
                                        <div class="valid-feedback">
                                        </div>
                                        @if ($errors->has('email'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('email')[0]}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group ">
                                        <label for="password" class="form-check-label">Password <span class="star">*</span></label>
                                        <input type="password" name="password" class="form-control"  id="password"
                                               placeholder="Password" required minlength="4">

                                        @if ($errors->has('password'))
                                            @foreach ($errors->get('password') as $password)
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$password}}
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group ">
                                        <label for="cpassword" class="form-check-label">Confirm Password <span class="star">*</span></label>
                                        <input type="password" name="password_confirmation" class="form-control" id="cpassword"
                                               placeholder="Confirm Password" required >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    @if ($errors->has('company_logo'))
                                        @foreach ($errors->get('company_logo') as $logo_error)
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$logo_error}}
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="form-group">
                                        <label for="input-file-now" class="form-check-label">Upload Logo <span class="star">*</span></label>
                                        <input type="file" name="company_logo" id="input-file-now" class="dropify" data-allowed-file-extensions="png psd jpg jpeg JPEG PNG PNG" />
                                    </div>


                                </div>
                            </div>


{{--                            <div class="row">--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">--}}
{{--                                    </div>--}}
{{--                                    {!! app('captcha')->display() !!}--}}
{{--                                    @if ($errors->has('g-recaptcha-response'))--}}
{{--                                        <span class="help-block">--}}
{{--                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @endif--}}

{{--                                </div>--}}
{{--                            </div>--}}




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
                                <a href="{{url('recruiter/login/facebook')}}" target="_blank" class="facebook-login ripple-effect"><i class="fab fa-facebook-f"></i> Facebook</a>
                                <a  href="{{url('recruiter/login/linkedin')}}" target="_blank" class="google-login ripple-effect"><i class="fab fa-linkedin-in"></i> Linkedin</a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script src="{{asset('frontend/assets/plugins/dropify/js/dropify.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            // Basic
           var drEvent = $('.dropify').dropify({
                messages: {
                    default: 'Please Drag/Drop image here'
                }
            });

            drEvent.on('dropify.error.fileSize', function(event, element){
                alert('Please Upload Image less then 2mb');
            });

        });
    </script>
@endsection()
