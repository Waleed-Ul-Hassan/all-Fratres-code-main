@extends('frontend.layouts.main')
@section('meta_info')
    @php $seo = \App\Seo::where('page_key','about')->first();@endphp

    @include('frontend.partials.seo', ['seo' => $seo] )


@endsection
@section('content')


<div class="container">
    <br><br>
    <div class="row pad-left">
        {!!$page->about!!}
    </div>
</div>
@endsection

