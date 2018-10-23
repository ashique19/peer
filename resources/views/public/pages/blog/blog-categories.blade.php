@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified - {{$category->name}} blog @stop

@section('meta')
    <meta name="title" content="Airposted Blogs on {{$category->name}}">
    <meta name="description" content="Airposted - Blogs and Articles">
    <meta name="keywords" content="Airposted, Blogs, articles, shipping, simplified, courier, {{$category->name}}">
@stop

@section('main')

<section class="row page-banner">
    <img src="{{$category->banner_photo}}" alt="{{$category->name}} Blogs" width="100%" class="img-responsive">
</section>




<div class="row">
    <div class="col-md-9">
        
        @if( count($blogs) > 0 )
        <div class="panel panel-default">
            <div class="panel-body posts">
                
                <div class="row blog-list">
                    @foreach($blogs as $blog)
                    <div class="col-md-6">
                        
                        <div class="post-item">
                            <div class="post-title">
                                <a href="{{route('singleBlog', $blog->link)}}">{{$blog->name}}</a>
                            </div>
                            <div class="post-date"><span class="fa fa-calendar"></span> {{$blog->created_at->format('m D, Y')}} </a></div>
                            <div class="post-text">
                                <img src="{{$blog->banner_photo}}" class="img-responsive img-text">
                                <p>{{$blog->summary}}</p>                                            
                            </div>
                            <div class="post-row">
                                <div class="post-info">
                                    <span class="fa fa-eye"></span> {{$blog->views}} - <span class="fa fa-star"></span> {{$blog->votes()->count()}}
                                </div>
                                <a href="{{route('singleBlog', $blog->link)}}" class="btn btn-default btn-rounded pull-right">Read more →</a>
                            </div>
                        </div>                                            
                        
                    </div>
                    @endforeach
                </div>
                
            </div>
        </div>
        @endif
        
        {!! $blogs->render() !!}                  
        
    </div>   
    @include('public.pages.blog.partials.right-nav')
</div>

@stop