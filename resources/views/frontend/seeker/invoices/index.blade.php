@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','seeker_thankyou')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )

@endsection
@section('style')
    <link rel="stylesheet" href="{{url('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

    <!-- AdminLTE App -->
    <script src="{{url('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
@endsection

@section('content')
    <style>
        .recru-dash-headv1{
            width:15.7%;
        }
        .dataTables_filter, .dataTables_length, .dataTables_info, #example1_paginate{
            padding:10px;
        }
    </style>

    @include('frontend.partials.joblistingheader')

    <div class="jobseeker-dashboard-main">
        <div class="container">

            <div class="jobseeker-dashb-content-main">

                @include('frontend.seeker.partials.sidebar')

                <div class="jobseeker-dashb-item2-mainheadv4 " style="margin: 0px;">

                    <div class="recru-dash-item2">

                        <div class="recru-post-jobhead">
                            <br>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h4 class="card-title card-title-rem">Orders Details</h4>

                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        @if($orders->count() > 0)
                                        <table class="table table-hover table-bordered" id="example1">
                                            <thead>
                                            <tr>

                                                <th scope="col">Type</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Order Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php $currency = $settings->symbol @endphp
                                            @foreach($orders as $order)
                                                <tr>
                                                    <td>You Upgraded your profile</td>
                                                    <td>{{$currency}}{{$order->total_amount}}</td>
                                                    <td>{{date("d M Y", strtotime($order->created_at))}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        {{$orders->links()}}
                                        @else
                                            <h4 class="text-center mt-5 mb-5">
                                                <i class="fas fa-shopping-cart fa-2x"></i> No Orders Yet
                                            </h4>
                                        @endif
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>


@endsection