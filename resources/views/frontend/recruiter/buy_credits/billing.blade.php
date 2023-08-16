@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','recruiter_buycredits_thankyou')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')


    <!--main-->
    <div class="recruiter-main-dashboard">
        <div class="recru-dash-head">

            @include('frontend.recruiter.partials.sidebar')

            <div class="recru-dash-item2">

                <div class="recru-post-jobhead">
                    <div class="form-wizard">
                        <form action="{{url('recruiter/buy-package/'.$id)}}" method="post" role="form">
                            @csrf
                            <div class="form-wizard-header">
                                <br>
                                <ul class="list-unstyled form-wizard-steps clearfix">
                                    <li class="activated"><span>1</span>
                                        <p>Select Your Package</p>
                                    </li>
                                    <li class="active"><span>2</span>
                                        <p>Payment</p>
                                    </li>
                                    <li><span>4</span>
                                        <p>Confirmation</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="container">

                                <fieldset class="wizard-fieldset show col-7">
                                    <h5 class="heading-form-recruiter"><span>Account Information</span></h5>
                                    <div class="form-group row">
                                        <label for="CompanyName" class="col-sm-3">
                                            First Name <span class="star">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" name="billing_first_name" class="form-control wizard-required" id="fname" value="{{old('billing_first_name')}}" required>

                                            @if ($errors->has('billing_first_name'))
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{$errors->get('billing_first_name')[0]}}
                                                </div>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <label for="CompanyName" class="col-sm-3">
                                            Email <span class="star">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="email" class="form-control wizard-required" id="Email" value="{{recruiter_logged('email')}}" readonly="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="CompanyName" class="col-sm-3">
                                            Phone number <span class="star">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="tel" name="phone_number" class="form-control wizard-required" id="Phone" value="{{old('phone_number')}}" required>
                                        </div>
                                        <div class="wizard-form-error"></div>
                                    </div>


                                    <hr>


                                    <h5 class="heading-form-recruiter"><span>Card Information</span></h5>
                                    <div class="form-group row">
                                        <label for="card_name" class="col-sm-3">
                                            Full name <span class="star">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control wizard-required" id="card_name" name="card_holder_name" value="{{old('card_holder_name')}}" required>

                                            @if ($errors->has('card_holder_name'))
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{$errors->get('card_holder_name')[0]}}
                                                </div>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <label for="card_number" class="col-sm-3">
                                            Card number <span class="star">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control wizard-required" id="card_number" name="card_holder_number" value="{{old('card_holder_number')}}" required>

                                            @if ($errors->has('card_holder_number'))
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{$errors->get('card_holder_number')[0]}}
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="expiry" class="col-sm-3">
                                            Expiration date <span class="star">*</span></label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control wizard-required" id="expiry" placeholder="MM" name="card_expiry_month" maxlength="2" value="{{old('card_expiry_month')}}" required>
                                        </div>
                                        <span class="recru-monthdate">/</span>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control wizard-required" id="Expiration" name="card_expiry_year" maxlength="4" value="{{old('card_expiry_year')}}" placeholder="YYYY" required>
                                        </div>


                                        <label for="expiry" class="col-sm-3"></label>

                                        <div class="col-sm-7">
                                            @if ($errors->has('card_expiry_month'))
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{$errors->get('card_expiry_month')[0]}}
                                                </div>
                                            @endif
                                            @if ($errors->has('card_expiry_year'))
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{$errors->get('card_expiry_year')[0]}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="card_number" class="col-sm-3">
                                            CVC <span class="star">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control wizard-required" id="Expiration" name="card_cvc" maxlength="4" value="{{old('card_cvc')}}" placeholder="123" required>

                                            @if ($errors->has('card_cvc'))
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{$errors->get('card_cvc')[0]}}
                                                </div>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <label for="CompanyName" class="col-sm-3"></label>
                                        <div class="col-sm-5">
                                            <button type="submit" class="btn btn-primary">PAY</button>
                                        </div>
                                    </div>


                                </fieldset>


                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div><!--END-->
    </div>
    </div>
@endsection
