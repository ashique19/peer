
@extends('admin.layout')

@section('title') Create new Comment @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Comments</center></h1>


@if($errors->any())
<section class="row panel-body">
    <h4>Please check:</h4>
    
    <ul>
        @foreach($errors->all() as $error)
        
            <li>{{$error}}</li>
        
        @endforeach
    </ul>
    <hr>
</section>    
@endif


<section class="col-sm-6 col-sm-offset-3">

<h3>Create Comment</h3>


{!! Form::open( ['url'=> action('Comments@store'), 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('user_id', 'User: ') !!}
            {!! Form::select('user_id', \App\User::lists('name', 'id'), old('user_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('blog_id', 'Blog: ') !!}
            {!! Form::select('blog_id', \App\Blog::lists('name', 'id'), old('blog_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('is_published', 'Is published: ') !!}
            {!! Form::select('is_published', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], old('is_published') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('is_reply', 'Is reply: ') !!}
            {!! Form::select('is_reply', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], old('is_reply') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('comment_id', 'Comment: ') !!}
            {!! Form::select('comment_id', \App\Comment::lists('name', 'id'), old('comment_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('commenter_name', 'Commenter name: ') !!}
            {!! Form::text('commenter_name', old('commenter_name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('commenter_email', 'Commenter email: ') !!}
            {!! Form::text('commenter_email', old('commenter_email') , ['class'=>'form-control']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Comment', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        