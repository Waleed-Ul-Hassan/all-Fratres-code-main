@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','recruiter_job_thankyou')->first();@endphp

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
                                <li class="activated"><span>4</span>
                                    <p>Payment</p>
                                </li>
                                <li class="active"><span>5</span>
                                    <p>Confirmation</p>
                                </li>
                            </ul>
                        </div>
                        <div class="container">

                            <br><br>
                    @if(!isset($_GET['invoiceIs']))
                        <div class="buy-order-confirmation-head col-6">
                            <i class="fas fa-check-circle"></i>
                            <h1>
                                thanks for your payment!
                            </h1>
                            <p>You'll Receive a Confirmation Email at <a href="#">{{json_decode($order->billing_info)->billing_email}}</a></p>

                            @if(isset(json_decode($order->stripe_response)->receipt_url))

                            <a href="?invoiceIs=true" class="btn btn-primary">
                                view invoice
                            </a>
                                @endif
                        </div>
                    @else
                    <?php

                    $data = file_get_contents(json_decode($order->stripe_response)->receipt_url);
                    $data = str_replace("erfan@fratres.net", "info@fratres.net", $data);
                    echo $data;
                    ?>
                    @endif
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div><!--END-->
    </div>
    </div>
@endsection
