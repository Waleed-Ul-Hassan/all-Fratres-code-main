@php
use Illuminate\Support\Facades\Cookie;
use App\Industry;
use App\SiteSetting;

$Jobsindustry = Industry::select("name")->orderBy("total_jobs", "DESC")->orderBy("name", "ASC")->limit(5)->get();
$siteSettings = SiteSetting::first();
@endphp


<!---footer-->
<footer class="jobdetail-ftr-main recru-ftr-hold">
    <div class="jobdetail-ftr">
        <div class="container">
            <div class="ftr-main-head">
                <div class="ftr-item">
                    <h3>Fratres</h3>
                    <ul>
                        <li><a href="{{url('about-us')}}"><i class="fas fa-angle-double-right"></i> <span>About Us</span></a></li>
                        <li><a href="{{url('seeker/cv-maker/register')}}"><i class="fas fa-angle-double-right"></i><span>CV Maker</span></a></li>
                        <li><a href="mailto:info@fratres.net"><i class="fas fa-angle-double-right"></i> <span>Work for Us</span></a></li>
                        <li><a href="{{url('publisher')}}"><i class="fas fa-angle-double-right"></i> <span>For Publishers</span></a></li>
                        <li><a href="{{url('contact')}}"><i class="fas fa-angle-double-right"></i> <span>Contact Us </span></a></li>

                    </ul>
                </div>
                <div class="ftr-item">
                    <h3>Job Seekers</h3>
                    <ul>
                        <li><a href="{{url('seeker/register')}}"><i class="fas fa-angle-double-right"></i> <span>Job Seeker Sign Up</span></a></li>
                        <li><a href="{{url('seeker/login')}}"><i class="fas fa-angle-double-right"></i> <span>Job Seeker Login</span></a></li>
                        <li><a href="{{url('create-job-alerts')}}"><i class="fas fa-angle-double-right"></i> <span>Create Job Alerts</span></a></li>

                        <li><a href="{{url('seeker/cv-maker/register')}}"><i class="fas fa-angle-double-right"></i> <span>Create cv</span></a></li>
                        <li><a href="{{url('search')}}"><i class="fas fa-angle-double-right"></i> <span>Find Jobs</span></a></li>

                    </ul>
                </div>
                <div class="ftr-item">
                    <h3>Employers</h3>
                    <ul>
                        <li><a href="{{url('recruiter/register')}}"><i class="fas fa-angle-double-right"></i> <span>Employer Sign Up</span></a></li>
                        <li><a href="{{url('recruiter/login')}}"><i class="fas fa-angle-double-right"></i> <span>Employer Login</span></a></li>
                        <li><a href="{{url('recruiter/job_post')}}"><i class="fas fa-angle-double-right"></i><span>Post a Job</span></a></li>
                        <li><a href="{{url('recruiter/cv-search')}}"><i class="fas fa-angle-double-right"></i> <span>Search cv database</span></a></li>
                        <li><a href="{{url('recruiter/buy-credits')}}"><i class="fas fa-angle-double-right"></i> <span>buy packages</span></a></li>
                    </ul>
                </div>
                <div class="ftr-item">
                    <h3>Bloggers</h3>
                    <ul>
                        <li><a href="{{url('career-advice')}}"><i class="fas fa-angle-double-right"></i> <span>Blogger Sign Up</span></a></li>
                        <li><a href="{{url('career-advice')}}"><i class="fas fa-angle-double-right"></i> <span>Blogger login</span></a></li>
                        <li><a href="{{url('career-advice')}}"><i class="fas fa-angle-double-right"></i> <span> latest blogs</span></a></li>

                        <h3 class="fratxjob">Fratres Group</h3>
                        <li><a href="{{url('our-networks')}}"><i class="fas fa-angle-double-right"></i>  <span>Network Sites</span></a></li>

                    </ul>
                </div>
                <div class="ftr-item">
                    <h3>popular jobs</h3>
                    <ul>
                        @foreach($Jobsindustry as $valueIndustry)
                    <li><a href="{{url('search?industry='.$valueIndustry->name)}}"><i class="fas fa-angle-double-right"></i> <span>{{$valueIndustry->name}}</span></a></li>

                            @endforeach

                    </ul>
                </div>
                <div class="ftr-item">

                    <a href="#"><img class="footer-logo" src="{{asset('frontend/assets/img/fratreslogofinal.png')}}" loading="lazy" width="150" height="80" alt=""></a>
                    <p>© {{date("Y")}} Fratres. All rights reserved. Use of this site signifies your consent to our
                        <a href="{{url('terms')}}">Terms of Use</a>, <a href="{{url('privacy')}}">Privacy Policy</a>, <a href="{{url('privacy')}}"> Cookies Policy</a> and <a href="{{url('sitemap')}}">Sitemap</a></p>
                </div>
            </div>
        </div>
        <div class="ftr-jobdetail-botm-head">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="jobdetail-appmain">
                            <a  href="#" class="jobdetail-apple">
                                <img src="{{asset('frontend/assets/img/app-store.png')}}" loading="lazy" width="100" height="70" class="img-fluid">
                                <span class="visually-hidden">Download the Fratres iPhone App</span>
                            </a>
                            <a  href="#" class="jobdetail-playstore">
                                <img src="{{asset('frontend/assets/img/google-play.png')}}" loading="lazy" width="100" height="70" class="img-fluid">
                                <span class="visually-hidden">Download the Fratres iPhone App</span>
                            </a>
                        </div>

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                        <div class="jobdetail-list-btmftr">
                            <ul>
                                @if($siteSettings->facebook != '')
                                <li>
                                    <a href="{{$siteSettings->facebook}}" target="_blank" class="footer__social-link  "> <i class="fab fa-facebook-f fa-2x fontawsome-footer-styling"></i>

                                    </a>
                                </li>
                                @endif
                                    @if($siteSettings->twitter != '')
                                <li>
                                    <a href="{{$siteSettings->twitter}}" target="_blank" class="footer__social-link ">
                                        <i class="fab fa-twitter fa-2x fontawsome-footer-styling"></i>
                                    </a>
                                </li>
                                    @endif
                                    @if($siteSettings->youtube != '')
                                <li>
                                    <a href="{{$siteSettings->youtube}}" target="_blank" class="footer__social-link ">
                                        <i class="fab fa-youtube fa-2x fontawsome-footer-styling"></i>
                                    </a>
                                </li>
                                    @endif
                                @if($siteSettings->linkdin != '')
                                <li>
                                    <a href="{{$siteSettings->linkdin}}" target="_blank" class="footer__social-link ">
                                        <i class="fab fa-linkedin fa-2x fontawsome-footer-styling"></i>
                                    </a>
                                </li>
                                @endif
                                 @if($siteSettings->tumbler != '')
                                <li>
                                    <a href="{{$siteSettings->tumbler}}" target="_blank" class="footer__social-link "> <i class="fab fa-tumblr fa-2x fontawsome-footer-styling"></i>
                                    </a>
                                </li>
                                @endif
                                 @if($siteSettings->instgram != '')
                                <li>
                                    <a href="{{$siteSettings->instgram}}" target="_blank" class="footer__social-link ">
                                        <i class="fab fa-instagram fa-2x fontawsome-footer-styling"></i>
                                    </a>
                                </li>
                                @endif
                                 @if($siteSettings->pinterest != '')
                                <li>
                                    <a href="{{$siteSettings->pinterest}}" target="_blank" class="footer__social-link ">
                                        <i class="fab fa-pinterest fa-2x fontawsome-footer-styling"></i>
                                    </a>
                                </li>
                                @endif



                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--/footer-->
<div class="footer-cookie" @if(Cookie::get('job_box')) style="display:none;" @endif>
    <div class="left-shape"></div>
    <div class="right-shape"></div>

    <div class="zoek-alerts-header-text font-weight-bold text-center pt-1">Get new jobs from Fratres straight into your inbox!</div>
    <div class="text-center flex-column flex-sm-row py-1" style="margin: 0 auto;">    
        <a href="{{ url('create-job-alerts')}}" class="btn btn-secondary yes-please m-1" id="yesButton">Yes Please!</a>
        <button class="btn btn-dark m-1" id="dontAskButton">Don't Ask Again</button>
    </div>
</div>



<script type="text/javascript">


@if(!\Illuminate\Support\Facades\Cookie::get('job_box'))
    // $(document).on("click", "#dontAskButton", function () {
    //     $(document).ready(function () {
    //         var element = $(this);
    //
    //         $.ajax({
    //             url: "/get-jobs-box-cookie",
    //             type:'GET',
    //             data: {},
    //             processData: false,
    //             contentType:false,
    //             success: function(data) {
    //                 element.parents('.footer-cookie').remove();
    //
    //             }
    //         });
    //     })
@endif
            // });
$(document).on("click", "#dontAskButton", function () {
    var element = $(this);
    $.ajax({
        url: "/get-jobs-box-cookie",
        type:'GET',
        data: {},
        processData: false,
        contentType:false,
        success: function(data) {
            element.parents('.footer-cookie').remove();

        }
    });
});
</script>