@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','seeker_notifications')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')



    <!--main-->
    <div class="jobseeker-dashboard-main">
        <div class="container">

            <!--jobseeker-dashb-head-->
            <div class="jobseeker-dashb-head">
                <h2>Notifications</h2>
            </div>
            <!--/jobseeker-dashb-head-->

            <!--jobseeker-main-dashobard-content-->
            <div class="jobseeker-dashb-content-main">
                @include('frontend.seeker.partials.sidebar')

                <div class="jobseeker-dashb-item2">

                    {{--notifications--}}
                    <div class="row d-flex justify-content-center mt-70 mb-70">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body">


                                    <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                        @php $badges = array("success", "warning", "danger","primary") @endphp
                                        @foreach($notifications as $notification)
                                        <div class="vertical-timeline-item vertical-timeline-element">
                                            <div> <span class="vertical-timeline-element-icon bounce-in">
                                        <i class="badge badge-dot badge-dot-xl badge-{{$badges[rand(0,3)]}}"> </i> </span>
                                                <div class="vertical-timeline-element-content bounce-in">
                                                    <h4 class="timeline-title">{{$notification->message}}</h4>
                                               @if($notification->read_at != null)
                                                    <p>Read at <span class="text-success">{{date("d M h:i a", strtotime($notification->read_at))}}</span></p>
                                                    @endif
                                                     <span class="vertical-timeline-element-date">{{date("d M", strtotime($notification->created_at))}}</span>
                                                </div>
                                            </div>
                                        </div>
                                            @php $notification->readAt() @endphp
                                            @endforeach


                                    </div>
                                    {{$notifications->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--notifications--}}

                </div>
            </div>
        </div>
    </div>

@endsection