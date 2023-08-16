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


                <a href="joblisting.html" class="btn btn-primary ">Find jobs<span><i class="fas fa-search"></i></span></a>
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
    <div class="jobseeker-mainenhance">
        <div class="jobseeker-enhance-head">
            <div class="jobseeker-enhanceitem1">
                <h1>CV-Library Premium Profiles</h1>
                <p>Upgrade your profile <span>to stand out from the crowd</span> and</p>
                <span>get your CV noticed first.</span>
                <h2>£9.99</h2>
                <a href="jobseekerpurchase.html" class="btn btn-primary">
                    upgrade now
                </a>
            </div>
            <div class="jobseeker-enhanceitem2">
                <img src="{{url('frontend/assets/img/enhance1.png')}}" class="img-fluid">
            </div>
        </div>
        <div class="jobseeker-enhance-headntm">
            <p>
                A <span>30 day premium </span>highlighted <span>profile and CV </span>on CV-Library
            </p>
        </div>
        <div class="jobseeker-premiumprofile">
            <div class="container">
                <h1>What do I get with my Premium Profile?</h1>
                <p>Thousands of businesses are searching CVs on our database every day, and it's not always easy to get yours noticed. With a Premium Profile your CV will become 'featured' and will appear at the top of search results, plus you'll receive a free CV review from experts.</p>
            </div>
        </div>
        <div class="jobseeker-enhance-profile-head-v1">
            <div class="jobseeker-enhance-profile-head-v1item1">
                <img src="{{url('frontend/assets/img/topptofile.svg')}}">
                <h1>Top profile</h1>
                <h5>Your profile will appear higher than standard candidate profiles in search results</h5>
                <p>When employers search our database, they see a list of matching profiles. With a Premium Profile you will appear at the top all of relevant searches so your CV is seen first.</p>
            </div>
            <div class="jobseeker-enhance-profile-head-v1item2">
                <img src="{{url('frontend/assets/img/enhance2.png')}}" class="img-fluid">
            </div>
        </div>
        <div class="jobseeker-enhance-profile-head-v1 preimum-jobseeker">
            <div class="jobseeker-enhance-profile-head-v1item1 preimum-jobseekeritem">
                <img src="{{url('frontend/assets/img/preimumjobseeker.svg')}}">
                <h1>Premium branding</h1>
                <h5>Your profile will appear higher than standard candidate profiles in search results</h5>
                <p>When employers search our database, they see a list of matching profiles. With a Premium Profile you will appear at the top all of relevant searches so your CV is seen first.</p>
            </div>
            <div class="jobseeker-enhance-profile-head-v1item2">
                <img src="{{url('frontend/assets/img/enhance2.png')}}" class="img-fluid">
            </div>
        </div>
        <div class="jobseeker-enhance-profile-head-v1">
            <div class="jobseeker-enhance-profile-head-v1item1">
                <img src="{{url('frontend/assets/img/cvjobseeker.svg')}}">
                <h1>Free CV review</h1>
                <h5>Enjoy a free CV review from industry experts</h5>
                <p><strong>Upgrade to a Premium Profile and receive:</strong></p>
                <ul class="list-ticks">
                    <li><span><img src="{{url('frontend/assets/img/jobsseker.svg')}}"></span>Feedback from a professional consultant</li>
                    <li><span><img src="{{url('frontend/assets/img/jobsseker.svg')}}"></span>A score out of 100 of your CV's effectiveness</li>
                    <li><span><img src="{{url('frontend/assets/img/jobsseker.svg')}}"></span>Constructive advice on the content, structure and style</li>
                    <li><span><img src="{{url('frontend/assets/img/jobsseker.svg')}}"></span>Advice on how to improve your CV</li>
                </ul>
            </div>
            <div class="jobseeker-enhance-profile-head-v1item2">
                <img src="{{url('frontend/assets/img/jobseeker-cv.png')}}" class="img-fluid">
            </div>
        </div>
        <div class="jobseeker-premiumprofile">
            <div class="container">
                <h1>Let employers know you're serious about your job search</h1>
                <div class="jobseeker-upgradestar">
                    <div class="jobseeker-upgrade-item">
                        <img src="{{url('frontend/assets/img/upgradestar.png')}}" class="img-fluid">
                    </div>
                    <div class="jobseeker-upgrade-item">
                        <h1>Upgrade to a Premium Profile and get <span>five times more CV views</span></h1>
                    </div>
                    <div class="jobseeker-upgrade-item">
                        <h1>£9.99</h1>
                    </div>
                    <div class="jobseeker-upgrade-item">
                        <a href="jobseekerpurchase.html" class="btn btn-primary">
                            upgrade now
                        </a>
                    </div>
                </div>
                <p>he Premium Profile candidate service does not guarantee you will secure a new job. It will significantly increase your visibility to employers but you must still meet the criteria the employers state in their job descriptions to secure a job or interview. Premium Profile status remains for 30 days. The price includes VAT.</p>
            </div>
        </div>
    </div>


@endsection