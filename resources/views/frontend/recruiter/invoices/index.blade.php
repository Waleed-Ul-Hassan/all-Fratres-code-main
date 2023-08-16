@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','recruiter_invoice_index')->first();@endphp

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
        .page-item.disabled .page-link {
            width: auto !important;
            height: 35px;
        }
    </style>
    <!--main-->

    

    <div class="recruiter-main-dashboard">
        <div class="recru-dash-head">
            <div class="recru-dash-headv1">
                <p>bottom</p>
            </div>

            @include('frontend.recruiter.partials.sidebar')

            <div class="recru-dash-item2">

                <div class="recru-post-jobhead">
                    <br>
                    <div class="col-md-12">
                        <div class="card">

                           

                            <div class="card-header border-0">
                                <h4 class="card-title card-title-rem">Orders Details</h4>

                            </div>
                            <div class="card-body table-responsive p-0">

                                    <table class="table table-hover table-bordered" id="example1">
                                        <thead>
                                        <tr>
                                            {{--<th scope="col">Order #</th>--}}
                                            <th scope="col">Job / Package</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Order Date</th>
                                            <th scope="col">Invoice</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $order_number = 545; @endphp
                                       
                                        <?php //pre($orders, true) ?>
                                        @foreach($orders as $order)
                                            <tr>
                                                {{--<th scope="row">---</th>--}}
                                                <td>
                                                    
                                                    @if($order->order_type == 'package_purchase')
                                                        <b>{{json_decode($order->package_details)->package_name}}</b>
                                                        <p>Type : <span class="color_text">Package</span></p>
                                                    @endif

                                                    @if($order->order_type == 'single_job' && $order->job_details != '')
                                                       @php $jobInfo = json_decode($order->job_details) @endphp
                                                       @if($jobInfo)
                                                        <b>{{$jobInfo->title ?? 'JOB DELETED' }}</b>
                                                        <p>Salary Offered : <span class="color_text">{{$settings->symbol.' '.$jobInfo->salary_min.' '.$jobInfo->salary_max}}</span></p>
                                                        <p>Type : <span class="color_text">Job</span></p>
                                                        @endif
                                                    @else
                                                        Job was Deleted
                                                    @endif
                                                    @if($order->order_type == 'cvs_purchased')

                                                        <b>{{$order->order_title}}</b>

                                                    @endif
                                                </td>
                                                <td>
                                                    @if($order->coupon_detail == null)
                                                        {{$settings->symbol}} {{$order->total_amount}}
                                                    @else
                                                        {{$settings->symbol}} {{$order->price_of_job + $order->tax_amount}}
                                                    @endif
                                                    <div></div>
                                                @if($order->coupon_detail == null)
                                                    @if($order->payment_status == 'pending')
                                                        <span class="badge badge-sm badge-warning">Pending</span>
                                                    @else
                                                        <span class="badge badge-sm badge-success">Completed</span>
                                                    @endif
                                                @endif

                                                </td>
                                                <td>
                                                    @if($order->coupon_detail != null)
                                                        @php $couponDetail = json_decode($order->coupon_detail) @endphp
                                                        Discount  {{$couponDetail->discount_percent}}%
                                                    @else
                                                        0%
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$order->created_at->diffForHumans()}}
                                                    {{--<a href="#" class="btn btn-xs"><i class="fa "></i></a>--}}
                                                </td>
                                                <td>

                                                    @if($order->stripe_response != '')
                                                    @if($order->order_type == 'single_job')
                                                        <a href="{{url('recruiter/invoices/'.encrypt($order->id).'?invoiceIs=true')}}" target="_blank" class="btn btn-primary">
                                                            view invoice
                                                        </a>
                                                    @endif
                                                    @if($order->order_type == 'cvs_purchased')
                                                        <a href="{{url('recruiter/invoices/'.encrypt($order->id).'?invoiceIs=true')}}" target="_blank" class="btn btn-primary bt-sm">
                                                            view invoice
                                                        </a>
                                                    @endif
                                                    @endif



                                                </td>
                                            </tr>
                                           @endforeach

                                      

                                        </tbody>
                                    </table>

                            </div>

                           
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
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
                "ordering": false
            });

        });
    </script>
@endsection