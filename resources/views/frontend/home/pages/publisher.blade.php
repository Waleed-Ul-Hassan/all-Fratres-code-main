@extends('frontend.layouts.main')

@section('content')

    @include('frontend.partials.joblistingheader')
    <div class="main_jobpublisher">
        <div class="jobpublisher_main_head">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="jobpublisher_top_details">
                            <h5>Advertise your jobs on</h5>
                            <h5>Fratres</h5>
                            <a href="#">Reach over 25 million candidates</a>
                            <p>By sponsoring your job ads you will be always on top and pay only when users click to view your ad.<a href="#"> Further information</a></p>
                        </div>
                        <div class="jobpublisher_topbtn">
                            <a href="#" class="btn btn-primary up">start</a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <img src="{{asset('frontend/assets/img/laptop_img.jpg')}}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
        <div class="jobme_main_fratres">
            <div class="container">
                <div class="jobme_heading">
                    <h3>Fratres today</h3>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">

                        <p>   <span><i class="fas fa-envelope"></i></span> Over 475'000'000 e-mails sent each month</p>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">

                        <p><span><i class="fas fa-user"></i></span> Over 2'970'000 unique users every month</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">

                        <p> <span><i class="fas fa-align-justify"></i></span> More than 3'800'000 job ads</p>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">

                        <p> <span><i class="fas fa-bolt"></i></span>Over 50'000 companies seeking candidates</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="jobtraffic_fratres_main">
            <div class="container">
                <h1>You have jobs. We have traffic.</h1>
                <h4>Providing us with an XML feed is the fastest way to get your jobs on Jooble</h4>
                <div class="jobtraffic_btn">
                    <a href="#" class="btn btn-primary">

                        Include your XML feed

                    </a>
                </div>
                <h5>Follow our XML feed <a href="#">specifications</a> to set up your feed. Once your XML feed is ready, submit your jobs or contact us.</h5>
            </div>
        </div>

        <div class="jobme_fratrex_different">

            <div class="container">
                <div class="jobme_difrnt_heading">
                    <h3>What makes us different</h3>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                        <div class="jobme_make1">
                            <div class="text-center">
                                <img src="{{asset('frontend/assets/img/focus_.png')}}" class="img-fluid">
                            </div>
                            <p>We know how to drive targeted candidates to your job board to maximize your ROI</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                        <div class="jobme_make1">
                            <div class="text-center">
                                <img src="{{asset('frontend/assets/img/wrench.png')}}" class="img-fluid">
                            </div>
                            <p>We know how to drive targeted candidates to your job board to maximize your ROI</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                        <div class="jobme_make1">
                            <div class="text-center">
                                <img src="{{asset('frontend/assets/img/group.png')}}" class="img-fluid">
                            </div>
                            <p>We know how to drive targeted candidates to your job board to maximize your ROI</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                        <div class="jobme_make1">
                            <div class="text-center">
                                <img src="{{asset('frontend/assets/img/user_is.png')}}" class="img-fluid">
                            </div>
                            <p>We know how to drive targeted candidates to your job board to maximize your ROI</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="jobme_fratres_start">
            <div class="container">
                <div class="jpbstart-heading">
                    <h5>start</h5>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <span> Configure your first campaign</span>
                        <p>To set up a campaign, you create an account and set your budget. You can then refine it at any time.</p>
                        <div class="jobpublisher_topbtn">
                            <a href="#" class="btn btn-primary up">start</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <span> Configure your first campaign</span>
                        <p>
                            Do you have doubts? Need a hand to set up your first campaign?
                            One of our experts will follow you step by step for free.
                            <a href="#">Click here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="jobme_fratrx_contact">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <form>
                            <div class="form-fratrx_contact">
                                <h3>Send us request to index your XML</h3>
                                <span>Get reply within 48 hours.</span>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Your name">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Contact phone">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Contact e-mail address">
                            </div>
                            <div class="form-group">

                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option value="0">Traffic plan</option>
                                    <option>Oraganic traffic</option>
                                    <option>Premium traffic</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Your website">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Link to XML feed">
                            </div>
                            <div class="jobpublisher_topbtn">
                                <a href="#" class="btn btn-primary btn-block">send</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".up").click(function() {
                $('html, body').animate({
                    scrollTop: $(".jobme_fratrx_contact").offset().top
                }, 1000);
            });
        });
    </script>
@endsection