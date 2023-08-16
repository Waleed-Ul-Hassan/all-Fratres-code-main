@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','privacy')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')


<div class="container">
    <br><br>
    <div class="row pad-left">
        {!!$page->privacy!!}
    </div>
</div>
@endsection

