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