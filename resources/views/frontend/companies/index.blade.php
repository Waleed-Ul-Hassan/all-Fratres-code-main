@extends('frontend.layouts.main')

@section('meta_info')
    @php $seo = \App\Seo::where('page_key','companies')->first();@endphp

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

    <div class="container mb-5 mt-5">

        <div class="row">

            <div class="col-md-12">
                <h4>Companies List</h4>
                <hr>
            </div>

            @foreach($recruiters as $recruiter)
            @php
            if($recruiter->company_slug == null){
                $recruiter->company_slug = $recruiter->createSlug($recruiter->company_name, $recruiter->cname, $recruiter->id);
                $recruiter->save();
            }
            $slug = $recruiter->company_slug; @endphp
            @php //$slug = $recruiter->cname.'-'.strtolower(str_slug($recruiter->company_name)) @endphp
            <div class="col-md-4" style="margin-bottom: 20px;">

                <div class="media media-bordered">
                    <img class="align-self-start mr-3" src="{{asset('recruiters/profile/square_'.$recruiter->company_logo)}}" alt="image" style="max-width:80px;max-height: 80px;">
                    <div class="media-body">
                        <h5 class="mt-0">{{$recruiter->company_name}}</h5>
                        <p> <i class="fas fa-map-marker-alt"></i> {{$recruiter->cname ?? 'N/A'}} - {{$recruiter->iname ?? 'N/A'}} </p>
                        <p><i class="fas fa-tasks"></i> ({{$recruiter->Activejobs->count() ?? 0}} - Active jobs)</p>
                        <p class="companies-links">
                            <a href="{{url('company/'.$slug)}}" class="card-link">Company Profile</a>
                            <a href="#" class="card-link add-reviews" data-recruiterid="{{$recruiter->id}}" data-recruitername="{{$recruiter->company_name}}" data-toggle="modal" data-target="#exampleModalCenter">Add Reviews</a>
                        </p>

                        {{--<p class="companies-links">--}}
                            {{--<a href="#" class="card-link no-margin-left">Read Reviews</a>--}}
                        {{--</p>--}}

                    </div>
                </div>

            </div>



            @endforeach


        </div>

    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">Review For : <span class="company_name"></span></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="mt-3" action="{{url('company/save_rating')}}" id="form_save_rating">
                        @csrf
                        <input type="hidden" name="rating" class="rating">
                        <input type="hidden" name="company_id" class="company_id" >
                        <div class="form-group">
                            <label for="company_name">Rate Company</label>
                            <p></p>
                            <div class="my-rating jq-stars"></div>
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
            initialRating: 0,
            starShape: 'rounded',
            strokeColor: '#894A00',
            strokeWidth: 10,
            starSize: 25,
            callback: function(currentRating, $el){
                // make a server call here
                $(".rating").val(currentRating);
            }
        });

        $(document).on("click", ".add-reviews", function () {

            var recruiter_id = $(this).attr("data-recruiterid");
            var recruiter_name = $(this).attr("data-recruitername");
            $(".company_id").val(recruiter_id);
            $(".company_name").html(recruiter_name);

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
