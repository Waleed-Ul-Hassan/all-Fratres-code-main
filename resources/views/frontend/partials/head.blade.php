<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="image" content="{{asset('frontend/assets/img/share-logo.png')}}">
    <meta name="image" property="og:image" content="{{asset('frontend/assets/img/share-logo.png')}}">
    <meta property="og:url" content="{{url('/')}}"/>
    <meta name="author" content="Fratres">
    <link rel="canonical" content="{{url('/')}}">




    @yield('meta_info')

    <meta name="google" content="notranslate"/>




    <!-- Bootstrap CSS -->
    <link rel="preload" href="{{url('frontend/assets/lib/Bootstrap/css/bootstrap.min.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{url('frontend/assets/lib/Bootstrap/css/bootstrap.min.css')}}"></noscript>
    <!-- font-awesome CSS -->
{{--    <link rel="stylesheet" href="{{url('frontend/assets/css/fonts/all.css')}}">--}}
    {{--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">--}}
     <!-- style CSS -->
    <link rel="stylesheet"  href="{{url('frontend/assets/css/style.css?v=2.1')}}" >
{{--    <link rel="preload" href="{{url('frontend/assets/css/style.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">--}}
{{--    <noscript><link rel="stylesheet" href="{{url('frontend/assets/css/style.css')}}"></noscript>--}}

    {{--<link rel="preload" href="{{url('frontend/assets/css/responsive.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">--}}
    {{--<noscript><link rel="stylesheet" href="{{url('frontend/assets/css/responsive.css')}}"></noscript>--}}



    <link rel="preload" href="{{url('frontend/assets/css/slick.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{url('frontend/assets/css/slick.css')}}"></noscript>

    <link rel="preload" href="{{url('frontend/assets/css/owl.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{url('frontend/assets/css/owl.css')}}"></noscript>
    <link rel="preload" href="{{url('frontend/assets/css/owltheme.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{url('frontend/assets/css/owltheme.css')}}"></noscript>

    <link rel="preload" href="{{url('frontend/assets/css/jquery-ui.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="{{url('frontend/assets/css/jquery-ui.css')}}" rel="stylesheet"></noscript>
    {{--<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" rel="stylesheet">--}}
    <script src="{{url('frontend/assets/lib/jquery/jquery-3.3.1.min.js')}}" ></script>


    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/css/tooltipster.min.css">--}}




    @yield('style')




    <script src="{{asset('frontend/pace/pace.js')}}"></script>
    <link rel="icon" href="{{asset('logo/favicon-16x16.png')}}" sizes="16x16" type="image/png">



    {!! $settings->google_analytics !!}


<!-- Begin Inspectlet Asynchronous Code -->
    <script type="text/javascript">
        (function() {
            window.__insp = window.__insp || [];
            __insp.push(['wid', 693760098]);
            var ldinsp = function(){
                if(typeof window.__inspld != "undefined") return; window.__inspld = 1; var insp = document.createElement('script'); insp.type = 'text/javascript'; insp.async = true; insp.id = "inspsync"; insp.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdn.inspectlet.com/inspectlet.js?wid=693760098&r=' + Math.floor(new Date().getTime()/3600000); var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(insp, x); };
            setTimeout(ldinsp, 0);
        })();
    </script>
    <!-- End Inspectlet Asynchronous Code -->


  </head>

