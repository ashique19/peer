@extends('public.layouts.layout')
@section('title')
@section('title')Airposted - Shipping Simplified - Blogs @stop
@stop

@section('meta')
    <meta name="title" content="Airposted Blogs">
    <meta name="description" content="Airposted - Blogs and Articles">
    <meta name="keywords" content="Airposted, Blogs, articles, shipping, simplified, courier">
@stop

@section('main')

<section class="row how-it-works-page">
    <div class="col-md-9 col-xs-12">
        
        <h1>Blogs</h1>
        
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
</section>

@stop