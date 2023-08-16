@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','cv_search_index')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('style')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>

@endsection
@section('content')

    <style>
        .recru-dash-headv1{
            /*width:15.7%;*/
        }
    </style>

    <div class="recruiter-main-dashboard">
        <div class="recru-dash-head">
            {{--<div class="recru-dash-headv1">--}}
                {{--<p>bottom</p>--}}
            {{--</div>--}}

            @include('frontend.recruiter.partials.sidebar')

            <div class="recru-dash-item2 ">
                <br>
                <div class="row col-md-12 col-mob-pad">

                    <div class="col-12 d-md-none d-sm-none d-xs-block pr-0">
                        <i class="fas fa-bars fa-2x float-right clearfix" style="color:#ff8a00;" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"></i>
                    </div>

                    <div class="collapse d-md-none d-sm-block width-100" id="collapseExample">
                        <form method="get" id="searchform">
                            <div class="col-md-12 clearfix" style="margin-bottom: 30px;padding-right: 0px; margin-top: 20px;">


                                <label class="sr-only" for="">Name</label>
                                <input type="text" class="form-control search-bar" name="q" placeholder="Jane Doe" value="@isset($_GET['q']){{$_GET['q']}}@endisset">

                                <button type="button" class="btn btn-primary searchbtn " style="border-radius:0px;height:40px;"><i class="fas fa-search"></i></button>

                            </div>



                            <div class="col-md-12 mt-3">


                                <div class="mt-4">
                                    <h4 class="sidebar-label">Years of Work Experience </h4>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input" name="exp_years[]" value="3-5" >
                                        <label class="custom-control-label c-label" >3-5 years</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input"  value="6-10" name="exp_years[]">
                                        <label class="custom-control-label c-label" >6-10 years</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input"  value="1-2" name="exp_years[]">
                                        <label class="custom-control-label c-label" >1-2 years</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input" value="10-20" name="exp_years[]">
                                        <label class="custom-control-label c-label" >More than 10 years</label>
                                    </div>

                                </div>

                                <div class="mt-4">
                                    <h4 class="sidebar-label">Career Level </h4>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input" name="career_level[]" value="Entry Level" >
                                        <label class="custom-control-label c-label" >Entry Level</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input"  value="Intermediate" name="career_level[]">
                                        <label class="custom-control-label c-label" >Intermediate</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input"  value="Experienced" name="career_level[]">
                                        <label class="custom-control-label c-label" >Experienced Professional</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input" value="Department Head" name="career_level[]">
                                        <label class="custom-control-label c-label" >Department Head</label>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <h4 class="sidebar-label">Industry</h4>
                                    @foreach($industries as $industry)
                                        <div class="custom-control custom-checkbox mt-2">
                                            <input type="checkbox" class="custom-control-input" name="industry_name[]" value="{{$industry->id}}" >
                                            <label class="custom-control-label c-label" >{{$industry->name}}</label>
                                        </div>
                                    @endforeach

                                </div>

                            </div>
                        </form>
                    </div>
                    <form method="get" class="d-none d-md-block mr-1" id="searchformD">
                        <div class="col-md-12 mb-3 clearfix" >


                            <label class="sr-only" for="inlineFormInputName2">Name</label>
                            <input type="text" class="form-control  search-bar" name="q" placeholder="Jane Doe" value="@isset($_GET['q']){{$_GET['q']}}@endisset">

                            <button type="button" class="btn btn-primary searchbtn " style="border-radius:0px;height:40px;"><i class="fas fa-search"></i></button>

                        </div>



                        <div class="col-md-12 mt-3">


                            <div class="mt-4">
                                <h4 class="sidebar-label">Years of Work Experience </h4>
                                <div class="custom-control custom-checkbox mt-2">
                                    <input type="checkbox" class="custom-control-input" name="exp_years[]" value="3-5" id="y-1" @if(request('exp_years') && in_array('3-5',request('exp_years'))) checked @endif>
                                    <label class="custom-control-label c-label" for="y-1">3-5 years</label>
                                </div>
                                <div class="custom-control custom-checkbox mt-2">
                                    <input type="checkbox" class="custom-control-input" id="y-2" value="6-10" name="exp_years[]" @if(request('exp_years') && in_array('6-10',request('exp_years'))) checked @endif>
                                    <label class="custom-control-label c-label" for="y-2">6-10 years</label>
                                </div>
                                <div class="custom-control custom-checkbox mt-2">
                                    <input type="checkbox" class="custom-control-input" id="y-3" value="1-2" name="exp_years[]" @if(request('exp_years') && in_array('1-2',request('exp_years'))) checked @endif>
                                    <label class="custom-control-label c-label" for="y-3">1-2 years</label>
                                </div>
                                <div class="custom-control custom-checkbox mt-2">
                                    <input type="checkbox" class="custom-control-input" id="y-4" value="10-20" name="exp_years[]" @if(request('exp_years') && in_array('10-20',request('exp_years'))) checked @endif>
                                    <label class="custom-control-label c-label" for="y-4">More than 10 years</label>
                                </div>

                            </div>

                            <div class="mt-4">
                                <h4 class="sidebar-label">Career Level </h4>
                                <div class="custom-control custom-checkbox mt-2">
                                    <input type="checkbox" class="custom-control-input" name="career_level[]" value="Entry Level" id="cl-1" @if(request('career_level') && in_array('Entry Level',request('career_level'))) checked @endif>
                                    <label class="custom-control-label c-label" for="cl-1">Entry Level</label>
                                </div>
                                <div class="custom-control custom-checkbox mt-2">
                                    <input type="checkbox" class="custom-control-input" id="cl-2" value="Intermediate" name="career_level[]" @if(request('career_level') && in_array('Intermediate',request('career_level'))) checked @endif>
                                    <label class="custom-control-label c-label" for="cl-2">Intermediate</label>
                                </div>
                                <div class="custom-control custom-checkbox mt-2">
                                    <input type="checkbox" class="custom-control-input" id="cl-3" value="Experienced" name="career_level[]" @if(request('career_level') && in_array('Experienced',request('career_level'))) checked @endif>
                                    <label class="custom-control-label c-label" for="cl-3">Experienced Professional</label>
                                </div>
                                <div class="custom-control custom-checkbox mt-2">
                                    <input type="checkbox" class="custom-control-input" id="cl-4" value="Department Head" name="career_level[]" @if(request('career_level') && in_array('Department Head',request('career_level'))) checked @endif>
                                    <label class="custom-control-label c-label" for="cl-4">Department Head</label>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h4 class="sidebar-label">Industry</h4>
                                @foreach($industries as $industry)
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input" name="industry_name[]" value="{{$industry->id}}" id="ind-{{$industry->id}}" @if(request('industry_name') && in_array($industry->id,request('industry_name'))) checked @endif>
                                        <label class="custom-control-label c-label" for="ind-{{$industry->id}}">{{$industry->name}}</label>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </form>


                    @if(recruiter_logged('cv_purchased_validity') != null)
                        @include('frontend.recruiter.cv-search.templates.paid-cvs')
                    @else
                        @include('frontend.recruiter.cv-search.templates.free-cvs')
                    @endif





                </div>


            </div>



        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <br>

                    <div class="row">

                        <div class="col-md-6">

                            <h4 class="borderd-under mb-5"> <span class="color_text"><i class="fas fa-credit-card"></i>&nbsp;&nbsp;</span> Card Information</h4>
                            <form action="{{url('recruiter/purchase-cvs')}}" method="post" id="form_save_job" role="form">
                                @csrf

                                <div class="form-group row">
                                    <label for="card_name" class="col-sm-4">
                                        Full name <span class="star">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control wizard-required" id="card_name" name="card_holder_name" value="{{old('card_holder_name')}}">

                                        @if ($errors->has('card_holder_name'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('card_holder_name')[0]}}
                                            </div>
                                        @endif
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label for="card_number" class="col-sm-4">
                                        Card # <span class="star">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control wizard-required" id="card_number" name="card_holder_number" value="{{old('card_holder_number')}}">

                                        @if ($errors->has('card_holder_number'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('card_holder_number')[0]}}
                                            </div>
                                        @endif
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="expiry" class="col-sm-4">
                                        Expiry <span class="star">*</span></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control wizard-required" id="expiry" placeholder="MM" name="card_expiry_month" maxlength="2" value="{{old('card_expiry_month')}}">
                                    </div>
                                    <span class="recru-monthdate">/</span>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control wizard-required" id="Expiration" name="card_expiry_year" maxlength="4" value="{{old('card_expiry_year')}}" placeholder="YYYY">
                                    </div>




                                </div>

                                <div class="form-group row">
                                    <label for="cvc" class="col-sm-4">
                                        CVC : <span class="star">*</span></label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control wizard-required" id="cvc" name="card_cvc" maxlength="4" value="{{old('card_cvc')}}" placeholder="123">
                                    </div>




                                </div>




                                <div class="form-group row clearfix">
                                    <label for="location" class="col-sm-4 "></label>
                                    <div class="col-sm-7">
                                        <button type="button" class="btn btn-primary purchase_now_button">BUY NOW  </button>
                                    </div>
                                </div>
                            </form>


                            <div class="print-error-msg col-md-10" style="display:none;padding-left: 0px">
                                <ul class=" errors"></ul>
                            </div>
                            <div class="print-success-msg col-md-12" style="display:none;padding-left: 0px">
                                <p class="success-para"></p>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="borderd-line " style="margin-right:5px;"></div>

                            <h4 class="borderd-under mb-3"><span class="color_text"><i class="fas fa-shopping-cart"></i>&nbsp;&nbsp;</span> Order Details</h4>


                            <caption><b>Pricing</b></caption>
                            <table class="table table-sm table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <td>Package Price</td>
                                    <td class="text-right">{{$settings->symbol}}{{$settings->recruiter_cv_purchase_price}}</td>
                                </tr>

                                <tr>
                                    <td>VAT</td>
                                    <td class="text-right "><small>({{$settings->tax}}%)</small> {{$settings->symbol}}{{$getTax}} </td>
                                </tr>

                                <tr >
                                    <th ></th>
                                    <th class="text-right font-16">Total : {{$settings->symbol}}{{$total}}</th>
                                </tr>
                                </tbody>
                            </table>
                            <br>
                            <caption><b>Validity will Remain - {{$settings->recruiter_cv_purchase_days}} Days</b></caption>
                            <table class="table table-bordered table-sm ">
                                <thead>
                                <tr>
                                    <th>FROM</th>
                                    <th>TO</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{date("D, d M-Y")}}</td>
                                    <td>{{date("D, d M-Y", strtotime("+".$settings->recruiter_cv_purchase_days." days"))}}</td>
                                </tr>

                                </tbody>
                            </table>


                        </div>

                    </div>


                </div>

            </div>
        </div>
    </div>

    <br>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"></script>
    <script>

        $(document).on("click", "#searchformD input[type=checkbox], .searchbtn", function(){

            var form = $('#searchformD').serialize();
            $(".fa-spinner").removeClass("d-none");
            $.ajax({
                url: "/recruiter/search/cvs",
                type:'GET',
                data: form,
                // processData: false,
                // contentType:false,
                success: function(data) {

                    $(".records-attach").html(data.seekers);
                    $(".c-resumes").html(data.total)
                    $(".fa-spinner").addClass("d-none");
                    window.history.pushState('?page2', 'Title', '?'+form);

                },
                error:function(data){
                    console.log(data);

                }
            });

        });

        $(document).on("click", "#searchform input[type=checkbox], .searchbtn", function(){

            var form = $('#searchform').serialize();
            $(".fa-spinner").removeClass("d-none");
            $.ajax({
                url: "/recruiter/search/cvs",
                type:'GET',
                data: form,
                // processData: false,
                // contentType:false,
                success: function(data) {

                    $(".records-attach").html(data.seekers);
                    $(".c-resumes").html(data.total)
                    $(".fa-spinner").addClass("d-none");
                    window.history.pushState('?page2', 'Title', '?'+form);

                },
                error:function(data){
                    console.log(data);

                }
            });

        });




        $(document).on("change","#choose_skills_app", function () {

            var skill = $(this).val();
            var url = '';
            if( skill != '' ){

                @if(isset($_GET['q']))
                    url = "?q={{$_GET['q']}}&skill="+skill;
                @else
                    url = "?skill="+skill;
                @endif

                window.location.href = '{{url("/recruiter/cv-search")}}'+url;
                // alert(url);
            }
        });

        $(document).on("click",".purchase_now_button", function () {

            var button =  $(this);
            button.html("BUY NOW <i class=\"fas fa-spinner fa-spin\" aria-hidden=\"true\"></i>");
            var form = $('#form_save_job')[0];

            $.ajax({
                url: "/recruiter/purchase-cvs",
                type:'POST',
                data: new FormData(form),
                processData: false,
                contentType:false,
                success: function(data) {

                    if($.isEmptyObject(data.error)){

                        $(".print-error-msg").css('display','none');
                        $(".print-success-msg").css('display','block');
                        $(".success-para").html(data.success);

                        setTimeout(function () {

                            window.location.href = '{{url("recruiter/invoices")}}';

                        },3000);

                    }else{
                        console.log(data);
                        printErrorMsg(data.error);
                        button.html("BUY NOW");

                    }
                },
                error:function(data){
                    console.log(data);
                    button.html("BUY NOW");
                }
            });

        });


        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-success-msg").css('display','none');
            $(".print-error-msg").css('display','block');
            if( Array.isArray(msg) ){
                $.each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
            }else{
                $(".print-error-msg").find("ul").append('<li>'+msg+'</li>');
            }
        }

        @if(recruiter_logged('cv_purchased_validity') != null)

            const cd = new Date().getFullYear() + 1
            $('[data-countdown]').each(function() {
                var $this = $(this), finalDate = $(this).data('countdown');
                $this.countdown(finalDate, function(event) {
                    $this.html(event.strftime('%D days %H:%M:%S Remaining'));
                });
            });

        @else


        @endif



    </script>
@endsection