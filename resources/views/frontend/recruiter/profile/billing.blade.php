@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','recruiter_profile_billing')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')

    <!--main-->
    <div class="recruiter-main-dashboard">
        <div class="recru-dash-head">
            <div class="recru-dash-headv1">
                <p>bottom</p>
            </div>

            @include('frontend.recruiter.partials.sidebar')

            <div class="recru-dash-item2">
                <div class="recru-dash-item2-v1-title">
                    <h3>Update Your Billing Info</h3>
                </div>

                <div class="recru-post-jobhead">
                    <div class="form-wizard">
                        <form action="{{url('recruiter/update-billing')}}" method="post" role="form">
                            @csrf

                            <div class="container">

                                <fieldset class="wizard-fieldset show col-7">
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3">
                                            First Name <span class="star">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="billing_first_name" class="form-control wizard-required" id="fname" value="{{ billing_details('billing_first_name') }}">

                                        @if ($errors->has('billing_first_name'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('billing_first_name')[0]}}
                                            </div>
                                        @endif
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="Surname" class="col-sm-3">
                                            Surname <span class="star">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control wizard-required" id="Surname" name="billing_sur_name" value="{{billing_details('billing_sur_name')}}">
                                        @if ($errors->has('billing_sur_name'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('billing_sur_name')[0]}}
                                            </div>
                                        @endif
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="Email" class="col-sm-3">
                                            Email <span class="star">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control wizard-required" id="Email" value="{{billing_details('billing_email')}}" name="billing_email">

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="CompanyName" class="col-sm-3">
                                            Company Name <span class="star">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="billing_company_name" class="form-control wizard-required" id="CompanyName" value="{{billing_details('billing_company_name')}}">

                                            @if ($errors->has('billing_company_name'))
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{$errors->get('billing_company_name')[0]}}
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="Address" class="col-sm-3">
                                            Address <span class="star">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="billing_address" class="form-control wizard-required" id="Address" value="{{billing_details('billing_address')}}">

                                        @if ($errors->has('billing_address'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('billing_address')[0]}}
                                            </div>
                                        @endif
                                        </div>

                                    </div>
                                    <div class="form-group row">

                                        <div class="offset-sm-3 col-sm-9">
                                            <input type="text" name="address_two" class="form-control wizard-required" id="address_two" value="{{billing_details('address_two')}}">
                                        </div>
                                        <div class="wizard-form-error"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="zip" class="col-sm-3">
                                            Zip/Postal Code <span class="star">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control wizard-required" name="zip" id="zip" value="{{billing_details('zip')}}">
                                            @if ($errors->has('zip'))
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{$errors->get('zip')[0]}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="wizard-form-error"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="city" class="col-sm-3">
                                            Town/City <span class="star">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="city" class="form-control" id="city">
                                                @foreach($cities as $city)
                                                    <option value="{{$city->name}}">{{$city->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('city'))
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{$errors->get('city')[0]}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="wizard-form-error"></div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="province" class="col-sm-3">
                                            State or province <span class="star">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="province" class="form-control wizard-required" id="province" value="{{billing_details('province')}}">
                                            @if ($errors->has('province'))
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{$errors->get('province')[0]}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="wizard-form-error"></div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="VAT" class="col-sm-3">
                                            VAT Number</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="vat_number" class="form-control wizard-required" id="VAT" value="{{billing_details('vat_number')}}">
                                        </div>
                                        <div class="wizard-form-error"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Phone" class="col-sm-3">
                                            Phone number <span class="star">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="tel" name="phone_number" class="form-control wizard-required" id="Phone" value="{{billing_details('phone_number')}}">
                                        </div>
                                        <div class="wizard-form-error"></div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="CompanyName" class="col-sm-3"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-primary">confirm</button>

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

@section('scripts')

@endsection