<!DOCTYPE html>
<html lang="en">

@include('frontend.partials.head')
<body>

{{--desktopview starts--}}

@include('frontend.partials.header')

    @yield('content')

@if(@auth('recruiter')->user())
    @include('frontend.recruiter.partials.credits')
@endif

@include('frontend.partials.footer')


<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

    <a href="{{url('seeker/login')}}" class="mbl-jobdetail-loginbtn ">
        Seeker login
    </a>
    <a href="{{url('/')}}">Home</a>
    <a href="{{url('create-job-alerts')}}">job alerts</a>
    <a href="{{url('search')}}">browse jobs</a>
    <a href="{{url('career-advice')}}">career advice</a>
    <a href="{{url('companies')}}">company a-z</a>
    <a href="{{url('recruiter/login')}}">Recruiting?</a>
</div>

<!-- Use any element to open the sidenav -->

{{--linkdin tag--}}
<script type="text/javascript">
    _linkedin_partner_id = "3370913";
    window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
    window._linkedin_data_partner_ids.push(_linkedin_partner_id);
</script><script type="text/javascript">
    (function(){var s = document.getElementsByTagName("script")[0];
        var b = document.createElement("script");
        b.type = "text/javascript";b.async = true;
        b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
        s.parentNode.insertBefore(b, s);})();
</script>
<noscript>
    <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=3370913&fmt=gif" />
</noscript>

<script>


    $(document).ready(function(){

        $('.slick-prev slick-arrow').text('Hello world');
        $('#jobseeker-drop1').hide();
        $("#sidebarSkillsLabel").click(function(){
            $("#sidebarSkillsLabel .fa-chevron-down").toggleClass("rtoate180");
            $('#jobseeker-drop1').slideToggle();

        });

    });
</script>



<script>
    $('ul.nav li.dropdown').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
    }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
    });
</script>


@yield('mblview')

@php $coupon = \App\Coupon::where('discount', 100)->first() @endphp
@if($coupon && $settings->website_is_free == 0)

<div class="modal fade" id="couponModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-lg-popup" role="document">
        <div class="modal-content " style="background: url('{{asset('frontend/assets/img/bg-coupon.jpg')}}'); background-position: inherit;background-size: cover;height: 238px;">

            <div class="modal-body" style="padding-bottom: 0px; ">
                <button type="button" class="close close-custom" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>

                    <div class="row">
                        <div class="col-12 " style="padding: 10px;color:#000;">

                        <h3 class="mt-5">POST FREE JOB TODAY</h3>
                        <p class="mt-2"><b>{{$coupon->coupon_code}}</b> coupon for 100% discount</p>
                        <h5 class="coupon-css float-right"> <b>{{$coupon->coupon_code}}</b></h5>

                        </div>

                    </div>




            </div>

        </div>
    </div>
</div>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
@endif


<script src="https://unpkg.com/@popperjs/core@2" ></script>
{{--<script src="{{url('frontend/assets/lib/popper/popper.min.js')}}" ></script>--}}
{{--<script src="{{url('frontend/assets/lib/Bootstrap/js/bootstrap.min.js')}}" ></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{--<link rel="preload" as="script" href="{{url('frontend/assets/lib/Bootstrap/js/bootstrap.min.js')}}">--}}
{{--<noscript><script src="{{url('frontend/assets/lib/Bootstrap/js/bootstrap.min.js')}}" ></script></noscript>--}}

{{--<script src="{{url('frontend/assets/js/main.js')}}"></script>--}}
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js" ></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js" ></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" ></script>


{{--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" ></script>--}}

<script src="{{url('js/newsletter.js')}}" ></script>
<script src="//api.jobtome.com/trust.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.2/owl.carousel.min.js"></script>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/js/jquery.tooltipster.min.js"></script>--}}

<script>

        @if( !Cookie::get('seen_coupon') )
        $("#couponModal").modal('show');
        {{Cookie::queue('seen_coupon', true, 15)}}
    @endif


    // $("#couponModal").modal('show');
    // $(document).ready(function(){
    //     $('.tooltip-ster').tooltipster({
    //         theme: 'tooltipster-noir'
    //     });
    // });
    // google translator

    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.FloatPosition.TOP_LEFT}, 'google_translate_element');
        console.log(google.translate.TranslateElement.FloatPosition);
    }

    function triggerHtmlEvent(element, eventName) {
        var event;
        if (document.createEvent) {
            event = document.createEvent('HTMLEvents');
            event.initEvent(eventName, true, true);
            element.dispatchEvent(event);
        } else {
            event = document.createEventObject();
            event.eventType = eventName;
            element.fireEvent('on' + event.eventType, event);
        }
    }

    $('.lang-select').click(function() {
        var theLang = $(this).attr('data-lang');
        $('.goog-te-combo').val(theLang);

        //alert(jQuery(this).attr('href'));
        window.location = jQuery(this).attr('href');
        location.reload();


    });

        // google translator

    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }

    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type') }}";
        console.log(type);
        switch (type) {
            case 'info':
                swal({
                    title: "{{ Session::get('message') }}",
                    text: "{{ Session::get('text') }}",
                    icon: "info",
                    button: "{{ Session::get('button') }}",
                    timer: 2500,
                });
                break;

            case 'warning':
                swal({
                    title: "{{ Session::get('message') }}",
                    text: "{{ Session::get('text') }}",
                    icon: "warning",
                    button: "{{ Session::get('button') }}",
                    timer: 2500,
                });
                break;

            case 'success':
                console.log('here');
                swal({
                    title: "{{ Session::get('message') }}",
                    text: "{{ Session::get('text') }}",
                    icon: "success",
                    button: "{{ Session::get('button') }}",
                    timer: 2500,
                });
                break;

            case 'error':
                console.log('error');
                swal({
                    title: "{{ Session::get('message') }}",
                    text: "{{ Session::get('text') }}",
                    icon: "error",
                    button: "{{ Session::get('button') }}",
                    timer: 2500,
                });
                break;
        }
    @endif

    jQuery.event.special.touchstart = {
        setup: function( _, ns, handle ) {
            this.addEventListener("touchstart", handle, { passive: !ns.includes("noPreventDefault") });
        }
    };
</script>
@if($settings->google_translator == 1)
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
@endif


@yield('scripts')

</body>
</html>