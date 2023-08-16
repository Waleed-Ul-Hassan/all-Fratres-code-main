@extends('admin.layout.main')

@section('content')
    <style>
        label:not(.form-check-label):not(.custom-file-label) {
             font-weight: normal !important;
        }
    </style>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Admin Settings</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
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
                <form method="post" action="{{url('admin/settings')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Website Settings</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <div class="form-group">
                                    Goolge Translator
                                    <input type="checkbox" name="google_translator" value="1"
                                           @if($settings->google_translator == 1) checked
                                           @endif data-bootstrap-switch data-off-color="danger"
                                           data-on-color="success">
                                    </div>
<hr>
                                    <p>
                                        Enable Language
                                        <input type="checkbox" name="enable_language" value="1"
                                               @if($settings->enable_language == 1) checked
                                               @endif data-bootstrap-switch data-off-color="danger"
                                               data-on-color="success">
                                    <hr>
                                    </p>


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Language Code</label>
                                        <input type="text" class="form-control" name="language_code"
                                               placeholder="e.g Language Code" id="language_code"
                                               value="{{$settings->language_code}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Website Title</label>
                                        <input type="text" class="form-control" name="website_title"
                                               placeholder="e.g Fratres" id="website_title"
                                               value="{{$settings->website_title}}">
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputPassword1">Phone</label>
                                            <input type="text" class="form-control" name="phone"
                                                   placeholder="e.g 123456" id="phone" value="{{$settings->phone}}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="exampleInputPassword1">Email</label>
                                            <input type="text" class="form-control" name="email"
                                                   placeholder="e.g abc@gmail.com" id="email" value="{{$settings->email}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Addrees</label>
                                        <textarea name="addrees" placeholder="e.g St # 1" class="form-control" cols="30"
                                                  rows="4">{{$settings->addrees}}</textarea>

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">About</label>
                                        <textarea name="about" placeholder="e.g About" class="form-control" cols="30"
                                                  rows="4">{{$settings->about}}</textarea>

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Country</label>
                                        <select name="country" id="" class="form-control">
                                            @foreach ($flags as $flag)
                                                <option value="{{strtoupper(str_replace('.fratres.net','',$flag->url))}}"
                                                        @if($settings->country_code == strtoupper(str_replace('.fratres.net','',$flag->url))) selected @endif>{{$flag->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">

                                            <label for="exampleInputPassword1">Currency</label>
                                            <input type="text" class="form-control" name="currency"
                                                   placeholder="e.g PKR 600" id="currency"
                                                   value="{{$settings->currency}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">

                                        <label for="exampleInputPassword1">Symbol</label>
                                        <input type="text" class="form-control" name="symbol"
                                               placeholder="e.g PKR" id="symbol" value="{{$settings->symbol}}">
                                        </div>

                                    </div>
                                        <div class="col-sm-6">
                                    <div class="form-group">

                                            <label for="exampleInputPassword1">Tax</label>
                                            <input type="text" class="form-control" name="tax"
                                                   placeholder="e.g Tax" id="tax" value="{{$settings->tax}}">
                                        </div>
                                    </div>
                                        <div class="col-sm-6">
                                    <div class="form-group">

                                            <label for="exampleInputPassword1">Tax Unit</label>
                                            <input type="text" class="form-control" name="tax_unit"
                                                   placeholder="e.g GST/VAT" id="tax_unit"
                                                   value="{{$settings->tax_unit}}">
                                        </div>
                                    </div>
                                        <div class="col-sm-6">
                                    <div class="form-group">

                                            <label for="exampleInputPassword1">Single Job Price</label>
                                            <input type="text" class="form-control" name="single_job_price"
                                                   placeholder="e.g Single Job Price" id="single_job_price"
                                                   value="{{$settings->single_job_price}}">
                                        </div>
                                    </div>
                                        <div class="col-sm-6">
                                    <div class="form-group">

                                            <label for="exampleInputPassword1">Single Job Expiry Days</label>
                                            <input type="text" class="form-control" name="single_job_expiry_days"
                                                   placeholder="e.g Single Job Expiry Days" id="single_job_expiry_days"
                                                   value="{{$settings->single_job_expiry_days}}">
                                        </div>
                                    </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">

                                                <label for="recruiter_cv_purchase_days">Recruiter Cv Purchase Days</label>
                                                <input type="number" class="form-control" name="recruiter_cv_purchase_days"
                                                       placeholder="e.g Recruiter Cv Purchase Days" id="recruiter_cv_purchase_days"
                                                       value="{{$settings->recruiter_cv_purchase_days}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">

                                                <label for="recruiter_cv_purchase_price">Recruiter Cv Purchase Price</label>
                                                <input type="number" class="form-control" name="recruiter_cv_purchase_price"
                                                       placeholder="e.g Recruiter Cv Purchase Price" id="recruiter_cv_purchase_price"
                                                       value="{{$settings->recruiter_cv_purchase_price}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">

                                                <label for="recruiter_cv_purchase_price">Daily Limit CV Download</label>
                                                <input type="number" class="form-control" name="daily_limit_cv_download"
                                                       placeholder="e.g Daily Limit CV Download" id="daily_limit_cv_download"
                                                       value="{{$settings->daily_limit_cv_download}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">

                                                <label for="recruiter_cv_purchase_price">Seeker Upgrade Price</label>
                                                <input type="number" class="form-control" name="seeker_upgrade_price"
                                                       placeholder="e.g Seeker Upgrade Price" id="seeker_upgrade_price"
                                                       value="{{$settings->seeker_upgrade_price}}">
                                            </div>
                                        </div>




                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Website Logo</h3>
                                </div>

                                <div class="card-body box-profile">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <input type="file" class="form-control" name="public_logo" id="public_logo"/>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="text-center">
                                                @if($settings->public_logo==null)
                                                    <img class="img-thumbnail "
                                                         src="{{url('logo/logo-white.png')}}" alt="Logo">
                                                @else
                                                    <img class="img-thumbnail "
                                                         src="{{asset('logo/'.$settings->public_logo) ?? '' }}" alt="Logo">
                                                @endif
                                            </div>
                                        </div>

                                    </div>


                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>

                            </div>
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Website Mode</h3>
                                </div>

                                <div class="card-body box-profile">
                                    <p>
                                        Portal is Free
                                        <input type="checkbox" class="pull-right" name="website_is_free" value="1"
                                               @if($settings->website_is_free == 1) checked
                                               @endif data-bootstrap-switch data-off-color="danger"
                                               data-on-color="success">
                                    </p>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>

                            </div>
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">External Jobs APIs Settings</h3>
                                </div>

                                <div class="card-body box-profile">
                                    <p>
                                        WhatJobs API
                                        <input type="checkbox" class="pull-right" name="what_job_api" value="1"
                                               @if(json_decode($settings->external_jobs_apis)->what_job_api == 1) checked
                                               @endif data-bootstrap-switch data-off-color="danger"
                                               data-on-color="success">

                                        <input type="text" class="form-control col-md-12 margin-top-15"
                                               name="whatjobs_api_key" placeholder="whatjobs API key"
                                               value="{{json_decode($settings->external_jobs_apis)->whatjobs_api_key}}">
                                    <hr>
                                    </p>
                                    <p>
                                        Zip Recruiter API
                                        <input type="checkbox" name="zip_recruiter_api" value="1"
                                               @if(json_decode($settings->external_jobs_apis)->zip_recruiter_api == 1) checked
                                               @endif data-bootstrap-switch data-off-color="danger"
                                               data-on-color="success">
                                        <input type="text" class="form-control col-md-12 margin-top-15"
                                               name="zip_recruiter_api_key" placeholder="zip recruiter API key"
                                               value="{{json_decode($settings->external_jobs_apis)->zip_recruiter_api_key}}">
                                    <hr>
                                    </p>
                                    <p>
                                        Adzuna API
                                        <input type="checkbox" name="adzuna_api" value="1"
                                               @if(json_decode($settings->external_jobs_apis)->adzuna_api == 1) checked
                                               @endif data-bootstrap-switch data-off-color="danger"
                                               data-on-color="success">
                                    <p></p>
                                    <input type="text" class="form-control col-md-5 margin-top-15 float-left"
                                           name="adzuna_app_id" placeholder="Adzuna app id"
                                           value="{{json_decode($settings->external_jobs_apis)->adzuna_app_id}}">
                                    <input type="text" class="form-control col-md-5 margin-top-15 float-right"
                                           name="adzuna_app_key" placeholder="Adzuna app key"
                                           value="{{json_decode($settings->external_jobs_apis)->adzuna_app_key}}">
                                    <div class="clearfix"></div>
                                    <hr>
                                    </p>
                                    <p>
                                        Jobtome API
                                        <input type="checkbox" name="jobtome_api" value="1"
                                               @if(json_decode($settings->external_jobs_apis)->jobtome_api == 1) checked
                                               @endif data-bootstrap-switch data-off-color="danger"
                                               data-on-color="success">
                                        <input type="text" class="form-control col-md-12 margin-top-15"
                                               name="jobtome_api_key" placeholder="Jobtome API key"
                                               value="{{json_decode($settings->external_jobs_apis)->jobtome_api_key}}">
                                    <hr>
                                    </p>
                                    <p>
                                        Careerjet API
                                        <input type="checkbox" name="careerjet_api" value="1"
                                               @if(json_decode($settings->external_jobs_apis)->careerjet_api == 1) checked
                                               @endif data-bootstrap-switch data-off-color="danger"
                                               data-on-color="success">
                                        <input type="text" class="form-control col-md-12 margin-top-15"
                                               name="careerjet_api_key" placeholder="CareerJet API key"
                                               value="{{json_decode($settings->external_jobs_apis)->careerjet_api_key}}">
                                    <hr>
                                    </p>
                                    <p>
                                        Neauvoo API
                                        <input type="checkbox" name="neauvoo_api" value="1"
                                               @if(json_decode($settings->external_jobs_apis)->neauvoo_api == 1) checked
                                               @endif data-bootstrap-switch data-off-color="danger"
                                               data-on-color="success">
                                        <input type="text" class="form-control col-md-12 margin-top-15"
                                               name="neauvoo_api_key" placeholder="whatjobs API key"
                                               value="{{json_decode($settings->external_jobs_apis)->neauvoo_api_key}}">
                                    <hr>
                                    </p>

                                    <p>
                                        JobsG8 API
                                        <input type="checkbox" class="pull-right" name="jobsg8_job_api" value="1"
                                               @if(json_decode($settings->external_jobs_apis)->jobsg8_job_api == 1) checked
                                               @endif data-bootstrap-switch data-off-color="danger"
                                               data-on-color="success">

                                        <input type="text" class="form-control col-md-12 margin-top-15"
                                               name="jobsg8_job_key" placeholder="JobsG8 API key"
                                               value="{{json_decode($settings->external_jobs_apis)->jobsg8_job_key}}">
                                    <hr>
                                    </p>

                                    <p>
                                        BestBananas API
                                        <input type="checkbox" class="pull-right" name="bestbananas_job_api" value="1"
                                               @if(json_decode($settings->external_jobs_apis)->bestbananas_job_api == 1) checked
                                               @endif data-bootstrap-switch data-off-color="danger"
                                               data-on-color="success">

                                        <input type="text" class="form-control col-md-12 margin-top-15"
                                               name="bestbananas_job_key" placeholder="BestBananas API key"
                                               value="{{json_decode($settings->external_jobs_apis)->bestbananas_job_key}}">
                                    <hr>
                                    </p>

                                    <p>
                                        All The Top Bananas API
                                        <input type="checkbox" class="pull-right" name="allthetopbananas_job_api"
                                               value="1"
                                               @if(json_decode($settings->external_jobs_apis)->allthetopbananas_job_api == 1) checked
                                               @endif data-bootstrap-switch data-off-color="danger"
                                               data-on-color="success">

                                        <input type="text" class="form-control col-md-12 margin-top-15"
                                               name="allthetopbananas_job_key" placeholder="All The Top Bananas API key"
                                               value="{{json_decode($settings->external_jobs_apis)->allthetopbananas_job_key}}">
                                    <hr>
                                    </p>


                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">App Settings</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <label for="exampleInputEmail1">App Theme Color</label>
                                                <input type="text" class="form-control" name="app_colors[theme_color]"
                                                       data-jscolor="{}" value="{{$settings->appSettings('theme_color')}}">
                                            </div>
                                            <div class="col">
                                                <label  for="exampleInputEmail1">Theme Font Color</label>
                                                <input type="text" class="form-control" name="app_colors[theme_font_color]"
                                                       data-jscolor="{}" value="{{$settings->appSettings('theme_font_color')}}">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <label for="exampleInputEmail1">Job Title Color</label>
                                                <input type="text" class="form-control" name="app_colors[job_title_color]"
                                                       data-jscolor="{}" value="{{$settings->appSettings('job_title_color')}}">
                                            </div>
                                            <div class="col">
                                                <label for="exampleInputEmail1">Job Title Size (px)</label>
                                                <input type="number" class="form-control" name="app_colors[job_title_size]" value="{{$settings->appSettings('job_title_size')}}">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <label for="exampleInputEmail1">Placeholder Color</label>
                                                <input type="text" class="form-control" name="app_colors[placeholder_color]"
                                                       data-jscolor="{}" value="{{$settings->appSettings('placeholder_color')}}">
                                            </div>
                                            <div class="col">
                                                <label for="exampleInputEmail1">Placeholder Size (px)</label>
                                                <input type="number" class="form-control" name="app_colors[placeholder_size]" value="{{$settings->appSettings('placeholder_size')}}">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <label for="exampleInputEmail1">Success Color</label>
                                                <input type="text" class="form-control" name="app_colors[success_color]"
                                                       data-jscolor="{}" value="{{$settings->appSettings('success_color')}}">
                                            </div>
                                            <div class="col">
                                                <label for="exampleInputEmail1">Primary Color</label>
                                                <input type="text" class="form-control" name="app_colors[primary_color]"
                                                       data-jscolor="{}" value="{{$settings->appSettings('primary_color')}}">
                                            </div>
                                        </div>
                                        <hr>
                                    </div>


                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Google Links</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Google API Key</label>
                                        <input type="text" class="form-control" name="google_api_key"
                                               placeholder="e.g Google API Key" id="google_api_key"
                                               value="{{$settings->google_api_key}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Google Analytics</label>
                                        <textarea placeholder="e.g Google Analytics" name="google_analytics"
                                                  class="form-control" id="" cols="30"
                                                  rows="4">{{$settings->google_analytics}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Google Adsense</label>
                                        <textarea placeholder="e.g Google Adsense" name="google_adsense"
                                                  class="form-control" id="" cols="30"
                                                  rows="4">{{$settings->google_adsense}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Android App URL</label>
                                        <input type="text" class="form-control" name="android"
                                               placeholder="e.g Android" id="android" value="{{$settings->android}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Apple App URL</label>
                                        <input type="text" class="form-control" name="apple"
                                               placeholder="e.g Apple" id="apple" value="{{$settings->apple}}">
                                    </div>


                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Social Links</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Facebook</label>
                                        <input type="text" class="form-control" name="facebook"
                                               placeholder="e.g facebook" id="facebook" value="{{$settings->facebook}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Linkdin</label>
                                        <input type="text" class="form-control" name="linkdin"
                                               placeholder="e.g Linkdin" id="linkdin" value="{{$settings->linkdin}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pinterest</label>
                                        <input type="text" class="form-control" name="pinterest"
                                               placeholder="e.g Pinterest" id="pinterest" value="{{$settings->pinterest}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tumbler</label>
                                        <input type="text" class="form-control" name="tumbler"
                                               placeholder="e.g Tumbler" id="tumbler" value="{{$settings->tumbler}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Instgram</label>
                                        <input type="text" class="form-control" name="instgram"
                                               placeholder="e.g Instgram" id="instgram" value="{{$settings->instgram}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Twitter</label>
                                        <input type="text" class="form-control" name="twitter"
                                               placeholder="e.g Twitter" id="twitter" value="{{$settings->twitter}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Youtube</label>
                                        <input type="text" class="form-control" name="youtube"
                                               placeholder="e.g Youtube" id="youtube" value="{{$settings->youtube}}">
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-danger">Update</button>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Payment Gateways</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">PayPal API KEY</label>
                                        <input type="text" class="form-control" name="paypal_key"
                                               placeholder="e.g PayPal API KEY" id="paypal_key"
                                               value="{{$settings->paypal_key}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">PayPal API Secret</label>
                                        <input type="text" class="form-control" name="paypal_secret"
                                               placeholder="e.g PayPal API Secret" id="paypal_secret"
                                               value="{{$settings->paypal_secret}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Stripe API KEY</label>
                                        <input type="text" class="form-control" name="stripe_key"
                                               placeholder="e.g Stripe API KEY" id="stripe_key"
                                               value="{{$settings->stripe_key}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Stripe API KEY Secret</label>
                                        <input type="text" class="form-control" name="stripe_secret"
                                               placeholder="e.g Stripe API KEY Secret" id="stripe_secret"
                                               value="{{$settings->stripe_secret}}">
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>

                            </div>
                        </div>
                        <!-- ./col -->


                        <!-- ./col -->
                    </div>
                </form>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <script src="{{url('admin/plugins/jscolor.js')}}"></script>
    <script src="{{url('admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{url('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>

    @if(session('message'))

        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'success',
                title: "{{ @session('message') }}"
            })

        </script>

    @endif

    <script>
        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });


    </script>

@endsection