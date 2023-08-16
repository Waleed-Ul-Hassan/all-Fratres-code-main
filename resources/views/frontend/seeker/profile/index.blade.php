@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','seeker_profile')->first();@endphp

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

     

    <!---/tophead-->
    <!----header-->
    {{--@include('frontend.partials.joblistingheader')--}}
    <!---/header--->
    <style>
        @media screen and (max-width: 800px){
            .width-64 {
                width: 83%;
            }
        }

    </style>
    <!--main-->
    <div class="jobseeker-dashboard-main">
        <div class="container">

            @include('frontend.seeker.partials.breadcrumb')

            <div class="jobseeker-dashb-content-main">

                @include('frontend.seeker.partials.sidebar')
                <div class="jobseeker-dashb-item2">
                    <div class="jobseeker-modifycontent">
                        <form id="cvprofile" method="post" enctype="multipart/form-data"
                              action="{{url('/seeker/account/update')}}">
                            @csrf
                            <div class="jobseeker-dashb-item2-mainheadv3">
                                <div class="jobseeker-modify-profile">

                                    <div class="jobseeker-currentcv-head">
                                        <h4>Your current CV</h4>
                                        @if(seeker_logged('cv_resume') != '')
                                        <img src="{{url('frontend/assets/img/cvjobseeker.svg')}}" class="img-fluid">
                                        <p>CV Attached!</p>
                                        <a target="_blank" href="{{url('/seekers/cvs/'.getDomainRoot().seeker_logged('cv_resume'))}}" dowload="{{url('/seekers/cvs/'.getDomainRoot().seeker_logged('cv_resume'))}}" style="float:left;"><span><i class="fas fa-download"></i></span> download cv</a>
                                        <a href="{{url('/seeker/cv/remove')}}" style="float: right;margin-right: 3px"><span><i class="fas fa-trash "></i></span> remove </a>
                                        @else
                                            <p class="red">Please Upload CV</p>
                                        @endif
                                    </div>
                                    <!--/end-->

                                    <div class="jobseeker-uploadcv-head">
                                        <h4>Upload new CV</h4>
                                        <p>We can accept the following file types: .doc, .docx .pdf</p>
                                        <div class="filepicker-dropdown" id="jobseekerfliker">
                                            <button id="" class="filepicker-dropdown__toggle valid" type="button"
                                                    aria-expanded="false" aria-invalid="false">
                                                <input type="file" id="file1" name="cv_resume" accept="pdf/docx" >
                                            </button>
                                            <p id="" class="filepicker-file-chosen">No file chosen</p></div>
                                    </div>
                                </div>
                            </div>
                            <!--/end-->
                            <div class="jobseeker-dashb-item2-mainheadv4">
                                <div class="modify-account-title">
                                    <h4>Modify Your Details</h4>

                                </div>
                                <div class="modify-account-dashed">
                                    <div class="modify-account-personal-details">
                                        <h3>Basic Information</h3>
                                        <span class="jobsekerdshed">
                                            <p>dddhdhdhhhh</p>
                                        </span>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="modifyaccount-personal-item1-head">
                                                    <div class="modify-perosnal-item1-head-title">
                                                        <h5>First Name</h5>
                                                    </div>
                                                    <div class="modify-perosnal-item1-head-option">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="first_name"
                                                                   value="{{seeker_logged('first_name')}}"
                                                                   id="firstname" placeholder="omi" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="modifyaccount-personal-item1-head">
                                                    <div class="modify-perosnal-item1-head-title">
                                                        <h5>Last Name</h5>
                                                    </div>
                                                    <div class="modify-perosnal-item1-head-option">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="last_name"
                                                                   value="{{seeker_logged('last_name')}}" id="lirstname"
                                                                   placeholder="dev" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="modifyaccount-personal-item1-head">
                                                <div class="modify-perosnal-item1-head-title">
                                                    <h5>Gender</h5>
                                                </div>

                            <div class="form-group  width-64">
                                <select class="form-control  " name="gender" id="titleform"
                                        required="">


                                    <option value="male"
                                            @if(seeker_logged('gender')== 'male') selected @endif>
                                        Male
                                    </option>
                                    <option value="female"
                                            @if(seeker_logged('gender')== 'female') selected @endif>
                                        Female
                                    </option>

                                </select>
                            </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="modifyaccount-personal-item1-head">
                                                <div class="modify-perosnal-item1-head-title">
                                                    <h5>Martial Status</h5>
                                                </div>

                                                    <div class="form-group width-64">
                                                        <select class="form-control " name="martial_status" id="titleform" required="">

                                                            <option value="single" @if(seeker_logged('martial_status') == 'single') selected @endif>Single</option>
                                                            <option value="married" @if(seeker_logged('martial_status') == 'married') selected @endif>Married</option>
                                                            <option value="divorced" @if(seeker_logged('martial_status') == 'divorced') selected @endif>Divorced</option>
                                                            <option value="widow" @if(seeker_logged('martial_status') == 'widow') selected @endif>Widow</option>
                                                        </select>
                                                    </div>

                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                                <div class="modifyaccount-personal-item1-head">
                                                <div class="modify-perosnal-item1-head-title">
                                                    <h5>Career Level</h5>
                                                </div>

                                                    <div class="form-group width-64">
                                                        <select class="form-control " name="career_level" id="exampleFormControlSelect1">
                                                            <option value="Entry Level" @if(seeker_logged('career_level') == 'Entry Level') selected @endif>Entry Level</option>
                                                            <option value="Intermediate" @if(seeker_logged('career_level') == 'Intermediate') selected @endif>Intermediate</option>
                                                            <option value="Experienced" @if(seeker_logged('career_level') == 'Experienced') selected @endif>Experienced Professional</option>
                                                            <option value="Department Head" @if(seeker_logged('career_level') == 'Department Head') selected @endif>Department Head</option>
                                                            <option value="GM / CEO / Country Head / President" @if(seeker_logged('career_level') == 'GM / CEO / Country Head / President') selected @endif>GM / CEO / Country Head / President</option>
                                                        </select>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="modifyaccount-personal-item2-head">
                                                <div class="modify-perosnal-item2-head-title">
                                                    <h5> DOB</h5>
                                                </div>
                                                <div class="modify-perosnal-item2-head-option">
                                                    <div class="form-group">
                                                        <input type="date" class="form-control" name="dob" required

                                                               value="{{seeker_logged('dob')}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="modifyaccount-personal-item2-head">
                                                <div class="modify-perosnal-item2-head-title">
                                                    <h5> Website / Portfolio</h5>
                                                </div>
                                                <div class="modify-perosnal-item2-head-option">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="website_portfolio"  value="{{seeker_logged('website_portfolio')}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        </div>

                                    </div>
                                </div>
                                <!--end 1-->
                                <div class="modify-account-dashed">
                                    <div class="modify-account-personal-details">
                                    <h3>Contact Information</h3>
                                    <span class="jobsekerdshed">
                                        <p>dddhdhdhhhh</p>
                                    </span>

                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="modifyaccount-personal-item2-head">
                                                <div class="modify-perosnal-item2-head-title">
                                                    <h5> Email</h5>
                                                </div>
                                                <div class="modify-perosnal-item2-head-option">
                                                    <div class="form-group">
                                                        <input type="email" disabled="" class="form-control"  value="{{seeker_logged('email')}}" id="emailaddress">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <div class="modifyaccount-personal-item1-head">
                                                <div class="modify-perosnal-item1-head-title">
                                                    <h5>Town/city</h5>
                                                </div>
                                                <div class="modify-perosnal-item1-head-option">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="city"
                                                               value="{{seeker_logged('city')}}" id="city"
                                                               placeholder="Hounslow West" required="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="modifyaccount-personal-item1-head">
                                                <div class="modify-perosnal-item1-head-title">
                                                    <h5>Country</h5>
                                                </div>


                                                        <div class="form-group width-64">
                                                            <select class="form-control " name="country"
                                                                    id="location" required="">
                                                                <option value="0">---Select a County/Location---
                                                                </option>
                                                                @foreach ($flags as $flag)
                                                                    <option value="{{strtoupper(str_replace('.fratres.net','',$flag->url))}}" @if(seeker_logged('country') == strtoupper(str_replace('.fratres.net','',$flag->url))) selected @endif>{{$flag->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="modifyaccount-personal-item2-head">
                                                <div class="modify-perosnal-item2-head-title">
                                                    <h5> Postcode</h5>
                                                </div>
                                                <div class="modify-perosnal-item2-head-option">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="postcode"
                                                               value="{{seeker_logged('postcode')}}" id="postcode"
                                                               placeholder="TW47QB" required="">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">

                                            <div class="modifyaccount-personal-item2-head">
                                                <div class="modify-perosnal-item2-head-title">
                                                    <h5> Main Phone</h5>
                                                </div>
                                                <div class="modify-perosnal-item2-head-option">
                                                    <div class="form-group">
                                                        <input type="tel" class="form-control" name="phone"
                                                               value="{{show_phone(seeker_logged('phone'),'phone')}}"
                                                               id="phone" placeholder="123456789" required="">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">

                                            <div class="modifyaccount-personal-item2-head">
                                                <div class="modify-perosnal-item2-head-title">
                                                    <h5>Optional Phone</h5>
                                                </div>
                                                <div class="modify-perosnal-item2-head-option">
                                                    <div class="form-group">
                                                        <input type="tel" class="form-control" name="phone_optional"
                                                               value="{{show_phone(seeker_logged('phone'),'phone_optional')}}"
                                                               id="pptionalphone" placeholder="">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                        <div class="modify-account-personal-details">
                                            <h3>Experience</h3>
                                            <span class="jobsekerdshed">
                                        <p>dddhdhdhhhh</p>
                                    </span>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="modifyaccount-personal-item1-head">
                                                <div class="modify-perosnal-item1-head-title">
                                                    <h5>Current Job Title</h5>
                                                </div>
                                                <div class="modify-perosnal-item1-head-option">
                                                    <div class="form-group">
                                                    <input type="text" class="form-control" name="current_job_title" value="{{seeker_logged('current_job_title')}}" id="currentjobtitle" required placeholder="Software Developer">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="modifyaccount-personal-item1-head">
                                                <div class="modify-perosnal-item1-head-title">
                                                    <h5>Current Company</h5>
                                                </div>
                                                <div class="modify-perosnal-item1-head-option">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="current_company"
                                                               id="desiredjob "
                                                               value="{{seeker_logged('current_company')}}"
                                                               placeholder="Senior Software Developer">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="modifyaccount-personal-item1-head">
                                                <div class="modify-perosnal-item1-head-title">
                                                    <h5>Expected Salary</h5>
                                                </div>
                                                <div class="modify-perosnal-item1-head-option">
                                                    <div class="form-group">
                                                        <input type="number" name="expected_salary" class="form-control" required value="{{seeker_logged('expected_salary')}}">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <div class="modifyaccount-personal-item2-head">
                                                <div class="modify-perosnal-item2-head-title">
                                                    <h5> Industry</h5>

                                                </div>

                                                <div class="modify-perosnal-item2-head-option">
                                                    <div class="form-group">
                                                        <select class="form-control " name="industries" id="industries">
                                                            <option value="0">---Select an Industry---</option>
                                                            @foreach($industries as $industriess )
                                                                <option value="{{$industriess->id}}"
                                                                        @if (seeker_logged('industries') == $industriess->id) selected @endif id="salary.1">{{$industriess->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <div class="modifyaccount-personal-item2-head">
                                                <div class="modify-perosnal-item2-head-title">
                                                    <h5>Willing to Relocate</h5>
                                                </div>
                                                <div class="modify-perosnal-item2-head-option">
                                                    <div class="form-group">
                                                        <select class="form-control" name="relocate" id="Relocate">
                                                            <option value="1"
                                                                    @if(seeker_logged('relocate')==1) selected @endif>
                                                                Yes
                                                            </option>
                                                            <option value="0"
                                                                    @if(seeker_logged('relocate')==0) selected @endif>No
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="modifyaccount-personal-item1-head">
                                                <div class="modify-perosnal-item1-head-title">
                                                    <h5>Experience years</h5>
                                                </div>
                                                <div class="modify-perosnal-item1-head-option">
                                                    <div class="form-group">
                                                        <input type="number" value="{{seeker_logged('experience_years')}}" name="experience_years" class="form-control" placeholder="3,4,5" required>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">

                                            <div class="modifyaccount-personal-item1-head">
                                                <div class="modify-perosnal-item1-head-title">
                                                    <h5>Availability</h5>
                                                    <span class="float-right">Hold 'Ctrl' to select more </span>
                                                </div>
                                                <div class="modify-perosnal-item1-head-option">
                                                    <div class="form-group">
                                                        <select name="available_job_type[]" id="job_types"
                                                                multiple="multiple" required="required"
                                                                class="form-control  valid" aria-invalid="false">
                                                            <option value="permanent"
                                                                    @if(array_fields('available_job_type','permanent') == 'permanent') selected @endif>
                                                                Permanent
                                                            </option>
                                                            <option value="temporary"
                                                                    @if(array_fields('available_job_type','temporary') == 'temporary') selected @endif>
                                                                Temporary
                                                            </option>
                                                            <option value="contract"
                                                                    @if(array_fields('available_job_type','contract') == 'contract') selected @endif>
                                                                Contract
                                                            </option>
                                                            <option value="part_time"
                                                                    @if(array_fields('available_job_type','part_time') == 'part_time') selected @endif>
                                                                Part Time
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </div>



                                    </div>

                                </div>
                                </div>

                                <!--end3-->
                                <div class="jobseeker-modify-btn-botm">

                                    <button type="submit" class="btn btn-primary" id="savejobseeker">
                                        save all changes <span><i class="fas fa-chevron-right"></i></span>
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection


@section('scripts')
    <script>

        

        $('.select2_skill').select2({
            placeholder: "Select Skills",
            allowClear: true
        });
    </script>
    <script src="{{url('/js/seeker_dashboard.js')}}"></script>
@endsection