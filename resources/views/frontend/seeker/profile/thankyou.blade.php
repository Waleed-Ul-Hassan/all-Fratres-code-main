@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','seeker_thankyou')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')


    {{--//thankyou--}}
    <!--main-->
    <div class="jobseeker-dashboard-main">
        <div class="container">

            <div class="jobseeker-dashb-content-main">

                @include('frontend.seeker.partials.sidebar')

                <div class="jobseeker-dashb-item2-mainheadv4 " style="margin: 0px;">
                    @if(!isset($_GET['receiptIs']))
                    <div class="modify-account-dashed margin-left-30">
                        <div class="modify-account-personal-details">

                            <div class="row">

                                <div class="buy-order-confirmation-head col-6">
                                    <i class="fas fa-check-circle"></i>
                                    <h1>
                                        thanks for upgrading your profile!
                                    </h1>
                                    <p>You'll Receive a Confirmation Email at <a href="#">{{seeker_logged('email')}}</a></p>


                                    <a href="?receiptIs=true" class="btn btn-primary">
                                        view invoice
                                    </a>
                                </div>

                            </div>

                        </div>
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

    {{--//thankyou--}}


@endsection