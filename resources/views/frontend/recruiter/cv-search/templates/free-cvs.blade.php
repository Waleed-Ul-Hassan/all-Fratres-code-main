<style>
    .ul-seeker-profiles li{
        list-style-type: none;
        width: 48%;
        display: inline-block;
    }
</style>
<div class="col-md-5 bg-grey mt-mob">
    <p class="mt-3"><small class="color-grey"><span class="c-resumes">{{$total_seekers}}</span> resumes</small> <i class="fas fa-spinner fa-spin ml-5 d-none" style="font-size:24px"></i> </p>
    <hr>
    <div class="row pt-20 records-attach">
        @foreach($seekers as $seeker)
            <div class="col-sm-12 margin-bottom-10">
                <p><b>{{$seeker->first_name}}</b></p>
                @if(!empty($seeker->current_job_title)) <p>{{$seeker->current_job_title}} @if(!empty($seeker->current_company)) - {{$seeker->current_company}} @endif</p> @endif
                @foreach($seeker->experience as $exp)
                    <p><small>{{$exp->job_title}} - {{$exp->company}}</small></p>
                @endforeach
                <p><small class="color-grey">Updated: {{$seeker->updated_at->format("M d Y")}}</small></p>
                <hr>
            </div>
        @endforeach
        <div class="col-md-12">
            {{$seekers->withPath('cv-search')->appends($querystringArray)->links()}}
        </div>
    </div>
</div>

<div class="col-md-3 mb-5">

    <div class="card bg-light position-sticky">
        <div class="card-body">
            <h6 class="card-title"><b>BUY CVs</b><small class="color-grey margin-left-20">({{$settings->symbol}}{{$settings->recruiter_cv_purchase_price}} for {{$settings->recruiter_cv_purchase_days}} days)</small></h6>
            <hr>

            <p class="card-text">
                Purchase Pacakage to access unlimited CVs for {{$settings->recruiter_cv_purchase_days}} days in just {{$settings->symbol}}{{$settings->recruiter_cv_purchase_price}} + {{$settings->tax_unit}}.
            <hr>
            <a href="#" class="btn btn-primary btn-block btn-padding" data-toggle="modal" data-target="#exampleModalCenter">BUY NOW</a>
            </p>


        </div>
    </div>



</div>