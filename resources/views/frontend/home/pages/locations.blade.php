@extends('frontend.layouts.main')

@section('meta_info')
    @php $seo = \App\Seo::where('page_key','locations')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection

@section('content')
    <style>
        .blog-jobcatev1 , .blog-content-v1 {
            flex-basis: 100%;
        }
        .listed-items li, .latestblog-item2-wrapper ul li{
            display: inline-block;
            width: 24%;
        }
    </style>

    <div class="container">
        <br><br>
        <div class="row pad-left">

            <div class="blog-content-v1">
                <div class="latestblog-item2-wrapper">
                    <div class="item2bloglatest-head">
                        <h3>Jobs By Locations</h3>
                    </div>
                    <div class="blog-jobcategoryhead">
                        <div class="blog-jobcatev1">
                            <ul class="listed-items">
                                @foreach($locations as $location)
                                    <li><a href="{{url('jobs/in-'.$location->city_slug)}}">{{$location->name}}</a></li>

                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection