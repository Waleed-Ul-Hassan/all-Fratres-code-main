@extends('frontend.layouts.main')


@section('meta_info')
    @php
        $seo = new stdClass();
        $seo->meta_description = $company->description;
        $seo->meta_key = $company->company_name;
        $seo->meta_title = $company->company_name;
        $seo->page_title = $company->company_name;
    @endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection

@section('content')

    <style>
        .media-body h5, .media-body p{
            font-size:13px;
        }
    </style>

    <link rel="stylesheet" href="{{asset('frontend/rating/star-rating-svg.css')}}">
    <script src="{{asset('frontend/rating/jquery.star-rating-svg.js')}}"></script>
    <div class="container">

        <div class="row mt-5 mb-5">

            <div class="jumbotron width-100">
                <div class="row">

                    <div class="col-md-8">
                        <div class="media">
                            <div class="ur-thumb">
                                <img class="mr-3 img-company" src="{{asset('recruiters/profile/'.getDomainRoot().'square_'.$company->company_logo)}}" alt="company-logo">
                            </div>
                            <div class="media-body">
                                <div class="center">
                                    <h5 class="mt-0">{{$company->company_name}}</h5>
                                    <i class="fas fa-map-marker-alt"></i> {{$company->cities->name ?? 'N/A'}} , {{$company->get_industry->name  ?? 'N/A'}}
                                    <div class="rateing" data-toggle="modal" data-target="#exampleModalCenter">
                                        <div class="my-rating jq-stars"></div>
                                        <p>{{$ratings_count}} Reviews</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="mailto:{{$company->email}}" class="btn btn-primary float-right">GET IN TOUCH</a>
                        <a href="mailto:{{$company->email}}" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter">WRITE REVIEW</a>
                    </div>

                </div>


            </div>

            <div class="col-md-4 pad-left-0">
                <div class="card shadow-box" >
                    <div class="card-body">
                        <h5 class="card-title">Company Overview</h5>
                        <h4>&nbsp;</h4>
                        <ul class="company-sidebar">
                            @if($company->company_url != '')
                            <li>
                                <div>
                                    <i class="fas fa-pencil-alt"></i> Company Website
                                    <small><a href="#" onclick="window.open('{{exturl($company->company_url)}}',  '_blank')" >{{$company->company_url}}</a></small>
                                </div>
                            </li>
                            @endif
                            <li>
                                <div>
                                    <i class="fas fa-users"></i>
                                    Employees
                                    <small>{{$company->company_size ?? 'N/A'}}</small>
                                </div>

                            </li>
                            <li>
                                <div>
                                    <i class="fas fa-at"></i> Email
                                    <small>{{$company->email ?? 'N/A'}}</small>
                                </div>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">

                <div class="row ">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bleft">
                                <li class="breadcrumb-item bread-crumb-font" aria-current="page">Active Jobs ({{count($jobs)}})</li>
                            </ol>
                        </nav>
                    </div>
                        @foreach($jobs as $job)
                        <div class="col-md-6" style="margin-bottom: 10px">
                            <div class="media media-bordered">
                                <img class="align-self-start mr-3" src="{{asset('recruiters/profile/'.getDomainRoot().$job->recruiter->company_logo)}}" alt="image" style="width:100px;max-height: 100px;">
                                <div class="media-body">
                                    <a href="{{url('job/'.$job->slug)}}"><h5 class="mt-0">{{$job->title}}</h5></a>
                                    <p> <i class="fas fa-map-marker-alt"></i> {{$job->get_city->name ?? 'N/A'}} - {{$job->get_industry->name ?? 'N/A'}} </p>

                                </div>
                            </div>
                        </div>
                        @endforeach


                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bleft">
                                <li class="breadcrumb-item bread-crumb-font" aria-current="page">About Company</li>
                            </ol>
                        </nav>
                        <p>
                            {!! $company->company_description !!}
                        </p>
                    </div>
                </div>

                {{--<div class="row mt-5">--}}
                    {{--<div class="col-md-12">--}}
                        {{--<nav aria-label="breadcrumb ">--}}
                            {{--<ol class="breadcrumb bleft">--}}
                                {{--<li class="breadcrumb-item bread-crumb-font" aria-current="page">Reviews</li>--}}
                            {{--</ol>--}}
                        {{--</nav>--}}
                        {{--<p>--}}
                            {{--asdasdasd--}}
                        {{--</p>--}}
                    {{--</div>--}}
                {{--</div>--}}





            </div>

        </div>

    </div>

     <!-- Modal -->
     <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">Review For : <span class="company_name">{{$company->company_name}}</span></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="mt-3" action="{{url('company/save_rating')}}" id="form_save_rating">
                        @csrf
                        <input type="hidden" name="rating" class="rating">
                        <input type="hidden" name="company_id" class="company_id" value="{{$company->id}}">
                        <div class="form-group">
                            <label for="company_name">Rate Company</label>
                            <p></p>
                            <div class="my-rating-assign jq-stars"></div>
                        </div>
                        <div class="form-group">
                            <label for="company_name">Employee Type</label>
                            <select name="employee_type" class="form-control" id="">
                                <option value="current">Current Employee</option>
                                <option value="former">Former Employee</option>
                                <option value="applicant">Job Applicant</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="company_name">Comments</label>
                            <textarea name="comments" class="form-control" id="" cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="print-error-msg col-md-10" style="display:none;padding-left: 0px">
                                <ul class=" errors"></ul>
                            </div>
                            <div class="print-success col-md-10" style="display:none;padding-left: 0px">
                                <p class="success-para"></p>
                            </div>
                        </div>


                        <button type="button" class="btn btn-primary submit-rating">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>

        $(".my-rating").starRating({
            initialRating: {{$rating_total}},
            strokeColor: '#ff8a00',
            starShape: 'rounded',
            strokeWidth: 10,
            starSize: 25,
            readOnly: true,
        });

        $(".my-rating-assign").starRating({
            initialRating: 0,
            strokeColor: '#ff8a00',
            starShape: 'rounded',
            strokeWidth: 10,
            starSize: 25,
            callback: function(currentRating, $el){
                // make a server call here
                $(".rating").val(currentRating);
            }
        });


        $(document).on("click", ".submit-rating", function () {

        var form = $('#form_save_rating')[0];
        $.ajax({
            url: "/company/save_rating",
            type:'POST',
            data: new FormData(form),
            processData: false,
            contentType:false,
            success: function(data) {

                if($.isEmptyObject(data.error)){

                    $(".print-error-msg").css('display','none');
                    $(".print-success").css('display','block');
                    $(".success-para").html(data.success);

                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);


                }else{
                    console.log(data);
                    printErrorMsg(data.error);
                }
            }
        });

        });


        function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-success").css('display','none');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
        }

    </script>
@endsection
