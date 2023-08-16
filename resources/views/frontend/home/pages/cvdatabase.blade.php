@extends('frontend.layouts.main')

@section('content')
    <style>
        body {
            background: #f9f9f9;
        }
    </style>
    <div class="container">
        <div class="row mt-5">
            <div class="col-2"></div>
            <div class="col-8 text-center">
                <h4 class="h4">Search our CV Database & Advertise Jobs today</h4>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-1"></div>
            <div class="col-md-5">
                <div class="card card-cv" >
                    <span class="product-offer product-offer--new">
                        <span class="product-offer__price">£75</span>
                        <span class="product-offer__vat  ">+VAT</span>
                    </span>
                    <div class="card-body">
                        <h5 class="card-title">Advertise Jobs</h5>
                        <br>
                        <p class="card-text">Post your job for 28 days and advertise to 16.3 million candidates</p>
                        <p class="card-text mt-3"><b>25 applications on average</b></p>

                        <a href="#" class="btn btn-primary mt-3 ">Advertise now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-5 ">
                <div class="card card-cv" >
                    <span class="product-offer product-offer--new">
                        <span class="product-offer__price">£75</span>
                        <span class="product-offer__vat  ">+VAT</span>
                    </span>
                    <div class="card-body">
                        <h5 class="card-title">Search CVs</h5>
                        <br>
                        <p class="card-text">Access the UK’s favourite CV Database to find the perfect match for your vacancy</p>
                        <p class="card-text mt-3"><b>Unlimited CV views</b></p>

                        <a href="#" class="btn btn-primary mt-3 ">Advertise now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-2"></div>
            <div class="col-md-8">
                <div class="card card-cv" >

                    <div class="card-body">
                        <h5 class="card-title">For Hiring Packages</h5>
                        <br>
                        <p class="card-text">We'll build a customised hiring solution, tailored to your needs
                            <a href="#" class="btn btn-primary mt-3 float-right enquire-btn">Enquire now</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-light-blue mt-5">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 simpl-text text-center">
                <h4>Simple and effective recruitment solutions for everyone</h4>
                <p>Fratres versatile hiring products and straightforward recruitment solutions are designed to benefit businesses of all sizes.</p>
                <p>We focus on delivering quality job applications and growing our CV Database.</p>
                <p>Fratres is ideal for…</p>
            </div>
            <div class="col-md-3">
                <div class="card card-eading text-center" >
                    <div class="card-body">
                        <img class="card-img-top" src="{{asset('frontend/assets/img/recruitment.svg')}}" alt="Card image cap">
                        <h5 class="card-title mt-2">Recruitment agencies</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-eading text-center" >
                    <div class="card-body">
                        <img class="card-img-top" src="{{asset('frontend/assets/img/direct-employers.svg')}}" alt="Card image cap">
                        <h5 class="card-title mt-2">Direct employers</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-eading text-center" >
                    <div class="card-body">
                        <img class="card-img-top" src="{{asset('frontend/assets/img/advertising-agencies.svg')}}" alt="Card image cap">
                        <h5 class="card-title mt-2">Advertising agencies</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-eading text-center" >
                    <div class="card-body">
                        <img class="card-img-top" src="{{asset('frontend/assets/img/corportates.svg')}}" alt="Card image cap">
                        <h5 class="card-title mt-2">Corporates</h5>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="container-fluid bg-light-blue pb-5">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 mt-5 simpl-text text-center">
                <h3 class="benefits-heading">Benefits of recruiting with Fratres</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <div class="card panel-is" >
                    <div class="card-body">
                        <div class="media">
                            <img class="mr-3" src="{{asset('frontend/assets/img/apply.svg')}}" alt="Generic placeholder image">
                            <div class="media-body">
                                <h5 class="mt-0 mb-2">3 million monthly job applications</h5>
                                <p>Candidates visiting Fratres generate an average of 25 applications per vacancy</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card panel-is" >
                    <div class="card-body">
                        <div class="media">
                            <img class="mr-3" src="{{asset('frontend/assets/img/social.svg')}}" alt="Generic placeholder image">
                            <div class="media-body">
                                <h5 class="mt-0 mb-2">3 million monthly job applications</h5>
                                <p>Candidates visiting Fratres generate an average of 25 applications per vacancy</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <div class="card panel-is" >
                    <div class="card-body">
                        <div class="media">
                            <img class="mr-3" src="{{asset('frontend/assets/img/head.svg')}}" alt="Generic placeholder image">
                            <div class="media-body">
                                <h5 class="mt-0 mb-2">3 million monthly job applications</h5>
                                <p>Candidates visiting Fratres generate an average of 25 applications per vacancy</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card panel-is" >
                    <div class="card-body">
                        <div class="media">
                            <img class="mr-3" src="{{asset('frontend/assets/img/troffee.svg')}}" alt="Generic placeholder image">
                            <div class="media-body">
                                <h5 class="mt-0 mb-2">3 million monthly job applications</h5>
                                <p>Candidates visiting Fratres generate an average of 25 applications per vacancy</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <br>
@endsection