@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','recruiter_team')->first();@endphp

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
                        <h3>Jobs Stats</h3>
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


                        @if(count($members)>0)

                                <div class="topactive-recru-post col-md-12">

                                    <table class="table  table-hover">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th class="">Designation</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($members as $member)
                                            <tr>
                                                <td>{{$member->creator_name}}</td>
                                                <td>{{$member->email}}</td>
                                                <td>{{$member->creator_position}}</td>
                                                <td>
                                                    <a href="{{url('recruiter/team/delete/'.$member->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>


                                        @endforeach


                                        </tbody>
                                    </table>

                                </div>

@else
                                <br><br>
                                <div class="text-center">
                                    <img src="{{asset('frontend/assets/img/fratreslogofinal.png')}}">
                                    <div class="topactive-recru-post">
                                        <p>You have no Team Created</p>
                                        <a href="{{url('recruiter/team/add')}}" class="btn btn-primary">
                                            Add Team Member
                                        </a>
                                    </div>
                                </div>

@endif


                        </div>




                    </div>



                </div>
            </div>


        </div><!--END-->
    </div>
    </div>

@endsection

