@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','homepage')->first();@endphp

    @if ($seo)
        <meta name="description" content="{{$seo->meta_description}}">
        <meta name="keywords" content="{{$seo->meta_key}}">
        <meta name="title" content="{{$seo->meta_title}}">

    @endif


@endsection
@section('content')

    <header class="jobdetails">
        <div class="container">
            <form class="form-inline row">
                <label for="inlineFormInputName2">Keywords</label>
                <input type="text" class="form-control  col-md-3" id="inlineFormInputName1"
                       placeholder="e.g customer services">

                <label for="inlineFormInputGroupUsername2">Location</label>
                <input type="text" class="form-control  col-md-3" id="inlineFormInputName2"
                       placeholder="e.g postcode or town">


                <select class="custom-select col-md-2" id="inlineFormCustomSelect">

                    <option value="1">up to 1 mile</option>
                    <option value="2">up to 2 miles</option>
                    <option value="3"> up to 3 miles</option>
                    <option value="4"> up to 4 miles</option>
                    <option value="5">up to 5 miles</option>
                    <option value="6">up to 6 miles</option>

                </select>


                <a href="joblisting.html" class="btn btn-primary col-md-2">Find jobs<span><i class="fas fa-search"></i></span></a>
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
    <div class="jobseeker-dashboard-main">
        <div class="container">

            <!--jobseeker-dashb-head-->
            <div class="jobseeker-dashb-head">
                <div class="row">
                    <div class="col-lg-6">
                        <h2>Modify CV</h2>
                    </div>
                    <div class="col-lg-6">
                        <h6>CV Last Modified: 01/05/2020 at 20:34:44</h6>
                    </div>
                </div>
            </div>
            <!--/jobseeker-dashb-head-->
            <div class="crums-job">
                <ul>
                    <li>
                        <a href="#">My account</a>
                        »
                    </li>
                    <li>
                        <strong>Modify CV</strong>
                    </li>
                </ul>
            </div>

            <!--jobseeker-main-dashobard-content-->
            <div class="jobseeker-dashb-content-main">
                <div class="jobseeker-dashb-item1">
                    <div class="jobseeker-dashb-item1-main">
                        <div class="text-center">
                            <form id="">
                                <ul>
                                    <li>
                                        <h5>omi free</h5>
                                        <h6>software developer</h6>
                                        <div class="profile-image-joseekerdashb">
                                            <label for="fileToUpload">
                                                <div class="profile-pic">
                                                    <span class="glyphicon glyphicon-camera"></span>
                                                    <span>Change Image</span>
                                                    <div class="profile-avatar__edit no-photo"><span
                                                                class="visually-hidden">Upload profile photo</span>
                                                    </div>
                                                </div>
                                            </label>
                                            <input type="File" name="fileToUpload" id="fileToUpload">
                                        </div>
                                        <div class="profile-jobseeker-progress">
                                            <p class="">70% complete</p>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                     style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <p class="profilejobseeker-title">+447789514877</p>
                                            <p class="profilejobseeker-title1">njoyner2022@gmail.com</p>
                                            <p>(
                                                <a href="#">not omi?</a>)
                                            </p>
                                            <!-- <div class="profile-seeker-jobedit">
                                             <a href="#" type="submit" class="btn btn-primary">Save profile</a>
                                            </div> -->
                                        </div>
                                    </li>
                                    <li>
                                        <div class="jobseeker-profile-completemain">
                                            <h5>Complete your profile</h5>
                                            <h6>A completed profile is 71% more likely to be viewed by a recruiter.</h6>
                                        </div>
                                        <div class="profile__field" data-sidebar-field="">
                                            <button id="sidebarSkillsLabel" class="profile__detail-btn skills"
                                                    type="button" aria-expanded="true" data-profile-expand="">
                                                <span>Main Skills</span><i class="fa fa-chevron-down"></i></button>
                                            <div class="profile__detail-dropdown" style="display: block;"
                                                 id="jobseeker-drop1">
                                                <span id="sidebarSkillsDesc">Enter up to 10 skills, separated by commas</span>
                                                <textarea name="sidebar_skills" rows="5" maxlength="180"
                                                          aria-labelledby="sidebarSkillsLabel"
                                                          aria-describedby="sidebarSkillsDesc"></textarea>
                                            </div>
                                        </div>
                                        <div class="profile__field" data-sidebar-field="" id="desiredjob">
                                            <button id="sidebarSkillsLabel" class="profile__detail-btn skills"
                                                    type="button" aria-expanded="true" data-profile-expand="">
                                                <span><input type="text" placeholder="Desired Job Title"></span><i
                                                        class="fa fa-chevron-down"></i></button>

                                        </div>
                                        <div class="profile-seeker-jobedit">
                                            <a href="#" class="btn btn-primary">save to profile</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="jobseeker-sidebar-botm">
                                            <div class="jobseeker-item1-sidebar">
                                                <a href="#"><i class="far fa-eye"></i></a>
                                                <a href="#">0</a>
                                                <a href="#" class="profile-btm-jobseekersidebar">
                                                    Profile views
                                                </a>
                                            </div>
                                            <div class="jobseeker-item2-sidebar">
                                                <a href="#" class="heartcolor"><i class="far fa-heart"></i></a>
                                                <a href="#">0</a>
                                                <a href="#" class="profile-btm-jobseekersidebar">
                                                    Profile views
                                                </a>
                                            </div>
                                            <div class="jobseeker-item3-sidebar">
                                                <a href="#"><i class="fas fa-bell"></i></a>
                                                <a href="#">2</a>
                                                <a href="#" class="profile-btm-jobseekersidebar">
                                                    Profile views
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="jobseeker-dashb-item2">
                    <div class="jobseeker-modifycontent">
                        <form id="cvprofile">
                            <div class="jobseeker-dashb-item2-mainheadv3">
                                <div class="jobseeker-modify-profile">

                                    <div class="jobseeker-currentcv-head">
                                        <h4>Your current CV</h4>
                                        <img src="{{url('frontend/assets/img/cvjobseeker.svg')}}" class="img-fluid">
                                        <p>CV Attached!</p>
                                        <a href="#"><span><i class="fas fa-download"></i></span> download cv</a>
                                    </div>
                                    <!--/end-->

                                    <div class="jobseeker-uploadcv-head">
                                        <h4>Upload new CV</h4>
                                        <p>We can accept the following file types: .doc, .docx, .rtf, .txt, .odt, .pdf
                                            and .wps</p>
                                        <div class="filepicker-dropdown" id="jobseekerfliker">
                                            <button id="" class="filepicker-dropdown__toggle valid" type="button"
                                                    aria-expanded="false" aria-invalid="false">
                                                Upload your CV
                                            </button>
                                            <div id="" class="filepicker-buttons">
                                                <button id="filepicker-device" type="button">
                                                    <img src="{{url('frontend/assets/img/device.png')}}"
                                                         alt="">
                                                    Device
                                                </button>
                                                <button id="filepicker-dropbox" type="button"
                                                        data-action="cloud-upload">
                                                    <img src="{{url('frontend/assets/img/filepicker-dropbox-icon.png')}}"
                                                         alt="">Dropbox
                                                </button>
                                                <button id="filepicker-googledrive" type="button"
                                                        data-action="cloud-upload">
                                                    <img src="{{url('frontend/assets/img/filepicker-googledrive-icon.png')}}"
                                                         alt="">Google Drive
                                                </button>
                                                <button id="filepicker-box" type="button" data-action="cloud-upload">
                                                    <img src="{{url('frontend/assets/img/filepicker-box-icon-btn.png')}}"
                                                         alt="">Box
                                                </button>
                                            </div>
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
                                        <h3>Personal Details</h3><span class="jobsekerdshed">
                    <p>dddhdhdhhhh</p>
                  </span>
                                        <div class="modifyaccount-personal-head">
                                            <div class="modifyaccount-perosnal-item1">
                                                <div class="modifyaccount-personal-item1-head">
                                                    <div class="modify-perosnal-item1-head-title">
                                                        <h5>Title</h5>
                                                    </div>
                                                    <div class="modify-perosnal-item1-head-option">
                                                        <div class="form-group">
                                                            <select class="form-control" id="titleform" required>

                                                                <option value="0">---Select a Title---</option>
                                                                <option value="1">Mr</option>
                                                                <option value="2">Mrs</option>
                                                                <option value="3">Miss</option>
                                                                <option value="4">Ms</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modifyaccount-personal-item1-head">
                                                    <div class="modify-perosnal-item1-head-title">
                                                        <h5>First Name</h5>
                                                    </div>
                                                    <div class="modify-perosnal-item1-head-option">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="firstname"
                                                                   placeholder="omi" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modifyaccount-personal-item1-head">
                                                    <div class="modify-perosnal-item1-head-title">
                                                        <h5>Last Name</h5>
                                                    </div>
                                                    <div class="modify-perosnal-item1-head-option">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="lirstname"
                                                                   placeholder="dev" required>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="modifyaccount-personal-item1-head">
                                                    <div class="modify-perosnal-item1-head-title">
                                                        <h5>Town/city</h5>
                                                    </div>
                                                    <div class="modify-perosnal-item1-head-option">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="city"
                                                                   placeholder="Hounslow West" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modifyaccount-personal-item1-head">
                                                    <div class="modify-perosnal-item1-head-title">
                                                        <h5>County/Location</h5>
                                                    </div>
                                                    <div class="modify-perosnal-item1-head-option">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <select class="form-control" id="location" required>
                                                                    <option value="0">---Select a County/Location---
                                                                    </option>
                                                                    <option value="228" id="county.1">Aberconwy and
                                                                        Colwyn
                                                                    </option>
                                                                    <option value="301" id="county.2">Aberdeenshire
                                                                    </option>
                                                                    <option value="201" id="county.3">Anglesey</option>
                                                                    <option value="302" id="county.4">Angus</option>
                                                                    <option value="501" id="county.5">Antrim</option>
                                                                    <option value="303" id="county.6">Argyllshire
                                                                    </option>
                                                                    <option value="502" id="county.7">Armagh</option>
                                                                    <option value="141" id="county.8">Avon</option>
                                                                    <option value="304" id="county.9">Ayrshire</option>
                                                                    <option value="305" id="county.10">Banffshire
                                                                    </option>
                                                                    <option value="101" id="county.11">Bedfordshire
                                                                    </option>
                                                                    <option value="507" id="county.12">Belfast</option>
                                                                    <option value="102" id="county.13">Berkshire
                                                                    </option>
                                                                    <option value="306" id="county.14">Berwickshire
                                                                    </option>
                                                                    <option value="224" id="county.15">Blaenau Gwent
                                                                    </option>
                                                                    <option value="335" id="county.16">Borders</option>
                                                                    <option value="202" id="county.17">Brecknockshire
                                                                    </option>
                                                                    <option value="230" id="county.18">Bridgend</option>
                                                                    <option value="103" id="county.19">Buckinghamshire
                                                                    </option>
                                                                    <option value="307" id="county.20">Buteshire
                                                                    </option>
                                                                    <option value="203" id="county.21">Caernarfonshire
                                                                    </option>
                                                                    <option value="225" id="county.22">Caerphilly
                                                                    </option>
                                                                    <option value="309" id="county.23">Caithness
                                                                    </option>
                                                                    <option value="104" id="county.24">Cambridgeshire
                                                                    </option>
                                                                    <option value="231" id="county.25">Cardiff</option>
                                                                    <option value="205" id="county.26">Cardiganshire
                                                                    </option>
                                                                    <option value="401" id="county.27">Carlow</option>
                                                                    <option value="204" id="county.28">Carmarthenshire
                                                                    </option>
                                                                    <option value="402" id="county.29">Cavan</option>
                                                                    <option value="336" id="county.30">Central</option>
                                                                    <option value="142" id="county.31">Channel Islands
                                                                    </option>
                                                                    <option value="105" id="county.32">Cheshire</option>
                                                                    <option value="310" id="county.33">
                                                                        Clackmannanshire
                                                                    </option>
                                                                    <option value="403" id="county.34">Clare</option>
                                                                    <option value="143" id="county.35">Cleveland
                                                                    </option>
                                                                    <option value="214" id="county.36">Clwyd</option>
                                                                    <option value="222" id="county.37">Conwy</option>
                                                                    <option value="404" id="county.38">Cork</option>
                                                                    <option value="106" id="county.39">Cornwall</option>
                                                                    <option value="308" id="county.40">Cromartyshire
                                                                    </option>
                                                                    <option value="107" id="county.41">Cumberland
                                                                    </option>
                                                                    <option value="144" id="county.42">Cumbria</option>
                                                                    <option value="206" id="county.43">Denbighshire
                                                                    </option>
                                                                    <option value="108" id="county.44">Derbyshire
                                                                    </option>
                                                                    <option value="405" id="county.45">Derry</option>
                                                                    <option value="109" id="county.46">Devon</option>
                                                                    <option value="406" id="county.47">Donegal</option>
                                                                    <option value="110" id="county.48">Dorset</option>
                                                                    <option value="503" id="county.49">Down</option>
                                                                    <option value="407" id="county.50">Dublin</option>
                                                                    <option value="337" id="county.51">Dumfries and
                                                                        Galloway
                                                                    </option>
                                                                    <option value="311" id="county.52">Dumfriesshire
                                                                    </option>
                                                                    <option value="312" id="county.53">Dunbartonshire
                                                                    </option>
                                                                    <option value="338" id="county.54">Dundee</option>
                                                                    <option value="111" id="county.55">Durham</option>
                                                                    <option value="215" id="county.56">Dyfed</option>
                                                                    <option value="313" id="county.57">East Lothian
                                                                    </option>
                                                                    <option value="145" id="county.58">East Sussex
                                                                    </option>
                                                                    <option value="339" id="county.59">Edinburgh
                                                                    </option>
                                                                    <option value="112" id="county.60">Essex</option>
                                                                    <option value="504" id="county.61">Fermanagh
                                                                    </option>
                                                                    <option value="314" id="county.62">Fife</option>
                                                                    <option value="207" id="county.63">Flintshire
                                                                    </option>
                                                                    <option value="408" id="county.64">Galway</option>
                                                                    <option value="208" id="county.65">Glamorgan
                                                                    </option>
                                                                    <option value="340" id="county.66">Glasgow</option>
                                                                    <option value="113" id="county.67">Gloucestershire
                                                                    </option>
                                                                    <option value="341" id="county.68">Grampian</option>
                                                                    <option value="140" id="county.69"
                                                                            selected="selected">Greater London
                                                                    </option>
                                                                    <option value="146" id="county.70">Greater
                                                                        Manchester
                                                                    </option>
                                                                    <option value="216" id="county.71">Gwent</option>
                                                                    <option value="217" id="county.72">Gwynedd</option>
                                                                    <option value="114" id="county.73">Hampshire
                                                                    </option>
                                                                    <option value="115" id="county.74">Herefordshire
                                                                    </option>
                                                                    <option value="116" id="county.75">Hertfordshire
                                                                    </option>
                                                                    <option value="342" id="county.76">Highland</option>
                                                                    <option value="147" id="county.77">Humberside
                                                                    </option>
                                                                    <option value="117" id="county.78">Huntingdonshire
                                                                    </option>
                                                                    <option value="315" id="county.79">Inverness-shire
                                                                    </option>
                                                                    <option value="148" id="county.80">Isle of Man
                                                                    </option>
                                                                    <option value="149" id="county.81">Isles of Scilly
                                                                    </option>
                                                                    <option value="118" id="county.82">Kent</option>
                                                                    <option value="409" id="county.83">Kerry</option>
                                                                    <option value="410" id="county.84">Kildare</option>
                                                                    <option value="411" id="county.85">Kilkenny</option>
                                                                    <option value="316" id="county.86">Kincardineshire
                                                                    </option>
                                                                    <option value="317" id="county.87">Kinross-shire
                                                                    </option>
                                                                    <option value="318" id="county.88">
                                                                        Kirkcudbrightshire
                                                                    </option>
                                                                    <option value="319" id="county.89">Lanarkshire
                                                                    </option>
                                                                    <option value="119" id="county.90">Lancashire
                                                                    </option>
                                                                    <option value="416" id="county.91">Laois</option>
                                                                    <option value="351" id="county.92">Leicester
                                                                    </option>
                                                                    <option value="120" id="county.93">Leicestershire
                                                                    </option>
                                                                    <option value="412" id="county.94">Leitrim</option>
                                                                    <option value="413" id="county.95">Limerick</option>
                                                                    <option value="121" id="county.96">Lincolnshire
                                                                    </option>
                                                                    <option value="506" id="county.97">Londonderry
                                                                    </option>
                                                                    <option value="414" id="county.98">Longford</option>
                                                                    <option value="343" id="county.99">Lothian</option>
                                                                    <option value="415" id="county.100">Louth</option>
                                                                    <option value="417" id="county.101">Mayo</option>
                                                                    <option value="418" id="county.102">Meath</option>
                                                                    <option value="209" id="county.103">Merioneth
                                                                    </option>
                                                                    <option value="150" id="county.104">Merseyside
                                                                    </option>
                                                                    <option value="232" id="county.105">Merthyr Tydfil
                                                                    </option>
                                                                    <option value="218" id="county.106">Mid Glamorgan
                                                                    </option>
                                                                    <option value="122" id="county.107">Middlesex
                                                                    </option>
                                                                    <option value="320" id="county.108">Midlothian
                                                                    </option>
                                                                    <option value="427" id="county.109">Monaghan
                                                                    </option>
                                                                    <option value="210" id="county.110">Monmouthshire
                                                                    </option>
                                                                    <option value="211" id="county.111">
                                                                        Montgomeryshire
                                                                    </option>
                                                                    <option value="321" id="county.112">Morayshire
                                                                    </option>
                                                                    <option value="322" id="county.113">Nairnshire
                                                                    </option>
                                                                    <option value="235" id="county.114">Neath and Port
                                                                        Talbot
                                                                    </option>
                                                                    <option value="348" id="county.115">Newcastle
                                                                    </option>
                                                                    <option value="226" id="county.116">Newport</option>
                                                                    <option value="123" id="county.117">Norfolk</option>
                                                                    <option value="151" id="county.118">North
                                                                        Yorkshire
                                                                    </option>
                                                                    <option value="124" id="county.119">
                                                                        Northamptonshire
                                                                    </option>
                                                                    <option value="125" id="county.120">Northumberland
                                                                    </option>
                                                                    <option value="350" id="county.121">Nottingham
                                                                    </option>
                                                                    <option value="126" id="county.122">
                                                                        Nottinghamshire
                                                                    </option>
                                                                    <option value="419" id="county.123">Offaly</option>
                                                                    <option value="323" id="county.124">Orkney</option>
                                                                    <option value="127" id="county.125">Oxfordshire
                                                                    </option>
                                                                    <option value="324" id="county.126">Peeblesshire
                                                                    </option>
                                                                    <option value="212" id="county.127">Pembrokeshire
                                                                    </option>
                                                                    <option value="347" id="county.128">Perth and
                                                                        Kinross
                                                                    </option>
                                                                    <option value="325" id="county.129">Perthshire
                                                                    </option>
                                                                    <option value="219" id="county.130">Powys</option>
                                                                    <option value="213" id="county.131">Radnorshire
                                                                    </option>
                                                                    <option value="349" id="county.132">Reading</option>
                                                                    <option value="326" id="county.133">Renfrewshire
                                                                    </option>
                                                                    <option value="233" id="county.134">Rhondda Cynon
                                                                        Taff
                                                                    </option>
                                                                    <option value="420" id="county.135">Roscommon
                                                                    </option>
                                                                    <option value="327" id="county.136">Ross-shire
                                                                    </option>
                                                                    <option value="328" id="county.137">Roxburghshire
                                                                    </option>
                                                                    <option value="128" id="county.138">Rutland</option>
                                                                    <option value="329" id="county.139">Selkirkshire
                                                                    </option>
                                                                    <option value="330" id="county.140">Shetland
                                                                    </option>
                                                                    <option value="129" id="county.141">Shropshire
                                                                    </option>
                                                                    <option value="421" id="county.142">Sligo</option>
                                                                    <option value="130" id="county.143">Somerset
                                                                    </option>
                                                                    <option value="220" id="county.144">South
                                                                        Glamorgan
                                                                    </option>
                                                                    <option value="152" id="county.145">South
                                                                        Yorkshire
                                                                    </option>
                                                                    <option value="131" id="county.146">Staffordshire
                                                                    </option>
                                                                    <option value="331" id="county.147">Stirlingshire
                                                                    </option>
                                                                    <option value="344" id="county.148">Strathclyde
                                                                    </option>
                                                                    <option value="132" id="county.149">Suffolk</option>
                                                                    <option value="133" id="county.150">Surrey</option>
                                                                    <option value="332" id="county.151">Sutherland
                                                                    </option>
                                                                    <option value="236" id="county.152">Swansea</option>
                                                                    <option value="345" id="county.153">Tayside</option>
                                                                    <option value="422" id="county.154">Tipperary
                                                                    </option>
                                                                    <option value="227" id="county.155">Torfaen</option>
                                                                    <option value="153" id="county.156">Tyne and Wear
                                                                    </option>
                                                                    <option value="505" id="county.157">Tyrone</option>
                                                                    <option value="234" id="county.158">Vale of
                                                                        Glamorgan
                                                                    </option>
                                                                    <option value="135" id="county.159">Warwickshire
                                                                    </option>
                                                                    <option value="423" id="county.160">Waterford
                                                                    </option>
                                                                    <option value="221" id="county.161">West Glamorgan
                                                                    </option>
                                                                    <option value="333" id="county.162">West Lothian
                                                                    </option>
                                                                    <option value="154" id="county.163">West Midlands
                                                                    </option>
                                                                    <option value="155" id="county.164">West Sussex
                                                                    </option>
                                                                    <option value="156" id="county.165">West Yorkshire
                                                                    </option>
                                                                    <option value="346" id="county.166">Western Isles
                                                                    </option>
                                                                    <option value="424" id="county.167">Westmeath
                                                                    </option>
                                                                    <option value="136" id="county.168">Westmorland
                                                                    </option>
                                                                    <option value="425" id="county.169">Wexford</option>
                                                                    <option value="426" id="county.170">Wicklow</option>
                                                                    <option value="334" id="county.171">Wigtownshire
                                                                    </option>
                                                                    <option value="137" id="county.172">Wiltshire
                                                                    </option>
                                                                    <option value="138" id="county.173">Worcestershire
                                                                    </option>
                                                                    <option value="223" id="county.174">Wrexham</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="modifyaccount-perosnal-item2">
                                                <div class="modifyaccount-personal-item2-head">
                                                    <div class="modify-perosnal-item2-head-title">
                                                        <h5> Postcode</h5>
                                                    </div>
                                                    <div class="modify-perosnal-item2-head-option">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="postcode"
                                                                   placeholder="TW47QB" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modifyaccount-personal-item2-head">
                                                    <div class="modify-perosnal-item2-head-title">
                                                        <h5> Main Phone</h5>
                                                    </div>
                                                    <div class="modify-perosnal-item2-head-option">
                                                        <div class="form-group">
                                                            <input type="tel" class="form-control" id="phone"
                                                                   placeholder="+447789514877" required>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="modifyaccount-personal-item2-head">
                                                    <div class="modify-perosnal-item2-head-title">
                                                        <h5> Optional</h5>
                                                    </div>
                                                    <div class="modify-perosnal-item2-head-option">
                                                        <div class="form-group">
                                                            <input type="tel" class="form-control" id="pptionalphone"
                                                                   placeholder="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modifyaccount-personal-item2-head">
                                                    <div class="modify-perosnal-item2-head-title">
                                                        <h5> Email</h5>
                                                    </div>
                                                    <div class="modify-perosnal-item2-head-option">
                                                        <div class="form-group">
                                                            <input type="email" class="form-control" id="emailaddress"
                                                                   placeholder="njoyner2022@gmail.com">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modifyaccount-personal-item2-head">
                                                    <div class="modify-perosnal-item2-head-title">
                                                        <h5> Age</h5>
                                                    </div>
                                                    <div class="modify-perosnal-item2-head-option">
                                                        <div class="form-group">
                                                            <select class="form-control" id="age">
                                                                <option value="0">---Select an Age---</option>
                                                                <option value="1" id="age.1">16 - 19</option>
                                                                <option value="2" id="age.2" selected="selected">20 -
                                                                    23
                                                                </option>
                                                                <option value="3" id="age.3">24 - 30</option>
                                                                <option value="4" id="age.4">31 - 35</option>
                                                                <option value="5" id="age.5">36 - 45</option>
                                                                <option value="6" id="age.6">46 - 54</option>
                                                                <option value="7" id="age.7">55+</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end 1-->
                                <div class="modify-account-personal-details">
                                    <h3>Job Details</h3><span class="jobsekerdshed">
                    <p>dddhdhdhhhh</p>
                  </span>
                                    <div class="modifyaccount-personal-head">
                                        <div class="modifyaccount-perosnal-item1">
                                            <div class="modifyaccount-personal-item1-head">
                                                <div class="modify-perosnal-item1-head-title">
                                                    <h5>Job Types</h5>
                                                    <span>Hold 'Ctrl' to select more than one job type</span>
                                                </div>
                                                <div class="modify-perosnal-item1-head-option">
                                                    <div class="form-group">
                                                        <select name="job_types" id="job_types" multiple="multiple"
                                                                required="required" class="valid" aria-invalid="false">
                                                            <option value="1" id="job_types.0" selected="selected">
                                                                Permanent
                                                            </option>
                                                            <option value="2" id="job_types.1">Temporary</option>
                                                            <option value="4" id="job_types.2">Contract</option>
                                                            <option value="5" id="job_types.3">Part Time</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modifyaccount-personal-item1-head">
                                                <div class="modify-perosnal-item1-head-title">
                                                    <h5>Current Job Title</h5>
                                                </div>
                                                <div class="modify-perosnal-item1-head-option">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="currentjobtitle"
                                                               placeholder="Software Developer">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modifyaccount-personal-item1-head">
                                                <div class="modify-perosnal-item1-head-title">
                                                    <h5>Desired Job Title</h5>
                                                </div>
                                                <div class="modify-perosnal-item1-head-option">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="desiredjob "
                                                               placeholder="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modifyaccount-personal-item1-head">
                                                <div class="modify-perosnal-item1-head-title">
                                                    <h5>Expected Salary</h5>
                                                </div>
                                                <div class="modify-perosnal-item1-head-option">
                                                    <div class="form-group">
                                                        <select class="form-control" id="salaryrangeexp">
                                                            <option value="0">---Select an Expected Salary---</option>
                                                            <option value="1" id="salary.1">£1 - £10,000</option>
                                                            <option value="2" id="salary.2" selected="selected">£10,001
                                                                - £15,000
                                                            </option>
                                                            <option value="3" id="salary.3">£15,001 - £20,000</option>
                                                            <option value="4" id="salary.4">£20,001 - £25,000</option>
                                                            <option value="5" id="salary.5">£25,001 - £30,000</option>
                                                            <option value="6" id="salary.6">£30,001 - £40,000</option>
                                                            <option value="7" id="salary.7">£40,001 - £60,000</option>
                                                            <option value="8" id="salary.8">£60,001 - £80,000</option>
                                                            <option value="9" id="salary.9">£80,001 - £100,000</option>
                                                            <option value="10" id="salary.10">£100,001 - £120,000
                                                            </option>
                                                            <option value="11" id="salary.11">£120,001+</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modifyaccount-personal-item1-head">
                                                <div class="modify-perosnal-item1-head-title">
                                                    <h5>Date Available</h5>
                                                </div>
                                                <div class="modify-perosnal-item1-head-option">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="dateavailable"
                                                               placeholder="10-5-2020">
                                                        <span>e.g  DD/MM/YYYY</span>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="modifyaccount-perosnal-item2">
                                            <div class="modifyaccount-personal-item2-head">
                                                <div class="modify-perosnal-item2-head-title">
                                                    <h5> Industries</h5>

                                                </div>
                                                <div class="modify-perosnal-item2-head-option">
                                                    <div class="form-group">
                                                        <select name="industries" id="industries" multiple="multiple"
                                                                required="required" class="valid" aria-invalid="false">
                                                            <option value="1" id="industries.0">Accountancy</option>
                                                            <option value="2" id="industries.1">Administration</option>
                                                            <option value="3" id="industries.2">Advertising</option>
                                                            <option value="4" id="industries.3">
                                                                Aerospace/Aviation/Defence
                                                            </option>
                                                            <option value="5" id="industries.4">Agriculture</option>
                                                            <option value="6" id="industries.5">Architecture</option>
                                                            <option value="7" id="industries.6">Art/Design/Graphics
                                                            </option>
                                                            <option value="8" id="industries.7">Automotive</option>
                                                            <option value="7" id="industries.6">Art/Design/Graphics
                                                            </option>
                                                            <option value="8" id="industries.7">Automotive</option>
                                                            <option value="7" id="industries.6">Art/Design/Graphics
                                                            </option>
                                                            <option value="8" id="industries.7">Automotive</option>
                                                            <option value="7" id="industries.6">Art/Design/Graphics
                                                            </option>
                                                            <option value="8" id="industries.7">Automotive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modifyaccount-personal-item2-head">
                                                <div class="modify-perosnal-item2-head-title">
                                                    <h5> Prepared to Travel</h5>
                                                </div>
                                                <div class="modify-perosnal-item2-head-option">
                                                    <div class="form-group">
                                                        <select class="form-control" id="pretravel">
                                                            <option value="1">up to 10 miles</option>
                                                            <option value="2">selected="selected">up to 20 miles
                                                            </option>
                                                            <option value="3">up to 35 miles</option>
                                                            <option value="4">up to 50 miles</option>
                                                            <option value="5">up to 100 miles</option>
                                                            <option value="6">up to 200 miles</option>
                                                            <option value="0">Anywhere</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="modifyaccount-personal-item2-head">
                                                <div class="modify-perosnal-item2-head-title">
                                                    <h5>Willing to Relocate</h5>
                                                </div>
                                                <div class="modify-perosnal-item2-head-option">
                                                    <div class="form-group">
                                                        <select class="form-control" id="Relocate">
                                                            <option value="1">Yes</option>
                                                            <option value="0" selected="selected">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modifyaccount-personal-item2-head">
                                                <div class="modify-perosnal-item2-head-title">
                                                    <h5> UK Driving Licence</h5>
                                                </div>
                                                <div class="modify-perosnal-item2-head-option">
                                                    <div class="form-group">
                                                        <select class="form-control" id="Licence">
                                                            <option value="1">Yes</option>
                                                            <option value="0" selected="selected">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <!--end2-->
                                <div class="modify-account-personal-details">
                                    <h3>Main Skills & Languages</h3><span class="jobsekerdshed">
                    <p>dddhdhdhhhh</p>
                  </span>
                                    <div class="jobseeker-mainskill-head">
                                        <div class="jobseeker-mainskill-item1">
                                            <p>Enter up to 10 keywords/phrases, separated by commas.</p>
                                            <div class="jobskerskillstext">
                                                <textarea name="skills" id="skills"
                                                          placeholder="e.g. Communication, time management, social media"
                                                          rows="5" cols="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="jobseeker-mainskill-item2">
                                            <div class="modify-cv-languages">

                                                <div class="languages">
                                                    <label for="languages">Fluent
                                                        Languages<span>Select up to 5</span></label>
                                                    <select name="languages" id="languages" multiple="multiple"
                                                            class="valid" aria-invalid="false">
                                                        <option value="1" id="languages.0">Afrikaans</option>
                                                        <option value="2" id="languages.1">Albanian</option>
                                                        <option value="3" id="languages.2">Arabic</option>
                                                        <option value="4" id="languages.3">Basque</option>
                                                        <option value="5" id="languages.4">Bulgarian</option>
                                                        <option value="6" id="languages.5">Byelorussian</option>
                                                        <option value="7" id="languages.6">Catalan</option>
                                                        <option value="8" id="languages.7">Croatian</option>
                                                        <option value="9" id="languages.8">Czech</option>
                                                        <option value="10" id="languages.9">Danish</option>
                                                        <option value="11" id="languages.10">Dutch</option>
                                                        <option value="13" id="languages.11">Esperanto</option>
                                                        <option value="14" id="languages.12">Estonian</option>
                                                        <option value="15" id="languages.13">Faroese</option>
                                                        <option value="16" id="languages.14">Finnish</option>
                                                        <option value="17" id="languages.15">French</option>
                                                        <option value="18" id="languages.16">Galician</option>
                                                        <option value="19" id="languages.17">German</option>
                                                        <option value="20" id="languages.18">Greek</option>
                                                        <option value="21" id="languages.19">Hebrew</option>
                                                        <option value="22" id="languages.20">Hungarian</option>
                                                        <option value="23" id="languages.21">Icelandic</option>
                                                        <option value="24" id="languages.22">Irish</option>
                                                        <option value="25" id="languages.23">Italian</option>
                                                        <option value="26" id="languages.24">Japanese</option>
                                                        <option value="27" id="languages.25">Korean</option>
                                                        <option value="28" id="languages.26">Lapp</option>
                                                        <option value="29" id="languages.27">Latvian</option>
                                                        <option value="30" id="languages.28">Lithuanian</option>
                                                        <option value="31" id="languages.29">Mandarin</option>
                                                        <option value="32" id="languages.30">Macedonian</option>
                                                        <option value="33" id="languages.31">Maltese</option>
                                                        <option value="34" id="languages.32">Norwegian</option>
                                                        <option value="35" id="languages.33">Polish</option>
                                                        <option value="36" id="languages.34">Portuguese</option>
                                                        <option value="37" id="languages.35">Romanian</option>
                                                        <option value="38" id="languages.36">Russian</option>
                                                        <option value="39" id="languages.37">Serbian</option>
                                                        <option value="41" id="languages.38">Slovak</option>
                                                        <option value="42" id="languages.39">Slovenian</option>
                                                        <option value="43" id="languages.40">Spanish</option>
                                                        <option value="44" id="languages.41">Swedish</option>
                                                        <option value="45" id="languages.42">Turkish</option>
                                                        <option value="46" id="languages.43">Ukrainian</option>
                                                        <option value="47" id="languages.44">Welsh</option>
                                                        <option value="95" id="languages.45">Thai</option>
                                                        <option value="96" id="languages.46">Hindi</option>
                                                        <option value="97" id="languages.47">Punjabi</option>
                                                        <option value="98" id="languages.48">Persian</option>
                                                        <option value="99" id="languages.49">Cantonese</option>
                                                    </select>
                                                    <div class="error_message" style="display: none;"></div>
                                                </div>
                                                <p class="fluent">Fluent Languages Only</p>
                                                <p class="hold">(Hold 'Ctrl' and click to select or deselect up to 5
                                                    languages.)</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!--end3-->
                                <div class="jobseeker-modify-btn-botm">
                                    <a href="#" class="btn btn-primary" id="savejobseeker">
                                        save all changes <span><i class="fas fa-chevron-right"></i></span>
                                    </a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--/jobseeker-main-dashobard-content-->
        </div>
    </div>

@endsection