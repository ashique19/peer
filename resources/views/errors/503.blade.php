@extends('public.layouts.layout')
@section('title')
@section('title')Airposted - Shipping Simplified - 503 @stop
@stop

@section('meta')
    <meta name="title" content="Airposted - 503">
    <meta name="description" content="Airposted - 503 error. Please continue to Airposted.com">
    <meta name="keywords" content="Airposted, 503">
@stop

@section('main')


<section class="row push-up-100">
    <h1 class="text-center">503 Error occured.</h1>
    <h2 class="text-center push-up-50 push-down-50">
        Please continue to <a href="{{route('home')}}" class="btn btn-lg white-bg blue-border blue-text">Homepage</a>
    </h2>
</section>


@stop
        