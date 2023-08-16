<div class="col-md-5 bg-grey">

    <p class="mt-3"><small class="color-grey"><span class="c-resumes">{{$total_seekers}}</span> resumes</small> <i class="fas fa-spinner fa-spin ml-5 d-none" style="font-size:24px"></i> </p>
    <hr>
    <div class="row pt-20 records-attach">
        @foreach($seekers as $seeker)
            <div class="col-sm-12 margin-bottom-10">
                <p><b>{{$seeker->first_name}}</b></p>
                @if(!empty($seeker->current_job_title)) <p>{{$seeker->current_job_title}} @if(!empty($seeker->current_company)) - {{$seeker->current_company}} @endif</p> @endif
                <p><small>Email : {{$seeker->email}}</small></p>
                <p> @if( show_phone($seeker->phone,'phone') != '' )
                    <small>Contact : {{show_phone($seeker->phone,'phone')}}</small>
                @endif
                @if( show_phone($seeker->phone,'phone_optional') != '' )
                   - <small>{{show_phone($seeker->phone,'phone_optional')}}</small>
                @endif </p>

                @foreach($seeker->experience as $exp)
                    <p><small>{{$exp->job_title}} - {{$exp->company}}</small></p>
                @endforeach
                <p><small class="color-grey">Updated: {{$seeker->updated_at->format("M d Y")}}</small></p>
                <hr>
                @if($seeker->cv_resume != null)
                    <a href="{{url('/recruiter/download_cvs/'.encrypt($seeker->id).'/0')}}" class="btn btn-info btn-xs" target="_blank" ><span><i class="fas fa-download" style="color:#fff;"></i></span> Download Uploaded CV</a>
                @endif
                @if($seeker->profile_complete > 80)
                    <a href="{{url('/recruiter/download_cvs/'.encrypt($seeker->id).'/1')}}" target="_blank" class="btn btn-success btn-xs" ><span><i class="fas fa-download" style="color:#fff;"></i></span> Download Fratres CV</a>
                @endif
                <hr>
            </div>

        @endforeach
        <div class="col-md-12">
            {{$seekers->withPath('cv-search')->appends($querystringArray)->links()}}
        </div>
    </div>


</div>

<div class="col-md-3">

    <div class="card card-green card-green-bg position-sticky">
        <div class="card-body">
            <h6 class="card-title"><b>Explore All CVs</b></h6>
            <hr>

            <p class="card-text">
                <b>Expiry : </b> {{date("D, d M-Y", strtotime(recruiter_logged('cv_purchased_validity')))}}
            </p>
            <p class="card-text">
                <b>Total Downloads : </b> {{App\RecruiterDownload::where('order_id',$order->id)->count()}}
            </p>
            <p class="card-text">
                <b>Downloads Today: </b> {{App\Recruiter::todays_downloads($order->id)}} / {{$settings->daily_limit_cv_download}}
            </p>

            <hr>
            <p class="card-text">
                <span id="countdown" data-countdown="{{date('Y/m/d', strtotime(recruiter_logged('cv_purchased_validity')))}}">
                </span>
            </p>



        </div>
    </div>



</div>

