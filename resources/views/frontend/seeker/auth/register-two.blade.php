@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','homepage')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')


    @php
        use App\WebStat;
        $stats = WebStat::first();
    @endphp
    @if($stats)
        <div class="jobdetail-header-top">
            <div class="container">
                <div class="jobdetail-company">
                    <div class="jobdetail-company-details">
                        <p><a href="{{url('search')}}">{{$stats->total_jobs}}</a> jobs for you </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="jobdetail-register">
        <div class="container">
            <div class="text-center">
                <h1>Just a few more details…</h1>
                <p>These will help us match you with your next job!</p>

            </div>
            <div class="row">
                <div class="col-lg-6 offset-lg-3">

                    <form id="selecttest" method="post" action="{{url('seeker/register-step-create')}}" enctype="multipart/form-data">
                        @csrf


                        <div class="abctest">
                            <h6>Employment details</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="number" name="expected_salary" value="{{ old('expected_salary')  }}" required placeholder="Expected Salary" class="form-control">
                                        @if ($errors->has('expected_salary'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('expected_salary')[0]}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="tel" name="phone" class="form-control" value="{{ old('phone')  }}" id="telephone"
                                               placeholder="Phone" required>
                                        @if ($errors->has('phone'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('phone')[0]}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="form-check-label">job type</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="myCheck" name="available_job_type[]"
                                           value="permanent">

                                    <label class="form-check-label" for="myCheck">
                                        Permanent
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="contract" id="myCheck2" name="available_job_type[]"
                                           >
                                    <label class="form-check-label" for="myCheck2">
                                        Contract
                                    </label>

                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="temporary" id="myCheck3" name="available_job_type[]"
                                           >
                                    <label class="form-check-label" for="myCheck3">
                                        Temporary
                                    </label>

                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="part_time" id="myCheck4" name="available_job_type[]"
                                           >
                                    <label class="form-check-label" for="myCheck4">
                                        Part Time
                                    </label>

                                </div>

                                @if ($errors->has('available_job_type'))
                                    <div class="invalid-feedback" style="display: block;">
                                        {{$errors->get('available_job_type')[0]}}
                                    </div>
                                @endif
                            </div>

                        </div>

                            <div class="abctest">
                                <h6>Upload CV
                                </h6>
                                <div class="form-group mb-4">
                                    <div class="form-group mb-4">
                                        <div class="custom-file">

                                            <label for="file1">Select a plain text file (e.g. *.PDF / docx.)</label>
                                            <input type="file" id="file1" name="cv_resume" accept="pdf/docx" >
                                        </div>
                                        @if ($errors->has('cv_resume'))
                                            <div class="invalid-feedback" style="display: block;">
                                                {{$errors->get('cv_resume')[0]}}
                                            </div>
                                        @endif

                                    </div>

            </div>


        </div>
        </p>


        <p>
        <div class="text-center">
            <input type="submit" value="Complete Registration"  id="completebtn">
    </div>
                        </p>
                    </form>
    <div class="job-detailform-btmcomplete">
        <p>By registering with Fratres you agree to our Privacy Policy and Terms & Conditions</p>
    </div>
    </div>






    </div>
    </div>






    </div>
    </div>


@endsection