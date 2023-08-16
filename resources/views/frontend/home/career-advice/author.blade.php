@extends('frontend.layouts.main')

@section('meta')
    <title>Blogs By {{str_replace("-"," ",$name)}} | Fratres</title>

    <meta name="Description" content="fratres is an online job search engine that helps you to get in touch with millions of job opportunity around the world. sign up with fratres to join world's latest job opportunity. with tools helping you to search job , create CV and company reviews. ">
    <meta name="Keywords" content="job search, fratres online jobs, jobs, search engine for jobs, job search engine, job listings, search jobs, career, employment, work, find jobs, IT jobs, Jobs in pakistan, Government jobs, latest jobs in lahore,best online job search tools	,job search engines in pakistan,the job search coach,recruitment online job search,job search retail,job search hopeless,job search on degree based,search job on skill base,recruitment resourcer jobs,job search latest,job search tips 2020,recruitment form for online job">

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="p:domain_verify" content="0be9ce285384de92cf70fb944ce9a9f2"/>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <meta property="og:title" content="Blogs By {{str_replace("-"," ",$name)}} | Fratres">
    <meta property="og:site_name" content="fratres">
    <meta property="og:url" content="https://blog.fratres.net">
    <meta property="og:description" content="">
    <meta property="og:type" content="article">
    <meta property="og:image" content="https://blog.fratres.net/assets/img/image-logo-resized.png">
    <meta name="image" content="https://blog.fratres.net/assets/img/image-logo-resized.png">
    <meta name="twitter:image" content="https://blog.fratres.net/assets/img/image-logo-resized.png">

    <meta name = 'wmail-verification' content = '80fa93a4b8e235973a7257ec5204f438' />
    <meta name="yandex-verification" content="e75aea3a081327cd" />

@endsection

@section('content')


    <link rel="stylesheet" href="https://blog.fratres.net/assets/css/owl.css">
    <link rel="stylesheet" href="https://blog.fratres.net/assets/css/owltheme.css">

    <link rel="stylesheet" href="https://blog.fratres.net/assets/css/style.css">
    <link rel="stylesheet" href="https://blog.fratres.net/assets/css/responsive.css">

    <style>
        .jobblog-item1-bg-profile img{
            height: unset;
        }
    </style>

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
                        <li >
                            <div class="jobblogmenulist ">
                                <a href="{{url('/')}}" class="jobbloglistbtn"><i class="fas fa-home"></i></a>
                            </div>
                        </li>
                        @foreach($categories as $category)
                            <li class="category-for-blog">
                                <div class="jobblogmenulist ">
                                    <a href="{{url('category/'.$category->slug)}}"  class="jobbloglistbtn">{{$category->name}}</a>
                                </div>
                            </li>
                        @endforeach


                    </ul>
                    <hr>
                    <h5 class="heading-form-recruiter"><span>{{str_replace("-"," ",$name)}} </span>  &nbsp;&nbsp;&nbsp; <span>{{$totalBlogs}} Blogs</span></h5>
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
                                            @foreach($categories as $category)
                                                <li class="category-for-blog">

                                                    <a href="{{url('category/'.$category->slug)}}"  class="jobbloglistbtn">{{$category->name}}</a>


                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>





                            </div>

                        </div>



                    </div>
                    <div class="row">
                        @foreach($authorBlogs as $randomBlog)
                            <div class="col-md-4 mg-bottom">
                                <div class="jobblog-item1-wrapper">
                                    <div class="jobblog-item1-bg-profile">
                                        <img src="https://blog.fratres.net/uploads/blog/{{$randomBlog->image}}" class="img-fluid max-img-height">
                                        <div class="socialShare ">
                                            <div class="socialBox pointer">
                                                <span class="fa fa-share-alt"></span>
                                                <div class="socialGallery">
                                                    <div class="socialToolBox">
                                                        @php
                            $facebook = "https://www.facebook.com/sharer/sharer.php?u=".url('/'.urlencode('career-advice/'.$randomBlog->slug))."&t=".urlencode($randomBlog->title)."&quote=";
                            $twitter = "https://twitter.com/intent/tweet?text=".urlencode($randomBlog->title)."%20".urlencode('career-advice/'.$randomBlog->slug);
                            $whatsapp = "https://api.whatsapp.com/send?text=".urlencode($randomBlog->title)."%20".url('/'.urlencode('career-advice/'.$randomBlog->slug));


                                                        @endphp
                                                        <a class="facebook" href="#" onclick="window.open('{{$facebook}}', 'name','width=600,height=400')"><i class="fab fa-facebook-f"></i></a>
                                                        <a class="whatsapp" href="" onclick="window.open('{{$whatsapp}}', 'name','width=600,height=400')"><i class="fab fa-whatsapp"></i></a>
                                                        <a class="twitter" onclick="window.open('{{$twitter}}', 'name','width=600,height=400')" href=""><i class="fab fa-twitter"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jobblog-item-wrpr-title">
                                        <a href="{{url('career-advice/'.$randomBlog->slug)}}">
                                            {{Str::limit($randomBlog->title,70)}}
                                        </a>
                                    </div>
                                    <div class="jobblog-item1wrapper-botm">
                                        <span>by</span><a href="{{url('author/'.$randomBlog->user->name)}}">
                                            {{$randomBlog->user->name}}
                                        </a> in
                                        <u class="jobblog-item-wrpr-title">
                                            <a href="{{url('category/'.$randomBlog->category->slug)}}">
                                                {{$randomBlog->category->name}}
                                            </a>
                                        </u>
                                    </div>

                                </div>
                            </div>

                        @endforeach

                        {{$authorBlogs->links()}}

                    </div>



                </div>


            </div>




        </div>
    </div>

    <script src="https://blog.fratres.net/assets/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js"></script>
    <script src="https://blog.fratres.net/assets/dropify/js/dropify.js"></script>
    <script src="https://blog.fratres.net/assets/js/owl.min.js"></script>

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