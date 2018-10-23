
@extends('admin.layout')

@section('title') Edit Blogvotes @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Modify Blogvote</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

{!! Form::open( ['method'=>'patch', 'url'=> action('Blogvotes@update', $blogvote->id), 'enctype'=>'multipart/form-data' ]) !!}

    
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', $blogvote->name , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('blog_id', 'Blog: ') !!}
                {!! Form::select('blog_id', \App\Blog::lists('name', 'id'), $blogvote->blog_id , ['class'=>'form-control select2']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('user_id', 'User: ') !!}
                {!! Form::select('user_id', \App\User::lists('name', 'id'), $blogvote->user_id , ['class'=>'form-control select2']) !!}
            </div>
                
    <div class="form-group">
        {!! Form::submit('Update Blogvote', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        