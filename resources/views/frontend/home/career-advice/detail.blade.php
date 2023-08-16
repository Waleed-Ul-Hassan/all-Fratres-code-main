@extends('frontend.layouts.main')

@section('meta_info')
    <meta name="description" content="{{$blog->title}}">
    <meta property="og:description" content="{{$blog->title}}">
    <meta name="keywords" content="{{$blog->title}}">
    <meta property="og:keywords" content="{{$blog->title}}">
    <meta name="title" content="{{$blog->title}}">
    <meta property="og:title" content="{{$blog->title}}">
    <meta property="og:type" content="jobs"/>

    <title>{{$blog->title}}</title>

@endsection
@section('content')

    <style>
        .jobblog-main-menu ul li{
            display: block;
        }
    </style>

    <section class="jobblogdetailpage">
        <br><br>
        <div class="container">

            <div class="jobblog-main-menu" style="padding-bottom: 0px;">
                <h4>{{$blog->title}}</h4>
            </div>

            <div class="jobblog-detailpage-title_end">
                <div class="jobblog-title_end_profile">
                    <img src="{{$blog->image}}" class="img-fluid">
                </div>
                <div class="jobblog-title-details">
                    <p>
                        posted:<a href="#">{{date("Y-m-d", strtotime($blog->created_at))}}</a>
                    </p>
                </div>
            </div>

            <div class="jobblogdetail-contents-v1">
                {!! $blog->description !!}

            </div>

        </div>

    </section>



@endsection
