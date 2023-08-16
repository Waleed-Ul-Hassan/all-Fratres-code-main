@extends('frontend.layouts.main')

@section('content')
    <style>
        section.network_clients_main , section.ournetwork_fratres , section.pricing{
            background-color: #f9f9f9 !important;
            background: #f9f9f9 !important;
        }
        a.btn.btn-primary {
            background-color: #fff;
            color: #ff8a00;
            opacity: 1;
        }
        .ournetwork_heading h3, .ournetwork_heading p {
            color: #ff8a00;
        }
        .our_network_breadcrums ul li a {
            color: #ff8a00;
            font-size: 16px;
        }
        .our_network_breadcrums ul li i {
            color: #ff8a00 !important;
        }
        @media (max-width: 992px) {
            .tophead-jobdetail, .main_network_sites , .footer.jobdetail-ftr-main{
                width: 150%;
            }
        }
    </style>
    <div class="main_network_sites mt-1">



        <section class="ournetwork_fratres">
            <div class="row-fluid">
                {{--<div class="our_network_breadcrums">--}}
                    {{--<ul>--}}
                        {{--<li>--}}
                            {{--<a href="#">Recruiter home</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<span><i class="fas fa-chevron-right"></i></span>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="#">Advertise Jobs</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
                <div class="ournetwork_heading">
                    <h3>Advertise your jobs to over millions candidates</h3>
                    <p>Showcase your vacancies to the {{$settings->country_code}}'s competitive independent CV Database and get applications sent straight to your inbox</p>
                </div>
            </div>
        </section>
        <section class="network_clients_main">
            <div class="container-fluid" >
                <div class="network_clients_head">


                    <section class="pricing py-5">
                        <div class="container">
                            <div class="row">
                                <!-- Free Tier -->
                                @foreach($packages as $package)
                                <div class="col-lg-4 ">
                                    <div class="card mb-5 mb-lg-0">
                                        <div class="card-body">
                                            <h5 class="card-title  text-uppercase text-center">{{$package->jobs}} Jobs</h5>
                                            <h6 class="card-price text-center">{{$settings->symbol.$package->price}}+{{$settings->tax_unit}}<span class="period">/month</span></h6>
                                            <hr>
                                            <ul class="fa-ul">
                                                @php
                                                    $features = json_decode($package->features);
                                                @endphp
                                                @if(count($features) > 0)
                                                    @foreach($features as $feature)
                                                        <li><span class="fa-li"><i class="fas fa-check"></i></span>{{$feature}}</li>
                                                    @endforeach
                                                @endif
                                                {{--<li><span class="fa-li"><i class="fas fa-check"></i></span>Only £47.50 per job</li>--}}
                                                {{--<li><span class="fa-li"><i class="fas fa-check"></i></span>Use over 3 months</li>--}}
                                                {{--<li><span class="fa-li"><i class="fas fa-check"></i></span>Multi-job saving: £203</li>--}}

                                            </ul>
                                            <a href="{{url('recruiter/buy-credits/purchase/'.encrypt($package->id))}}" class="btn btn-block btn-primary text-uppercase">BUY NOW</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- Plus Tier -->
                                {{--<div class="col-lg-4">--}}
                                    {{--<div class="card mb-5 mb-lg-0">--}}
                                        {{--<div class="card-body">--}}
                                            {{--<h5 class="card-title  text-uppercase text-center">Single Job</h5>--}}
                                            {{--<h6 class="card-price text-center">$69+VAT<span class="period">/month</span></h6>--}}
                                            {{--<hr>--}}
                                            {{--<ul class="fa-ul">--}}
                                                {{--<div class="product__flash"><span class="visually-hidden">Most popular</span></div>--}}
                                                {{--<li><span class="fa-li"><i class="fas fa-check"></i></span>28 day job postings</li>--}}
                                                {{--<li><span class="fa-li"><i class="fas fa-check"></i></span>25 applications on average</li>--}}
                                                {{--<li><span class="fa-li"><i class="fas fa-check"></i></span>Your job sent in daily alerts</li>--}}
                                                {{--<li><span class="fa-li"><i class="fas fa-check"></i></span>Free Company Profile</li>--}}
                                            {{--</ul>--}}
                                            {{--<a href="#" class="btn btn-block btn-primary text-uppercase">BUY NOW</a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <!-- Pro Tier -->
                                {{--<div class="col-lg-4 ">--}}
                                    {{--<div class="card">--}}
                                        {{--<div class="card-body">--}}
                                            {{--<h5 class="card-title  text-uppercase text-center">5 Jobs+</h5>--}}
                                            {{--<h6 class="card-price text-center">+44 207 101 9297</h6>--}}
                                            {{--<hr>--}}
                                            {{--<ul class="fa-ul">--}}

                                                {{--<li class="custom"><span class="fa-li"><i class="fas fa-check"></i></span>We are currently offering <b>highly discounted rates</b> on larger job packages!</li>--}}
                                                {{--<li>&nbsp;</li>--}}
                                                {{--<li>&nbsp;</li>--}}


                                            {{--</ul>--}}
                                            {{--<a href="#" class="btn btn-block btn-primary text-uppercase">BUY NOW</a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </section>


                </div>
                <div class="network_sector_wrapper">
                    <div class="row mb-5 logos-bg">
                        <div class="container p-3 logos-img">
                            <h4 class="text-center text-white mb-4"><b>Our Partners</b></h4>
                            <img src="{{asset('frontend/assets/img/medicaljobs.png')}}" class="img-fluid" style="margin-top: 10px;">
                            <img src="{{asset('frontend/assets/img/retailjobsuk.png')}}" class="img-fluid" style="margin-top: -20px">
                            <img src="{{asset('frontend/assets/img/city-jobs.png')}}" class="img-fluid">
                            <img src="{{asset('frontend/assets/img/wowjobs.png')}}" class="img-fluid">
                            <img src="{{asset('frontend/assets/img/jobinn.png')}}" class="img-fluid">
                            <img src="{{asset('frontend/assets/img/securityjobf.png')}}" class="img-fluid">
                        </div>

                    </div>

                    {{--<hr>--}}
                    <div class="row for-discount-text discounts-bg" >
                        <div class="col-2"></div>
                        <div class="col-8 pb-3 text-white">
                            <br>
                            For discounts on larger job packages please <a href="{{url('contact')}}"><u class="text-white">contact</u></a> our friendly sales team, we'll be happy to help!
                            <div class="d-flex justify-content-center mt-3">
                                <a href="{{url('contact')}}" class="btn  btn-primary">Enquire Now</a>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>

                <div class="network_sector_wrapper  text-center  bg-white">
                    <div class="row cards-data justify-content-center text-center bg-white mb-5">
                        <div class="col-12 text-center mb-5 mt-5">
                            <h4 class="what-happens mb-3">What happens after you post a job?</h4>
                            <p>Within minutes, you can advertise a job on Fratres and place your vacancy in front of over millions of candidates to view quickly and easily.</p>
                        </div>


                        <div class="col-md-3 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{asset('frontend/assets/img/high-application-rate.svg')}}" alt="">
                                    <h5>High application rate</h5>
                                    <p class="pt-3">Jobs advertised on Fratres receive 25 applications on average</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{asset('frontend/assets/img/dedicated-account.svg')}}" alt="">
                                    <h5>Excellent account management</h5>
                                    <p class="pt-3">You will know exactly who to turn to if you need a helping hand</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{asset('frontend/assets/img/exposure.svg')}}" alt="">
                                    <h5>Exposure across job sites</h5>
                                    <p class="pt-3">All jobs are automatically shared across our network.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{asset('frontend/assets/img/free-company.svg')}}" alt="">
                                    <h5> Company Profile</h5>
                                    <p class="pt-3">A dedicated place to showcase your brand and jobs</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12"><br><br></div>
                    </div>
                </div>

                <div class="network_sector_wrapper ">
                    <div class="row cards-data justify-content-center">
                        <div class="col-12 text-center mb-5">
                            <h4 class="what-happens mb-3">Posting is quick and simple</h4>
                        </div>


                        <div class="col-md-3 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{asset('frontend/assets/img/select.svg')}}" alt="">
                                    <h5 class="card-title mt-3">Select</h5>
                                    <p class="card-text mt-3">Add the job details, including salary and location, and choose your screening questions</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <i class="fas fa-angle-right card-angle"></i>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{asset('frontend/assets/img/advertise.svg')}}" alt="">
                                    <h5 class="card-title mt-3">Advertise</h5>
                                    <p class="card-text mt-3">Post your job and it will automatically be sent to all relevant sites</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <i class="fas fa-angle-right card-angle"></i>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{asset('frontend/assets/img/hire.svg')}}" alt="">
                                    <h5 class="card-title">Hire</h5>
                                    <p class="card-text mt-3">Receive applications, shortlist candidates and make your next hire!</p>
                                </div>
                            </div>
                        </div>




                    </div>
                </div>

                {{--<div class="network_sector_wrapper mt-5 bg-white">--}}
                    {{--<div class="row cards-data-add justify-content-center">--}}
                        {{--<div class="col-12 text-center mt-5 mb-5">--}}
                            {{--<h2 ><b>Premium Products</b></h2>--}}
                        {{--</div>--}}

                        {{--<div class="col-md-5  text-center">--}}
                            {{--<div class="card">--}}
                                {{--<div class="card-body">--}}
                                    {{--<img src="{{asset('frontend/assets/img/job-add-1.png')}}" width="300" alt="">--}}
                                    {{--<h5 class="card-title mt-5">Premium Branded Adverts</h5>--}}
                                    {{--<p class="card-text mt-3">Jobs include an eye-catching header image and stand out with a 'Premium' sash</p>--}}
                                    {{--<a href="#" class="btn btn-primary mt-5">Learn More</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="col-md-5 text-center">--}}
                            {{--<div class="card">--}}
                                {{--<div class="card-body">--}}
                                    {{--<img src="{{asset('frontend/assets/img/job-add-2.png')}}" alt="">--}}
                                    {{--<h5 class="card-title mt-5">Premium Featured Adverts</h5>--}}
                                    {{--<p class="card-text mt-3">Jobs include extensive branding and are boosted to the top of our search results - maximising application rates</p>--}}
                                    {{--<a href="#" class="btn btn-primary mt-5">Learn More</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}


                    {{--<div class="col-12"><br><br></div>--}}

                    {{--</div>--}}
                {{--</div>--}}








            </div>
        </section>


    </div>

@endsection