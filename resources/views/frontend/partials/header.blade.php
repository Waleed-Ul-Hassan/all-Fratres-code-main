<div class="tophead-jobdetail">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="{{asset('logo/'.$settings->public_logo)}}" width="120" height="35" class="img-fluid">
                    </a>
                    <div class="open-nav-jobdetail">
                        <span style="font-size:30px;cursor:pointer;color:#ff8a00;" onclick="openNav()">
                            &#9776;
                        </span>
                    </div>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item @if(Request::path()=='search') active @endif">
                                <a class="nav-link" href="{{url('search')}}">search jobs <span class="sr-only">(current)</span></a>
                            </li>

                            <li class="nav-item @if(Request::path()=='create-job-alerts') active @endif">
                                <a class="nav-link" href="{{url('create-job-alerts')}}">job alerts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('career-advice')}}">career advice</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('companies')}}">company profile</a>
                            </li>
                            <li class="nav-item">
                                @if(@auth('seeker')->user())
                                    <a class="nav-link" href="{{url('seeker/cv-maker')}}">CV Maker</a>
                                @else
                                    <a class="nav-link" href="{{url('seeker/cv-maker/register')}}">CV Maker</a>
                                @endif
                            </li>
                            @php
                                $job = new \App\Job();
                                $ids_array = $job->cookieJobs();
                            @endphp
                            @if($ids_array)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('saved-jobs')}}">Saved Jobs <sup class="badge badge-primary" style="top:-10px !important;">{{count($ids_array)}}</sup> </a>
                                </li>
                                @endif


                        </ul>
                        @if(@auth('seeker')->user())

                            <div class="header-user">
                                <ul class="nav navbar-nav">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            {{seeker_logged('first_name')}}
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{url('seeker/upgrade-profile')}}"><i class="fas fa-tachometer-alt"></i> <span class="pl-2">Upgrade my Profile
                                                        @if(seeker_logged('is_upgraded') == 1)
                                                            <span class="badge badge-success badge-sm">upgraded</span>
                                                        @endif
                                                    </span></a>
                                            </li>
                                            <li>
                                                <a href="{{url('seeker/profile')}}"><i class="fas fa-user-circle"></i> <span class="pl-2">My Account</span></a>
                                            </li>
                                            <li>
                                                <a href="{{url('seeker/dashboard')}}"><i class="fas fa-laptop"></i> <span class="pl-2">My Applications</span></a>
                                            </li>
                                            <li>
                                                <a href="{{url('seeker/notifications')}}"><i class="fas fa-bell"></i> <span class="pl-2">Notifications</span> <sup class="badge badge-primary float-right">{{App\NotificationLogs::countUnreadSeeker()}}</sup></a>
                                            </li>
                                            <li>
                                                <a href="{{url('logout')}}"><i class="fas fa-sign-out-alt"></i> <span class="pl-2">Logout</span></a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </div>



                        @elseif(@auth('recruiter')->check())
                            <div class="header-user">
                                <ul class="nav navbar-nav">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            {{recruiter_logged('company_name')}}
                                           </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{url('recruiter/dashboard')}}"><i class="fas fa-tachometer-alt"></i> <span class="pl-2">Dashboard</span></a>
                                            </li>
                                            <li>
                                                <a href="{{url('recruiter/profile')}}"><i class="fas fa-user-circle"></i> <span class="pl-2">My Account</span></a>
                                            </li>
                                            <li>
                                                <a href="{{url('recruiter/manage-jobs')}}"><i class="fas fa-laptop"></i> <span class="pl-2">Manage Jobs</span></a>
                                            </li>
                                            <li>
                                                <a href="{{url('recruiter/cv-search')}}"><i class="fas fa-cog"></i> <span class="pl-2">Search CVs</span></a>
                                            </li>
                                            <li>
                                                <a href="{{url('recruiter/notifications')}}"><i class="fas fa-bell"></i> <span class="pl-2">Notifications </span> <sup class="badge badge-primary float-right">{{App\NotificationLogs::countUnreadRecruiter()}}</sup></a>
                                            </li>

                                            <li>
                                                <a href="{{url('logout')}}"><i class="fas fa-sign-out-alt"></i> <span class="pl-2">Logout</span></a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </div>
                        @else
                            <ul class="top-jobdetail-login">
                            <li>
                                <a href="{{url('seeker/login')}}">login <span><i class="fas fa-lock"></i></span></a>
                            </li>
                            <li>
                                <a href="{{url('recruiter/login')}}" class="registerbtn" style="text-transform: inherit;">Post a Job</a>
                            </li>
                            </ul>
                        @endif
                        <ul class="top-jobdetail-login">

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                     <span>
                       <img style="max-width: 30px;" width="19" height="14" loading="lazy" src="{{url('frontend/assets/flags/'.$current_flag)}}">
                     </span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <div class="row">
                                        @foreach($flags->chunk(3) as $chunk)
                                        <div class="col-lg-4">
                                            @foreach($chunk as $flag)

                                    <a class="dropdown-item dropdown-flags @if($settings->country_name==$flag->name) active @endif" href="https://{{$flag->url}}">
                                        <span class='sprite-flag-{{str_replace(".fratres.net","",$flag->url)}}'></span>
                                        {{$flag->name}}
                                    </a>
                                            @endforeach

                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                            </li>

                            <!-- <li>
                              <a href="#">recruiting</a>
                            </li> -->
                        </ul>
        @if($settings->enable_language == 1)
                        <ul class="top-jobdetail-login">

                            <li class="nav-item dropdown">
                                <a  class="nav-link dropdown-toggle" role="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-transform: lowercase;cursor: pointer;">

                                    en
                                </a>
                                <div class="dropdown-menu width-language" aria-labelledby="navbarDropdown">


                                    <a href="#googtrans(en|{{$settings->language_code}})" class="lang-cn lang-select" data-lang="{{$settings->language_code}}">
                                        {{$settings->language_code}}
                                    </a>
                                    <a class="lang-en lang-select" href="#googtrans(en|en)" data-lang="en">
                                        en
                                    </a>

                                </div>
                            </li>
                        </ul>
            @endif

                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>