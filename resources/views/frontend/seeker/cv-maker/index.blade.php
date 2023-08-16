@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','homepage')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>

    <style>
        .modal-header {
            padding: 0;
            padding-right: 10px;
            margin: 0;
        }
        .sumary_head_jobeefratres p {

            word-break: break-all;

        }
        .row{
            word-break: break-all;
        }
        .tagify{
            background: #f9f9f9;
            margin: 0px !important;
        }
        @media screen and (min-width: 900px) {
            .ml-l {
                margin-left: 10px;
            }
        }
    </style>
    <!---main-->
    <div class="main_fratresjobee_wrapper">
        <div class="container-fluid">
            <div class="fratres_mainjobee_head">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="jobee_item_profile_logo">
                            <div class="jobee_profile_logohandle">
                                <form action="{{url('seeker/change_avatar')}}" enctype="multipart/form-data" id="profile_avatar" method="post">
                                    @csrf
                                    <div class="avatar-upload">
                    
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="
                                            @if(Auth::guard('seeker')->user()->avatar == '')
                                                    background-image: url({{asset('frontend/assets/img/person-placeholder.jpg')}}) no-repeat;
                                            @else
                                                    background-image: url({{url('seekers/profile/'.getDomainRoot().Auth::guard('seeker')->user()->avatar)}});
                        
                                            @endif
                                                    ">
                        
                                            </div>
                                            <div class="avatar-edit fratres_imageupload">
                                                <input type="file" name="fileToUpload" id="imageUpload" accept=".png, .jpg, .jpeg">
                                                <label for="imageUpload"></label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
    
                        </div>
                        <div class="jobee_profile_details_head">
                            <div class="jobee_profile_details_sub" data-toggle="modal" data-target="#fratresjobeeprofile">
                                <h3>{{seeker_logged('first_name') .' '. seeker_logged('last_name')}} <span><i class="fas fa-pencil-alt"></i></span></h3>
                                <p>{{$seeker->age}} years</p>
                                <p>{{$seeker->city}} {{$seeker->country}}</p>
                                <h3>{{$seeker->previous_job_title}}</h3>
                                @if($seeker->experience_years != '')
                                    <p>{{$seeker->experience_years}} years experience</p>
                                @else
                                    <p>experience not set</p>
                                @endif
        
                            </div>
    
                        </div>
                        <div class="jobee_prolife_socails">
                            <ul>
                                <li>
                                    <a href="{{$seeker->twitter_profile}}">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{$seeker->facebook_profile}}">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{$seeker->linkdin_profile}}">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="fratres_editbasicinfo">
        
                            <div class="row">
                                <div class="col-lg-10 col-md-6 col-sm-6 col-8 ">
                                    <h3>
                                        <a href="{{url('seeker/profile')}}">
                                            <span><i class="fas fa-user"></i></span> basic information
                                        </a>
                                    </h3>
                                </div>
                                <div class="col-lg-2  col-md-6 col-sm-6 col-4 pt-2 pl-2">
                                    <a href="{{url('seeker/profile')}}" class="edit-mobile">edit</a>
                                </div>
                            </div>
    
                        </div>
                        <div class="fratres_editbasicinfo">
        
                            <div class="row">
                                <div class="col-lg-12  col-md-12 col-sm-12 col-12">
                
                                    <span><i class="fas fa-envelope fa-color"></i></span> <span class="margin-left-10">{{$seeker->email}}</span>
            
                                </div>
        
                            </div>
    
                        </div>
    
                        <div class="fratres_editbasicinfo">
        
                            <div class="row">
                                <div class="col-lg-10  col-md-6 col-sm-6 col-8">
                                    <h3>
                                        <a href="{{url('seeker/job-alerts')}}">
                                            <span><i class="fas fa-envelope-square"></i></span> Job Alerts
                                        </a>
                                    </h3>
                                </div>
                                <div class="col-lg-2  col-md-6 col-sm-6 col-4 pt-2 pl-2">
                                    <a href="{{url('seeker/job-alerts')}}" class="edit-mobile">edit</a>
                                </div>
                            </div>
    
                        </div>
                        <div class="fratres_editbasicinfo">
        
                            <div class="row">
                                <div class="col-lg-10  col-md-6 col-sm-6 col-8">
                                    <h3>
                                        <a href="#" class="edit-mobile fa-100" @if($seeker->username == '') data-toggle="modal" data-target="#publiclinkedit" @endif>
                                            <span><i class="fas fa-link "></i></span> Public Link
                                        </a>
                                    </h3>
                                    <p style="text-align: left;">{{url('seeker-profile')}}/{{$seeker->username}}</p>
                                    <h6>
                                        <a href="#" @if($seeker->username == '') data-toggle="modal" data-target="#publiclinkedit" class="edit-mobile" @endif >
                                            <span><i class="fab fa-facebook-square"></i></span>
                                            share on facebook
                                        </a>
                                    </h6>
                                </div>
                                @if($seeker->username == '')
                                    <div class="col-lg-2  col-md-6 col-sm-6 col-4 pt-2 pl-2">
                                        <a href="#" class="edit-mobile" data-toggle="modal" data-target="#publiclinkedit">edit</a>
                                    </div>
                                @endif
                            </div>
    
                        </div>
                        <div class="fratres_editbasicinfo">
        
                            <div class="row">
                                <div class="col-lg-10  col-md-6 col-sm-6 col-8">
                                    <h3>
                                        <a href="#">
                                            <span><i class="fas fa-graduation-cap"></i></span> Education
                                        </a>
                                    </h3>
            
            
                                </div>
                                <div class="col-lg-2  col-md-6 col-sm-6 col-4 pt-2 pl-2">
                                    <a href="#" data-toggle="modal" data-target="#edu_jobeefratresmain" class="edit-mobile">Add</a>
                                </div>
                            </div>
    
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="sumary_head_jobeefratres" style="border:1px dashed #dfdfdf;">
                            <div class="row">
                                <div class="col pl-0">
                                    <div class="text-left">
                                        <h3>
                                            <span><i class="fas fa-file"></i></span>summary
                                        </h3>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-right">
                                        <a href="#" class="edit-mobile" data-toggle="modal" data-target="#summaryfratres" >edit</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="summary_details_head " data-toggle="modal" data-target="#summaryfratres">
                
                                    {{ $seeker->summary }}
            
                                </div>
                            </div>
                        </div>
                        <div class="sumary_head_jobeefratres" style="    border: 1px dotted #dfdfdf;">
                            <div class="row">
                                <div class="col-7 pl-0 pt-3">
                                    <div class="text-left">
                                        <h3>
                                            <span><i class="fas fa-list"></i></span>work experience
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-5 pt-3">
                                    <div class="text-right">
                                        <a href="#"  data-toggle="modal" data-target="#workexpfratres"><span>+</span>add experience</a>
                                    </div>
                                </div>
                            </div>
                            @if($experiences->count() > 0)
                                @foreach($experiences as $experience)
                                    <div class="summary_subheads edit_experience" data-id="{{$experience->id}}">
                                        <a href="" class="delete-experience" data-id="{{$experience->id}}" style="position: relative;left: 100%;top: 65%;"><span><i class="fas fa-trash fa-color"></i></span></a>
                                        <div class="row pt-3">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 titlesoftEXP">
                                                <h4 id="titlesoft" data-toggle="modal" data-target="#workexpfratres">{{$experience->job_title}} <span><i class="fas fa-pencil-alt"></i></span>
                                                </h4>
                            
                                                <h6 id="subtitlesoft" data-toggle="modal" data-target="#workexpfratres">{{$experience->company}} </h6>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="text-right">
                                                    <h4 id="datetitlesoft" data-toggle="modal" data-target="#workexpfratres">{{date("M-Y", strtotime($experience->date_start))}} - {{date("M-Y", strtotime($experience->date_end))}} </h4>
                                                    <h6 id="citytitlesoft" data-toggle="modal" data-target="#workexpfratres">{{$experience->job_city}} , {{$experience->job_country}} </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pt-4 pb-3">
                                            <div class="col-lg-12 exclipe">
                                                {!! $experience->description !!}
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            @else
                                <div class="summary_subheads">
                                    <div class="row pt-3">
                                        <p id="Qisstsoft" class="font-alert" data-toggle="modal" data-target="#workexpfratres">No experience added</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="sumary_head_jobeefratres" style="border: 1px dashed #dfdfdf;">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-8 pl-0 pt-3">
                                    <div class="text-left">
                                        <h3>
                                            <span><i class="fas fa-list"></i></span>projects
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-4 pt-3">
                                    <div class="text-right">
                                        <a href="#" data-toggle="modal" data-target="#projectsratres"><span>+</span>add project</a>
                                    </div>
                                </div>
                            </div>
                            @if($projects->count() > 0)
                                @foreach($projects as $project)
                                    <div class="summary_subheads edit_project" data-id="{{$project->id}}">
                                        <a href="" class="delete-project" data-id="{{$project->id}}" style="position: relative;left: 100%;top: 65%;"><span><i class="fas fa-trash fa-color"></i></span></a>
                                        <div class="row pt-3">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <h4 id="Qisstsoft" data-toggle="modal" data-target="#projectsratres"> {{$project->project_title}}<span class="pl-2"><i class="fas fa-pencil-alt"></i></span></h4>
                                                <h6 id="subprojectsoft" data-toggle="modal" data-target="#projectsratres">{{$project->company}} </h6>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="text-right">
                                                    <h4 id="dateprojectsoft" data-toggle="modal" data-target="#projectsratres">{{date("M-Y", strtotime($project->date_start))}} - {{date("M-Y", strtotime($project->date_end))}}
                                
                                                    </h4>
                            
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pt-4 pb-3 exclipe" data-toggle="modal" data-target="#projectsratres">
                                            {!! $project->description !!}
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            @else
                                <div class="summary_subheads">
                                    <div class="row pt-3">
                                        <p id="Qisstsoft" class="font-alert" data-toggle="modal" data-target="#projectsratres">No prjects added</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="sumary_head_jobeefratres" style="border:1px dotted #dfdfdf;">
                            <div class="row">
                                <div class="col-6 pl-0 pt-3">
                                    <div class="text-left">
                                        <h3>
                                            <span><i class="fas fa-sun"></i></span>Education
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-6 pt-3">
                                    <div class="text-right">
                                        <a href="#" data-toggle="modal" data-target="#edu_jobeefratresmain" onclick="resetForm();"><span>+</span>add education</a>
                                    </div>
                                </div>
                                @if($educations->count() > 0)
                                    @foreach($educations as $education)
                                        <div class="summary_subheads edit_education" data-id="{{$education->id}}" style="width: 100%;">
                                            <a href="" class="delete-education" data-id="{{$education->id}}" style="position: relative;left: 95%;top: 65%;z-index:9;"><span><i class="fas fa-trash fa-color"></i></span></a>
                                            <div class="row pt-3">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <h4 id="certiv" data-toggle="modal" data-target="#edu_jobeefratresmain" >{{$education->school}}<span class="pl-2"><i class="fas fa-pencil-alt"></i></span></h4>
                                                    <h6 id="certivb" data-toggle="modal" data-target="#edu_jobeefratresmain">Completed On : {{$education->year}} </h6>
                                                    <h6 id="certivb" data-toggle="modal" data-target="#edu_jobeefratresmain">Degree : {{$education->degree}} <small>{{$education->location}}</small> </h6>
                                                    <h6 id="certivb" data-toggle="modal" data-target="#edu_jobeefratresmain">Field : {{$education->study_field}} <small>(GRADE {{$education->grade}})</small> </h6>
                            
                                                </div>
                        
                                            </div>
                                            <hr>
                                        </div>
                
                                    @endforeach
                                @else
                
                                    <p id="" class="font-alert" data-toggle="modal" data-target="#edu_jobeefratresmain"><br>No education added</p>
                                @endif
                            </div>
    
                        </div>
                        <div class="sumary_head_jobeefratres" style="border:1px dotted #dfdfdf;">
                            <div class="row">
                                <div class=" col-6 pl-0 pt-3">
                                    <div class="text-left">
                                        <h3>
                                            <span><i class="fas fa-sun"></i></span>Certifications
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-6 pt-3">
                                    <div class="text-right">
                                        <a href="#" data-toggle="modal" data-target="#certificationfratres"><span>+</span>add certification</a>
                                    </div>
                                </div>
                                @if($certifications->count() > 0)
                                    @foreach($certifications as $certification)
                                        <div class="summary_subheads" style="width: 100%;">
                                            <a href="" class="delete-certification" data-id="{{$certification->id}}" style="position: relative;left: 95%;top: 15%;"><span><i class="fas fa-trash fa-color"></i></span></a>
                                            <div class="row pt-3">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <h4 id="certiv" data-toggle="modal" data-target="#certificationfratres" class="edit_certification" data-id="{{$certification->id}}">{{$certification->certification_name}}<span class="pl-2"><i class="fas fa-pencil-alt"></i></span></h4>
                                                    <h6 id="certivb" data-toggle="modal" data-target="#certificationfratres">Completed On : {{date("m-Y", strtotime($certification->end_date))}} </h6>
                                                    <h6 id="certivb" data-toggle="modal" data-target="#certificationfratres">Authority : {{$certification->certification_authority}} <small>{{$certification->certification_url}}</small> </h6>
                            
                                                </div>
                        
                                            </div>
                                            <hr>
                                        </div>
                
                                    @endforeach
                                @else
                
                                    <p id="" class="font-alert" data-toggle="modal" data-target="#certificationfratres"><br>No certifications added</p>
                                @endif
                            </div>
    
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="jobee3_head_content">
                            <div class="profile_alreadresume">
                                <div class="text-center">
                                    <h3><span><i class="fas fa-chart-pie"></i></span>Profile Strength</h3>
                
                                    <!-- Progress bar 1 -->
                                    <div class="progress-round mx-auto" data-value='{{$seeker->score}}'>
          <span class="progress-left">
            <span class="progress-bar border-primary"></span>
          </span>
                                        <span class="progress-right">
            <span class="progress-bar border-primary"></span>
          </span>
                                        <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                            <div class="h2 font-weight-bold">{{$seeker->score}}<sup class="small">%</sup></div>
                                        </div>
                                    </div>
                                    <!-- END -->
                                </div>
                                <br>
                            </div>
                            <div class="fratres_jobee_downloadcv">
                                <div class="text-center">
                                    <a href="#" data-target="#download-cv-templates" data-toggle="modal">Download cv</a>
                                </div>
                            </div>
                            <div class="skills_jobeefratres_download">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8 pading-l-5">
                                        <h3>
                                            <a href="#" data-toggle="modal" data-target="#skillsfratres">
                                                <span><i class="fas fa-chart-bar ml-l"></i></span>Skills
                                            </a>
                                        </h3>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 pt-2 ">
                                        <a href="#" data-toggle="modal" class="edit-mobile add-mob float-right" data-target="#skillsfratres">Add</a>
                                    </div>
                                </div>
                                @if($seekers_skills_display != null)
                                    <div class="skills_progree_jobeefratres">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <ul>
                                                    @foreach(explode(",", $seekers_skills_display) as $seeker_skill)
                                                        <li><span>{{$seeker_skill}}</span></li>
                                                    @endforeach
                                                </ul>
                        
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
        
                            <div class="fratres_editbasicinfo">
            
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8 pading-l-5" >
                                        <h3>
                                            <a href="#" data-toggle="modal" data-target="#hobbiesfratres">
                                                <span><i class="far fa-futbol ml-l"></i></span> Hobbies/Activities
                                            </a>
                                        </h3>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 pt-2 ">
                                        <a href="#" data-toggle="modal" data-target="#hobbiesfratres" class="edit-mobile add-mob float-right">Add</a>
                                    </div>
                                    @if($seeker->hobbies != '')
                                        <div class="skills_progree_jobeefratres">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <ul>
                                    
                                                    @foreach(json_decode($seeker->hobbies) as $hobby)
                                                            <li>
                                                    <span>
                                                      {{$hobby->value}}
                                                     </span>
                                                            </li>
                                                        @endforeach
                                
                                                    </ul>
                            
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
        
                            </div>
                            <div class="fratres_editbasicinfo">
            
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8 pading-l-5">
                                        <h3>
                                            <a href="#" data-toggle="modal" data-target="#languagefratres">
                                                <span><i class="fas fa-volume-up ml-l"></i></span> Languages
                                            </a>
                                        </h3>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 pt-2 ">
                                        <a href="#" data-toggle="modal" data-target="#languagefratres" class="edit-mobile add-mob float-right">Add</a>
                                    </div>
                                    @if($seeker->languages != '')
                                        <div class="skills_progree_jobeefratres">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <ul>
                                    
                                                        @foreach(json_decode($seeker->languages) as $language)
                                                            <li>
                                                    <span>
                                                      {{$language->value}}
                                                     </span>
                                                            </li>
                                                        @endforeach
                                
                                                    </ul>
                            
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
        
                            </div>
                            <div class="fratres_editbasicinfo">
            
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8 pading-l-5">
                                        <h3>
                                            <a href="#">
                                                <span><i class="fas fa-users ml-l"></i></span> References
                                            </a>
                                        </h3>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 pt-2 pl-0">
                                        <a href="#" data-toggle="modal" data-target="#referencesfratres" class="edit-mobile add-mob float-right">Add</a>
                                    </div>
                                </div>
        
                            </div>
        
                            @if($references->count() > 0)
                                <div class="skills_progree_jobeefratres">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <ul class="reference">
                                                @foreach($references as $reference)
                                                    <li style="display: block;">
                                                        <p>{{$reference->name}} <a href="#" data-id="{{encrypt($reference->id)}}" class="float-right delete-referece" style="cursor: pointer"><i class="fas fa-trash"></i></a></p>
                                                        <p>{{$reference->email}}</p>
                                                        <p>{{$reference->company}}</p>
                                                        <p>{{$reference->contact_no}}</p>
                                
                                                    </li>
                                
                                                    <hr>
                                                @endforeach
                                            </ul>
                    
                                        </div>
                                    </div>
                                </div>
                            @endif
    
    
    
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!--/main-->


    {{--modals--}}
    <!--modal-->
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="frates_editjobeeinfo_modal">
        <div class="modal fade" id="fratresjobeeprofile" tabindex="-1" role="dialog" aria-labelledby="fratresjobeeprofileTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fratresjobeeprofileTitle"><span><i class="fas fa-user"></i></span>profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="fratres_jobee_edit-info">
                            <form action="{{url('seeker/cv-maker/update_account')}}" id="update-account" method="post">
                                @csrf
                                <div class="form-group row">

                                    <div class="col-sm-6">
                                        <label for="FirstName">* First Name</label>
                                        <input type="text"  class="form-control" name="first_name" id="FirstName" value="{{seeker_logged('first_name')}}" placeholder="FirstName">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="LastName">* Last Name</label>
                                        <input type="text" class="form-control" id="LastName" value="{{seeker_logged('last_name')}}" name="last_name" placeholder="LastName">
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-sm-6">
                                        <label for="Gender">* Gender</label>
                                        <select class="form-control" name="gender">
                                            <option value="male" @if(seeker_logged('gender')=='male') selected @endif>Male</option>
                                            <option value="female" @if(seeker_logged('gender')=='female') selected @endif>Female</option>
                                            <option value="shemale" @if(seeker_logged('gender')=='shemale') selected @endif>Shemale</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="Dateofbirth">* Date of birth</label>
                                        <input type="date" class="form-control" id="Dateofbirth" value="{{$seeker->dob}}" placeholder="DD/MM/YYYY" name="dob">
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-sm-6">
                                        <label for="City">* City</label>
                                        <input type="text" class="form-control" id="city" value="{{$seeker->city}}" name="city" placeholder="e.g City Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="country">* Country</label>
                                        <select class="form-control selectpicker" name="country"
                                                id="location" required="">
                                            <option value="0">---Select a County/Location---
                                            </option>
                                            @foreach ($flags as $flag)
                                                <option value="{{strtoupper(str_replace('.fratres.net','',$flag->url))}}" @if($seeker->country == strtoupper(str_replace('.fratres.net','',$flag->url))) selected @endif>{{$flag->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">


                                    <div class="col-sm-6">
                                        <label for="Experience">* Experience Years</label>
                                        <input type="number" value="{{$seeker->experience_years}}" name="experience_years" class="form-control" placeholder="3,4,5">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="Salary">* Expected Salary</label>
                                        <input type="number" name="expected_salary" class="form-control" value="{{$seeker->expected_salary}}">
                                    </div>

                                </div>

                                <div class="form-group row">

                                    <div class="col-sm-6">
                                        <label for="Designation">*  Current Job Title</label>
                                        <input type="text" class="form-control" name="current_job_title" value="{{$seeker->current_job_title}}" id="currentjobtitle" placeholder="Software Developer">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="Company">* Current Company</label>
                                        <input type="text" name="current_company" class="form-control" id="Company" value="{{$seeker->current_company}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="Company">* Industry</label>
                                        <select class="form-control " name="industries" id="industries">
                                            <option value="0">---Select an Industry---</option>
                                            @foreach($industries as $industriess )
                                                <option value="{{$industriess->id}}"
                                                        @if (seeker_logged('industries') == $industriess->id) selected @endif id="salary.1">{{$industriess->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>





                                <div class="fratres_edit_socails">
                                    <h3>Link your social accounts</h3>
                                </div>
                                <div class="form-group row">

                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text linkedjobee" id="basic-addon1"><i class="fab fa-linkedin-in"></i></span>
                                            </div>
                                            <input type="text" value="{{$seeker->linkdin_profile}}" name="linkdin_profile" class="form-control" placeholder="Profile link" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text facebookjobee" id="basic-addon1"><i class="fab fa-facebook-f"></i></span>
                                            </div>
                                            <input type="text" value="{{$seeker->facebook_profile}}" name="facebook_profile" class="form-control" placeholder="Profile link" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text githubbg" id="basic-addon1"><i class="fab fa-github"></i></span>
                                            </div>
                                            <input type="text" name="github_profile" class="form-control" placeholder="Profile link" value="{{$seeker->github_profile}}" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text twitterjobee" id="basic-addon1"><i class="fab fa-twitter"></i></span>
                                            </div>
                                            <input type="text" name="twitter_profile" class="form-control" placeholder="Profile link" value="{{$seeker->twitter_profile}}" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="print-error-msg col-md-10" style="display:none;padding-left: 0px">

                            <ul class=" errors"></ul>
                        </div>
                        <div class="print-success-msg col-md-10" style="display:none;padding-left: 0px">
                            <p class="success-para"></p>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="fratres_jobee_edit_btm">
                            <button type="button" class="btn btn-primary save_account_info">Save changes</button>
                            <a href="#"  data-dismiss="modal">No , Cancel</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----/end-->


    <!--registration-->
    <div class="reg_head_modal_jobeefratres">


        <!-- Modal -->
        <div class="modal fade" id="awardfratres" tabindex="-1" role="dialog" aria-labelledby="awardfratresTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="awardfratresTitle"><span><i class="fas fa-trophy"></i></span>Awards</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Title</label>
                                    <input type="text" class="form-control" id="inputEmail4">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Authority</label>
                                    <input type="text" class="form-control" id="inputEmail4">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Date</label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="Date/month">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Award URL</label>
                                    <input type="text" class="form-control" id="inputEmail4">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="fratres_jobee_edit_btm">
                            <button type="button" class="btn btn-primary">Save Changes</button>
                            <a href="#"  data-dismiss="modal">No , Cancel</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/end-->


    <div class="reg_head_modal_jobeefratres">


        <!-- Modal -->
        <div class="modal fade" id="certificationfratres" tabindex="-1" role="dialog" aria-labelledby="certificationfratresTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="certificationfratresTitle"><span><i class="fas fa-sun"></i></span>Certifications</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{url('seeker/cv-maker/save_certification')}}" id="save_certification">
                            <input type="hidden" name="certification_id" class="certification_id">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Certification Name</label>
                                    <input type="text" name="certification_name" class="form-control" id="inputEmail4">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">License number / Enrollment </label>
                                    <input type="text" name="license_number" class="form-control" id="inputEmail4">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Certification Authority</label>
                                    <input type="text" name="certification_authority" class="form-control" id="inputEmail4" placeholder="full name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Certification URL</label>
                                    <input type="text" name="certification_url" class="form-control" id="inputEmail4">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Start Date</label>
                                    <input type="date" name="completion_date" class="form-control" id="inputEmail4" placeholder="Date/month/year">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">End Date</label>
                                    <input type="date" name="end_date" class="form-control" id="inputEmail4" placeholder="Date/month/year" max="{{date("Y-m-d")}}">
                                </div>
                            </div>
                        </form>
                        <div class="print-error-msg col-md-10" style="display:none;padding-left: 0px">

                            <ul class=" errors"></ul>
                        </div>
                        <div class="print-success-msg col-md-10" style="display:none;padding-left: 0px">
                            <p class="success-para"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="fratres_jobee_edit_btm">
                            <button type="button" class="btn btn-primary save_certification" >Save Changes</button>
                            <a href="#"  data-dismiss="modal">No , Cancel</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- skills modal -->
    <div class="reg_head_modal_jobeefratres">
        <!-- Modal -->
        <div class="modal fade" id="skillsfratres" tabindex="-1" role="dialog" aria-labelledby="certificationfratresTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="certificationfratresTitle"><span><i class="fas fa-chart-bar"></i></span>Skills</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{url('seeker/cv-maker/save_skills')}}" id="save_skills">
                    <div class="modal-body">
                        

                            @csrf
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="inputEmail4">Main Skills &amp; Languages</label>
                                </div>
                                {{--selectpicker--}}
                                <textarea name='skills' placeholder='Skills' class="width-100">{{ $selectedskills }}</textarea>

                                <p><small class="l-gray">press 'enter' after adding a skill</small></p>
                            </div>

                       
                        <div class="print-error-msg col-md-10" style="display:none;padding-left: 0px">

                            <ul class=" errors"></ul>
                        </div>
                        <div class="print-success-msg col-md-10" style="display:none;padding-left: 0px">
                            <p class="success-para"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="fratres_jobee_edit_btm">
                            
                            <button type="button" class="btn btn-primary save_skills" >Save Changes</button>
                            <a href="#"  data-dismiss="modal">No , Cancel</a>

                        </div>
                    </div>
                     </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Hobbies modal -->
    <div class="reg_head_modal_jobeefratres">
        <!-- Modal -->
        <div class="modal fade" id="hobbiesfratres" tabindex="-1" role="dialog" aria-labelledby="certificationfratresTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="certificationfratresTitle"><span><i class="fas fa-chart-bar"></i></span>Hobbies / Activities</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="#" id="save_hobbies">

                            @csrf
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="hobbies">Hobbies / Activities</label>
                                </div>
                                <input name="hobbies" value="{{$seeker->hobbies}}" id="hobbies" class="form-control" />
                                <p><small class="l-gray">press 'enter' after adding a hobby</small></p>
                            </div>

                        </form>
                        <div class="print-error-msg col-md-10" style="display:none;padding-left: 0px">

                            <ul class=" errors"></ul>
                        </div>
                        <div class="print-success-msg col-md-10" style="display:none;padding-left: 0px">
                            <p class="success-para"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="fratres_jobee_edit_btm">
                            <button type="button" class="btn btn-primary save_hobbies" >Save Changes</button>
                            <a href="#"  data-dismiss="modal">No , Cancel</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- language modal -->
    <div class="reg_head_modal_jobeefratres">
        <!-- Modal -->
        <div class="modal fade" id="languagefratres" tabindex="-1" role="dialog" aria-labelledby="certificationfratresTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="certificationfratresTitle"><span><i class="fas fa-chart-bar"></i></span>Add Language </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="#" id="save_language">

                            @csrf
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="save_language">Add Languages <small>(english, arabic,turkish )</small></label>
                                </div>
                                <input name="languages_input" value="{{$seeker->languages}}" id="save_language" class="form-control" />
                                <p><small class="l-gray">press 'enter' after adding a language</small></p>
                            </div>

                        </form>
                        <div class="print-error-msg col-md-10" style="display:none;padding-left: 0px">

                            <ul class=" errors"></ul>
                        </div>
                        <div class="print-success-msg col-md-10" style="display:none;padding-left: 0px">
                            <p class="success-para"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="fratres_jobee_edit_btm">
                            <button type="button" class="btn btn-primary save_language" >Save Changes</button>
                            <a href="#"  data-dismiss="modal">No , Cancel</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!--registration-->
    <div class="reg_head_modal_jobeefratres">


        <!-- Modal -->
        <div class="modal fade" id="workexpfratres" tabindex="-1" role="dialog" aria-labelledby="workexpfratresTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="workexpfratresTitle"><span><i class="fas fa-list"></i></span>Work Experience</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('seeker/cv-maker/save_experience')}}" method="post" id="save_experience">
                            <input type="hidden" name="experience_id" class="experience_id">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="jobtitle">Job title</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Job title" name="job_title">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="Company"> Company</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Job title" name="company">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="jobtitle">Reference Email</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Reference Email" name="reference_email">
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-4">
                                    <label for="Company"> Reference Number</label>
                                    <input type="text" class="form-control" name="reference_number" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Reference Number">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="start_date"> Start Date</label>
                                    <input type="date" class="form-control" id="start_date" aria-describedby="emailHelp" placeholder="Job title" name="date_start"  max="{{date("Y-m-d")}}">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="end_date"> End Date</label>
                                    <input type="date" class="form-control" id="end_date" aria-describedby="emailHelp" placeholder="Job title" name="date_end" max="{{date("Y-m-d")}}">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="Company"> City</label>
                                    <input type="text" class="form-control" name="job_city" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="city">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="Company"> Country</label>
                                    <input type="text" class="form-control" name="job_country" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="country">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <textarea name="description" id="description_experience" class="tiny" cols="30" rows="10"></textarea>

                                </div>
                            </div>
                        </form>
                        <div class="print-error-msg col-md-10" style="display:none;padding-left: 0px">

                            <ul class=" errors"></ul>
                        </div>
                        <div class="print-success-msg col-md-10" style="display:none;padding-left: 0px">
                            <p class="success-para"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="fratres_jobee_edit_btm">
                            <button type="button" class="btn btn-primary save_experience">Save Changes</button>

                            <a href="#"  data-dismiss="modal">No , Cancel</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/end-->

    <!--registration-->
    <div class="reg_head_modal_jobeefratres">


        <!-- Modal -->
        <div class="modal fade" id="projectsratres" tabindex="-1" role="dialog" aria-labelledby="projectsTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="projectsfratresTitle"><span><i class="fas fa-list"></i></span>Projects</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{url('seeker/cv-maker/save_project')}}" id="save_project" >
                            <input type="hidden" name="project_id" class="project_id">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="jobtitle">Project Title</label>
                                    <input type="text" class="form-control" name="project_title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Project Title">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="Company"> Company</label>
                                    <input type="text" name="company" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="jobtitle">Project URL</label>
                                    <input type="text" name="project_url" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Web Link">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="start_date"> Start Date</label>
                                    <input type="date" class="form-control" id="start_date" aria-describedby="emailHelp" placeholder="Job title" name="date_start">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="end_date"> End Date</label>
                                    <input type="date" class="form-control" id="end_date" aria-describedby="emailHelp" placeholder="Job title" name="date_end" max="{{date("Y-m-d")}}">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="Company"> Client/Customer Name</label>
                                    <input type="text" name="client_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Full Name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="Company"> Client/Customer URL</label>
                                    <input type="text" name="client_url" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email or Weblink">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <textarea name="description" id="description_project" class="tiny" cols="30" rows="10"></textarea>

                                </div>
                            </div>
                        </form>
                        <div class="print-error-msg col-md-10" style="display:none;padding-left: 0px">

                            <ul class=" errors"></ul>
                        </div>
                        <div class="print-success-msg col-md-10" style="display:none;padding-left: 0px">
                            <p class="success-para"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="fratres_jobee_edit_btm">
                            <button type="button" class="btn btn-primary save_project">Save Changes</button>

                            <a href="#"  data-dismiss="modal">No , Cancel</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/end-->


    <!--registration-->
    <div class="reg_head_modal_jobeefratres">


        <!-- Modal -->
        <div class="modal fade" id="summaryfratres" tabindex="-1" role="dialog" aria-labelledby="summaryfratresTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="summaryfratresTitle"><span><i class="fas fa-file"></i></span>Summary</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('seeker/cv-maker/update_account')}}" id="update-summary" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <textarea name="summary" class="form-control hover-me"  cols="30" rows="10"> {{ $seeker->summary  }}</textarea>

                                </div>
                            </div>
                        </form>
                        <div class="print-error-msg col-md-10" style="display:none;padding-left: 0px">

                            <ul class=" errors"></ul>
                        </div>
                        <div class="print-success-msg col-md-10" style="display:none;padding-left: 0px">
                            <p class="success-para"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="fratres_jobee_edit_btm">
                            <button type="button" class="btn btn-primary save_summary" >Save Changes</button>
                            <a href="#"  data-dismiss="modal">No , Cancel</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/end-->



    <!--registration-->
    <div class="reg_head_modal_jobeefratres">


        <!-- Modal -->
        <div class="modal fade" id="referencesfratres" tabindex="-1" role="dialog" aria-labelledby="referencesfratresTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="referencesfratresTitle"><span><i class="fas fa-users"></i></span>References</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="save_reference">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Name</label>
                                    <input type="text" name="name" class="form-control" id="inputEmail4">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Company</label>
                                    <input type="text" name="company" class="form-control" id="inputEmail4">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Email</label>
                                    <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Date/month">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Contact No</label>
                                    <input type="tel" name="contact_no" class="form-control" id="inputEmail4">
                                </div>
                            </div>
                        </form>
                        <div class="print-error-msg col-md-10" style="display:none;padding-left: 0px">

                            <ul class=" errors"></ul>
                        </div>
                        <div class="print-success-msg col-md-10" style="display:none;padding-left: 0px">
                            <p class="success-para"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="fratres_jobee_edit_btm">
                            <button type="button" class="btn btn-primary save_reference" >Save Changes</button>
                            <a href="#"  data-dismiss="modal">No , Cancel</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/end-->





    <!--registration-->
    <div class="reg_head_modal_jobeefratres">


        <!-- Modal -->
        <div class="modal fade" id="publiclinkedit" tabindex="-1" role="dialog" aria-labelledby="publiclinkeditTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="publiclinkeditTitle"><span><i class="fas fa-link"></i></span>Public Profile Links</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Enhance your career by creating a custom URL for your Fratres public profile.</label>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">User Name</label>
                                    <input type="text" placeholder="ie. john doe" class="form-control username_input" id="inputEmail4" >
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="exampleInputPassword1">Public URL Links</label>

                                    <div class="public-nav2">
                                        <a href="#">{{url('seeker-profile/')}}/<span class="username"></span> </a>
                                    </div>

                                </div>
                            </div>

                        </form>
                        <div class="print-error-msg col-md-10" style="display:none;padding-left: 0px">

                            <p class="error-para"></p>
                        </div>
                        <div class="print-success-msg col-md-10" style="display:none;padding-left: 0px">
                            <p class="success-para"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="fratres_jobee_edit_btm">
                            <button type="button" class="btn btn-primary check_availability">Check Availability  </button>
                            <!-- <a href="#"  data-dismiss="modal">No , Cancel</button> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/end-->
    <!--registration-->






    <div class="reg_head_modal_jobeefratres">


        <!-- Modal -->
        <div class="modal fade" id="edu_jobeefratresmain" tabindex="-1" role="dialog" aria-labelledby="edu_jobeefratresmainTitle" aria-hidden="true">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edu_jobeefratresmainTitle"><span><i class="fas fa-graduation-cap"></i></span>Education</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form_main_info_head">
                                    <form id="save_education">
                                        <input type="hidden" name="education_id" class="education_id">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="school">School *</label>
                                                <input type="text" class="form-control" name="school" id="school" placeholder="Ex: Boston University">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="degree">Degree *</label>
                                                <input type="text" class="form-control" name="degree" id="degree" placeholder="Ex: Bachelor's">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="study_field"> Field of study *</label>
                                                <input type="text" class="form-control" name="study_field" id="study_field" placeholder="Ex: Business">

                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="year"> Year Completion *</label>
                                                <select name="year" id="year" class="form-control">
                                                    @php $year = date("Y"); @endphp
                                                    @for($i=0;$i<=100;$i++)
                                                        <option value="{{$year}}">{{$year}}</option>
                                                        @php $year--; @endphp
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label for="grade"> Grade *</label>
                                                <input type="text" name="grade" class="form-control" id="grade" placeholder="">


                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="location"> Location *</label>
                                                <input type="text" class="form-control" name="location" id="location" placeholder="">
                                            </div>
                                            <div class="print-error-msg col-md-10" style="display:none;padding-left: 0px">

                                                <ul class=" errors"></ul>
                                            </div>
                                            <div class="print-success-msg col-md-10" style="display:none;padding-left: 0px">
                                                <p class="success-para"></p>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="fratres_jobee_edit_btm">
                            <button type="button" class="btn btn-primary save_education" >Save</button>

                            <a href="#"  data-dismiss="modal"> Cancel</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/end-->

    <div class="">


        <!-- Modal -->
        <div class="modal fade" id="download-cv-templates" tabindex="-1" role="dialog" aria-labelledby="edu_jobeefratresmainTitle" aria-hidden="true">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="padding:1rem;">
                        <h5 class="modal-title " id="edu_jobeefratresmainTitle"><span><i class="fas fa-download"></i></span> Download CV in your desired Template</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            @if( $seeker->cv_download_inputs() )
                                <br>
                                <div class="alert alert-danger margin-20" style="width:100%;" role="alert">
                                    Please Complete Your Profile Before Proceeding Download...
                                </div>
                                <div class="alert alert-info margin-20" role="alert" style="width:100%;">

                                    <b>Please fill in below inputs : </b>
                                    <ul style="list-style-type: none;">

                                        @foreach($seeker->cv_download_inputs() as $seeker_missing_val)
                                            <li> - {{$seeker_missing_val}}</li>
                                        @endforeach
                                    </ul>
                                </div>

                            @else

                            <div class="col-lg-6 img-template">
                                <a href="{{url('/seeker/cv-maker/cv-download/template-1')}}" target="_blank">
                                <img src="{{asset('seekers/cv-templates/template-1.png')}}" alt=""  class="template" data-template="template-1" width="120">
                                </a>

                            </div>
                            <div class="col-lg-6 img-template">
                                <a href="{{url('/seeker/cv-maker/cv-download/template-2')}}" target="_blank">
                                <img src="{{asset('seekers/cv-templates/template-2.png')}}" alt="" width="120">
                                </a>

                            </div>
                            <div class="col-lg-6 img-template">
                                <a href="{{url('seeker/cv-maker/cv-download/template-3')}}" target="_blank">
                                <img src="{{asset('seekers/cv-templates/template-3.jpg')}}" alt="" width="140">
                                </a>
                            </div>
                            <div class="col-lg-6 img-template">
                                <a href="{{url('seeker/cv-maker/cv-download/template-4')}}" target="_blank">
                                <img src="{{asset('seekers/cv-templates/template-4.png')}}" alt="" width="120">
                                </a>
                            </div>
                            <div class="col-lg-12 img-template">
                                <a href="{{url('seeker/cv-maker/cv-download/template-5')}}" target="_blank">
                                <img src="{{asset('seekers/cv-templates/template-5.png')}}" alt="" width="120">
                                </a>
                            </div>

                            @endif


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--/end-->



    {{--modals--}}
@endsection
@section('scripts')
    <script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/5/tinymce.min.js"></script>
    <script src="{{url('/js/seeker_dashboard.js')}}"></script>
    <script src="{{url('/js/seeker/seeker_cv_maker.js?ver=2.1')}}"></script>


    <script>

        var skills = '{!! $skills !!}';
        var count = '{!! $count !!}';

        skills = JSON.parse(skills);
        
        var whitelist = [];

        console.log(skills[6])
        for(var i = 0; i < count; i++) {
            // var obj = {}; 

            // obj['id'] = skills[i].id;
            // obj['value'] = skills[i].value;
            whitelist.push({ id: skills[i].id, value : skills[i].value });
            // console.log(skills[i].id)

        }
        
        console.log(whitelist)

        var input = document.querySelector('textarea[name=skills]')

        var tagify = new Tagify(input, {
                enforceWhitelist: false,
                delimiters: null,
                whitelist: whitelist,
                callbacks: {
                    add: console.log,  // callback when adding a tag
                    remove: console.log   // callback when removing a tag
                }
        })




        $(document).on("change", "#fileToUpload", function () {
            alert();
            $('#profile_avatar').submit();

        });

        $(document).on("change", "#imageUpload", function () {
            // alert();
            $('#profile_avatar').submit();

        });

        function resetForm() {
            $("#save_education")[0].reset();
        }

        $(function() {

            $(".progress-round").each(function() {

                var value = $(this).attr('data-value');
                var left = $(this).find('.progress-left .progress-bar');
                var right = $(this).find('.progress-right .progress-bar');

                if (value > 0) {
                    if (value <= 50) {
                        right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
                    } else {
                        right.css('transform', 'rotate(180deg)')
                        left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
                    }
                }

            })

            function percentageToDegrees(percentage) {

                return percentage / 100 * 360

            }

        });

        $(document).on("click", ".template", function () {
            // var template = $(this).attr("data-template");


        });

        function convertToSlug(Text)
        {
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g,'')
                .replace(/ +/g,'-')
                ;
        }







        tinymce.init({
            selector: 'textarea.tiny',
            menubar: false,
        });

        // The DOM element you wish to replace with Tagify
        var input = document.querySelector('input[name=hobbies]');
        // initialize Tagify on the above input node reference
        new Tagify(input)


        var input = document.querySelector('input[name=languages_input]');
        new Tagify(input)

    </script>
@endsection