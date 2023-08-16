@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','recruiter_profile_index')->first();@endphp

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
        .select2-container--default .select2-selection--single{
            background: #fff !important;
            background-color: #fff !important;
        }
        .errors-displaying{
            position: absolute;
            right: 20px;
            top: 120px;
            width: 30%;
        }

    </style>

    <link rel="stylesheet" href="{{asset('frontend/assets/plugins/dropify/css/dropify.min.css')}}">
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
                <h3>Update Profile</h3>
            </div>
        </div>
        <div class="recru-dash-item2-v1-list">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item ">
                    <a class="nav-link @if($tab=='' || $tab=='a') active @endif recruiter-tab" id="pills-personal-details-tab" data-toggle="pill" href="#pills-personal-details" role="tab" aria-controls="pills-active" data-tab="a" aria-selected="true">Personal details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($tab=='b') active @endif recruiter-tab" id="pills-company-details-tab" data-toggle="pill" href="#pills-company-details" role="tab" aria-controls="pills-suspended" data-tab="b" aria-selected="false">Company details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($tab=='c') active @endif recruiter-tab" data-tab="c" id="pills-email-tab" data-toggle="pill" href="#pills-email" role="tab" aria-controls="pills-expired" aria-selected="false">Email & Password</a>
                </li>


            </ul>
        </div>
        <div class="recur-item2-maincontent">

            {{--tabs here--}}
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade  @if($tab=='' || $tab=='a') show active @endif" id="pills-personal-details" role="tabpanel" aria-labelledby="pills-personal-details-tab">


                    <form action="{{url('recruiter/update')}}" method="post">
                        @csrf
                        <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="CompanyName" class="col-sm-3">
                                        Your Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="creator_name" class="form-control wizard-required"  id="fname" value="{{recruiter_logged('creator_name')}}" placeholder="john" required>
                                    </div>
                                    <div class="wizard-form-error"></div>
                                </div>

                                <div class="form-group row">
                                    <label for="CompanyName" class="col-sm-3">
                                        Your position</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control wizard-required"  id="Email" value="{{recruiter_logged('creator_position')}}" placeholder="HR Manager" name="creator_position" required>
                                    </div>
                                    <div class="wizard-form-error"></div>
                                </div>
                                <div class="form-group row">
                                    <label for="company_description" class="col-sm-3">
                                        Company Description</label>
                                    <div class="col-sm-9">
                                        <textarea name="company_description" class="" id="company_descriptions" cols="30" rows="10" >{{recruiter_logged('company_description')}}</textarea>

                                    </div>
                                    <div class="wizard-form-error"></div>
                                </div>
                                <div class="form-group clearfix">

                                    <div class="offset-md-3 col-sm-9 pl-6">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    </form>
                </div>
                <div class="tab-pane fade @if($tab=='b') show active @endif" id="pills-company-details" role="tabpanel" aria-labelledby="pills-company-details-tab">
                    <form action="{{url('recruiter/update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="container-fluid">
                        <div class="row">


                            <div class="col-lg-10">

                                <div class="form-group row">
                                   <div class="col">
                                       <label for="company_name" class="col-sm-5">
                                           Company Name <span class="star">*</span></label>
                                       <div class="col-sm-9">
                                           <input type="text" class="form-control wizard-required"  id="company_name" value="{{recruiter_logged('company_name')}}" name="company_name" placeholder="ie. Fratres">
                                       </div>
                                   </div>

                                    <div class="col">
                                        <label for="company_url" class="col-sm-5">
                                            Company URL <span class="star">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control wizard-required"  id="company_url" value="{{recruiter_logged('company_url')}}" name="company_url" placeholder="ie. https://fratres.net">
                                        </div>
                                    </div>
                                    <div class="wizard-form-error"></div>

                                </div>

                                <div class="form-group row">
                                   <div class="col">
                                       <label for="company_size" class="col-sm-5">Company Size <span class="star">*</span></label>
                                       <div class="col-sm-9">
                                           <select name="company_size" id="company_size" class="form-control" required>
                                               <option value="">Company Size</option>

                                               <option value="10" @if(Auth::guard('recruiter')->user()->company_size==10) selected @endif>Less than 10</option>
                                               <option value="20" @if(Auth::guard('recruiter')->user()->company_size==20) selected @endif>Less than 20</option>
                                               <option value="50" @if(Auth::guard('recruiter')->user()->company_size==50) selected @endif>Less than 50</option>
                                               <option value="200" @if(Auth::guard('recruiter')->user()->company_size==200) selected @endif>Less than 200</option>
                                               <option value="300" @if(Auth::guard('recruiter')->user()->company_size==300) selected @endif>Less than 300</option>
                                               <option value="500" @if(Auth::guard('recruiter')->user()->company_size==500) selected @endif>500+</option>
                                           </select>
                                       </div>
                                   </div>

                                    <div class="col">
                                        <label for="industry" class="col-sm-12">
                                            Company Industry <span class="star">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="industry" id="industry" class="selectpicker width-100" required style="width:100%;">
                                                <option value="">Please Choose Industry</option>
                                                @foreach($industries as $industry)
                                                    <option value="{{$industry->id}}" @if(recruiter_logged('industry') == $industry->id) selected @endif>{{$industry->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="wizard-form-error"></div>

                                </div>

                                <div class="form-group row">
                                   <div class="col">
                                       <label for="city" class="col-sm-5">Company Location <span class="star">*</span></label>
                                       <div class="col-sm-9 custom-wdith-selectpicker">
                                           <select name="city" id="city" class="selectpicker" required style="width:100%;">
                                               <option value="">Company Location</option>
                                               @foreach($cities as $city)
                                                   <option value="{{$city->id}}" @if(recruiter_logged('city') == $city->id) selected @endif>{{$city->name}}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                   </div>

                                    <div class="col">
                                        <label for="phone" class="col-sm-5">
                                            Company Phone <span class="star">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="tel" name="phone" placeholder="12345678" class="form-control" value="{{recruiter_logged('phone')}}">
                                        </div>
                                    </div>
                                    <div class="wizard-form-error"></div>

                                </div>

                                <div class="form-group row">
                                    <div class="col">
                                        <div class="col-sm-4">
                                            <input type="file" name="company_logo" id="input-file-now" class="dropify" data-allowed-file-extensions="png psd jpg jpeg JPEG PNG PNG" data-default-file="{{asset('/recruiters/profile/'.getDomainRoot().recruiter_logged('company_logo'))}}" />
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group clearfix">

                                    <div class="offset-md-3 col-sm-9 pl-6">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    </form>

                </div>
                <div class="tab-pane fade @if($tab=='c') show active @endif" id="pills-email" role="tabpanel" aria-labelledby="pills-email-tab">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">


                                <div class="form-group row">
                                    <label for="CompanyName" class="col-sm-4">
                                        Your current email</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control wizard-required emailinfo-read-hold"  id="Yourcurrentemail" value="{{recruiter_logged('email')}}" readonly>
                                    </div>
                                    <div class="wizard-form-error"></div>
                                </div>

                            <form action="{{url('recruiter/update')}}" method="post">
                                @csrf
                                <h4 class="heading-form-recruiter"><span>Change your password</span></h4>
                                <div class="form-group row">
                                    <label for="Cpassword" class="col-sm-4">
                                        Current password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="current_password" class="form-control wizard-required"  id="Cpassword" value="" >
                                    </div>
                                    <div class="wizard-form-error"></div>
                                </div>
                                <div class="form-group row">
                                    <label for="Newpassword" class="col-sm-4">
                                        New password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password" class="form-control wizard-required"  id="Newpassword" value="" required>
                                    </div>
                                    <div class="wizard-form-error"></div>
                                </div>

                                <div class="form-group row">
                                    <label for="Retypenewpassword" class="col-sm-4">
                                        Retype new password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password_confirmation" class="form-control wizard-required"  id="Retypenewpassword" value="" required>

                                        @foreach ($errors->all() as $message)
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$message}}
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="wizard-form-error"></div>

                                </div>



                                <div class="form-group clearfix">
                                    <div class="offset-md-4 col-md-8 pl-6">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                    </div>
                            </form>

                                </div>
                            </div>

                        </div>


                    </div>

                </div>


            </div>
            {{--tabs ENDS here--}}

            <div class="errors-displaying">

            </div>


        </div>
    </div>

        </div><!--END-->
    </div>
    </div>
@endsection


@section('scripts')
    <script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/5/tinymce.min.js"></script>
    <script src="{{asset('frontend/assets/plugins/dropify/js/dropify.min.js')}}"></script>
    <script>



        $(document).ready(function(){

            $(document).on("click", ".recruiter-tab", function(){

                var refresh = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab='+$(this).attr("data-tab");
                window.history.pushState({ path: refresh }, '', refresh);

            });

            // Basic
            var drEvent = $('.dropify').dropify({
                messages: {
                    default: 'Please Drag/Drop image here'
                }
            });

            drEvent.on('dropify.error.fileSize', function(event, element){
                alert('Please Upload Image less then 2mb');
            });

            tinymce.init({
                selector: 'textarea#company_descriptions',
                menubar: false,
            });

            $('.select2_skill').select2({
                placeholder: "Select Skills",
                allowClear: true
            });

        });
    </script>
@endsection()