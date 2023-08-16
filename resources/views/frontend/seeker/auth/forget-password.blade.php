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

    <!--main-login-->
    <div class="jobseeker-login-main">
        <div class="container">
            <div class="login-jobseeker-top">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                           aria-controls="home" aria-selected="true">
                            Forget Password
                        </a>
                    </li>


                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="jobseeker-login-mainhead">
                            <div class="container h-100">
                                <div class="row h-100 justify-content-center align-items-center">
                                    <form class="col-lg-12 col-md-12" action="{{url('seeker/forget-password')}}" method="post">
                                        @csrf
                                        <div class="AppForm shadow-lg">
                                            <div class="row">
                                                <div class="col-md-4 d-flex justify-content-center align-items-center">
                                                    <div class="AppFormLeft width-80">


                                                        <div class="form-group position-relative mb-4">
                                                            <label class="form-check-label">Email address</label>
                                                            <input type="text" name="email"
                                                                   class="form-control border-top-0 border-right-0 border-left-0 rounded-0 shadow-none"
                                                                   id="username"
                                                                   placeholder="Username" required><i
                                                                    class="validation"><span></span><span></span></i>
                                                            <i class="fas fa-user"></i>
                                                            @if ($errors->has('email'))
                                                                <div class="invalid-feedback" style="display: block;">
                                                                    {{$errors->get('email')[0]}}
                                                                </div>
                                                            @endif
                                                        </div>



                                                        <input type="submit" id="login-jobseeker" value="Send Email">


                                                        <p class="text-center mt-5">
                                                            Don't have an account?
                                                            <span>
                                            <a href="{{url('seeker/register')}}"> Create your account</a>
                                          </span>

                                                        </p>

                                                    </div>

                                                </div>
                                                <div class="col-lg-6 ">
                                                    <div class="AppFormRight">
                                                        <div class="text-center">
                                                            <h4>Recover Your Password</h4>
                                                        </div>
                                                        <ul>
                                                            <li>
                                                                <a href="#"><span><i class="fas fa-check"></i></span>
                                                                    Enter your email address connected with an account</a>
                                                            </li>
                                                            <li><a href="#"><span><i class="fas fa-check"></i></span>
                                                                    Click on Send Email Button below</a></li>
                                                            <li><a href="#"><span><i class="fas fa-check"></i></span>
                                                                    Check Your Email Inbox/Spam and Click on Reset Password Button</a></li>
                                                            <li><a href="#"><span><i class="fas fa-check"></i></span>
                                                                    Update Password</a></li>
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
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="recuriter-main">
                            <div class="container h-100">
                                <div class="row h-100 justify-content-center align-items-center">
                                    <form class="col-md-9">
                                        <div class="AppForm shadow-lg">
                                            <div class="row">
                                                <div class="col-md-6 d-flex justify-content-center align-items-center">
                                                    <div class="AppFormLeft">

                                                        <h1>Recruiter login</h1>
                                                        <p>Please enter your email address to get started.</p>
                                                        <div class="form-group position-relative mb-4">
                                                            <label class="form-check-label">Email address</label>
                                                            <input type="text"
                                                                   class="form-control border-top-0 border-right-0 border-left-0 rounded-0 shadow-none"
                                                                   id="username"
                                                                   placeholder="Username" required><i
                                                                    class="validation"><span></span><span></span></i>
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                        <div class="form-group position-relative mb-4">
                                                            <label class="form-check-label">password</label>
                                                            <input type="password"
                                                                   class="form-control border-top-0 border-right-0 border-left-0 rounded-0 shadow-none"
                                                                   id="password"
                                                                   name="password"
                                                                   placeholder="Password"
                                                                   required/>
                                                            <i class="fa fa-key"></i>

                                                        </div>
                                                        <div class="row  mt-4 mb-4">
                                                            <div class="col-md-6">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           value="" id="defaultCheck1">
                                                                    <label class="form-check-label" for="defaultCheck1">
                                                                        Remember me
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 text-right">
                                                                <a href="#">Forgot Password?</a>
                                                            </div>
                                                        </div>
                                                        <p>
                                                        <div data-captcha-enable="true"></div>

                                                        <div class="jobseeker-sociallinks">
                                                            <a href="#" class="facebook-login-social"><i
                                                                        class="fab fa-facebook-f"></i> Facebook</a>
                                                            <a href="#" class="google-login-social"><i
                                                                        class="fab fa-linkedin-in"></i> Linkedin</a>

                                                        </div>

                                                        </p>
                                                        <input type="submit" id="login-jobseeker" value="Login">

                                                        <p class="text-center mt-5">
                                                            Don't have an account?
                                                            <span>
                                            <a href="register.html">  Create your account</a>
                                          </span>

                                                        </p>

                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="AppFormRight">
                                                        <div class="text-center">
                                                            <h4>publish your vacancies and start receiving
                                                                applications</h4>
                                                        </div>
                                                        <ul>
                                                            <li><a href="#"><span><i
                                                                                class="fas fa-check-circle"></i></span>
                                                                    be featured in the top search result</a></li>
                                                            <li><a href="#"><span><i
                                                                                class="fas fa-check-circle"></i></span>
                                                                    be included in our job alerts</a></li>
                                                            <li><a href="#"><span><i
                                                                                class="fas fa-check-circle"></i></span>
                                                                    track the performace of your jobs</a></li>
                                                            <li><a href="#"><span><i
                                                                                class="fas fa-check-circle"></i></span>
                                                                    get quality applications directly to your inbox</a>
                                                            </li>
                                                            <li><a href="#"><span><i
                                                                                class="fas fa-check-circle"></i></span>
                                                                    listings optimised for all devices :phones tablets &
                                                                    desktops</a></li>
                                                        </ul>
                                                        <div class="text-center jobseeker-btm-head">
                                                            <div class="jobseeker-btm">
                                                                <a type="button" href="#" class="btn btn-primary">Register</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--/main login--->
    <!---footer-->


@endsection