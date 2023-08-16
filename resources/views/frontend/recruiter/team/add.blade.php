@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','recruiter_team_add')->first();@endphp

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
                <div class="recru-dash-item2-v1">
                    <div class="recru-dash-item2-v1-title">
                        <h3>Team Members</h3>
                    </div>
                    <div class="recru-dash-item2-v1-action">
                        <div class="recru-dash-item2-v1-action-head">
                            <div class="recru-dash-item2-v1-action-head-item1">
                                <h3>{{recruiter_logged('job_credits') ?? 0}}</h3>
                            </div>
                            <div class="recru-dash-item2-v1-action-head-item2">
                                <h2>job credits</h2>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="recur-item2-maincontent">
                    <br><br><br>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-active" role="tabpanel" aria-labelledby="pills-home-tab">




                            <form action="{{url('recruiter/team/store')}}" method="post">
                                @csrf
                               <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label for="CompanyName" class="col-sm-3">
                                                     Name <span class="star">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="team_name" class="form-control wizard-required" id="fname" placeholder="john" required="">
                                                    @if ($errors->has('team_name'))
                                                        <div class="invalid-feedback" style="display: block;">
                                                            {{$errors->get('team_name')[0]}}
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <label for="CompanyName" class="col-sm-3">
                                                     Position <span class="star">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control wizard-required" id="Email" placeholder="HR Manager" name="team_position" required="">
                                                    @if ($errors->has('team_position'))
                                                        <div class="invalid-feedback" style="display: block;">
                                                            {{$errors->get('team_position')[0]}}
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label for="Email" class="col-sm-3">
                                                    Email <span class="star">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control wizard-required" id="Email" placeholder="team@email.com" name="email" required="">
                                                    @if ($errors->has('email'))
                                                        <div class="invalid-feedback" style="display: block;">
                                                            {{$errors->get('email')[0]}}
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label for="password" class="col-sm-3">
                                                    Password <span class="star">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control wizard-required" id="password" name="password" required="">

                                                    @if ($errors->has('password'))
                                                        <div class="invalid-feedback" style="display: block;">
                                                            {{$errors->get('password')[0]}}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cpassword" class="col-sm-3">
                                                    Confirm Password <span class="star">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control wizard-required" id="cpassword" name="password_confirmation" required="">
                                                </div>
                                                <div class="wizard-form-error"></div>
                                            </div>


                                            <div class="form-group clearfix">

                                                <div class="offset-md-3 col-sm-9 pl-6">
                                                    <button type="submit" class="btn btn-primary">Add Member</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                        </div>
                                    </div>
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

