<div class="recru-dash-item1">
    <div class="recu-dash-logo">
        @if(Auth::guard('recruiter')->user()->company_logo == '')
        <img src="{{asset('frontend/assets/img/fratreslogofinal.png')}}" class="img-fluid">
        @else
        <img src="{{url('recruiters/profile/'.Auth::guard('recruiter')->user()->company_logo)}}" class="img-fluid img-thumbnail logo_sidebar" >
        @endif
    </div>
    <div class="recu-dash-list recur-hold-content">
        <h3>Your postings</h3>
        <ul class="recruiter_sidebar_active">
            <li class="">
                <a href="{{url('recruiter/dashboard')}}">Dashboard</a>
            </li>
            <li class="">
                <a href="{{url('recruiter/job_post')}}">post your jobs</a>
            </li>

            <li>
                <a href="{{url('recruiter/manage-jobs')}}">manage your jobs <span class="color_text">({{App\Job::where('job_status', '!=', 'deleted')->where('recruiter_id', recruiter_logged('id'))->count()}})</span></a>
            </li>

            <li>
                <a href="{{url('recruiter/buy-credits')}}">
                    buy job credits <span class="color_text">({{recruiter_logged('job_credits') ?? 0}})</span></a>
            </li>
        </ul>
    </div>
    {{--<div class="recu-dash-list">--}}
        {{--<h3>Manage Team </h3>--}}
        {{--<ul class="recruiter_sidebar_active">--}}
            {{--<li>--}}
                {{--<a href="{{url('recruiter/team')}}">Manage Team</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</div>--}}
    <div class="recu-dash-list">
        <h3>CV search</h3>
        <ul class="recruiter_sidebar_active">
            <li>
                <a href="{{url('recruiter/cv-search')}}">CV search </a>
            </li>
        </ul>
    </div>

    <div class="recu-dash-list">
        <h3>Your Account</h3>
        <ul class="recruiter_sidebar_active">
            <li>
                <a href="{{url('recruiter/profile')}}">account information</a>
            </li>
            <li>
                <a href="{{url('recruiter/billing')}}">billing information</a>
            </li>
            <li>
                <a href="{{url('recruiter/invoices')}}">your invoices <span class="color_text">({{App\Order::where('recruiter_id', recruiter_logged('id'))->count()}})</span></a>
            </li>
        </ul>
    </div>
    <div class="recu-dash-list">
        <h3>more info</h3>
        <ul>
            <li>
                <a href="{{url('recruiter/contact')}}">contact us</a>
            </li>
        </ul>
    </div>
</div>

<script>
    $(".recruiter_sidebar_active>li>a").each(function () {
        var this_url = $(this).attr('href');
        var opened_url = window.location.href;
        if(this_url == opened_url){
            $(this).parents('li').addClass('active');
            console.log(this_url);
        }
    })
</script>