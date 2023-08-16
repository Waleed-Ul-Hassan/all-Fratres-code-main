@extends('frontend.layouts.main')

@section('meta_info')
    @php $seo = \App\Seo::where('page_key','career_advice')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')

    <style>
        .jobblog-item1-bg-profile img{
            height: 190px;
        }
        .jobblog-item-wrpr-title a{
            font-size:14px;
        }
    </style>

    <div class="main-blog-wrapper">
    <div class="container">
    <div class="jobblog-main">

        <div class="jobblog-main-menu">

            <div class="row">

                @foreach($blogs->data as $blog)
                <div class="col-md-4 mg-bottom" style="margin-bottom: 40px">
                    <div class="jobblog-item1-wrapper">
                        <div class="jobblog-item1-bg-profile">
                            <img src="https://blog.fratres.net/uploads/blog/{{$blog->image}}" class="img-fluid max-img-height">

                        </div>
                        <div class="jobblog-item-wrpr-title">
                            <a href="{{url('career-advice/'.$blog->slug)}}">
                                {{$blog->title}}
                            </a>
                        </div>

                    </div>
                </div>
                @endforeach
                <?php
//                    dd($blogs->current_page);
                    $pagination = true;
                    $numOfpages = $blogs->total;
                    $current_page = $blogs->current_page;
                    $has_next_page = $blogs->next_page_url;
                    $has_previous_page = $blogs->prev_page_url;
                    $next_page = $blogs->next_page_url;
                ?>
                @if(isset($current_page))
                    <?php
                    $prev = $current_page - 1;
                    ?>
                    @if(($has_next_page == true) && ($has_previous_page == false))
                        <li><a href="{{$next_page}}">Next</a></li>
                    @elseif(($has_next_page == false) && ($has_previous_page == true))
                        <li><a href="{{$prev}}">Previous</a></li>
                    @elseif(($has_next_page == true) && ($has_previous_page == true))
                        <li><a href="{{$prev}}">Previous</a></li><li><a href="{{$next_page}}">Next</a></li>
                    @endif
                @endif

                @if(!count($blogs->data) > 0)
                    <h4 class="text-center">No Blogs Available</h4>
                @endif
        </div>

        </div>
    </div>
    </div>
    </div>
@endsection