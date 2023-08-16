@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','job_detail_description')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')


    <!---/tophead-->
    <!----header-->
    <header class="jobdetails">
        <div class="container">
            <form class="form-inline row">
                <label for="inlineFormInputName2">Keywords</label>
                <input type="text" class="form-control  col-md-3" id="inlineFormInputName1" placeholder="e.g customer services">

                <label  for="inlineFormInputGroupUsername2">Location</label>
                <input type="text" class="form-control  col-md-3" id="inlineFormInputName2" placeholder="e.g postcode or town">


                <select class="custom-select col-md-2" id="inlineFormCustomSelect">

                    <option value="1">up to 1 mile </option>
                    <option value="2">up to 2 miles</option>
                    <option value="3"> up to 3 miles</option>
                    <option value="4"> up to 4 miles</option>
                    <option value="5">up to 5 miles</option>
                    <option value="6">up to 6 miles</option>

                </select>


                <a href="joblisting.html" type="submit" class="btn btn-primary col-md-2">Find jobs<span><i class="fas fa-search"></i></span></a>
            </form>

        </div>
        <div class="jobdetail-header-top">
            <div class="container">
                <div class="jobdetail-company">
                    <div class="jobdetail-company-details">
                        <p>90,124 jobs from <a href="#">9,868</a> companies</p>
                    </div>
                    <!-- <div class="jobdetail-company-saved">
                      <a href="#">saved jobs(0) <span><i class="far fa-heart"></i></span></a>
                    </div> -->
                </div>
            </div>
        </div>
    </header>
    <!---/header--->

    <!--main-->
    <div class="jobdetailmain">
        <div class="container">
            <div class="jobdetail-postjob">
                <ul class="breadcrums">
                    <li>
                        <a href="#">jobs <span><i class="fas fa-chevron-right"></i></span></a>
                    </li>
                    <li>
                        <a href="#">Manufacturing <span><i class="fas fa-chevron-right"></i></span></a>
                    </li>
                    <li>
                        <a href="#">Manufacturing Technician jobs</a>
                    </li>
                </ul>
                <div class="jobdetail-ad-main">
                    <div class="jobdetail-ad-fields">
                        <section class="job-similar">
                            <h2> Similar Jobs</h2>
                            <ul>
                                <li>
                                    <h3>Technician</h3>
                                    <p>Leeds</p>
                                    <p>£23,000 - £26,000/annum</p>
                                </li>
                                <li>
                                    <h3>Technician</h3>
                                    <p>Leeds</p>
                                    <p>£23,000 - £26,000/annum</p>
                                </li>
                                <li>
                                    <h3>Technician</h3>
                                    <p>Leeds</p>
                                    <p>£23,000 - £26,000/annum</p>
                                </li>
                            </ul>
                        </section>
                        <section class="job-similar">
                            <h2> Recently Viewed Jobs</h2>
                            <ul>
                                <li>
                                    <h3>Technician</h3>
                                    <p>Leeds</p>
                                    <p>£23,000 - £26,000/annum</p>
                                </li>
                            </ul>
                        </section>
                        <section class="job-similar">
                            <h2> Star Recruitment And Employability Ltd</h2>
                            <ul>
                                <li>
                                    <h3>Technician</h3>
                                    <p>Leeds</p>
                                    <p>£23,000 - £26,000/annum</p>
                                </li>
                                <li>
                                    <h3>Technician</h3>
                                    <p>Leeds</p>
                                    <p>£23,000 - £26,000/annum</p>
                                </li>
                                <li>
                                    <h3>Technician</h3>
                                    <p>Leeds</p>
                                    <p>£23,000 - £26,000/annum</p>
                                </li>
                            </ul>
                        </section>
                    </div>
                    <div class="jobdetail-ad-main-detail">
                        <div class="jobad-btnsave">
                            <a href="#">save <span><i class="fas fa-heart"></i></span></a>
                        </div>
                        <div class="jobad-details-form">

                            <h1>Development Technician</h1>
                            <div class="jobad-posted-main">
                                <div class="jobs-posted-left">
                                    <div class="jobad-posted-details">
                                        <p>
                                            Posted by
                                            <a href="#">Star Recruitment And Employability Ltd</a>
                                            24/04/2020 (22:02)</p>
                                    </div>
                                    <div class="job-posted-location">
                                        <h4>
                                            <span><i class="fas fa-map-marker-alt"></i></span>
                                            Halifax, Calderdale
                                        </h4>

                                    </div>
                                </div>
                                <div class="jobad-logo-main">
                                    <img src="{{url('frontend/assets/img/star-detail.gif')}}" class="img-fluid">

                                </div>
                            </div>

                            <div class="job-ad-apply-head">
                                <div class="job-ad-apply-item1"></div>
                                <div class="job-ad-apply-item2">
                                    <a href="#">apply now</a>
                                </div>
                                <div class="job-ad-apply-item3">

                                </div>
                            </div>
                            <div class="jobdetail-ad-details-full">




                                <p>We are looking for a development technician to join a small R&amp;D&nbsp;team within a chemical manufacturing company based in West Yorkshire.</p>

                                <p>You will support the team of chemists working on projects from concept to production. Your responsibilities&nbsp;will include but not be limited to;</p>

                                <ul>
                                    <li>Sending samples to new and existing products to customers and updating the sample log.&nbsp;</li>
                                    <li>Screening new raw materials and improving new suppliers.</li>
                                    <li>Carry out basic product development work.</li>
                                    <li>Update MSDS system.</li>
                                    <li>Producing weekly reports on projects, sample updates and raw material testing.</li>
                                    <li>QC testing of production batches.</li>
                                </ul>

                                <p>The successful candidate will have previous experience of working in a laboratory environment. A chemistry background would be preferred but is not essential. You will have good problem solving skills, attention to detail and have a methodical approach to your work. You will have the ability to take responsibility for&nbsp;your own workload and be able to work effectively within a team.</p>

                                <p>If you would like more information please contact Laura Osta or apply online</p>


                            </div>
                            <div class="job-ad-tech-head">
                                <div class="job-ad-tech-head-item1">
                                    <div class="job-ad-item1-a">
                                        <dt>Type:</dt>
                                        <dd>Permanent</dd>

                                    </div>
                                    <div class="job-ad-item1-a">
                                        <dt>Contact Name:</dt>
                                        <dd>Login or register to view</dd>

                                    </div>
                                    <div class="job-ad-item1-a">
                                        <dt> Job Reference:</dt>
                                        <dd> SRYO86</dd>

                                    </div>


                                </div>
                                <div class="job-ad-tech-head-item2">
                                    <div class="job-ad-item1-a">
                                        <dt>Type:</dt>
                                        <dd>Permanent</dd>

                                    </div>
                                    <div class="job-ad-item1-a">
                                        <dt>Contact Name:</dt>
                                        <dd>Login or register to view</dd>

                                    </div>
                                    <div class="job-ad-item1-a">
                                        <dt> Job Reference:</dt>
                                        <dd> SRYO86</dd>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="job-detail-btn-links">
                            <div class="jobdetail-btn1">
                                <a href="#"><span><i class="far fa-heart"></i></span>save</a>
                            </div>
                            <div class="jobdetail-btn2">
                                <a href="#"><span><i class="fas fa-print"></i></span>print</a>
                            </div>
                            <div class="jobdetail-btn3">
                                <a href="#"><span><i class="fas fa-share-square"></i></span>share</a>
                            </div>
                        </div>
                        <ul class="breadcrums">
                            <li>
                                <a href="#">Halifax <span><i class="fas fa-chevron-right"></i></span></a>
                            </li>
                            <li>
                                <a href="#">Manufacturing <span><i class="fas fa-chevron-right"></i></span></a>
                            </li>

                        </ul>
                        <section class="create-alert">
                            <h1>Create new Job Alert</h1>
                            <p>Create a new Job Alert to make sure you see the best new jobs first!</p>
                            <form class="needs-validation" novalidate>
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <label for="validationCustom01">Keywords/Job Title</label>
                                        <input type="text" class="form-control" id="validationCustom01" placeholder="e.g. Sales" required>

                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="validationCustom02">Location</label>
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Halifax, Calderdale"  required>

                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="validationCustomUsername">Distance</label>
                                        <select class="custom-select" id="inlineFormCustomSelect">

                                            <option value="1">up to 1 mile </option>
                                            <option value="2">up to 2 miles</option>
                                            <option value="3"> up to 3 miles</option>
                                            <option value="4"> up to 4 miles</option>
                                            <option value="5">up to 5 miles</option>
                                            <option value="6">up to 6 miles</option>

                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary" type="submit" id="alertbtn-jobdetail">create alert</button>
                                    </div>
                                </div>

                            </form>

                        </section>
                        <section class="jobdetail-related">
                            <h4>Related sectors</h4>
                            <div class="jobdetail-related-head">
                                <div class="related-jobitem">
                                    <a href="#"> Engineering</a>
                                </div>
                                <div class="related-jobitem">
                                    <a href="#">
                                        Construction
                                    </a>
                                </div>
                                <div class="related-jobitem">
                                    <a href="#">
                                        IT
                                    </a>
                                </div>
                                <div class="related-jobitem">
                                    <a href="#">
                                        Manufacturing
                                    </a>
                                </div>
                                <div class="related-jobitem">
                                    <a href="#">
                                        Motoring & Automotive
                                    </a>
                                </div>
                                <div class="related-jobitem">
                                    <a href="#">
                                        Science

                                    </a>
                                </div>
                                <div class="related-jobitem">
                                    <a href="#">
                                        Aerospace & Aviation
                                    </a>
                                </div>
                                <div class="related-jobitem">
                                    <a href="#">
                                        Energy
                                    </a>
                                </div>
                                <div class="related-jobitem">
                                    <a href="#">
                                        Oil & Gas
                                    </a>
                                </div>
                                <div class="related-jobitem">
                                    <a href="#">
                                        Agriculture
                                    </a>
                                </div>
                                <div class="related-jobitem">
                                    <a href="#">
                                        Part Time
                                    </a>
                                </div>
                                <div class="related-jobitem">
                                    <a href="#">
                                        Cleaning
                                    </a>
                                </div>
                                <div class="related-jobitem">
                                    <a href="#">

                                        Marketing

                                    </a>
                                </div>
                                <div class="related-jobitem">
                                    <a href="#">
                                        Retail
                                    </a>
                                </div>
                                <div class="related-jobitem">
                                    <a href="#">
                                        Civil Service
                                    </a>
                                </div>
                            </div>
                            <p>
                                Remember: You should never send cash or cheques to a prospective employer,
                                or provide your bank details or any other financial information.
                                We pay great attention to vetting all jobs that appear on our site,
                                but please <a href="#">get in touch</a> if you see any roles asking for such payments or financial details from you.
                                For more information on conducting a safe job hunt online, visit <a href="#">safer-jobs.com</a>

                            </p>
                        </section>
                        <section class="similar-jobdetail-mobile">
                            <div class="similar-jobdetail-head-mobile">
                                <a class="btn btn-primary" data-toggle="collapse" href="#similarjobsmmenu" role="button" aria-expanded="false" aria-controls="similarjobsmmenu">
                                    similar jobs <span class="text-right"><i class="fas fa-angle-down"></i></span>
                                </a>
                                <div class="collapse" id="similarjobsmmenu">
                                    <div class="card card-body">
                                        <ul>
                                            <li>
                                                <h3>Technician</h3>
                                                <p>Leeds</p>
                                                <p>£23,000 - £26,000/annum</p>
                                            </li>
                                            <li>
                                                <h3>Technician</h3>
                                                <p>Leeds</p>
                                                <p>£23,000 - £26,000/annum</p>
                                            </li>
                                            <li>
                                                <h3>Technician</h3>
                                                <p>Leeds</p>
                                                <p>£23,000 - £26,000/annum</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
@endsection