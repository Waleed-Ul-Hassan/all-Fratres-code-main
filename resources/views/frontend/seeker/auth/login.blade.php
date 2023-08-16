@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','login_seeker')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('meta_info')
    <title>Seeker Login</title>

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
                        <a class="nav-link active" id="home-tab" href="{{url('seeker/login')}}" >
                            Jobseeker Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab"  href="{{url('recruiter/login')}}" >  Recruiter Login</a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="jobseeker-login-mainhead">
                            <div class="container ">
                                <div class="row  justify-content-center align-items-center">
                                    <form class="col-lg-9 col-md-12" action="{{url('seeker/login')}}" method="post">
                                        @csrf
                                        <div class="AppForm shadow-lg">
                                            <div class="row">
                                                <div class="col-md-6 d-flex justify-content-center align-items-center">
                                                    <div class="AppFormLeft width-80">

                                                        <div class="form-group position-relative mb-4">
                                                            <label class="form-check-label">Email address</label>
                                                            <input type="text" name="email" class="form-control border-top-0 border-right-0 border-left-0 rounded-0 shadow-none" id="username"
                                                                   placeholder="Username" required><i class="validation"><span></span><span></span></i>
                                                            <i class="fas fa-user"></i>
                                                            @if ($errors->has('email'))
                                                                <div class="invalid-feedback" style="display: block;">
                                                                    {{$errors->get('email')[0]}}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group position-relative mb-4">
                                                            <label class="form-check-label">password</label>
                                                            <input type="password" class="form-control border-top-0 border-right-0 border-left-0 rounded-0 shadow-none" id="password"
                                                                   name="password"
                                                                   placeholder="Password"
                                                                   required />
                                                            <i class="fa fa-key"></i>
                                                            @if ($errors->has('password'))
                                                                <div class="invalid-feedback" style="display: block;">
                                                                    {{$errors->get('password')[0]}}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="row  mt-4 mb-4">
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" name="remember_me" type="checkbox" value="1" id="defaultCheck1">
                                                                    <label class="form-check-label" for="defaultCheck1">
                                                                        Remember me
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 text-right">
                                                                <a href="{{url('seeker/forget-password')}}">Forgot Password?</a>
                                                            </div>
                                                        </div>


                                                        <input type="submit" id="login-jobseeker" value="Login">

                                                        <div class="jobseeker-sociallinks">
                                                            <a href="{{url('seeker/login/facebook')}}" target="_blank" class="facebook-login-social"><i class="fab fa-facebook-f"></i> Facebook</a>
                                                            <a href="{{url('seeker/login/linkedin')}}" target="_blank" class="google-login-social"><i class="fab fa-linkedin-in"></i> Linkedin</a>

                                                        </div>

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
                                                            <h4>New to fratres</h4>
                                                        </div>
                                                        <ul>
                                                            <li><a href="#"><span><i class="fas fa-check"></i></span> be alerted to latest job</a></li>
                                                            <li><a href="#"><span><i class="fas fa-check"></i></span> Apply for jobs with a single click</a></li>
                                                            <li><a href="#"><span><i class="fas fa-check"></i></span> showcases your cv to thousands of employers</a></li>
                                                            <li><a href="#"><span><i class="fas fa-check"></i></span> keep a record of all your applications</a></li>
                                                        </ul>
                                                        <div class="text-center">
                                                            <div class="jobseeker-btm">
                                                                <a type="button" href="{{url('seeker/register')}}" class="btn btn-primary">Register</a>
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