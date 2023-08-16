@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','recruiter_buycredits_index')->first();@endphp

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

    <!--main-->
    <div class="recruiter-main-dashboard">
        <div class="recru-dash-head">
            <div class="recru-dash-headv1">
                <p>bottom</p>
            </div>

            @include('frontend.recruiter.partials.sidebar')

            <div class="recru-dash-item2">

                <div class="recru-post-jobhead">
                    <div class="form-wizard">
                        <form action="{{url('recruiter/create_job')}}" method="post" role="form">
                            @csrf
                            <div class="form-wizard-header">
                                <br>
                                <ul class="list-unstyled form-wizard-steps clearfix">
                                    <li class="active"><span>1</span>
                                        <p>Select Your Package</p>
                                    </li>
                                    <li><span>2</span>
                                        <p>Payment</p>
                                    </li>
                                    <li><span>3</span>
                                        <p>Confirmation</p>
                                    </li>
                                </ul>
                            </div>

                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-11">


                                        <fieldset class="wizard-fieldset show">
                                        @if($packages->count() > 0)
                                        <?php $tax = $settings->tax ?>

                                            <div class="buy-filed-title">
                                                <h4>Select your package</h4>
                                            </div>


                                            <div class="buy-field-package-head mpkg">

                                                <div class='wrapper-custom'>
                                                    @foreach($packages as $package)
                                                        @php $tax = ( $package->price * $tax ) / 100; @endphp
                                                        <div class='package-custom @if($loop->index == 1) brilliant @endif '>
                                                            @if($loop->index == 1) <i class="fa fa-check fa-featured"></i> @endif
                                                            <div class='name'>{{$package->name}}</div>
                                                            <div class='price'>{{$settings->symbol}} {{$package->price}} <small>+{{$settings->tax_unit}}</small></div>
                                                            <div class='trial'>for {{$package->jobs}} jobs</div>
                                                            <hr>
                                                            @php $features = json_decode($package->features) @endphp
                                                            @if($features)
                                                                <ul class="customp">
                                                                    @foreach($features as $feature)
                                                                        <li><i class="fa fa-check fa-col" aria-hidden="true"></i> {{$feature}} </li>
                                                                    @endforeach

                                                                </ul>
                                                                <a href="{{url('recruiter/buy-credits/purchase/'.encrypt($package->id))}}" class="form-wizard-next-btn " id="buycredit-confirm">BUY NOW</a>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>


                                            </div>

                                        @else
                                            <h5 class="mb-5 mt-5 text-center">No Packages offered for now</h5>

                                            @endif
                                        </fieldset>


                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>


        </div><!--END-->
    </div>
    </div>

@endsection
