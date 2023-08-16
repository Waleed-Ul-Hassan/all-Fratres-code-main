@extends('frontend.layouts.main')

@section('meta_info')
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="https://fratres.net">
    <meta name="twitter:image:src" content="{{asset('frontend/assets/img/share-logo.png')}}">
    <meta name="twitter:title" content="Anna Claire Christoffer">
    <meta name="twitter:url" content="{{url('/')}}">
    <meta name="twitter:description" content="Konzeptionelle Gestaltung von Anna Claire Christoffer">

    <!-- Open Graph -->
    <meta property="og:url" content="{{url('/')}}">
    <meta property="og:site_name" content="Anna Claire Christoffer">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Anna Claire Christoffer">
    <meta property="og:description" content="Konzeptionelle Gestaltung von Anna Claire Christoffer">
    <meta property="og:image" content="{{asset('frontend/assets/img/share-logo.png')}}">
    <title>{{$detail->title}}</title>
@endsection
@section('content')

<style>
    .jobblog-main-menu ul li{
        display: block;
    }
    #desktopviewblogmenu li{
        display: inline-block;
    }

</style>

{{--<link rel="stylesheet" href="https://blog.fratres.net/assets/css/style.css">--}}
{{--<link rel="stylesheet" href="https://blog.fratres.net/assets/css/responsive.css">--}}

<section class="jobblogdetailpage">
    <div class="container">
        <br>



        <div class="jobblogdetail-pageimg-wrapper">
            <img src="https://blog.fratres.net/uploads/blog/{{$detail->image}}" class="img-fluid" style="max-height: 600px;">
            <div class="jobblog-detail-page-top-details">
                <ul>
                    <li>
                        <a href="{{url('category/'.$detail->blog_cat)}}">{{$detail->category->name}}</a>
                    </li>
                    <li>»</li>
                    <li>{{$detail->title}}</li>
                </ul>
            </div>
        </div>
        <div class="jobblog-main-menu" style="padding-bottom: 0px;">
            <br>
            <ul id="desktopviewblogmenu" style="padding-left: 20px;">
                <li>
                    <div class="jobblogmenulist">
                        <a href="{{url('/')}}" class="jobbloglistbtn"><i class="fas fa-home"></i></a>
                    </div>
                </li>
                @foreach($categories as $category)
                    <li class="category-for-blog">
                        <div class="jobblogmenulist @if($category->slug==$detail->blog_cat) active @endif">
                            <a href="{{url('category/'.$category->slug)}}"  class="jobbloglistbtn">{{$category->name}}</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</section>

