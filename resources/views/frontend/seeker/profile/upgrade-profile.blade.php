@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','homepage')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')
    @include('frontend.partials.joblistingheader')
    <!--main-->
    <div class="jobseeker-dashboard-main">
        <div class="container">

            <div class="jobseeker-dashb-content-main">

                @include('frontend.seeker.partials.sidebar')

    <div class="jobseeker-dashb-item2-mainheadv4" style="margin: 0px;">
        <div class="modify-account-title">
            <h4>Upgrade Your Profile. <a  data-toggle="collapse" href="#collapseExample_0" role="button" aria-expanded="true" aria-controls="collapseExample">why?</a></h4>
            <div class="collapse " id="collapseExample_0" style="width: 40%; margin-top: 10px; position: absolute; z-index: 99; border: 2px solid rgb(0 123 255);margin-left: 12%;">
                <div class="card card-body">
                    <p>
                        <b>CV Searches : </b> if you upgrade your profile, our strong AI Alogrtihms will show your profile on top search results which increases chances to get hired.
                    </p>
                    <p>
                        <b>Job Applications : </b> You will also appear on top in job applications.
                    </p>
                </div>
            </div>
        </div>
        <div class="modify-account-dashed">
            <div class="modify-account-personal-details">

                <div class="row">

                    <fieldset class="wizard-fieldset show margin-left-30 col-9">

                        <h5 class="heading-form-recruiter"><span>Charges </span></h5>
                        <div class="form-group row">
                            <label for="card_name" class="col-sm-3">
                                Amount </label>
                            <div class="col-sm-5">
                                <p><b>{{$settings->symbol}} {{$settings->seeker_upgrade_price}}/m</b></p>

                            </div>

                        </div>

                        <hr>

                        @if(seeker_logged('is_upgraded') != 1)

                        <form action="{{url('seeker/upgrade-profile')}}" method="post">
                            @csrf

                        <h5 class="heading-form-recruiter"><span>Card Information</span></h5>
                        <div class="form-group row">
                            <label for="card_name" class="col-sm-3">
                                Full name <span class="star">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control wizard-required" id="card_name" name="card_holder_name" value="" required="">

                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="card_number" class="col-sm-3">
                                Card number <span class="star">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control wizard-required" id="card_number" name="card_holder_number" value="" required="">

                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="expiry" class="col-sm-3">
                                Expiration date <span class="star">*</span></label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control wizard-required" id="expiry" placeholder="MM" name="card_expiry_month" maxlength="2" value="" required="">
                            </div>
                            <span class="recru-monthdate">/</span>
                            <div class="col-sm-2">
                                <input type="text" class="form-control wizard-required" id="Expiration" name="card_expiry_year" maxlength="4" value="" placeholder="YYYY" required="">
                            </div>


                            <label for="expiry" class="col-sm-3"></label>

                            <div class="col-sm-7">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cvc" class="col-sm-3">
                                CVC <span class="star">*</span></label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control wizard-required" id="cvc" name="card_cvc" maxlength="4" value="" placeholder="123" required="">

                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="CompanyName" class="col-sm-3"></label>
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-primary">PAY</button>
                            </div>
                        </div>
                        </form>

                        @else
                            <h5 class="heading-form-recruiter"><span>Your Profile is Featured Already untill {{date("d M Y", strtotime(seeker_logged('expiry_upgrade')))}} </span></h5>
                        @endif

                    </fieldset>

                </div>

            </div>
        </div>



    </div>

            </div>
        </div>
    </div>

@endsection