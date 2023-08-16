@extends('frontend.layouts.main')

@section('meta_info')
    @php $seo = \App\Seo::where('page_key','career_advice')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')

    <style>
        .jobblog-item-wrpr2-title a {
            font-size: 14px !important;
        }
    </style>

    <link rel="stylesheet" href="https://blog.fratres.net/assets/css/owl.css">
    <link rel="stylesheet" href="https://blog.fratres.net/assets/css/owltheme.css">

    <link rel="stylesheet" href="https://blog.fratres.net/assets/css/style.css">
    <link rel="stylesheet" href="https://blog.fratres.net/assets/css/responsive.css">


        <!--main-->

        <div class="main-blog-wrapper">
            <div class="container">
                <div class="jobblog-main">
                    <div class="jobblog-title-head">
                        <!-- <h2>Career advice</h2> -->
                    </div>
                    <div class="jobblog-main-menu">
                        <h1 class="text-center"><span>Career advice</span></h1>
                        <br>
                        <ul id="desktopviewblogmenu">
                            <li>
                                <div class="jobblogmenulist">
                                    <a href="{{url('/')}}" class="jobbloglistbtn"><i class="fas fa-home"></i></a>
                                </div>
                            </li>
                            @if($categories)
                            @foreach($categories as $category)
                                <li>
                                    <div class="jobblogmenulist">
                                        <a href="{{url('category/'.$category->slug)}}"  class="jobbloglistbtn">{{$category->name}}</a>
                                    </div>
                                </li>
                            @endforeach
                                @endif


                        </ul>
                        <hr>
                        <div id="mbliewblogmenu">

                            <div id="accordion" class="accordion">
                                <div class="card mb-0">
                                    <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
                                        <a class="card-title">
                                            Career advice
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="card-body collapse" data-parent="#accordion" >
                                        <div class="mbmenublogtop">
                                            <ul>
                                                @if($categories)
                                                @foreach($categories as $category)
                                                    <li>

                                                        <a href="{{url('category/'.$category->slug)}}"  class="jobbloglistbtn">{{$category->name}}</a>

                                                    </li>
                                                @endforeach
                                                    @endif
                                            </ul>
                                            <br>
                                        </div>
                                    </div>





                                </div>

                            </div>



                        </div>

                        {{--<div class="blog-main-porfolio-head">--}}
                        {{--@foreach($randomBlogs as $randomBlog)--}}
                        {{--<div class="col-md-4">--}}
                        {{--<div class="jobblog-item1-wrapper">--}}
                        {{--<div class="jobblog-item1-bg-profile">--}}
                        {{--<img src="{{asset('uploads/blog/'.$randomBlog->image)}}" class="img-fluid max-img-height">--}}

                        {{--</div>--}}
                        {{--<div class="jobblog-item-wrpr-title">--}}
                        {{--<a href="{{url('/'.$randomBlog->slug)}}">--}}
                        {{--{{Str::limit($randomBlog->title,70)}}--}}
                        {{--</a>--}}
                        {{--</div>--}}
                        {{--<div class="jobblog-item1wrapper-botm">--}}
                        {{--<span>by</span>--}}
                        {{--<a href="{{url('author/'.$randomBlog->user->name)}}">--}}
                        {{--{{$randomBlog->user->name}}--}}
                        {{--</a> in--}}
                        {{--<u class="jobblog-item-wrpr-title">--}}
                        {{--<a href="{{url('category/'.$randomBlog->category->slug)}}">--}}
                        {{--{{$randomBlog->category->name}}--}}
                        {{--</a>--}}
                        {{--</u>--}}
                        {{--</div>--}}

                        {{--</div>--}}
                        {{--</div>--}}

                        {{--@endforeach--}}

                        {{--</div>--}}
                        <div class="blog-main-porfolio-head">
                            <div class="blog-portfolio-item1">
                                <div class="jobblog-item1-wrapper">
                                    <div class="jobblog-item1-bg-profile">
                                        @if($randomBlogs)
                                        <img src="https://blog.fratres.net/uploads/blog/{{$randomBlogs->image}}" class="img-fluid" style="width:100%;max-height:400px;">

                                        <div class="socialShare">
                                            <div class="socialBox pointer">
                                                <span class="fa fa-share-alt"></span>
                                                <div class="socialGallery">
                                                    <div class="socialToolBox">
                                                        @php
                                                            $facebook = "https://www.facebook.com/sharer/sharer.php?u=".url('/'.urlencode($randomBlogs->slug))."&t=".urlencode($randomBlogs->title)."&quote=";
                                                            $twitter = "https://twitter.com/intent/tweet?text=".urlencode($randomBlogs->title)."&url=".url(urlencode($randomBlogs->slug));
                                                            $whatsapp = "https://api.whatsapp.com/send?text=".urlencode($randomBlogs->title)."&url=".url(urlencode($randomBlogs->slug));


                                                        @endphp
                                                        <a class="facebook" href="#" onclick="window.open('{{$facebook}}', 'name','width=600,height=400')"><i class="fab fa-facebook-f"></i></a>
                                                        <a class="whatsapp" href="" onclick="window.open('{{$whatsapp}}', 'name','width=600,height=400')"><i class="fab fa-whatsapp"></i></a>
                                                        <a class="twitter" onclick="window.open('{{$twitter}}', 'name','width=600,height=400')" href=""><i class="fab fa-twitter"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    @if($randomBlogs)
                                    <div class="jobblog-item-wrpr-title">
                                        <a href="{{url('career-advice/'.$randomBlogs->slug)}}">
                                            {{$randomBlogs->title}}
                                        </a>
                                    </div>
                                    <div class="jobblog-item1wrapper-botm">
                                        <span>by</span><a href="{{url('author/'.$randomBlogs->user->name)}}">
                                            {{$randomBlogs->user->name}}
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="blog-portfolio-item2">
                                @if($randomBlogstwo)
                                    @foreach($randomBlogstwo as $value)
                                    <div class="jobblog-item2-wrapper">
                                        <div class="jobblog-item2-wrapper-profile">
                                            <img src="https://blog.fratres.net/uploads/blog/{{$value->image}}" class="img-fluid" style="max-height:195px;min-width: 100%;">
                                            <div class="socialShare">
                                                <div class="socialBox pointer">
                                                    <span class="fa fa-share-alt"></span>
                                                    <div class="socialGallery">
                                                        <div class="socialToolBox">
                                                            @php
                                                                $facebook = "https://www.facebook.com/sharer/sharer.php?u=".url('/'.urlencode($value->slug))."&t=".urlencode($value->title)."&quote=";
                                                                $twitter = "https://twitter.com/intent/tweet?text=".urlencode($value->title)."&url=".url(urlencode($value->slug));
                                                                $whatsapp = "https://api.whatsapp.com/send?text=".urlencode($value->title)."&url=".url(urlencode($value->slug));


                                                            @endphp
                                                            <a class="facebook" href="#" onclick="window.open('{{$facebook}}', 'name','width=600,height=400')"><i class="fab fa-facebook-f"></i></a>
                                                            <a class="whatsapp" href="" onclick="window.open('{{$whatsapp}}', 'name','width=600,height=400')"><i class="fab fa-whatsapp"></i></a>
                                                            <a class="twitter" onclick="window.open('{{$twitter}}', 'name','width=600,height=400')" href=""><i class="fab fa-twitter"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="jobblog-item-wrpr2-title">
                                            <a href="{{url('career-advice/'.$value->slug)}}">
                                                {{$value->title}}
                                            </a>
                                        </div>
                                        <div class="jobblog-item2wrapper-botm">
                                            <span>by</span><a href="{{url('author/'.$value->user->name)}}">
                                                {{$value->user->name}}
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                                @endif
                            </div>

                        </div>


                        <div class="jobblog-details col-md-12">
                            <p>Our advice centre contains articles with helpful tips, how-to guides and CV templates. Written by career experts, we're committed to helping your job search and ensuring you get the most from your career.</p>
                        </div>

                        <section class="latest-project-blog">
                            <div class="jobblog-latest-head">
                                <div class="jobblog-latest-item1">
                                    <div class="bloglatest-item1heading">
                                        <h3><a href="#">Latest articles</a></h3>
                                    </div>
                                    <div id="owl-demo" class="owl-carousel owl-theme">
                                        @if($latests)
                                            @foreach($latests as $latest)
                                            <div class="item" title="{{$latest->title}}">

                                                <div class="jobblog-latestproject-head">
                                                    <div class="jobblog-latestproject-item">
                                                        <div class="jobblog-item-latestlogo">
                                                            <img src="https://blog.fratres.net/uploads/blog/{{$latest->image}}" class="img-fluid">
                                                            <div class="socialShare pbottm">
                                                                <div class="socialBox pointer">
                                                                    <span class="fa fa-share-alt"></span>
                                                                    <div class="socialGallery">
                                                                        <div class="socialToolBox">
                                                                            @php
                                                                                $facebook = "https://www.facebook.com/sharer/sharer.php?u=".url('/'.urlencode($latest->slug))."&t=".urlencode($latest->title)."&quote=";
                                                                                $twitter = "https://twitter.com/intent/tweet?text=".urlencode($latest->title)."&url=".url(urlencode($latest->slug));
                                                                                $whatsapp = "https://api.whatsapp.com/send?text=".urlencode($latest->title)."&url=".url(urlencode($latest->slug));


                                                                            @endphp
                                                                            <a class="facebook" href="#" onclick="window.open('{{$facebook}}', 'name','width=600,height=400')"><i class="fab fa-facebook-f"></i></a>
                                                                            <a class="whatsapp" href="" onclick="window.open('{{$whatsapp}}', 'name','width=600,height=400')"><i class="fab fa-whatsapp"></i></a>
                                                                            <a class="twitter" onclick="window.open('{{$twitter}}', 'name','width=600,height=400')" href=""><i class="fab fa-twitter"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="jobblog-item-latestlink">
                                                            <a href="{{url('career-advice/'.$latest->slug)}}">{{Str::limit($latest->title,25)}}</a>
                                                        </div>
                                                        <div class="jobblog-latest-fotr-details">
                                                            <ul>
                                                                <li>
                                                                    <p> <small>By</small>
                                                                        <a href="{{url('author/'.$latest->user->name)}}">
                                                                            {{$latest->user->name}}
                                                                        </a>
                                                                    </p>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @endif

                                    </div>

                                @foreach($categories as $category)
                                    @php $posts = $category->load('latest_posts')->latest_posts @endphp
                                    <!--blog2-->
                                        <div class="bloglatest-item1heading">
                                            <h3>{{$category->name}}</h3>
                                        </div>

                                        <div id="owl-demo" class="owl-carousel owl-theme">
            @if($posts)
                                            @foreach($posts as $post)
                                                <div class="item">
                                                    <div class="jobblog-latestproject-head">
                                                        <div class="blog-item-1wraper-latestproject">
                                                            <div class="blog-itemv2-latestproject">
                                                                <div class="blog-itemv2-profile">
                                                                    <img src="https://blog.fratres.net/uploads/blog/{{$post->image}}" class="img-fluid">
                                                                    <div class="socialShare pbottm">
                                                                        <div class="socialBox pointer">
                                                                            <span class="fa fa-share-alt"></span>
                                                                            <div class="socialGallery">
                                                                                <div class="socialToolBox">
                                                                                    @php
                                                                                        $facebook = "https://www.facebook.com/sharer/sharer.php?u=".url('/'.urlencode($post->slug))."&t=".urlencode($post->title)."&quote=";
                                                                                        $twitter = "https://twitter.com/intent/tweet?text=".urlencode($post->title)."&url=".url(urlencode($post->slug));
                                                                                        $whatsapp = "https://api.whatsapp.com/send?text=".urlencode($post->title)."&url=".url(urlencode($post->slug));


                                                                                    @endphp
                                                                                    <a class="facebook" href="#" onclick="window.open('{{$facebook}}', 'name','width=600,height=400')"><i class="fab fa-facebook-f"></i></a>
                                                                                    <a class="whatsapp" href="" onclick="window.open('{{$whatsapp}}', 'name','width=600,height=400')"><i class="fab fa-whatsapp"></i></a>
                                                                                    <a class="twitter" onclick="window.open('{{$twitter}}', 'name','width=600,height=400')" href=""><i class="fab fa-twitter"></i></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="blog-itemv2-details">
                                                                    <a href="{{url('career-advice/'.$post->slug)}}">{{Str::limit($post->title,20)}}</a>
                                                                </div>
                                                                <div class="jobblog-latest-fotr-details">
                                                                    <ul>

                                                                        <li>
                                                                            <p><small>by </small>
                                                                                <a href="{{url('author/'.$post->user->name)}}">
                                                                                    {{$post->user->name}}
                                                                                </a>
                                                                            </p>
                                                                        </li>

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @endif


                                        </div>
                                        <!--end-->
                                @endforeach


                                <!--new content-->

                                    {{--<div class="bloglatest-item1heading">--}}
                                        {{--<h3><a href="javascript:void(0)">The latest jobs on Fratres</a></h3>--}}
                                    {{--</div>--}}
                                    {{--<div class="clearfix"></div>--}}



                                    {{--<div class="blog-test-bottom-content-head">--}}
                                        {{--<div class="blog-content-v1">--}}
                                            {{--<div class="latestblog-item2-wrapper">--}}
                                                {{--<div class="item2bloglatest-head">--}}
                                                    {{--<h3>Jobs By Category</h3>--}}
                                                {{--</div>--}}
                                                {{--<div class="blog-jobcategoryhead">--}}
                                                    {{--<div class="blog-jobcatev1">--}}
                                                        {{--<ul>--}}
                                                            {{--<li>--}}
                                                                {{--<a href="#">--}}
                                                                    {{--Care Jobs--}}
                                                                {{--</a>--}}
                                                            {{--</li>--}}
                                                            {{--<li>--}}
                                                                {{--<a href="#" title=" Sales Manager Jobs">--}}
                                                                    {{--Sales  Jobs--}}
                                                                {{--</a>--}}
                                                            {{--</li>--}}
                                                            {{--<li>--}}
                                                                {{--<a href="#">--}}
                                                                    {{--IT Jobs--}}
                                                                {{--</a>--}}
                                                            {{--</li>--}}
                                                            {{--<li>--}}
                                                                {{--<a href="#">--}}
                                                                    {{--Marketing Jobs--}}
                                                                {{--</a>--}}
                                                            {{--</li>--}}
                                                            {{--<li>--}}
                                                                {{--<a href="#">--}}
                                                                    {{--Nursing Jobs--}}
                                                                {{--</a>--}}
                                                            {{--</li>--}}
                                                            {{--<li>--}}
                                                                {{--<a href="#">--}}
                                                                    {{--Teaching Jobs--}}
                                                                {{--</a>--}}
                                                            {{--</li>--}}
                                                        {{--</ul>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="blog-jobcatv2">--}}
                                                        {{--<ul>--}}
                                                            {{--<li>--}}
                                                                {{--<a href="#" title=" Business Development Jobs">--}}
                                                                    {{--Business  Jobs--}}
                                                                {{--</a>--}}
                                                            {{--</li>--}}
                                                            {{--<li>--}}
                                                                {{--<a href="#">--}}
                                                                    {{--Sales Jobs--}}
                                                                {{--</a>--}}
                                                            {{--</li>--}}
                                                            {{--<li>--}}
                                                                {{--<a href="#" title=" Software Developer Jobs">--}}
                                                                    {{--Software  Jobs--}}
                                                                {{--</a>--}}
                                                            {{--</li>--}}
                                                            {{--<li>--}}
                                                                {{--<a href="#">--}}
                                                                    {{--Healthcare Jobs--}}
                                                                {{--</a>--}}
                                                            {{--</li>--}}
                                                            {{--<li>--}}
                                                                {{--<a href="#" title="  Digital Marketing jobs--}}
                      {{--.">--}}
                                                                    {{--Digital jobs                      </a>--}}
                                                            {{--</li>--}}
                                                            {{--<li>--}}
                                                                {{--<a href="#" title=" Teaching Assistant jobs">--}}
                                                                    {{--Teaching jobs--}}
                                                                {{--</a>--}}
                                                            {{--</li>--}}
                                                        {{--</ul>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                        {{--<div class="blog-content-v2">--}}
                                            {{--<div class="latestblog-item2-wrapper">--}}
                                                {{--<div class="item2bloglatest-head">--}}
                                                    {{--<h3>Jobs By Country</h3>--}}
                                                {{--</div>--}}
                                                {{--<div class="blog-jobcategoryhead">--}}
                                                    {{--<div class="blog-jobcatev1">--}}
                                                        {{--<ul>--}}
                                                            {{--@php $counter = 0; @endphp--}}
                                                            {{--@foreach($flags as $flag)--}}
                                                                {{--@if($counter == 7)  @break; @endif--}}
                                                                {{--<li>--}}
                                                                    {{--<a href="https://{{$flag->url}}">--}}
                                                                        {{--{{$flag->name}}--}}
                                                                    {{--</a>--}}
                                                                {{--</li>--}}
                                                                {{--@php $counter++; @endphp--}}
                                                            {{--@endforeach--}}
                                                        {{--</ul>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="blog-jobcatv2">--}}
                                                        {{--<ul>--}}
                                                            {{--@php $counter = 0; @endphp--}}
                                                            {{--@foreach($flags as $flag)--}}
                                                                {{--@if($counter <= 7) @php $counter++; @endphp  @continue; @endif--}}
                                                                {{--@if($counter == 13)  @break; @endif--}}
                                                                {{--<li>--}}
                                                                    {{--<a href="https://{{$flag->url}}">--}}
                                                                        {{--{{$flag->name}}--}}
                                                                    {{--</a>--}}
                                                                {{--</li>--}}
                                                                {{--@php $counter++; @endphp--}}
                                                            {{--@endforeach--}}
                                                            {{--<li><a href="{{url('blogger/country')}}" style="color:#ff8a00;">See More</a> </li>--}}
                                                        {{--</ul>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}





                                    {{--</div>--}}

                                    <!--end-->
                                    <div class="blog-test-bottom-content-head">
                                        <div class="blog-contentpopular">
                                            <div class="latestblog-item2-wrapper">
                                                <div class="item2bloglatest-head">
                                                    <h3>popular jobs</h3>
                                                </div>
                                                <div class="blog-jobcategoryhead">
                                                    @foreach ($industries->chunk(20) as $industry)
                                                        <div class="blog-jobcatev1">
                                                        <ul>
                                                            @foreach ($industry as $product)
                                                                <li><a href="{{url('search?industry='.$product->industry_slug)}}">{{$product->name}}</a></li>
                                                            @endforeach

                                                        </ul>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="jobblog-latest-item2">
                                    <div class="latestblog-item2-wrapper">
                                        <!-- <div class="item2bloglatest-head">
                                          <h3>Impacted by Covid-19?</h3>
                                        </div> -->
                                        <div class="b b_promo">
                                            <h2>Cv Maker</h2>
                                            <p>Search 1000's of remote jobs</p>
                                            <img src="https://blog.fratres.net/assets/img/portfolio.png" width="60" height="">
                                            <div class="pt-4">
                                                <a href="{{url('seeker/cv-maker/register')}}" class="btn btn-primary">Cv Maker »</a>
                                            </div>

                                        </div>



                                    </div>

                                    {{--<div class="latestblog-item2-wrapper latestblog-item2-wrapperbg">--}}

                                        {{--<div class="b mobile-app blogmobile-app">--}}

                                            {{--<h2>Get the mobile app<span class="badge">NEW!</span></h2>--}}

                                            {{--<p>Continue your search from your iPhone or Android phone.</p>--}}

                                            {{--<div>--}}
                                                {{--<a href="#" class="btn btn-primary" data-track="mobile_promo" target="_blank">Download now</a></div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                </div>
                            </div>
                        </section>

                    </div>


                </div>




            </div>
        </div>



    <script src="https://blog.fratres.net/assets/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js"></script>
    <script src="https://blog.fratres.net/assets/dropify/js/dropify.js"></script>
    <script src="https://blog.fratres.net/assets/js/owl.min.js"></script>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }

        $('.socailblog-icon').hide();
        $('.blog_latest_v2_project_submenu').hide();

        $(document).ready(function () {
            jQuery('.owl-carousel').owlCarousel({
                dots: false,
                autoplay: false,
                lazyLoad: true,
                loop: true,
                margin: 2,

                nav: true,
                navText: ['<div class="more_articlesjobblog"><span><i class="fa fa-angle-left" aria-hidden="true"></i></span><a href="#" class="more_articles_btn" >more articles</a><span><i class="fa fa-angle-right" aria-hidden="true"></i></span></div>'],


                /*
               animateOut: 'fadeOut',
               animateIn: 'fadeIn',
               */
                responsiveClass: true,
                autoHeight: true,
                autoplayTimeout: 1000,
                smartSpeed: 800,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },

                    600: {
                        items: 2
                    },
                    992: {
                        items: 3
                    },
                    1024: {
                        items: 3
                    },

                    1366: {
                        items: 3
                    }

                }

            });


            $("#latest1").click(function () {
                $(".socailblog-icon").toggle();
            });
            $("#latestprov2").click(function () {
                $('.blog_latest_v2_project_submenu').toggle();
            });

        });
    </script>
    <script>
        $(document).on('click', '.socialShare > .socialBox', function() {

            var self = $(this);
            var element = $(this).closest('div').find('.socialGallery a');
            var c = 0;

            if (self.hasClass('animate')) {
                return;
            }

            if (!self.hasClass('open')) {

                self.addClass('open');

                TweenMax.staggerTo(element, 0.3, {
                        opacity: 1,
                        visibility: 'visible'
                    },
                    0.075);
                TweenMax.staggerTo(element, 0.3, {
                        top: -12,
                        ease: Cubic.easeOut
                    },
                    0.075);

                TweenMax.staggerTo(element, 0.2, {
                        top: 0,
                        delay: 0.1,
                        ease: Cubic.easeOut,
                        onComplete: function() {
                            c++;
                            if (c >= element.length) {
                                self.removeClass('animate');
                            }
                        }
                    },
                    0.075);

                self.addClass('animate');

            } else {

                TweenMax.staggerTo(element, 0.3, {
                        opacity: 0,
                        onComplete: function() {
                            c++;
                            if (c >= element.length) {
                                self.removeClass('open animate');
                                element.css('visibility', 'hidden');
                            };
                        }
                    },
                    0.075);
            }
        });
    </script>
@endsection