@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','job_listing')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')


    <div id="desktopview">
    <!--header-->
        @include('frontend.partials.joblistingheader')
     <!--/header-->


        <div class="container">


            <!--crumbs-->
            <div class="crums-job">
                <ul>
                    <li>
                        <a href="#">jobs</a>
                        »
                    </li>
                    <li>
                        <strong>Jobs in UK</strong>
                    </li>
                </ul>
            </div>
            <!--/crumbs-->

            <!--jobsinuk-->
            <div class="job-ukmain">
                <div class="jobuk-item">
                    <span>114,005</span>
                    <h1>Jobs in UK</h1>
                    <p>Popular searches:
                        <a href="#">charities</a>,
                        <a href="#">arts</a>,
                        <a href="#">artist</a>,
                        <a href="#">teaching assistant</a>,
                        <a href="#">museum</a>
                        <span><a href="#">government</a>, </span>
                        <span><a href="#">driver</a>, </span>
                        <span><a href="#">security</a>, </span>
                        <span><a href="#">leisure</a>, </span>
                        <span><a href="#">cleaner</a></span>
                        <strong id="hellip">...&nbsp;</strong>
                        <a href="#srs" rel="no_follow" id="srs">more »</a>
                        <a href="#">post job</a>
                    </p>
                </div>
                <div class="job-feeddback" data-toggle="modal" data-target="#emojisfeedback">
                    <a href="#">
              <span>
                Give feedback on
                <br>
                your search results
              </span>
                        <svg viewBox="0 0 20 24" xmlns="http://www.w3.org/2000/svg"><path d="M20 14.11765c0 .93443-.4149 1.792-1.10035 2.38214.25003.45472.38606.967.38606 1.50021 0 1.37616-.89177 2.55113-2.14994 2.98505a2.59184 2.59184 0 0 1 .00709.19142c0 1.55879-1.2798 2.82353-2.85715 2.82353-2.44437 0-4.87222-.42793-7.16982-1.2633l-3.85167-1.40368c-.34098-.10368-.69591-.15655-1.05136-.15655H.71429c-.3945 0-.71429-.31603-.71429-.70588V9.17648c0-.38985.3198-.70589.71429-.70589h1.49428c.20717 0 .40197-.08735.53823-.24184l4.21956-4.76421c.11329-.12815.1765-.29485.1765-.46594V1.41177c0-.78692.65622-1.41456 1.45078-1.41177 2.35818.01188 4.2635 1.90368 4.2635 4.2353v.03953c0 .54833-.12917 1.09006-.37683 1.5778l-.61029 1.2062h4.12427c1.442 0 2.74867.89628 3.15066 2.23366.25655.85714.15385 1.7194-.24474 2.4435C19.58533 12.32611 20 13.18347 20 14.11765zM1.42857 19.76471h.78429c.49802 0 .99455.07395 1.5084.2313l3.88823 1.41587c2.1394.77786 4.40028 1.17636 6.67622 1.17636.78837 0 1.42858-.63268 1.42858-1.41177 0-.15671-.03139-.31594-.09411-.4833-.16361-.43656.1377-.90733.60695-.94831.92193-.08051 1.63001-.8335 1.63001-1.74486 0-.4478-.17382-.86871-.48378-1.19713-.32529-.34466-.22395-.90153.20247-1.1126.60777-.30083.9956-.9013.9956-1.57262 0-.67131-.38783-1.2718-.9956-1.57262-.42667-.2112-.52782-.76852-.20201-1.11308.43548-.46056.59562-1.08956.40146-1.73824-.21577-.71787-.95236-1.22312-1.781-1.22312h-5.28c-.53098 0-.87634-.55222-.63887-1.02156l1.1276-2.22867c.1481-.29166.22556-.61652.22556-.94553V4.2353c0-1.5546-1.27003-2.81563-2.84112-2.82353-.01168 0-.01602.0041-.01602 0V2.9986c0 .51242-.18837 1.00919-.52966 1.39525l-4.21901 4.7636c-.40692.46138-.99461.7249-1.61419.7249h-.78v9.88236z" fill="#9EA5AC" fill-rule="nonzero"></path></svg>
                        <svg viewBox="0 0 20 24" xmlns="http://www.w3.org/2000/svg"><path d="M0 9.88235c0-.93443.4149-1.792 1.10035-2.38214C.85032 7.0455.71429 6.53321.71429 6c0-1.37616.89177-2.55113 2.14994-2.98505a2.59184 2.59184 0 0 1-.00709-.19142C2.85714 1.26474 4.13694 0 5.7143 0c2.44437 0 4.87222.42793 7.16982 1.2633l3.85167 1.40368c.34098.10368.69591.15655 1.05136.15655h1.49857c.3945 0 .71429.31603.71429.70588v11.29411c0 .38985-.3198.70589-.71429.70589h-1.49428c-.20717 0-.40197.08735-.53823.24184l-4.21956 4.76421c-.11329.12814-.1765.29485-.1765.46594v1.58683c0 .78692-.65622 1.41456-1.45078 1.41177-2.35818-.01188-4.2635-1.90368-4.2635-4.2353v-.03953c0-.54833.12917-1.09006.37683-1.5778l.61029-1.2062H4.0057c-1.442 0-2.74867-.89628-3.15066-2.23366-.25655-.85714-.15385-1.7194.24474-2.4435C.41467 11.67389 0 10.81653 0 9.88235zm18.57143-5.64706h-.78429c-.49802 0-.99455-.07395-1.5084-.2313l-3.88823-1.41587c-2.1394-.77786-4.40028-1.17636-6.67622-1.17636-.78837 0-1.42858.63268-1.42858 1.41177 0 .15671.03139.31594.09411.4833.16361.43656-.1377.90733-.60695.94831-.92193.08051-1.63001.8335-1.63001 1.74486 0 .4478.17382.86871.48378 1.19713.32529.34466.22395.90153-.20247 1.1126-.60777.30083-.9956.9013-.9956 1.57262 0 .67131.38783 1.2718.9956 1.57262.42667.2112.52782.76852.20201 1.11308-.43548.46056-.59562 1.08956-.40146 1.73824.21577.71787.95236 1.22312 1.781 1.22312h5.28c.53098 0 .87634.55222.63887 1.02156L8.797 18.77964c-.1481.29166-.22556.61652-.22556.94553v.03953c0 1.5546 1.27003 2.81563 2.84112 2.82353.01168 0 .01602-.0041.01602 0V21.0014c0-.51242.18837-1.00919.52966-1.39525l4.21901-4.7636c.40692-.46138.99461-.7249 1.61419-.7249h.78V4.23528z" fill="#9EA5AC" fill-rule="nonzero"></path></svg>
                    </a>
                </div>
            </div>
            <!--/jobsinuk-->

            <!--maincontent-->
            <div class="joblist-maincontent">
                <div class="joblist-salary">
                    <div id="f">
                        <div class="h2 h2_sld">Salary<img src="{{asset('frontend/assets/img/preload_f.gif')}}" width="22" height="22" class="pr"></div>
                        <!-- <div class="sld" id="sld_salary">
                            <div class="sld_l">£0 to £100,000 per annum</div>
                            <div class="sld_c noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr">
                              <div class="noUi-base"><div class="noUi-connects">
                                <div class="noUi-connect" style="transform: translate(0%, 0px) scale(1, 1);">
                                </div>
                              </div>
                              <div class="noUi-origin" style="transform: translate(-1000%, 0px); z-index: 5;">
                                <div class="noUi-handle noUi-handle-lower" data-handle="0" tabindex="0" role="slider" aria-orientation="horizontal" aria-valuemin="0.0" aria-valuemax="100000.0" aria-valuenow="0.0" aria-valuetext="0">
                                  <div class="noUi-touch-area"></div>
                                </div>
                              </div>
                              <div class="noUi-origin" style="transform: translate(0%, 0px); z-index: 4;">
                                <div class="noUi-handle noUi-handle-upper" data-handle="1" tabindex="0" role="slider" aria-orientation="horizontal" aria-valuemin="0.0" aria-valuemax="100000.0" aria-valuenow="100000.0" aria-valuetext="100000">
                                  <div class="noUi-touch-area"></div>
                                </div>
                              </div>
                              </div>
                            </div>
                            <ul class="scale">
                                <li class="ticks"></li>
                                <li class="l">£0</li>
                                <li class="m">£50K</li>
                                <li class="r">£100K+</li>
                            </ul>

                          </div> -->
                        <div class="slider-box">
                            <!-- <label for="priceRange">Price Range per annum:</label> -->
                            <input type="text" id="priceRange" readonly >
                            <div id="price-range" class="slider"></div>

                            <ul class="scale">
                                <li class="ticks"></li>
                                <li class="l">£0</li>
                                <li class="m">£50K</li>
                                <li class="r">£100K+</li>
                            </ul>


                        </div>




                        <div class="h2">Location</div>
                        <ul><li class="i1"><strong>UK</strong> <span>(114,068)</span></li><li class="i2 na"><a href="" title="19,977 jobs available in South East England">South East England</a> <span>(19,977)</span></li><li class="i2 na"><a href="#" title="11,794 jobs available in Eastern England">Eastern England</a> <span>(11,794)</span></li><li class="i2 na"><a href="#" title="11,189 jobs available in North West England">North West England</a> <span>(11,189)</span></li><li class="i2 na"><a href="#" title="9,357 jobs available in South West England">South West England</a> <span>(9,357)</span></li><li class="i2 na"><a href="#" title="9,076 jobs available in West Midlands">West Midlands</a> <span>(9,076)</span></li><li class="i2 na"><a href="#" title="7,474 jobs available in Yorkshire And The Humber">Yorkshire And The Humber</a> <span>(7,474)</span></li><li class="i2 na"><a href="#" title="7,458 jobs available in East Midlands">East Midlands</a> <span>(7,458)</span></li><li class="i2 na"><a href="#" title="3,267 jobs available in Scotland">Scotland</a> <span>(3,267)</span></li><li class="i2 na"><a href="#" title="2,453 jobs available in Wales">Wales</a> <span>(2,453)</span></li></ul><ul class="smr" style="display:none;"><li class="i2 na"><a href="#" title="23 jobs available in Channel Islands">Channel Islands</a> <span>(23)</span></li>            </ul>
                        <span class="smr i2">show more »</span>


                        <div class="h2">Category</div>
                        <ul>
                            <li>
                                <a href="#">Healthcare & Nursing Jobs</a> <span>(13,074)</span></li>
                            <li>
                                <a href="#">Teaching Jobs</a> <span>(13,074)</span></li>
                            <li>
                                <a href="#">IT Jobs</a> <span>(13,074)</span></li>
                            <li>
                                <a href="#">Social work Jobs</a> <span>(13,074)</span></li>
                            <li>
                                <a href="#">Engineering Jobs</a> <span>(13,074)</span></li>
                        </ul>
                        <span class="smr">show more »</span>

                        <div class="h2">Company</div>
                        <ul>
                            <li>
                                <a href="#">Barchester Healthcare</a> <span>(13,074)</span>
                            </li>
                            <li>
                                <a href="#">HC One</a> <span>(13,074)</span>
                            </li>
                            <li>
                                <a href="#">Simply Education</a> <span>(13,074)</span>
                            </li>
                            <li>
                                <a href="#">Voyage Care</a> <span>(13,074)</span>
                            </li>
                            <li>
                                <a href="#">Mencap</a> <span>(13,074)</span>
                            </li>
                        </ul>
                        <span class="smr">show more »</span>

                        <div class="h2">Contract type</div>
                        <ul>
                            <li>
                                <a href="#">Permanent</a> <span>(13,074)</span>
                            </li>
                            <li>
                                <a href="#">Contract</a> <span>(13,074)</span>
                            </li>
                        </ul>

                        <div class="h2">Hours</div>
                        <ul>
                            <li>
                                <a href="#">Full time</a> <span>(13,074)</span>
                            </li>
                            <li>
                                <a href="#">Part time</a> <span>(13,074)</span>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="joblist-jobsads">
                    <div class="ea">
                        <div class="ea_form">
                            <input type="hidden" name="ea_serialised" value="">
                            <input type="hidden" name="ea_title" value="Jobs in UK">
                            <label for="ea_srp_top"><strong>Receive the newest jobs for this search <a href="#" title="Click to learn more about setting up email alerts" class="alert_by_email" data-ga-track="job_alerts;shown;email-info-modal">by email</a>:</strong></label>
                            <input type="email" id="ea_srp_top" placeholder="your.email@domain.com">
                            <button class="btn">Create alert</button>
                        </div>
                        <div class="ea_gdpr">By creating an alert, you agree to our <a href="#" target="_blank">T&amp;Cs</a> and <a href="#" target="_blank">Privacy Notice</a>, and Cookie Use. </div>
                    </div>
                    <div class="show-head-section">
                        <div class="srt"><p>Results 1-50 of 114,075</p>
                            <div class="show-price">Show
                                <select name="per_page" id="per_page">
                                    <option value="50"> 50 </option>
                                    <option value="50"> 40 </option>
                                    <option value="50"> 30 </option>
                                    <option value="50">20 </option>
                                </select>
                            </div>
                            <div class="show-price2"> per page and sort by
                                <select name="per_page" id="per_page">
                                    <option value="50"> Most recent </option>
                                    <option value="50"> Most relevant </option>
                                    <option value="50"> Highest salary </option>
                                    <option value="50">Lowest salary </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="job-ad-head">

                        <div class="job-ad-capital">
                            <div class="job-ad-cap_item">
                                <a href="#"><h4>
                                        Partnerships Manager, EMAA
                                        <span class="badge badge-secondary">Easy Apply</span>
                                    </h4></a>
                                <p>
                                    VILLAGE CAPITAL -
                                    <span>LONDON, UK</span>
                                </p>
                            </div>
                            <div class="job-heart">
                                <i class="far fa-heart"></i>
                            </div>
                        </div>
                        <div class="jobad-wrp">
                            <div class="job-item-profile">
                                <img src="{{asset('frontend/assets/img/1.png')}}" class="img-fluid">
                            </div>
                            <div class="jobad-details">
                                <p>
                                    Reports to: Senior Director, Partnerships Type of role: Full time About Village Capital Are you passionate about how entrepreneurship can solve important problems in the world? At Village Capital, we find, train and support entrepreneurs solving problems ...
                                    <br>
                                    <b>51,500-62311 GBP</b>
                                </p>
                                <ul>
                                    <li>
                                        <a href="#">share</a>

                                    </li>
                                    <li>
                                        <a href="#">more details »</a>

                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="vmcv_inline">
                            <span class="vmcv_inline_i vmcv_inline_b"></span>
                            <span class="vmcv_inline_t">Boost your CV</span><br>
                            <a href="#" >It takes 2 minutes and it's free. <strong>Try ValueMyCV now »</strong></a>
                        </div>
                    </div>


                    <div class="job-ad-head">

                        <div class="job-ad-capital">
                            <div class="job-ad-cap_item">
                                <a href="#"><h4>
                                        Partnerships Manager, EMAA
                                        <span class="badge badge-secondary">Easy Apply</span>
                                    </h4></a>
                                <p>
                                    VILLAGE CAPITAL -
                                    <span>LONDON, UK</span>
                                </p>
                            </div>
                            <div class="job-heart">
                                <i class="far fa-heart"></i>
                            </div>
                        </div>
                        <div class="jobad-wrp">
                            <div class="job-item-profile">
                                <img src="{{asset('frontend/assets/img/1.png')}}" class="img-fluid">
                            </div>
                            <div class="jobad-details">
                                <p>
                                    Reports to: Senior Director, Partnerships Type of role: Full time About Village Capital Are you passionate about how entrepreneurship can solve important problems in the world? At Village Capital, we find, train and support entrepreneurs solving problems ...
                                    <br>
                                    <b>51,500-62311 GBP</b>
                                </p>
                                <ul>
                                    <li>
                                        <a href="#">share</a>

                                    </li>
                                    <li>
                                        <a href="#">more details »</a>

                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="job-ad-head">

                        <div class="job-ad-capital">
                            <div class="job-ad-cap_item">
                                <a href="#"><h4>
                                        Partnerships Manager, EMAA
                                        <span class="badge badge-secondary">Easy Apply</span>
                                    </h4></a>
                                <p>
                                    VILLAGE CAPITAL -
                                    <span>LONDON, UK</span>
                                </p>
                            </div>
                            <div class="job-heart">
                                <i class="far fa-heart"></i>
                            </div>
                        </div>
                        <div class="jobad-wrp">
                            <div class="job-item-profile">
                                <img src="{{asset('frontend/assets/img/1.png')}}" class="img-fluid">
                            </div>
                            <div class="jobad-details">
                                <p>
                                    Reports to: Senior Director, Partnerships Type of role: Full time About Village Capital Are you passionate about how entrepreneurship can solve important problems in the world? At Village Capital, we find, train and support entrepreneurs solving problems ...
                                    <br>
                                    <b>51,500-62311 GBP</b>
                                </p>
                                <ul>
                                    <li>
                                        <a href="#">share</a>

                                    </li>
                                    <li>
                                        <a href="#">more details »</a>

                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="job-ad-head">

                        <div class="job-ad-capital">
                            <div class="job-ad-cap_item">
                                <a href="#"><h4>
                                        Partnerships Manager, EMAA
                                        <span class="badge badge-secondary">Easy Apply</span>
                                    </h4></a>
                                <p>
                                    VILLAGE CAPITAL -
                                    <span>LONDON, UK</span>
                                </p>
                            </div>
                            <div class="job-heart">
                                <i class="far fa-heart"></i>
                            </div>
                        </div>
                        <div class="jobad-wrp">
                            <div class="job-item-profile">
                                <img src="{{asset('frontend/assets/img/1.png')}}" class="img-fluid">
                            </div>
                            <div class="jobad-details">
                                <p>
                                    Reports to: Senior Director, Partnerships Type of role: Full time About Village Capital Are you passionate about how entrepreneurship can solve important problems in the world? At Village Capital, we find, train and support entrepreneurs solving problems ...
                                    <br>
                                    <b>51,500-62311 GBP</b>
                                </p>
                                <ul>
                                    <li>
                                        <a href="#">share</a>

                                    </li>
                                    <li>
                                        <a href="#">more details »</a>

                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="ea">
                        <div class="ea_form">
                            <input type="hidden" name="ea_serialised" value="">
                            <input type="hidden" name="ea_title" value="Jobs in UK">
                            <label for="ea_srp_top"><strong>Receive the newest jobs for this search <a href="#" title="Click to learn more about setting up email alerts" class="alert_by_email" data-ga-track="job_alerts;shown;email-info-modal">by email</a>:</strong></label>
                            <input type="email" id="ea_srp_top" placeholder="your.email@domain.com">
                            <button class="btn">Create alert</button>
                        </div>
                        <div class="ea_gdpr">By creating an alert, you agree to our <a href="#" target="_blank">T&amp;Cs</a> and <a href="#" target="_blank">Privacy Notice</a>, and Cookie Use. </div>
                    </div>
                    <div class="job-ad-head">

                        <div class="job-ad-capital">
                            <div class="job-ad-cap_item">
                                <a href="#"><h4>
                                        Partnerships Manager, EMAA
                                        <span class="badge badge-secondary">Easy Apply</span>
                                    </h4></a>
                                <p>
                                    VILLAGE CAPITAL -
                                    <span>LONDON, UK</span>
                                </p>
                            </div>
                            <div class="job-heart">
                                <i class="far fa-heart"></i>
                            </div>
                        </div>
                        <div class="jobad-wrp">
                            <div class="job-item-profile">
                                <img src="{{asset('frontend/assets/img/1.png')}}" class="img-fluid">
                            </div>
                            <div class="jobad-details">
                                <p>
                                    Reports to: Senior Director, Partnerships Type of role: Full time About Village Capital Are you passionate about how entrepreneurship can solve important problems in the world? At Village Capital, we find, train and support entrepreneurs solving problems ...
                                    <br>
                                    <b>51,500-62311 GBP</b>
                                </p>
                                <ul>
                                    <li>
                                        <a href="#">share</a>

                                    </li>
                                    <li>
                                        <a href="#">more details »</a>

                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="job-ad-head">

                        <div class="job-ad-capital">
                            <div class="job-ad-cap_item">
                                <a href="#"><h4>
                                        Partnerships Manager, EMAA
                                        <span class="badge badge-secondary">Easy Apply</span>
                                    </h4></a>
                                <p>
                                    VILLAGE CAPITAL -
                                    <span>LONDON, UK</span>
                                </p>
                            </div>
                            <div class="job-heart">
                                <i class="far fa-heart"></i>
                            </div>
                        </div>
                        <div class="jobad-wrp">
                            <div class="job-item-profile">
                                <img src="{{asset('frontend/assets/img/1.png')}}" class="img-fluid">
                            </div>
                            <div class="jobad-details">
                                <p>
                                    Reports to: Senior Director, Partnerships Type of role: Full time About Village Capital Are you passionate about how entrepreneurship can solve important problems in the world? At Village Capital, we find, train and support entrepreneurs solving problems ...
                                    <br>
                                    <b>51,500-62311 GBP</b>
                                </p>
                                <ul>
                                    <li>
                                        <a href="#">share</a>

                                    </li>
                                    <li>
                                        <a href="#">more details »</a>

                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    <div class="ea">
                        <div class="ea_form">
                            <input type="hidden" name="ea_serialised" value="">
                            <input type="hidden" name="ea_title" value="Jobs in UK">
                            <label for="ea_srp_top"><strong>Receive the newest jobs for this search <a href="#" title="Click to learn more about setting up email alerts" class="alert_by_email" data-ga-track="job_alerts;shown;email-info-modal">by email</a>:</strong></label>
                            <input type="email" id="ea_srp_top" placeholder="your.email@domain.com">
                            <button class="btn">Create alert</button>
                        </div>
                        <div class="ea_gdpr">By creating an alert, you agree to our <a href="#" target="_blank">T&amp;Cs</a> and <a href="#" target="_blank">Privacy Notice</a>, and Cookie Use. </div>
                    </div>
                    <div class="pagination">
                        <ul>
                            <li class="previous"><a href="#">«previous</a></li>
                            <li>
                                <ol>
                                    <li class="active"><a>1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                </ol>
                            </li>
                            <li class="next"><a href="#">next»</a></li>
                        </ul>
                    </div>

                </div>
                <div class="joblist-currency">
                    <div class="b b_ssc_rhs">
                        <div class="b_ssc_rhs_top">
                            <strong>114,000</strong>
                            <span>Jobs in UK</span><br>
                        </div>
                        <div class="b_ssc_rhs_bottom">
                            <strong>£35,772</strong>
                            <span>Average salary for Jobs in UK</span><br>
                        </div>
                        <a href="#" class="btn b_ssc_cta" target="_blank">See More Stats<span></span></a>
                    </div>
                    <div class="rhs-covid-promo">
                        <div class="b b_promo">
                            <h2>Impacted by Covid-19?</h2>
                            <p>Search 1000's of remote jobs</p>
                            <img src="assets/img/covid_promo_grey.svg" width="60" height="">
                            <div>
                                <a href="#" class="btn">Remote Jobs »</a>
                            </div>
                        </div>
                    </div>
                    <div class="rhs-covid-promo">
                        <div class="b b_promo">
                            <h2>ValueMyCV</h2>
                            <p>Find out your market rate by simply uploading your CV</p>
                            <img src="assets/img/vmcv_rhs_promo.svg" width="60" height="">
                            <div>
                                <a href="#" class="btn">Try ValueMyCV</a>
                            </div>
                        </div>
                    </div>
                    <div class="b mobile-app">

                        <h2>Get the mobile app<span class="badge">NEW!</span></h2>

                        <p>Continue your search from your iPhone or Android phone.</p>

                        <div><a href="#" class="btn" data-track="mobile_promo" target="_blank">Download now</a></div>
                    </div>
                    <div class="b b_blog">
                        <h2>Latest blog posts</h2>

                        <p><a href="#" title="Click to visit our blog">Visit our blog »</a></p>
                    </div>
                    <div class="b b_shr">
                        <h2>Share this search</h2>
                        <ul>
                            <li><a href="#" class="email" target="_blank">Share via email</a></li>
                            <li><a href="#" class="fb">Share on Facebook</a></li>
                            <li><a href="#" class="tw">Share on Twitter</a></li>

                            <li><a href="#" class="in">Share on LinkedIn</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/maincontent-->

            <!--footer-promo-->
            <div class="footer-promo">
                <a href="#">
                    <img src="{{asset('frontend/assets/img/app-store-badge.png')}}" class="img-fluid">
                </a>
                <a href="#">
                    <img src="{{asset('frontend/assets/img/app-store-badge.png')}}" class="img-fluid">
                </a>
            </div>
            <!--/footer-promo-->


            <!--/footer-->
        </div>
    </div>

    <!--modal emojis rating-->
    <!-- Modal -->
    <div class="emoji-modal-head">
        <div class="modal fade" id="emojisfeedback" tabindex="-1" role="dialog" aria-labelledby="emojisfeedbackLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>

                            <div class="emojis-head">
                                <h2>1. How would your rate your search results?</h2>
                                <ul>
                                    <li>
                                        <img src="{{asset('frontend/assets/img/happ.png')}}" class="img-fluid" id="happyimg">

                                    </li>
                                    <li>
                                        <img src="{{asset('frontend/assets/img/sad.png')}}" class="img-fluid" id="sadimg">
                                    </li>
                                    <li>
                                        <img src="{{asset('frontend/assets/img/confu.png')}}" class="img-fluid" id="irrelv">
                                    </li>
                                    <li>
                                        <img src="{{asset('frontend/assets/img/angry.png')}}" class="img-fluid" id="virrelv">
                                    </li>
                                    <li>
                                        <img src="{{asset('frontend/assets/img/wink.png')}}" class="img-fluid" id="vrelv">
                                    </li>
                                </ul>
                                <span class="happyemo">happy</span>
                                <span class="sademo">Neutral</span>
                                <span class="irr">somewhat irrelevent</span>
                                <span class="virr">very irrelevent</span>
                                <span class="vr">very relevent</span>
                            </div>
                            <div class="emo-survey">
                                <div class=""><h2>2. What are the main reasons for your rating (select all that apply)?</h2><div class="relevance_survey_reasons"><label for="ability_to_refine_search"><input type="checkbox" id="ability_to_refine_search">Ability to refine your search with filters</label><label for="information_for_each_job"><input type="checkbox" id="information_for_each_job">Information shown for each job</label><label for="number_of_results"><input type="checkbox" id="number_of_results">Number of results</label><label for="match_job_title"><input type="checkbox" id="match_job_title">Match with your job title</label><label for="match_location"><input type="checkbox" id="match_location">Match with your location</label><label for="job_variety"><input type="checkbox" id="job_variety">Variety of jobs</label><label for="other"><input type="checkbox" id="other">Other (please specify):</label><input type="text" class="relevance_survey_other relevance_survey_form_element" placeholder="e.g. company information" disabled="" value=""></div></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('mblview')
    @include('frontend.mblview.joblisting')
@endsection
@section('scripts')
    <!-- Optional JavaScript -->

    <script src="{{url('frontend/assets/js/custom/joblisting.js')}}"></script>
@endsection
