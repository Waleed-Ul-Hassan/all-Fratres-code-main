<style>
    .profile-image-joseekerdashb .profile-pic {
        background: url({{url('seekers/profile/'.Auth::guard('seeker')->user()->avatar)}}) no-repeat;
        background-size: cover;
    }
</style>
<div class="jobseeker-dashb-item1">
    <div class="jobseeker-dashb-item1-main">
        <div class="text-center">
            <form action="{{url('seeker/change_avatar')}}" enctype="multipart/form-data" id="profile_avatar" method="post">
                @csrf
                <ul>
                    <li>
                        <h5>{{Auth::guard('seeker')->user()->first_name}} {{Auth::guard('seeker')->user()->last_name}}</h5>
                        <h6>{{Auth::guard('seeker')->user()->previous_job_title}}</h6>
                        <div class="profile-image-joseekerdashb">
                            <label for="fileToUpload">
                                <div class="profile-pic">
                                    <span class="glyphicon glyphicon-camera"></span>
                                    <span>Change Image</span>
                                    <div  class="profile-avatar__edit no-photo"><span class="visually-hidden">Upload profile photo</span></div>
                                </div>
                            </label>

                            <input type="File" name="fileToUpload" id="fileToUpload">


                        </div>
                        <div class="profile-jobseeker-progress">
                            <p class="">70% complete</p>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="profilejobseeker-title">{{show_phone(Auth::guard('seeker')->user()->phone,'phone')}}</p>
                            <p class="profilejobseeker-title1">{{Auth::guard('seeker')->user()->email}}</p>
                            <p>(
                                <a href="#">not {{Auth::guard('seeker')->user()->first_name}}?</a>)
                            </p>
                            <div class="profile-seeker-jobedit">
                                <a href="{{url('seeker/update-password')}}" class="btn btn-primary">Update Password</a>
                                <br>
                                <br>
                                <a href="{{url('seeker/profile')}}" class="btn btn-primary">edit profile</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="jobseeker-profile-completemain">
                            <h5>Complete your profile</h5>
                            <h6>A completed profile is 71% more likely to be viewed by a recruiter.</h6>
                        </div>
                        @if( Auth::guard('seeker')->user()->skills == '' )
                        <div class="profile__field" data-sidebar-field="">
                            <button id="sidebarSkillsLabel" class="profile__detail-btn skills" type="button" aria-expanded="true" data-profile-expand="">
                                <span>Main Skills</span><i class="fa fa-chevron-down"></i></button>
                            <div class="profile__detail-dropdown" style="display: block;" id="jobseeker-drop1">
                                <span id="sidebarSkillsDesc">Enter up to 10 skills, separated by commas</span>
                                <textarea name="seeker_skills" rows="5" maxlength="180" aria-labelledby="sidebarSkillsLabel" aria-describedby="sidebarSkillsDesc"></textarea>
                            </div>
                        </div>
                        @endif
                        <div class="profile__field" data-sidebar-field="" id="desiredjob">
                            <label for="" class="label_jobs">Desired Job Title</label>
                            <button id="sidebarSkillsLabel" class="profile__detail-btn skills" type="button" aria-expanded="true" data-profile-expand="">
                                <span><input type="text" placeholder="Desired Job Title" name="desired_job_title" value="{{Auth::guard('seeker')->user()->desired_job_title}}"></span></button>
                        </div>
                        <div class="profile__field" data-sidebar-field="" id="desiredjob">
                            <label for="sidebarSkillsLabel" class="label_jobs">Current Job Title</label>
                            <button id="" class="profile__detail-btn skills" type="button" aria-expanded="true" data-profile-expand="">
                                <span><input type="text" id="sidebarSkillsLabel" placeholder="Current Job Title" name="previous_job_title" value="{{Auth::guard('seeker')->user()->previous_job_title}}"></span></button>
                        </div>

                        <div class="profile-seeker-jobedit">
                            <button type="submit"  class="btn btn-primary">save to profile</button>
                        </div>
                    </li>
                    <li>
                        <div class="jobseeker-sidebar-botm">
                            <div class="jobseeker-item1-sidebar width-32">
                                <a href="#"><i class="far fa-eye"></i></a>
                                <a href="#">0</a>
                                <a href="#" class="profile-btm-jobseekersidebar">
                                    Profile views
                                </a>
                            </div>
                            <div class="jobseeker-item2-sidebar width-32">
                                <a href="#" class="heartcolor"><i class="far fa-heart"></i></a>
                                <a href="#">0</a>
                                <a href="#" class="profile-btm-jobseekersidebar">
                                    Saved Jobs
                                </a>
                            </div>
                            <div class="jobseeker-item3-sidebar width-32">
                                <a href="#"><i class="fas fa-bell"></i></a>
                                <a href="#">2</a>
                                <a href="#" class="profile-btm-jobseekersidebar">
                                    Job Alerts
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>

