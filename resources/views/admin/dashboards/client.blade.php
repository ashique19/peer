@extends('public.layouts.layout')
@section('title')@if(\App\Setting::find(1)){{\App\Setting::find(1)->application_name}}@else Application name @endif. @stop
@section('main')

<section class="row page-banner">
    <img src="/public/img/banners/top-banner.jpg" alt="Login to continue" width="100%" class="img-responsive">
    <div class="cover"></div>
</section>

<section class="row client-nav-area blue-bg">
    <div class="col-sm-10 col-sm-offset-1 col-xs-12">
        <ul class="nav nav-tabs no-margin">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">My Profile</a></li>
            <li><a href="#">Message Box</a></li>
            <li><a href="#">My Product</a></li>
            <li><a href="#">Search Traveller</a></li>
            <li><a href="#">Payment</a></li>
        </ul>
        <a href="#" class="profile-img" >
            <img src="/public/img/settings/logo.png" alt="" width="100" />
        </a>
    </div>
</section>

@stop