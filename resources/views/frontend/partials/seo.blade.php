@if(hasWord("in-", Request::fullUrl()))
    @php
        $root_domain = Request::root()."/jobs/in-";
        $root_domain = str_replace($root_domain,"", Request::fullUrl());
        $location_name = "Find and apply today for the latest Jobs in ".$root_domain." in Different Sectors like, education, hospital, Finance at the Largest jobsite in ".$root_domain;
        $title_is = "Jobs in ".$root_domain." | Find Vacancies & Jobs in ".$root_domain." | Fratres";
    @endphp

    <meta name="description" content="{{$location_name}}">
    <meta property="og:description" content="{{$location_name}}">
    <meta name="keywords" content="{{$location_name}}">
    <meta property="og:keywords" content="{{$location_name}}">
    <meta name="title" content="{{$title_is}}">
    <meta property="og:title" content="{{$title_is}}">
    <meta property="og:type" content="jobs"/>
    <title>{{$title_is}}</title>
@else

    @if ($seo)
        <meta name="description" content="{{$seo->meta_description}}">
        <meta property="og:description" content="{{$seo->meta_description}}">
        <meta name="keywords" content="{{$seo->meta_key}}">
        <meta property="og:keywords" content="{{$seo->meta_key}}">
        <meta name="title" content="{{$seo->meta_title}}">
        <meta property="og:title" content="{{$seo->meta_title}}">
        <meta property="og:type" content="jobs"/>

        <title>{{$seo->page_title}}</title>
    @endif

@endif