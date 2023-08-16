@php
    $seeker = App\Seeker::find(seeker_logged('id'));
@endphp
<style>
    .profile-image-joseekerdashb .profile-pic {
        @if($seeker->avatar != '')
        background: url({{url('seekers/profile/'.getDomainRoot().$seeker->avatar)}}) no-repeat;
        @else
        background: url({{asset('frontend/assets/img/person-placeholder.jpg')}}) no-repeat;
        @endif
        background-size: cover;
    }
</style>

<div class="jobseeker-dashb-item1">
    <div class="jobseeker-dashb-item1-main">
        <div class="recu-dash-list text-center">
            <form action="{{url('seeker/change_avatar')}}" enctype="multipart/form-data" id="profile_avatar" method="post">
                @csrf
                <p class="pbt-10">{{$seeker->first_name}} {{$seeker->last_name}}</p>
                <h6>{{$seeker->previous_job_title}}</h6>
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
                    <p class="">{{$seeker->profile_complete}}% complete</p>
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{$seeker->profile_complete.'%'}}" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <hr>
                <ul class="recruiter_sidebar_active">

                    <h3 class="text-left">Account Information</h3>

                        <li class="seeker-list">
                            <a href="{{url('seeker/dashboard')}}">Dashboard</a>
                        </li>
                        <li class="seeker-list">
                            <a href="{{url('seeker/profile')}}">Edit Profile </a>
                        </li>
                        <li class="seeker-list">
                            <a href="{{url('seeker/cv-maker')}}">
                                CV Maker</a>
                        </li>
                        <li class="seeker-list">
                            <a href="{{url('seeker/job-alerts')}}"> Job Alerts <span class="badge badge-primary float-right mr-40">{{$seeker->job_alerts->count()}}</span></a>
                        </li>
                        <li class="seeker-list">
                            <a href="{{url('seeker/invoices')}}"> Invoices </a>
                        </li>

                        <li class="seeker-list">
                            <a href="{{url('seeker/upgrade-profile')}}">
                                Upgrade Profile
                                @if(seeker_logged('is_upgraded') == 1)
                                    <span class="badge badge-success badge-sm">upgraded</span>
                                @endif
                            </a>
                        </li>
                        <li class="seeker-list">
                            <a href="{{url('seeker/update-password')}}">
                                Update password </a>
                        </li>

                </ul>
                <br>
                    <li style="list-style-type: none;">
                        <div class="jobseeker-sidebar-botm">
                            <div class="jobseeker-item1-sidebar width-32">
                                <a href="#"><i class="far fa-eye"></i></a>
                                <a href="#">0</a>
                                <a href="#" class="profile-btm-jobseekersidebar">
                                    Profile views
                                </a>
                            </div>

                            <div class="jobseeker-item2-sidebar width-32">
                                <a href="{{url('saved-jobs')}}" class="heartcolor"><i class="far fa-heart"></i></a>
                                @if(Cookie::get('saved_jobs'))
                                    @php
                                        $ids_array = explode(",",Cookie::get('saved_jobs'));
                                    @endphp
                                <a href="#">{{count($ids_array)}}</a>
                                @else
                                    <a href="#">0</a>
                                @endif
                                <a href="{{url('saved-jobs')}}" class="profile-btm-jobseekersidebar">
                                    Saved Jobs
                                </a>
                            </div>
                            <div class="jobseeker-item3-sidebar width-32">
                                <a href="{{url('seeker/job-alerts')}}"><i class="fas fa-bell"></i></a>

                                <a href="{{url('seeker/job-alerts')}}">{{$seeker->job_alerts->count()}}</a>
                                <a href="{{url('seeker/job-alerts')}}" class="profile-btm-jobseekersidebar">

                                    Job Alerts
                                </a>
                            </div>
                        </div>
                    </li>

            </form>
        </div>
    </div>
</div>
<script>
    $(".recruiter_sidebar_active>li>a").each(function () {
        var this_url = $(this).attr('href');
        var opened_url = window.location.href;
        if(this_url == opened_url){
            $(this).parents('li').addClass('active');
            console.log(this_url);
        }
    });
    $(document).on("change", "#fileToUpload", function () {
        // alert();
        $('#profile_avatar').submit();

    });

    $(document).on("change", "#imageUpload", function () {
        // alert();
        $('#profile_avatar').submit();

    });

</script>
