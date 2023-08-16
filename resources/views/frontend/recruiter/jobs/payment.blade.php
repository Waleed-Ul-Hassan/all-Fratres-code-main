@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','recruiter_job_payment')->first();@endphp

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
                <br>
                <div class="recru-post-jobhead">
                    <div class="form-wizard">


                            <div class="form-wizard-header">

                                <ul class="list-unstyled form-wizard-steps clearfix">
                                    <li class="activated"><span>1</span>
                                        <p>Job details</p>
                                    </li>
                                    <li class="activated"><span>2</span>
                                        <p>Preview</p>
                                    </li>
                                    <li class="activated"><span>3</span>
                                        <p>Billing information</p>
                                    </li>
                                    <li class="active"><span>4</span>
                                        <p>Payment</p>
                                    </li>
                                    <li><span>5</span>
                                        <p>Confirmation</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="container mt-5-mob">
                                @php $coupon = \App\Coupon::where('discount', 100)->first() @endphp
                            <fieldset class="wizard-fieldset show col-6 col-sm-12-mob ">
                                <form action="{{url('recruiter/apply_coupon')}}" method="post" id="form_save_job" role="form">
                                        @csrf
                                        <input type="hidden" name="__bringorder__" value="{{encrypt($order->id)}}">

                                    <h5 class="heading-form-recruiter"><span>Post For Free</span></h5>
                                    {{--<h5 class="heading-form-recruiter"><span>Do you have coupon?</span></h5>--}}
                                    <div class="form-group row">
                                        <label for="coupon" class="col-sm-3 ">Apply Coupon </label>

                                        <div class="col-sm-6">
                                            <input type="text" name="coupon_code" class="form-control wizard-required"  id="coupon" placeholder="3EHJU87K" @if($coupon) value="{{$coupon->coupon_code}} @endif">
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-primary">Apply Code</button>
                                        </div>
                                    </div>
                                </form>
                                    <br>
                                    <h5 class="heading-form-recruiter"><span>Premium Job insertion fee: <strong>{{$settings->symbol}} {{$order->total_amount}}</strong>  (incl. {{$settings->tax_unit}})</span></h5>

                                <form action="{{url('recruiter/create_job')}}" method="post" id="form_save_job" role="form">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                    <div class="form-group row">
                                        <label for="card_name" class="col-sm-3">
                                            Full name <span class="star">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control wizard-required" id="card_name" name="card_holder_name" value="{{old('card_holder_name')}}">

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
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control wizard-required" id="card_number" name="card_holder_number" value="{{old('card_holder_number')}}">

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
                                            <input type="text" class="form-control wizard-required" id="expiry" placeholder="MM" name="card_expiry_month" maxlength="2" value="{{old('card_expiry_month')}}">
                                        </div>
                                        <span class="recru-monthdate">/</span>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control wizard-required" id="Expiration" name="card_expiry_year" maxlength="4" value="{{old('card_expiry_year')}}" placeholder="YYYY">
                                        </div>
                                        <label for="expiry">
                                            CVC : <span class="star">*</span></label>
                                        <div class="col-md-2 col-sm-3">
                                            <input type="text" class="form-control wizard-required" id="Expiration" name="card_cvc" maxlength="4" value="{{old('card_cvc')}}" placeholder="123">
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


                                    <div class="form-group row clearfix">
                                        <label for="location" class="col-sm-3 "></label>
                                        <div class="col-sm-7">
                                            <button type="submit" class="btn btn-primary">PAY</button>
                                        </div>
                                    </div>
                                    </form>
                                @if(recruiter_logged('job_credits') > 0)
                                <h5 class="heading-form-recruiter"><span>OR Post using Job Credits</span></h5>
                                <div class="form-group row clearfix">
                                    <label for="location" class="col-sm-3 "></label>
                                    <div class="col-sm-7">
                                        <a href="{{url('recruiter/create-job-with-credits/'.encrypt($order->id))}}" class="btn btn-primary">PUBLISH NOW</a>
                                    </div>
                                </div>
                                @endif
                                </fieldset>



                            </div>

                    </div>
                </div>
            </div>

        </div>

    </div><!--END-->
    </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        //set your publishable key
        Stripe.setPublishableKey("{{Config::get('services.stripe.key')}}");

        //callback to handle the response from stripe
        function stripeResponseHandler(status, response) {
            if (response.error) {
                //enable the submit button
                $('#payBtn').removeAttr("disabled");
                //display the errors on the form
                //console.log(response.error.message);
                $(".payment-errors").html('<div class="alert alert-danger">' + response.error.message + '</div>');
            } else {
                var form$ = $("#form_save_job");
                //get token id
                var token = response['id'];
                //insert the token into the form
                form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                //submit form to the server
                form$.get(0).submit();
            }
        }
    </script>
@endsection