@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','homepage')->first();@endphp

    @if ($seo)
        <meta name="description" content="{{$seo->meta_description}}">
        <meta name="keywords" content="{{$seo->meta_key}}">
        <meta name="title" content="{{$seo->meta_title}}">

    @endif


@endsection
@section('content')

    <header class="jobdetails">
        <div class="container">
            <form class="form-inline row">
                <label for="inlineFormInputName2">Keywords</label>
                <input type="text" class="form-control  col-md-3" id="inlineFormInputName1" placeholder="e.g customer services">

                <label  for="inlineFormInputGroupUsername2">Location</label>
                <input type="text" class="form-control  col-md-3" id="inlineFormInputName2" placeholder="e.g postcode or town">


                <select class="custom-select col-md-2" id="inlineFormCustomSelect">

                    <option value="1">up to 1 mile </option>
                    <option value="2">up to 2 miles</option>
                    <option value="3"> up to 3 miles</option>
                    <option value="4"> up to 4 miles</option>
                    <option value="5">up to 5 miles</option>
                    <option value="6">up to 6 miles</option>

                </select>


                <a href="joblisting.html"  class="btn btn-primary ">Find jobs<span><i class="fas fa-search"></i></span></a>
            </form>

        </div>
        <div class="jobdetail-header-top">
            <div class="container">
                <div class="jobdetail-company">
                    <div class="jobdetail-company-details">
                        <p>90,124 jobs from <a href="#">9,868</a> companies</p>
                    </div>
                    <!-- <div class="jobdetail-company-saved">
                      <a href="#">saved jobs(0) <span><i class="far fa-heart"></i></span></a>
                    </div> -->
                </div>
            </div>
        </div>
    </header>
    <!---/header--->

    <!--main-->
    <div class="jobseeker-dashboard-main">
        <div class="container">

            <!--jobseeker-dashb-head-->
            <div class="jobseeker-dashb-head">
                <h2>
                    My Applications</h2>
            </div>
            <!--/jobseeker-dashb-head-->

            <!--jobseeker-main-dashobard-content-->
            <div class="jobseeker-dashb-content-main">
                <div class="jobseeker-dashb-item1">
                    <div class="jobseeker-dashb-item1-main">
                        <div class="text-center">
                            <form>
                                <ul>
                                    <li>
                                        <h5>omi free</h5>
                                        <h6>software developer</h6>
                                        <div class="profile-image-joseekerdashb">
                                            <label for="fileToUpload">
                                                <div class="profile-pic">
                                                    <span class="glyphicon glyphicon-camera"></span>
                                                    <span>Change Image</span>
                                                    <div class="profile-avatar__edit no-photo"><span class="visually-hidden">Upload profile photo</span></div>
                                                </div>
                                            </label>
                                            <input type="File" name="fileToUpload" id="fileToUpload">
                                        </div>
                                        <div class="profile-jobseeker-progress">
                                            <p class="">70% complete</p>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="profilejobseeker-title">+447789514877</p>
                                            <p class="profilejobseeker-title1">njoyner2022@gmail.com</p>
                                            <p>(
                                                <a href="#">not omi?</a>)
                                            </p>
                                            <div class="profile-seeker-jobedit">
                                                <a href="jobseekermodifyaccount.html" class="btn btn-primary">edit profile</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="jobseeker-profile-completemain">
                                            <h5>Complete your profile</h5>
                                            <h6>A completed profile is 71% more likely to be viewed by a recruiter.</h6>
                                        </div>
                                        <div class="profile__field" data-sidebar-field="">
                                            <button id="sidebarSkillsLabel" class="profile__detail-btn skills" type="button" aria-expanded="true" data-profile-expand="">
                                                <span>Main Skills</span><i class="fa fa-chevron-down"></i></button>
                                            <div class="profile__detail-dropdown" style="display: block;" id="jobseeker-drop1">
                                                <span id="sidebarSkillsDesc">Enter up to 10 skills, separated by commas</span>
                                                <textarea name="sidebar_skills" rows="5" maxlength="180" aria-labelledby="sidebarSkillsLabel" aria-describedby="sidebarSkillsDesc"></textarea>
                                            </div>
                                        </div>
                                        <div class="profile__field" data-sidebar-field="" id="desiredjob">
                                            <button id="sidebarSkillsLabel" class="profile__detail-btn skills" type="button" aria-expanded="true" data-profile-expand="">
                                                <span><input type="text" placeholder="Desired Job Title"></span><i class="fa fa-chevron-down"></i></button>

                                        </div>
                                        <div class="profile-seeker-jobedit">
                                            <a href="#"  class="btn btn-primary">save to profile</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="jobseeker-sidebar-botm">
                                            <div class="jobseeker-item1-sidebar">
                                                <a href="#"><i class="far fa-eye"></i></a>
                                                <a href="#">0</a>
                                                <a href="#" class="profile-btm-jobseekersidebar">
                                                    Profile views
                                                </a>
                                            </div>
                                            <div class="jobseeker-item2-sidebar">
                                                <a href="#" class="heartcolor"><i class="far fa-heart"></i></a>
                                                <a href="#">0</a>
                                                <a href="#" class="profile-btm-jobseekersidebar">
                                                    Profile views
                                                </a>
                                            </div>
                                            <div class="jobseeker-item3-sidebar">
                                                <a href="#"><i class="fas fa-bell"></i></a>
                                                <a href="#">2</a>
                                                <a href="#" class="profile-btm-jobseekersidebar">
                                                    Profile views
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="jobseeker-dashb-item2">
                    <div class="jobseeker-dashb-item2-mainheadv1">
                        <h2>External Applications</h2>
                        <div class="jobseeker-changepswd-headv2-item1">

                            <p>Below are jobs that required you to complete your application on the recruiter/company's own website.</p>

                        </div>
                        <!--postjob1-->
                        <div class="jobseeker-dashb-item2-mainheadv1-main">
                            <div class="jobseeker-dashb-item2-mainheadv1-main-logo">
                                <img src="{{url('frontend/assets/img/applicationclientlogo.png')}}">
                            </div>
                            <div class="jobseeker-dashb-item2-mainheadv1-main-details">
                                <a href="jobdetaildescription.html">Trainee Software Developer</a>
                                <h5>company :<a href="#">The-Training-Room-IT-Training</a></h5>
                                <h5> Location: <strong>Nationwide</strong></h5>
                            </div>
                            <div class="jobseeker-dashb-item2-mainheadv1-main-btns">
                                <div class="appliation-jobseeker">
                                    <h5>  Job Ref: <strong>  Trainee Software Developer</strong></h5>
                                    <h5>  Date Applied: <strong>   06/05/2020 06:16</strong></h5>
                                </div>

                                <!-- <ul>
                                  <li>
                                    <a href="#" class="btn btn-primary">
                                      view all<span><i class="fas fa-chevron-right"></i></span>
                                    </a>
                                    <a href="#" class="btn btn-success">
                                   Apply<span><i class="fas fa-chevron-right"></i></span>
                                    </a>
                                  </li>
                                </ul> -->
                            </div>
                        </div>
                        <!--/postjob1-->


                        <div class="application-btn-jobseeker">
                            <a href="#" class="btn btn-primary">1</a>
                        </div>


                    </div>
                    <!--/end-->


                </div>
            </div>
            <!--/jobseeker-main-dashobard-content-->
        </div>
    </div>

@endsection