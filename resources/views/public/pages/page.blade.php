@extends('public.layouts.layout')
@section('title')
@section('title')Airposted - Shipping Simplified @stop
@stop

@section('meta')
    @if($page)
        <meta name="title" content="{{$page->meta_tag_title}}">
        <meta name="description" content="{{$page->meta_tag_description}}">
        <meta name="keywords" content="{{$page->meta_tag_keywords}}">
    @endif
@stop

@section('main')

<!--<section class="row page-banner">-->
<!--    <img src="/public/img/banners/8.jpg" alt="Login to continue" width="100%" class="img-responsive">-->
    <!--<div class="cover"></div>-->
<!--</section>-->

<section class="row faq-page">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        
    @if($page)
    
        <h1>{{ucfirst(str_replace('-', ' ',$page->name))}}</h1>
    
        <div class="panel-body posts justify">
            {!! $page->details !!}
            
        </div>
        
    </div>
        
    @else
    
    <!--If the Page does not exist, we say sorry! -->
    
    <div class="panel panel-default">
        <h2 class="page-title"><center>Sorry! The page you are looking for, does not exist..</center></h2>
        <strong><center>Come again soon to see if it exists or <a href="{{route('home')}}">checkout our collection</a>.</center></strong>
    </div>
    
    @endif
    </div>
</section>

@stop
        