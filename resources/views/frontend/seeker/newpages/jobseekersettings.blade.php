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
                <div class="row">
                    <div class="col-lg-6">
                        <h2>My Settings</h2>
                    </div>
                    <div class="col-lg-6">
                        <h6>You last logged in: 08/05/2020 07:07</h6>
                    </div>
                </div>
            </div>
            <!--/jobseeker-dashb-head-->
            <div class="crums-job">
                <ul>
                    <li>
                        <a href="#">My account</a>
                        »
                    </li>
                    <li>
                        <strong>My Settings</strong>
                    </li>
                </ul>
            </div>
            <!--jobseeker-dashb-head-->
            <div class="jobseeker-dashb-head">
                <h2>My account</h2>
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
                                                <a href="jobseekermodifyaccount.html"  class="btn btn-primary">edit profile</a>
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
                    <div class="jobseeker-settings-pas-head">
                        <form action="{{url('seeker/update-password')}}" method="post">
                            @csrf
                            <h2>Change password</h2>
                            <div class="jobseeker-changepswd-head">
                                <div class="jobseeker-changepswd-head-item1">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">old Password</label>
                                        <input type="password" name="old_pass" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">new Password</label>
                                        <input type="password" name="new_pass" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                </div>
                                <div class="jobseeker-changepswd-head-item2">
                                    <div class="passwordjobseekerchange">
                                        <h4>Password advice</h4>
                                        <p>We recommend using passwords with multiple random words, as they are the most secure.</p>
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

                    <div class="jobseeker-settings-pas-headv2">
                        <form>
                            <h2>My email preferences</h2>
                            <div class="jobseeker-changepswd-headv2">
                                <div class="jobseeker-changepswd-headv2-item1">
                                    <h4>Snooze from all emails for 6 months?</h4>
                                    <p>We hate goodbyes! Why not take a short break from our emails instead?</p>
                                    <div class="changejobseeker-btn">


                                        <a href="#" class="changejobseeker-botmbtn" >
                                            Snooze all emails for 6 months
                                        </a>
                                    </div>
                                </div>
                                <p>Tick the boxes below to select which emails you wish to receive from CV-Library.co.uk. You may still receive emails up to 48 hours after updating your preferences.</p>
                                <div class="jobseeker-changepswd-togl">
                                    <div class="jobseeker-changpsw-toglehead">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <p>CV-Library Emails</p>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <p class="text-right"> CV-Library Emails</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jobseeker-change-detailsv1">
                                        <div class="jobseeker-email-list-items">

                                            <label for="CAN_AAR" class="email-pref-labels">Abandoned applications reminder emails</label>
                                            <span class="yes">yes</span>
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>

                                            </label>

                                        </div>
                                        <div class="jobseeker-email-list-items">

                                            <label for="CAN_AAR" class="email-pref-labels">Abandoned applications reminder emails</label>
                                            <span class="yes">yes</span>
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                            </label>

                                        </div>
                                        <div class="jobseeker-email-list-items">

                                            <label for="CAN_AAR" class="email-pref-labels">Abandoned applications reminder emails</label>
                                            <span class="yes">yes</span>
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                            </label>

                                        </div>
                                        <div class="jobseeker-email-list-items">

                                            <label for="CAN_AAR" class="email-pref-labels">Abandoned applications reminder emails</label>
                                            <span class="yes">yes</span>
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                            </label>

                                        </div>
                                        <div class="jobseeker-email-list-items">

                                            <label for="CAN_AAR" class="email-pref-labels">Abandoned applications reminder emails</label>
                                            <span class="yes">yes</span>
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                            </label>

                                        </div>
                                    </div>
                                </div>
                                <div class="changejobseeker-btn">

                                    <a href="#" class="changejobseeker-botmbtn" >
                                        Update email preferences
                                    </a>
                                </div>

                                <div class="jobseeker-changepswd-headv2-item1">

                                    <p>To stop receiving Job Alerts you need to either delete or deactivate your alerts accordingly. Manage Job Alerts</p>

                                </div>
                                <p>
                                    <strong> Please note:</strong> you will still receive emails regarding your job search and apply process, e.g enquiries from recruiters/employers or job application confirmation.
                                </p>
                            </div>

                        </form>
                    </div>

                    <!--end-->
                    <div class="jobseeker-settings-pas-headv2">
                        <form>
                            <h2>My current CV visibility/status</h2>

                            <div class="jobseeker-changepswd-headv2-item1">

                                <p>Your CV is currently visible to employers and recruiters</p>

                            </div>
                            <p>Hiding your CV will mean that employers and recruiters won't be able to find you. This will decrease your chances of finding a job, but you'll still be able to apply for jobs.</p>

                            <p>Hide CV benefits</p>

                            <ul class="cvl-list">
                                <li>You will still be able to search and apply for jobs</li>
                                <li>Your profile will be hidden from recruiters</li>
                                <li>You will still have access to all of CV-Library's services</li>
                                <li>You will still receive all email notifications (unless modified in your email preferences)</li>
                            </ul>
                            <div class="changejobseeker-btn">

                                <a href="#" class="changejobseeker-botmbtn" >
                                    Hide my CV now
                                </a>
                            </div>


                            <p>
                                <strong> Please note:</strong> you will still receive emails regarding your job search and apply process, e.g enquiries from recruiters/employers or job application confirmation.
                            </p>


                        </form>
                    </div>
                    <!--end-->
                    <div class="jobseeker-settings-pas-headv2">
                        <form>
                            <h2>Delete my CV-Library account</h2>

                            <div class="jobseeker-changepswd-headv2-item1">

                                <p>Your CV is currently visible to employers and recruiters</p>

                            </div>
                            <p>Deleting your CV-Library account will remove all of your details (including your CV) from our system. If you decide to return to CV-Library in the future you will need to go through the registration process again.</p>

                            <p>If you are deleting your account because you don't want others to see your CV, you can hide your CV (above) and still keep your account. If you're deleting your account because you want to update your CV, you can upload a new one here and still keep your account.</p>

                            <ul class="cvl-list">
                                <li style="font-weight:600;">Your CV and account history will be permanently deleted from our records</li>
                                <li>You will no longer receive any further services from CV-Library, including email notifications</li>
                                <li>You will need to re-register if you wish to return to CV-Library</li>
                            </ul>
                            <div class="changejobseeker-btn">


                                <a href="#" class="changejobseeker-botmbtn" >
                                    Delete my account
                                </a>
                            </div>

                    </div>




                    </form>
                </div>

            </div>
        </div>
        <!--/jobseeker-main-dashobard-content-->
    </div>

@endsection