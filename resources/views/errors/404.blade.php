@extends('public.layouts.layout')
@section('title')
@section('title')Airposted - Shipping Simplified - (404) Page not found @stop
@stop

@section('meta')
    <meta name="title" content="Airposted - page not found">
    <meta name="description" content="Airposted - Requested page was not found. Please continue to Airposted.com">
    <meta name="keywords" content="Airposted, page not found">
@stop

@section('main')


<section class="row push-up-100">
    <h1 class="text-center">Page Not Found</h1>
    <h2 class="text-center push-up-50 push-down-50">
        Please continue to <a href="{{route('home')}}" class="btn btn-lg white-bg blue-border blue-text">Homepage</a>
    </h2>
</section>


@stop
        