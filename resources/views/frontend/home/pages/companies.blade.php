@extends('frontend.layouts.main')

@section('meta_info')
    @php $seo = \App\Seo::where('page_key','companies')->first();@endphp

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
                        <h3>Jobs By Companies</h3>
                    </div>
                    <div class="blog-jobcategoryhead">
                        <div class="blog-jobcatev1">
                            <ul class="listed-items">
                                @foreach($companies as $companies)
                                    <li><a href="#">{{$companies->company_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection