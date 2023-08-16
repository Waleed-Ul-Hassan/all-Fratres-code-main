@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add Keywords</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Keywords</li>
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
                <form method="post" action="{{url('admin/seo')}}">
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
                                        <input type="text" class="form-control" name="page_title"
                                               placeholder="e.g Page Tilte" id="page_title">
                                    </div>



                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Page Key</label>
                                        <select class="form-control select2" name="page_key">
                                            <option value="homepage">homepage</option>
                                            <option value="companies">companies</option>
                                            <option value="login_seeker">login_seeker</option>
                                            <option value="signup_seeker">signup_seeker</option>
                                            <option value="login_recruiter">login_recruiter</option>
                                            <option value="signup_recruiter">signup_recruiter</option>
                                            <option value="post_job">post_job</option>
                                            <option value="job_alert">job_alert</option>
                                            <option value="reset_password">reset_password</option>
                                            <option value="about">about</option>
                                            <option value="privacy">privacy</option>
                                            <option value="terms">terms</option>
                                            <option value="network">network</option>
                                            <option value="ppc">ppc</option>
                                            <option value="career_advice">career advice</option>
                                            <option value="recruiter_applications_index">recruiter_applications_index</option>
                                            <option value="reset_pass_recruiter">reset_pass_recruiter</option>
                                            <option value="recruiter_buycredits_billing">recruiter_buycredits_billing</option>
                                            <option value="recruiter_buycredits_index">recruiter_buycredits_index</option>
                                            <option value="recruiter_buycredits_thankyou">recruiter_buycredits_thankyou</option>
                                            <option value="recruiter_index">recruiter_index</option>
                                            <option value="recruiter_invoice_index">recruiter_invoice_index</option>
                                            <option value="recruiter_job_billing">recruiter_job_billing</option>
                                            <option value="recruiter_jobpost">recruiter_jobpost</option>
                                            <option value="recruiter_job_payment">recruiter_job_payment</option>
                                            <option value="recruiter_job_preview">recruiter_job_preview</option>
                                            <option value="recruiter_job_thankyou">recruiter_job_thankyou</option>
                                            <option value="recruiter_manage_job_index">recruiter_manage_job_index</option>
                                            <option value="recruiter_notifications">recruiter_notifications</option>
                                            <option value="recruiter_profile_billing">recruiter_profile_billing</option>
                                            <option value="recruiter_profile_index">recruiter_profile_index</option>
                                            <option value="recruiter_stat_index">recruiter_stat_index</option>
                                            <option value="recruiter_stat">recruiter_stat</option>
                                            <option value="recruiter_team_add">recruiter_team_add</option>
                                            <option value="recruiter_team">recruiter_team</option>
                                            <option value="seeker_alert">seeker_alert</option>
                                            <option value="seeker_cvmaker">seeker_cvmaker</option>
                                            <option value="seeker_cvmaker_profile">seeker_cvmaker_profile</option>
                                            <option value="seeker_dashboard">seeker_dashboard</option>
                                            <option value="seeker_notifications">seeker_notifications</option>
                                            <option value="seeker_profile">seeker_profile</option>
                                            <option value="seeker_thankyou">seeker_thankyou</option>
                                            <option value="contact">contact</option>
                                            <option value="cv_search_index">cv_search_index</option>
                                            <option value="job_detail_description">job_detail_description</option>
                                            <option value="seeker_dashboard">seeker_dashboard</option>
                                            <option value="job_listing">job_listing</option>
                                            <option value="job_detail">job_detail</option>
                                            <option value="search">search</option>
                                            <option value="saved_jobs">saved_jobs</option>
                                            <option value="view_job_alert">view_job_alert</option>
                                            @foreach($locations as $location)
                                                <option value="{{$location->city_slug}}_location">{{$location->name}} Location</option>
                                            @endforeach
                                            @foreach($industries as $industry)
                                                <option value="{{$industry->industry_slug}}_industry">{{$industry->name}} Industry</option>
                                            @endforeach
                                        </select>
                                    </div>



                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Meta Key</label>
                                        <input type="text" class="form-control" name="meta_key"
                                               placeholder="e.g Meta Key" id="homepage_meta_key">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Meta Title</label>
                                        <input type="text" class="form-control" name="meta_title"
                                               placeholder="e.g Meta Title" id="homepage_meta_title">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Meta Description</label>
                                        <textarea class="form-control" name="meta_description"
                                                  placeholder="e.g Meta Description" id="homepage_meta_description"></textarea>

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