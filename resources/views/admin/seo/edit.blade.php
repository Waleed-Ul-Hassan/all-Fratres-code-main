@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Update Keywords</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Update Keywords</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <form method="post" action="{{url('admin/update-seo')}}">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Meta Details
                                    </h3>
                                </div>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Page Tilte</label>
                                        <input type="text" value="{{$edit->page_title}}" class="form-control"
                                               name="page_title"
                                               placeholder="e.g Page Tilte" id="page_title">
                                    </div>


                                    <input type="hidden" value="{{$edit->id}}" name="id" id="id">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Page Key</label>
                                        <select class="form-control select2" name="page_key">
                                            <option value="homepage" {{ ( $edit->page_key == "homepage") ? 'selected' : '' }}>
                                                homepage
                                            </option>
                                            <option value="companies" {{ ( $edit->page_key == "companies") ? 'selected' : '' }}>
                                                companies
                                            </option>

                                            <option value="login_seeker" {{ ( $edit->page_key == "login_seeker") ? 'selected' : '' }}>
                                                login_seeker
                                            </option>
                                            <option value="signup_seeker" {{( $edit->page_key == "signup_seeker") ? 'selected' : '' }}>
                                                signup_seeker
                                            </option>
                                            <option value="login_recruiter" {{( $edit->page_key == "login_recruiter") ? 'selected' : '' }}>
                                                login_recruiter
                                            </option>
                                            <option value="signup_recruiter" {{( $edit->page_key == "signup_recruiter") ? 'selected' : '' }}>
                                                signup_recruiter
                                            </option>
                                            <option value="post_job" {{( $edit->page_key == "post_job") ? 'selected' : '' }}>
                                                post_job
                                            </option>
                                            <option value="job_alert" {{( $edit->page_key == "job_alert") ? 'selected' : '' }}>
                                                job_alert
                                            </option>
                                            <option value="career_advice" {{( $edit->page_key == "career_advice") ? 'selected' : '' }}>career advice</option>
                                            <option value="reset_password" {{( $edit->page_key == "reset_password") ? 'selected' : '' }}>
                                                reset_password
                                            </option>
                                            <option value="about" {{( $edit->page_key == "about") ? 'selected' : '' }}>
                                                about
                                            </option>
                                            <option value="privacy" {{( $edit->page_key == "privacy") ? 'selected' : '' }}>
                                                privacy
                                            </option>
                                            <option value="terms" {{( $edit->page_key == "terms") ? 'selected' : '' }}>
                                                terms
                                            </option>
                                            <option value="network" {{( $edit->page_key == "network") ? 'selected' : '' }}>
                                                network
                                            </option>
                                            <option value="ppc" {{( $edit->page_key == "ppc") ? 'selected' : '' }}>ppc
                                            </option>
                                            <option value="recruiter_applications_index" {{( $edit->page_key == "recruiter_applications_index") ? 'selected' : '' }}>recruiter_applications_index
                                            </option>
                                            <option value="reset_pass_recruiter" {{( $edit->page_key == "reset_pass_recruiter") ? 'selected' : '' }}>reset_pass_recruiter</option>
                                            <option value="recruiter_buycredits_billing" {{( $edit->page_key == "recruiter_buycredits_billing") ? 'selected' : '' }}>recruiter_buycredits_billing
                                            </option>
                                            <option value="recruiter_buycredits_index" {{( $edit->page_key == "recruiter_buycredits_index") ? 'selected' : '' }}>recruiter_buycredits_index
                                            </option>
                                            <option value="recruiter_buycredits_thankyou" {{( $edit->page_key == "recruiter_buycredits_thankyou") ? 'selected' : '' }}>
                                                recruiter_buycredits_thankyou
                                            </option>
                                            <option value="recruiter_index" {{( $edit->page_key == "recruiter_index") ? 'selected' : '' }}>recruiter_index</option>
                                            <option value="recruiter_invoice_index" {{( $edit->page_key == "recruiter_invoice_index") ? 'selected' : '' }}>recruiter_invoice_index</option>
                                            <option value="recruiter_job_billing" {{( $edit->page_key == "recruiter_job_billing") ? 'selected' : '' }}>recruiter_job_billing</option>
                                            <option value="recruiter_jobpost" {{( $edit->page_key == "recruiter_jobpost") ? 'selected' : '' }}>recruiter_jobpost</option>
                                            <option value="recruiter_job_payment" {{( $edit->page_key == "recruiter_job_payment") ? 'selected' : '' }}>recruiter_job_payment</option>
                                            <option value="recruiter_job_preview" {{( $edit->page_key == "recruiter_job_preview") ? 'selected' : '' }}>recruiter_job_preview</option>
                                            <option value="recruiter_job_thankyou" {{( $edit->page_key == "recruiter_job_thankyou") ? 'selected' : '' }}>recruiter_job_thankyou</option>
                                            <option value="recruiter_manage_job_index" {{( $edit->page_key == "recruiter_manage_job_index") ? 'selected' : '' }}>recruiter_manage_job_index
                                            </option>
                                            <option value="recruiter_notifications" {{( $edit->page_key == "recruiter_notifications") ? 'selected' : '' }}>recruiter_notifications</option>
                                            <option value="recruiter_profile_billing" {{( $edit->page_key == "recruiter_profile_billing") ? 'selected' : '' }}>recruiter_profile_billing</option>
                                            <option value="recruiter_profile_index" {{( $edit->page_key == "recruiter_profile_index") ? 'selected' : '' }}>recruiter_profile_index</option>
                                            <option value="recruiter_stat_index" {{( $edit->page_key == "recruiter_stat_index") ? 'selected' : '' }}>recruiter_stat_index</option>
                                            <option value="recruiter_stat" {{( $edit->page_key == "recruiter_stat") ? 'selected' : '' }}>recruiter_stat</option>
                                            <option value="recruiter_team_add" {{( $edit->page_key == "recruiter_team_add") ? 'selected' : '' }}>recruiter_team_add</option>
                                            <option value="recruiter_team" {{( $edit->page_key == "recruiter_team") ? 'selected' : '' }}>recruiter_team</option>
                                            <option value="seeker_alert" {{( $edit->page_key == "seeker_alert") ? 'selected' : '' }}>seeker_alert</option>
                                            <option value="seeker_cvmaker" {{( $edit->page_key == "seeker_cvmaker") ? 'selected' : '' }}>seeker_cvmaker</option>
                                            <option value="seeker_cvmaker_profile" {{( $edit->page_key == "seeker_cvmaker_profile") ? 'selected' : '' }}>seeker_cvmaker_profile</option>
                                            <option value="seeker_dashboard" {{( $edit->page_key == "seeker_dashboard") ? 'selected' : '' }}>seeker_dashboard</option>
                                            <option value="seeker_notifications" {{( $edit->page_key == "ppc") ? 'selected' : '' }}>seeker_notifications</option>
                                            <option value="seeker_profile" {{( $edit->page_key == "seeker_profile") ? 'selected' : '' }}>seeker_profile</option>
                                            <option value="seeker_thankyou" {{( $edit->page_key == "seeker_thankyou") ? 'selected' : '' }}>seeker_thankyou</option>
                                            <option value="contact" {{( $edit->page_key == "contact") ? 'selected' : '' }}>contact</option>
                                            <option value="cv_search_index" {{( $edit->page_key == "cv_search_index") ? 'selected' : '' }}>cv_search_index</option>
                                            <option value="job_detail_description" {{( $edit->page_key == "job_detail_description") ? 'selected' : '' }}>job_detail_description</option>
                                            <option value="seeker_dashboard" {{( $edit->page_key == "seeker_dashboard") ? 'selected' : '' }}>seeker_dashboard</option>
                                            <option value="job_listing" {{( $edit->page_key == "job_listing") ? 'selected' : '' }}>job_listing</option>
                                            <option value="job_detail" {{( $edit->page_key == "job_detail") ? 'selected' : '' }}>job_detail</option>
                                            <option value="search" {{( $edit->page_key == "search") ? 'selected' : '' }}>search</option>
                                            <option value="saved_jobs" {{( $edit->page_key == "saved_jobs") ? 'selected' : '' }}>saved_jobs</option>
                                            <option value="view_job_alert" {{( $edit->page_key == "view_job_alert") ? 'selected' : '' }}>view_job_alert</option>
                                            <option value="industries" {{( $edit->page_key == "industries") ? 'selected' : '' }}>industries</option>
                                            <option value="locations" {{( $edit->page_key == "locations") ? 'selected' : '' }}>locations</option>
                                            <option value="companies" {{( $edit->page_key == "companies") ? 'selected' : '' }}>companies</option>
                                            @foreach($locations as $location)
                                                <option value="{{$location->city_slug}}_location" {{( $edit->page_key == $location->city_slug."_location") ? 'selected' : '' }}>{{$location->name}} Location</option>
                                            @endforeach
                                            @foreach($industries as $industry)
                                                <option value="{{$industry->industry_slug}}_industry" {{( $edit->page_key == $industry->industry_slug."_industry") ? 'selected' : '' }}>{{$industry->name}} Industry</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Meta Key</label>
                                        <input type="text" value="{{$edit->meta_key}}" class="form-control"
                                               name="meta_key"
                                               placeholder="e.g Meta Key" id="homepage_meta_key">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Meta Title</label>
                                        <input type="text" value="{{$edit->meta_title}}" class="form-control"
                                               name="meta_title"
                                               placeholder="e.g Meta Title" id="homepage_meta_title">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Meta Description</label>
                                        <textarea class="form-control" name="meta_description" maxlength="1000"
                                                  placeholder="e.g Meta Description"
                                                  id="homepage_meta_description">{{$edit->meta_description}}</textarea>

                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>

                            </div>

                        </div>
                    {{--                    <div class="col-md-6">--}}
                    {{--                        <div class="card card-primary">--}}
                    {{--                            <div class="card-header">--}}
                    {{--                                <h3 class="card-title">Login for Seeker--}}
                    {{--                                </h3>--}}
                    {{--                            </div>--}}
                    {{--                            <!-- /.card-header -->--}}
                    {{--                            <!-- form start -->--}}

                    {{--                            <div class="card-body">--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Key</label>--}}
                    {{--                                    <input type="text" class="form-control" name="login_seeker_meta_key"--}}
                    {{--                                           placeholder="e.g Meta Key" id="login_seeker_meta_key">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Title</label>--}}
                    {{--                                    <input type="text" class="form-control" name="login_seeker_meta_title"--}}
                    {{--                                           placeholder="e.g Meta Title" id="login_seeker_meta_title">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Description</label>--}}
                    {{--                                    <textarea class="form-control" name="login_seeker_meta_description"--}}
                    {{--                                              placeholder="e.g Meta Description" id="login_seeker_meta_description"></textarea>--}}

                    {{--                                </div>--}}

                    {{--                            </div>--}}
                    {{--                            <!-- /.card-body -->--}}

                    {{--                            <div class="card-footer">--}}
                    {{--                                <button type="submit" onclick="save()" class="btn btn-primary">Save</button>--}}
                    {{--                            </div>--}}

                    {{--                        </div>--}}

                    {{--                    </div>--}}
                    {{--                    <div class="col-md-6">--}}
                    {{--                        <div class="card card-primary">--}}
                    {{--                            <div class="card-header">--}}
                    {{--                                <h3 class="card-title">Signup for Seeker--}}
                    {{--                                </h3>--}}
                    {{--                            </div>--}}
                    {{--                            <!-- /.card-header -->--}}
                    {{--                            <!-- form start -->--}}

                    {{--                            <div class="card-body">--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Key</label>--}}
                    {{--                                    <input type="text" class="form-control" name="signup_seeker_meta_key"--}}
                    {{--                                           placeholder="e.g Meta Key" id="signup_seeker_meta_key">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Title</label>--}}
                    {{--                                    <input type="text" class="form-control" name="signup_seeker_meta_title"--}}
                    {{--                                           placeholder="e.g Meta Title" id="signup_seeker_meta_title">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Description</label>--}}
                    {{--                                    <textarea class="form-control" name="signup_seeker_meta_description"--}}
                    {{--                                              placeholder="e.g Meta Description" id="signup_seeker_meta_description"></textarea>--}}

                    {{--                                </div>--}}

                    {{--                            </div>--}}
                    {{--                            <!-- /.card-body -->--}}

                    {{--                            <div class="card-footer">--}}
                    {{--                                <button type="submit" onclick="save()" class="btn btn-primary">Save</button>--}}
                    {{--                            </div>--}}

                    {{--                        </div>--}}

                    {{--                    </div>--}}
                    {{--                    <div class="col-md-6">--}}
                    {{--                        <div class="card card-primary">--}}
                    {{--                            <div class="card-header">--}}
                    {{--                                <h3 class="card-title">Login for Recruiter--}}
                    {{--                                </h3>--}}
                    {{--                            </div>--}}
                    {{--                            <!-- /.card-header -->--}}
                    {{--                            <!-- form start -->--}}

                    {{--                            <div class="card-body">--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Key</label>--}}
                    {{--                                    <input type="text" class="form-control" name="login_recuiter_meta_key"--}}
                    {{--                                           placeholder="e.g Meta Key" id="login_recuiter_meta_key">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Title</label>--}}
                    {{--                                    <input type="text" class="form-control" name="login_recuiter_meta_title"--}}
                    {{--                                           placeholder="e.g Meta Title" id="login_recuiter_meta_title">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Description</label>--}}
                    {{--                                    <textarea class="form-control" name="login_recuiter_meta_description"--}}
                    {{--                                              placeholder="e.g Meta Description" id="login_recuiter_meta_description"></textarea>--}}

                    {{--                                </div>--}}

                    {{--                            </div>--}}
                    {{--                            <!-- /.card-body -->--}}

                    {{--                            <div class="card-footer">--}}
                    {{--                                <button type="submit" onclick="save()" class="btn btn-primary">Save</button>--}}
                    {{--                            </div>--}}

                    {{--                        </div>--}}

                    {{--                    </div>--}}
                    {{--                    <div class="col-md-6">--}}
                    {{--                        <div class="card card-primary">--}}
                    {{--                            <div class="card-header">--}}
                    {{--                                <h3 class="card-title">Signup for Recruiter--}}
                    {{--                                </h3>--}}
                    {{--                            </div>--}}
                    {{--                            <!-- /.card-header -->--}}
                    {{--                            <!-- form start -->--}}

                    {{--                            <div class="card-body">--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Key</label>--}}
                    {{--                                    <input type="text" class="form-control" name="signup_recuiter_meta_key"--}}
                    {{--                                           placeholder="e.g Meta Key" id="signup_recuiter_meta_key">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Title</label>--}}
                    {{--                                    <input type="text" class="form-control" name="signup_recuiter_meta_title"--}}
                    {{--                                           placeholder="e.g Meta Title" id="signup_recuiter_meta_title">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Description</label>--}}
                    {{--                                    <textarea class="form-control" name="signup_recuiter_meta_description"--}}
                    {{--                                              placeholder="e.g Meta Description" id="signup_recuiter_meta_description"></textarea>--}}

                    {{--                                </div>--}}

                    {{--                            </div>--}}
                    {{--                            <!-- /.card-body -->--}}

                    {{--                            <div class="card-footer">--}}
                    {{--                                <button type="submit" onclick="save()" class="btn btn-primary">Save</button>--}}
                    {{--                            </div>--}}

                    {{--                        </div>--}}

                    {{--                    </div>--}}
                    {{--                    <div class="col-md-6">--}}
                    {{--                        <div class="card card-primary">--}}
                    {{--                            <div class="card-header">--}}
                    {{--                                <h3 class="card-title">post job--}}
                    {{--                                </h3>--}}
                    {{--                            </div>--}}
                    {{--                            <!-- /.card-header -->--}}
                    {{--                            <!-- form start -->--}}

                    {{--                            <div class="card-body">--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Key</label>--}}
                    {{--                                    <input type="text" class="form-control" name="post_job_meta_key"--}}
                    {{--                                           placeholder="e.g Meta Key" id="meta_key">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Title</label>--}}
                    {{--                                    <input type="text" class="form-control" name="post_job_meta_title"--}}
                    {{--                                           placeholder="e.g Meta Title" id="post_job_meta_title">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Description</label>--}}
                    {{--                                    <textarea class="form-control" name="post_job_meta_description"--}}
                    {{--                                              placeholder="e.g Meta Description" id="post_job_meta_description"></textarea>--}}

                    {{--                                </div>--}}

                    {{--                            </div>--}}
                    {{--                            <!-- /.card-body -->--}}

                    {{--                            <div class="card-footer">--}}
                    {{--                                <button type="submit" onclick="save()" class="btn btn-primary">Save</button>--}}
                    {{--                            </div>--}}

                    {{--                        </div>--}}

                    {{--                    </div>--}}
                    {{--                    <div class="col-md-6">--}}
                    {{--                        <div class="card card-primary">--}}
                    {{--                            <div class="card-header">--}}
                    {{--                                <h3 class="card-title">Job Alert Page--}}
                    {{--                                </h3>--}}
                    {{--                            </div>--}}
                    {{--                            <!-- /.card-header -->--}}
                    {{--                            <!-- form start -->--}}

                    {{--                            <div class="card-body">--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Key</label>--}}
                    {{--                                    <input type="text" class="form-control" name="job_alert_page_meta_key"--}}
                    {{--                                           placeholder="e.g Meta Key" id="job_alert_page_meta_key">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Title</label>--}}
                    {{--                                    <input type="text" class="form-control" name="job_alert_page_meta_title"--}}
                    {{--                                           placeholder="e.g Meta Title" id="job_alert_page_meta_title">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Description</label>--}}
                    {{--                                    <textarea class="form-control" name="job_alert_page_meta_description"--}}
                    {{--                                              placeholder="e.g Meta Description" id="job_alert_page_meta_description"></textarea>--}}

                    {{--                                </div>--}}

                    {{--                            </div>--}}
                    {{--                            <!-- /.card-body -->--}}

                    {{--                            <div class="card-footer">--}}
                    {{--                                <button type="submit" onclick="save()" class="btn btn-primary">Save</button>--}}
                    {{--                            </div>--}}

                    {{--                        </div>--}}

                    {{--                    </div>--}}
                    {{--                    <div class="col-md-6">--}}
                    {{--                        <div class="card card-primary">--}}
                    {{--                            <div class="card-header">--}}
                    {{--                                <h3 class="card-title">Reset Password page--}}
                    {{--                                </h3>--}}
                    {{--                            </div>--}}
                    {{--                            <!-- /.card-header -->--}}
                    {{--                            <!-- form start -->--}}

                    {{--                            <div class="card-body">--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Key</label>--}}
                    {{--                                    <input type="text" class="form-control" name="reset_password_page_meta_key"--}}
                    {{--                                           placeholder="e.g Meta Key" id="reset_password_page_meta_key">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Title</label>--}}
                    {{--                                    <input type="text" class="form-control" name="reset_password_page_meta_title"--}}
                    {{--                                           placeholder="e.g Meta Title" id="reset_password_page_meta_title">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Description</label>--}}
                    {{--                                    <textarea class="form-control" name="reset_password_page_meta_description"--}}
                    {{--                                              placeholder="e.g Meta Description" id="reset_password_page_meta_description"></textarea>--}}

                    {{--                                </div>--}}

                    {{--                            </div>--}}
                    {{--                            <!-- /.card-body -->--}}

                    {{--                            <div class="card-footer">--}}
                    {{--                                <button type="submit" onclick="save()" class="btn btn-primary">Save</button>--}}
                    {{--                            </div>--}}

                    {{--                        </div>--}}

                    {{--                    </div>--}}
                    {{--                    <div class="col-md-6">--}}
                    {{--                        <div class="card card-primary">--}}
                    {{--                            <div class="card-header">--}}
                    {{--                                <h3 class="card-title">About</h3>--}}
                    {{--                            </div>--}}
                    {{--                            <!-- /.card-header -->--}}
                    {{--                            <!-- form start -->--}}

                    {{--                            <div class="card-body">--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Key</label>--}}
                    {{--                                    <input type="text" class="form-control" name="about_meta_key"--}}
                    {{--                                           placeholder="e.g Meta Key" id="about_meta_key">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Title</label>--}}
                    {{--                                    <input type="text" class="form-control" name="about_meta_title"--}}
                    {{--                                           placeholder="e.g Meta Title" id="about_meta_title">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Description</label>--}}
                    {{--                                    <textarea class="form-control" name="about_meta_description"--}}
                    {{--                                              placeholder="e.g Meta Description" id="about_meta_description"></textarea>--}}

                    {{--                                </div>--}}

                    {{--                            </div>--}}
                    {{--                            <!-- /.card-body -->--}}

                    {{--                            <div class="card-footer">--}}
                    {{--                                <button type="submit" onclick="save()" class="btn btn-primary">Save</button>--}}
                    {{--                            </div>--}}

                    {{--                        </div>--}}

                    {{--                    </div>--}}
                    {{--                    <div class="col-md-6">--}}
                    {{--                        <div class="card card-primary">--}}
                    {{--                            <div class="card-header">--}}
                    {{--                                <h3 class="card-title">Privacy--}}
                    {{--                                </h3>--}}
                    {{--                            </div>--}}
                    {{--                            <!-- /.card-header -->--}}
                    {{--                            <!-- form start -->--}}

                    {{--                            <div class="card-body">--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Key</label>--}}
                    {{--                                    <input type="text" class="form-control" name="privacy_meta_key"--}}
                    {{--                                           placeholder="e.g Meta Key" id="privacy_meta_key">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Title</label>--}}
                    {{--                                    <input type="text" class="form-control" name="privacy_meta_title"--}}
                    {{--                                           placeholder="e.g Meta Title" id="privacy_meta_title">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Description</label>--}}
                    {{--                                    <textarea class="form-control" name="privacy_meta_description"--}}
                    {{--                                              placeholder="e.g Meta Description" id="privacy_meta_description"></textarea>--}}

                    {{--                                </div>--}}

                    {{--                            </div>--}}
                    {{--                            <!-- /.card-body -->--}}

                    {{--                            <div class="card-footer">--}}
                    {{--                                <button type="submit" onclick="save()" class="btn btn-primary">Save</button>--}}
                    {{--                            </div>--}}

                    {{--                        </div>--}}

                    {{--                    </div>--}}
                    {{--                    <div class="col-md-6">--}}
                    {{--                        <div class="card card-primary">--}}
                    {{--                            <div class="card-header">--}}
                    {{--                                <h3 class="card-title">Terms & Conditions--}}
                    {{--                                </h3>--}}
                    {{--                            </div>--}}
                    {{--                            <!-- /.card-header -->--}}
                    {{--                            <!-- form start -->--}}

                    {{--                            <div class="card-body">--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Key</label>--}}
                    {{--                                    <input type="text" class="form-control" name="terms_conditions_meta_key"--}}
                    {{--                                           placeholder="e.g Meta Key" id="terms_conditions_meta_key">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Title</label>--}}
                    {{--                                    <input type="text" class="form-control" name="terms_conditions_meta_title"--}}
                    {{--                                           placeholder="e.g Meta Title" id="terms_conditions_meta_title">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Description</label>--}}
                    {{--                                    <textarea class="form-control" name="terms_conditions_meta_description"--}}
                    {{--                                              placeholder="e.g Meta Description" id="terms_conditions_meta_description"></textarea>--}}

                    {{--                                </div>--}}

                    {{--                            </div>--}}
                    {{--                            <!-- /.card-body -->--}}

                    {{--                            <div class="card-footer">--}}
                    {{--                                <button type="submit" onclick="save()" class="btn btn-primary">Save</button>--}}
                    {{--                            </div>--}}

                    {{--                        </div>--}}

                    {{--                    </div>--}}
                    {{--                    <div class="col-md-6">--}}
                    {{--                        <div class="card card-primary">--}}
                    {{--                            <div class="card-header">--}}
                    {{--                                <h3 class="card-title">Network Sites--}}
                    {{--                                </h3>--}}
                    {{--                            </div>--}}
                    {{--                            <!-- /.card-header -->--}}
                    {{--                            <!-- form start -->--}}

                    {{--                            <div class="card-body">--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Key</label>--}}
                    {{--                                    <input type="text" class="form-control" name="network_sites_meta_key"--}}
                    {{--                                           placeholder="e.g Meta Key" id="network_sites_meta_key">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Title</label>--}}
                    {{--                                    <input type="text" class="form-control" name="network_sites_meta_title"--}}
                    {{--                                           placeholder="e.g Meta Title" id="network_sites_meta_title">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Description</label>--}}
                    {{--                                    <textarea class="form-control" name="network_sites_meta_description"--}}
                    {{--                                              placeholder="e.g Meta Description" id="network_sites_meta_description"></textarea>--}}

                    {{--                                </div>--}}

                    {{--                            </div>--}}
                    {{--                            <!-- /.card-body -->--}}

                    {{--                            <div class="card-footer">--}}
                    {{--                                <button type="submit" onclick="save()" class="btn btn-primary">Save</button>--}}
                    {{--                            </div>--}}

                    {{--                        </div>--}}

                    {{--                    </div>--}}
                    {{--                    <div class="col-md-6">--}}
                    {{--                        <div class="card card-primary">--}}
                    {{--                            <div class="card-header">--}}
                    {{--                                <h3 class="card-title">PPC--}}
                    {{--                                </h3>--}}
                    {{--                            </div>--}}
                    {{--                            <!-- /.card-header -->--}}
                    {{--                            <!-- form start -->--}}

                    {{--                            <div class="card-body">--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Key</label>--}}
                    {{--                                    <input type="text" class="form-control" name="ppc_meta_key"--}}
                    {{--                                           placeholder="e.g Meta Key" id="ppc_meta_key">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Title</label>--}}
                    {{--                                    <input type="text" class="form-control" name="ppc_meta_title"--}}
                    {{--                                           placeholder="e.g Meta Title" id="ppc_meta_title">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <label for="exampleInputEmail1">Meta Description</label>--}}
                    {{--                                    <textarea class="form-control" name="ppc_meta_description"--}}
                    {{--                                              placeholder="e.g Meta Description" id="ppc_meta_description"></textarea>--}}

                    {{--                                </div>--}}

                    {{--                            </div>--}}
                    {{--                            <!-- /.card-body -->--}}

                    {{--                            <div class="card-footer">--}}
                    {{--                                <button type="submit" onclick="save()" class="btn btn-primary">Save</button>--}}
                    {{--                            </div>--}}

                    {{--                        </div>--}}

                    {{--                    </div>--}}


                    <!-- ./col -->
                    </div>
                </form>
            </div>
        </section>
        <!-- /.content -->
    </div>


    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>


@endsection