<div class="main-blog-wrapper">
    <div class="container">
        <div class="jobblog-main">
            <div class="jobblog-title-head">
                <h2>{{$detail->title}}</h2>
            </div>
            <div class="jobblog-main-menu">



                <div class="blog-main-porfolio-head">
                    <div class="blogdetailpage-portfolio-item">
                        <div class="jobblog-item1-wrapper">


                            <div class="jobblog-detailpage-title_end">
                                <div class="jobblog-title_end_profile">
                                    <img src="https://blog.fratres.net/uploads/blog/{{$detail->image}}" class="img-fluid">
                                </div>
                                <div class="jobblog-title-details">
                                    <p>
                                        posted:<a href="#">{{$detail->created_at->diffForHumans()}}</a>by<a href="{{url('author/'.$detail->user->name)}}">{{$detail->user->name}}</a>in <a href="{{url('category/'.$detail->category->slug)}}">{{$detail->category->name}}</a>
                                    </p>
                                </div>
                            </div>

                            <div class="sharify-post-top">
                                <br>
                                <div class="sharify-container">

                                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                        <a class="a2a_button_facebook"></a>
                                        <a class="a2a_button_twitter"></a>
                                        <a class="a2a_button_whatsapp"></a>
                                        <a class="a2a_button_pinterest"></a>
                                        <a class="a2a_button_linkedin"></a>
                                        <a class="a2a_button_facebook_messenger"></a>
                                        <a href="mailto:info@fratres.net" ><i class="fa fa-envelope print"></i></a>
                                        <a href="#" onclick="window.print()"><i class="fa fa-print print"></i></a>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>


                </div>


                <section class="latest-project-blog">
                    <div class="jobblogdetail-latest-head">
                        <div class="jobblogdetail-latest-item1">
                            <div class="jobblogdetail-contents-v1">
                                {!! $detail->description !!}
                            </div>



                        </div>




                        <div class="jobblogdetail-latest-item2">
                            <div class="jobblog_detail_page_v2_head">
                                <div class="jobblog_detail_page_v2_list_head">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="related-tab" data-toggle="tab" href="#related" role="tab" aria-controls="related" aria-selected="true">related</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="recent-tab" data-toggle="tab" href="#recent" role="tab" aria-controls="recent" aria-selected="false">recent</a>
                                        </li>

                                    </ul>
                                    <div class="jobblog-tabs-head-blog-detailpage">
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="related" role="tabpanel" aria-labelledby="related-tab">
                                                @foreach($relatedBlogs as $relatedBlog)
                                                    <div class="jobpage_detailblog_v2_content">
                                                        <img src="https://blog.fratres.net/uploads/blog/{{$relatedBlog->image}}" class="img-fluid">
                                                        <div class="jobpage_blog_detail_v2_contentv1">
                                                            <a href="{{url('career-advice/'.$relatedBlog->slug)}}">
                                                                {{Str::limit($relatedBlog->title,60)}}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="tab-pane fade" id="recent" role="tabpanel" aria-labelledby="recent-tab">
                                                @foreach($recentBlogs as $recentBlog)
                                                    <div class="jobpage_detailblog_v2_content">
                                                        <img src="https://blog.fratres.net/uploads/blog/{{$recentBlog->image}}" class="img-fluid" style="height: 190px;">
                                                        <div class="jobpage_blog_detail_v2_contentv1">
                                                            <a href="{{url('career-advice/'.$recentBlog->slug)}}">
                                                                {{Str::limit($recentBlog->title,60)}}</a>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="latestblog-item2-wrapper">
                                <div class="b b_promo">
                                    <h2>Cv Maker</h2>
                                    <p>Search 1000's of remote jobs</p>
                                    <img src="https://blog.fratres.net/assets/img/portfolio.png" width="60" height="">
                                    <div class="pt-4">
                                        <a href="{{url('seeker/cv-maker/register')}}" class="btn btn-primary">Cv Maker »</a>
                                    </div>

                                </div>

                            </div>



                        </div>
                    </div>
                </section>

            </div>


            <div class="row">



                <div class="sharify-post-top col-md-6">

                    <div class="sharify-container">

                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                            <a class="a2a_button_facebook"></a>
                            <a class="a2a_button_twitter"></a>
                            <a class="a2a_button_whatsapp"></a>
                            <a class="a2a_button_pinterest"></a>
                            <a class="a2a_button_linkedin"></a>
                            <a class="a2a_button_facebook_messenger"></a>
                            <a href="mailto:info@fratres.net" ><i class="fa fa-envelope print"></i></a>
                            <a href="#" onclick="window.print()"><i class="fa fa-print print"></i></a>
                        </div>



                    </div>
                </div>

                <div class="col-md-6 text-right">

                    <span>{{$detail->blog_like}}</span> <i class="fas fa-thumbs-up thmbs"></i>

                    <span>{{$detail->blog_dislike}}</span> <i class="fas fa-thumbs-down thmbs"></i>
                </div>
            </div>

            <div class="jobblog-detail_page-v1-ftr-head_botm" >
                <ul>
                    @if($prev)
                        <li>
                            <a href="{{url('career-advice/'.$prev->slug)}}">
                                <span><i class="fas fa-long-arrow-alt-left"></i></span>
                                {{$prev->title}}
                            </a>
                        </li>
                    @endif
                    @if($next)
                        <li class="float-right">
                            <a href="{{url('career-advice/'.$next->slug)}}">
                                <span><i class="fas fa-long-arrow-alt-right"></i></span>
                                {{$next->title}}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>


        </div>




    </div>
</div>

<script async src="https://static.addtoany.com/menu/page.js"></script>


<script>
    $(document).on("click",".fa-thumbs-up", function () {
        $.get("/blogger/blog_like/{{$detail->id}}/blog_like", function(data, status){
            location.reload();
        });
    });
    $(document).on("click",".fa-thumbs-down", function () {
        $.get("/blogger/blog_like/{{$detail->id}}/blog_dislike", function(data, status){
            location.reload();
        });
    });

</script>
@endsection
