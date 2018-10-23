@extends('public.layouts.layout')
@section('title')
@if(\App\Setting::find(1)){{\App\Setting::find(1)->application_name}}@else Application name @endif-@if($page){{$page->name}} @endif 
@stop

@section('meta')
    @if($page)
        <meta name="title" content="{{$page->meta_tag_title}}">
        <meta name="description" content="{{$page->meta_tag_description}}">
        <meta name="keywords" content="{{$page->meta_tag_keywords}}">
    @endif
@stop

@section('main')

<section class="col-xs-12 col-sm-8 main-body">
    
    <div class="panel panel-default"></div>
    
    @if($page)
    
    <div class="panel panel-default">
        
        <h2 class="page-title"><center>{{$page->name}}</center></h2>
        
        <div class="panel-body posts">
            {!! $page->details !!}
        </div>
        
    </div>
        
    @else
    
    <!--If the Page does not exist, we say sorry! -->
    
    <div class="panel panel-default">
        <h2 class="page-title"><center>Sorry! The page you are looking for, does not exist..</center></h2>
        <strong><center>Come again later to see if it exists or <a href="{{route('home')}}">checkout our collection</a>.</center></strong>
    </div>
    
    @endif
        
</section>

@stop
        