@extends('public.layouts.layout')

@section('main')

<section class="row heading-cover height-100"></section>

<section class="row blog-list">
    
    <div class="col-sm-10 col-sm-offset-1">
        {!! Form::open(['url'=> action('BlogPublic@storeBlogCreateByUser'), 'method'=> 'POST','files' => true]) !!}
        
        {!! errors($errors) !!}
        
        <div class="col-sm-6 col-xs-12">
            {!! Form::text('name', old('name'), ['class'=> 'form-control red-bottom-border push-up-20 push-down-20 pull-left-10', 'placeholder'=> 'Title']) !!}
        </div>
            
        <div class="col-sm-6 col-xs-12">
            {!! Form::select('category_id', \App\Blogcategory::lists('name', 'id'), old('category_id'), ['class'=> 'form-control red-bottom-border push-up-20 push-down-20', 'placeholder'=> 'Select Category']) !!}
        </div>
            
        <div class="col-sm-6 col-xs-12">
            {!! Form::file('banner_photos', old('banner_photos'), ['class'=> 'form-control file red-bottom-border push-up-20 push-down-20', 'placeholder'=> 'upload blog thumbnail']) !!}
        </div>
            
        <div class="col-sm-6 col-xs-12">
            {!! Form::textarea('short_description', old('short_description'), ['class'=> 'form-control red-bottom-border push-up-20 push-down-20', 'placeholder'=> 'Short Description']) !!}
        </div>
            
        <div class="col-xs-12">
            {!! Form::textarea('details', old('name'), ['class'=> 'form-control summernote red-bottom-border push-up-20 push-down-20', 'placeholder'=> 'Write your blog here']) !!}
        </div>
        
        <div class="col-xs-12">
            <button class="btn red-bg white-text pull-right square-border push-up-30">Post</button>
        </div>
        {!! Form::close() !!}
    </div>
</section>

@stop