@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','recruiter_jobpost')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('style')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

@endsection
@section('content')


<style>
        button.dropdown-toggle{
            background-color: #f9f9f9 !important;
        }
        .form-wizard .form-control{
            color:#000;
            font-weight: normal;
        }
        .tagify{
            background: #f9f9f9;
            margin: 0px !important;
        }
        
    </style>

<!--main-->
<div class="recruiter-main-dashboard">
    <div class="recru-dash-head">
        @if($isPaid)
        <div class="recru-dash-headv1">
            <p>bottom</p>
        </div>
        @endif
        @include('frontend.recruiter.partials.sidebar')
        
        <div class="recru-dash-item2">
            
            <div class="recru-post-jobhead">
                <div class="form-wizard">
                    <form @if($mode == 'edit') action="{{url('recruiter/update_job')}}" @else action="{{url('recruiter/create_job')}}" @endif method="post" role="form">
                        @csrf
                        @if($isPaid)
                        <div class="form-wizard-header">
                            <br>
                            <ul class="list-unstyled form-wizard-steps clearfix">
                                <li class="active"><span>1</span>
                                    <p>Job details</p>
                                </li>
                                <li><span>2</span>
                                    <p>Preview</p>
                                </li>
                                <li><span>3</span>
                                    <p>Billing information</p>
                                </li>
                                <li><span>4</span>
                                    <p>Payment</p>
                                </li>
                                <li><span>5</span>
                                    <p>Confirmation</p>
                                </li>
                            </ul>
                        </div>

                        @endif
                        <input type="hidden" name="mode" value="{{$mode}}">
                        <input type="hidden" name="unique_string" value="{{$unique_string}}">
                        <div class="container mt-5-mob">
                            <div class="row">
                                <div class="col-lg-7">
                                    <fieldset class="wizard-fieldset show">
                                        <h5 class="heading-form-recruiter"><span>About the job</span></h5>
                                        
                                        <div class="form-group row">
                                            <label for="job_title" class="col-sm-4 ">Job title <span class="star">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="title" class="form-control wizard-required"  id="job_title" value="{{old_data('title',$mode,$job)}}" placeholder="e.g web developer required">
                                                @if ($errors->has('title'))
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{$errors->get('title')[0]}}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="city" class="col-sm-4 ">City <span class="star">*</span></label>
                                            <div class="col-sm-8 custom-wdith-selectpicker">
                                                {{--<input type="text" class="form-control  " id="example-ddg" placeholder="e.g postcode or town" name="city" value="@if(old_data('city',$mode,$job) == $city->id) selected @endif">--}}
                                                <select name="city" id="city" class="form-control city-input" required>
                                                    {{--<option value="">--Please Choose Job City--</option>--}}
                                                    @foreach($cities as $city)
                                                    <option value="{{$city->id}}" @if(old_data('city',$mode,$job) == $city->id) selected @endif>{{$city->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('city'))
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{$errors->get('city')[0]}}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="founded" class="col-sm-4 ">Job Industry <span class="star">*</span></label>
                                            <div class="col-sm-8">
                                                <select name="job_industry" id="industry" class="form-control industry-input width-100 " required >
                                                    
                                                    @foreach($industries as $industry)
                                                    <option value="{{$industry->id}}" @if(old_data('job_industry',$mode,$job) == $industry->id) selected @endif>{{$industry->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('job_industry'))
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{$errors->get('job_industry')[0]}}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                        {{--<div class="form-group row">--}}
                                            {{--<label for="skills" class="col-sm-4 ">Skills Required <span class="star">*</span></label>--}}
                                            {{--<div class="col-sm-8 custom-wdith-selectpicker">--}}
                                                {{----}}
                                                {{--<textarea name='skills' placeholder='Skills' >--}}
                                                    {{--{{ $selectedskills }}--}}
                                                {{--</textarea>--}}
                                                {{--@if ($errors->has('skills'))--}}
                                                {{--<div class="invalid-feedback" style="display: block;">--}}
                                                    {{--{{$errors->get('skills')[0]}}--}}
                                                {{--</div>--}}
                                                {{--@endif--}}
                                            {{--</div>--}}
                                            {{--<div class="wizard-form-error"></div>--}}
                                        {{--</div>--}}
                                        
                                       
                                        <div class="form-group row">
                                            <label for="contract" class="col-sm-4 ">Contract Type <span class="star">*</span></label>
                                            <div class="col-sm-4">
                                                <select class="form-control" id="contract" name="contract_type">
                                                    <option value="">--Contract type--</option>
                                                    <option value="permanent" @if(old_data('contract_type',$mode,$job) == 'permanent') selected @endif>Permanent</option>
                                                    <option value="contract" @if(old_data('contract_type',$mode,$job) == 'contract') selected @endif>Contract</option>
                                                    <option value="temporary" @if(old_data('contract_type',$mode,$job) == 'temporary') selected @endif>Temporary</option>
                                                    <option value="training" @if(old_data('contract_type',$mode,$job) == 'training') selected @endif>Training</option>
                                                    <option value="voluntary" @if(old_data('contract_type',$mode,$job) == 'voluntary') selected @endif>Voluntary</option>
                                                </select>
                                                @if ($errors->has('contract_type'))
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{$errors->get('contract_type')[0]}}
                                                </div>
                                        @endif
                                    </div>
                                   
                                    <div class="col-sm-4">
                                        <select class="form-control" name="time_available">
                                            <option value="full_time" @if(old_data('time_available',$mode,$job) == 'full_time') selected @endif>Full-time</option>
                                            <option value="part_time" @if(old_data('time_available',$mode,$job) == 'part_time') selected @endif>Part-time</option>
                                        </select>
                                        @if ($errors->has('time_available'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('time_available')[0]}}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="wizard-form-error"></div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="salary" class="col-sm-4 ">Salary ({{$settings->symbol}}) <span class="star">*</span></label>
                                    <div class="col-sm-4">
                                        <input type="number" step="0.01" name="salary_min" class="form-control wizard-required"  id="salary" value="{{old_data('salary_min',$mode,$job)}}" placeholder="salary min">
                                        @if ($errors->has('salary_min'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('salary_min')[0]}}
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <input type="number" step="0.01" name="salary_max" class="form-control wizard-required"  id="salary" value="{{old_data('salary_max',$mode,$job)}}" placeholder="salary max">
                                        @if ($errors->has('salary_max'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('salary_max')[0]}}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="wizard-form-error"></div>
                                </div>
                                <div class="form-group row">
                                    <label for="salary" class="col-sm-4 "></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="salary_schedule">
                                            <option value="">--Choose time period--</option>
                                            <option value="Hour" @if(old_data('salary_schedule',$mode,$job) == 'Hour') selected @endif>per hour</option>
                                            <option value="Day" @if(old_data('salary_schedule',$mode,$job) == 'Day') selected @endif>per day</option>
                                            <option value="Week" @if(old_data('salary_schedule',$mode,$job) == 'Week') selected @endif>per week</option>
                                            <option value="Month" @if(old_data('salary_schedule',$mode,$job) == 'Month') selected @endif>per month</option>
                                            <option value="Year" @if(old_data('salary_schedule',$mode,$job) == 'Year') selected @endif>per year</option>
                                        </select>
                                        @if ($errors->has('salary_schedule'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('salary_schedule')[0]}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                @if(!$isPaid)
                                <div class="form-group row">
                                    <label for="salary" class="col-sm-4 ">Job Status</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="job_status">
                                            <option value="active" @if(old_data('job_status',$mode,$job) == 'active') selected @endif>Active</option>
                                            <option value="draft" @if(old_data('job_status',$mode,$job) == 'draft') selected @endif>Draft</option>
                                        </select>
                                    </div>
                                </div>
                                @endif
                                
                                <div class="form-group row">
                                    <label for="basic-example2" class="col-sm-4">Job Description <span class="star">*</span></label>
                                    <div class="col-sm-8">
                                        <textarea name="description" id="basic-example2">{{old_data('description',$mode,$job)}}</textarea>
                                        @if ($errors->has('description'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('description')[0]}}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="wizard-form-error"></div>
                                </div>

                                {{--<h5 class="heading-form-recruiter"><span>About the company</span></h5>--}}

                                {{--<div class="form-group row">--}}
                                    {{--<label for="CompanyName" class="col-sm-4 ">Company Name <span class="star">*</span></label>--}}
                                    {{--<div class="col-sm-8">--}}
                                        {{--<input type="text" class="form-control wizard-required"  id="CompanyName" name="company_name" value="{{recruiter_logged('company_name')}}" placeholder="ie. fratres.net">--}}
                                        {{--@if ($errors->has('company_name'))--}}
                                            {{--<div class="invalid-feedback" style="display: block;">--}}
                                                {{--{{$errors->get('company_name')[0]}}--}}
                                            {{--</div>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                    {{--<div class="wizard-form-error"></div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group row">--}}
                                    {{--<label for="CompanyName" class="col-sm-4 ">Number of employees <span class="star">*</span></label>--}}
                                    {{--<div class="col-sm-8">--}}
                                        {{--<select name="company_size" id="" class="form-control" required>--}}
                                            {{--<option value="">Company Size</option>--}}
                                            {{--<option value="10" @if(recruiter_logged('company_size')==10) selected @endif>Less than 10</option>--}}
                                            {{--<option value="20" @if(recruiter_logged('company_size')==20) selected @endif>Less than 20</option>--}}
                                            {{--<option value="50" @if(recruiter_logged('company_size')==50) selected @endif>Less than 50</option>--}}
                                            {{--<option value="200" @if(recruiter_logged('company_size')==200) selected @endif>Less than 200</option>--}}
                                            {{--<option value="300" @if(recruiter_logged('company_size')==300) selected @endif>Less than 300</option>--}}
                                            {{--<option value="500" @if(recruiter_logged('company_size')==500) selected @endif>500+</option>--}}
                                        {{--</select>--}}
                                        {{--@if ($errors->has('company_size'))--}}
                                            {{--<div class="invalid-feedback" style="display: block;">--}}
                                                {{--{{$errors->get('company_size')[0]}}--}}
                                            {{--</div>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                    {{--<div class="wizard-form-error"></div>--}}
                                {{--</div>--}}

                                {{----}}
                                {{--<div class="form-group row">--}}
                                    {{--<label for="basic-example" class="col-sm-4 ">About your company <span class="star">*</span></label>--}}
                                    {{--<div class="col-sm-8">--}}
                                        {{--<textarea name="company_description" id="basic-example">{{recruiter_logged('company_description')}}</textarea>--}}
                                        {{--@if ($errors->has('company_description'))--}}
                                            {{--<div class="invalid-feedback" style="display: block;">--}}
                                                {{--{{$errors->get('company_description')[0]}}--}}
                                            {{--</div>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}

                                    {{--<div class="wizard-form-error"></div>--}}
                                {{--</div>--}}

                                <div class="form-group row clearfix">
                                    <label for="location" class="col-sm-4 "></label>
                                    <div class="col-sm-8">
                                        <button type="submit" class="btn btn-primary btn-block"> @if ($mode == 'edit') Update @else @if($isPaid) Next @else Create Job @endif @endif</button>
                                    </div>
                                </div>
                            </fieldset>


                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

        </div>

    </div><!--END-->
    </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/5/tinymce.min.js"></script>


    <script>

        {{--var skills = '{!! $skills !!}';--}}
        {{--var count = '{!! $count !!}';--}}
        {{--skills = JSON.parse(skills);--}}
        
        {{--var whitelist = [];--}}

        {{--console.log(skills[6])--}}
        {{--for(var i = 0; i < count; i++) {--}}
            {{--// var obj = {}; --}}

            {{--// obj['id'] = skills[i].id;--}}
            {{--// obj['value'] = skills[i].value;--}}
            {{--whitelist.push({ id: skills[i].id, value : skills[i].value });--}}
            {{--// console.log(skills[i].id)--}}

        {{--}--}}
        
        {{--console.log(whitelist)--}}

        {{--var input = document.querySelector('textarea')--}}

        {{--var tagify = new Tagify(input, {--}}
                {{--enforceWhitelist: true,--}}
                {{--delimiters: null,--}}
                {{--whitelist: whitelist,--}}
                {{--callbacks: {--}}
                    {{--add: console.log,  // callback when adding a tag--}}
                    {{--remove: console.log   // callback when removing a tag--}}
                {{--}--}}
        {{--})--}}

        tinymce.init({
            selector: 'textarea#basic-example',
            menubar: false,
        });

        tinymce.init({
            selector: 'textarea#basic-example2',
            menubar: false,
        });

        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.city-input').select2();

            $('.industry-input').select2({
                placeholder: "Select Industry",
                allowClear: true
            });
        });



    </script>
    @endsection