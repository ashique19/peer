
@extends('admin.layout')

@section('title') Edit Pages @stop

@section('main')

<h1><center>Modify Page</center></h1>

<section class="col-xs-12">
@if($errors->any())

    <h4>Please check:</h4>
    
    <ul>
        @foreach($errors->all() as $error)
        
            <li>{{$error}}</li>
        
        @endforeach
    </ul>
    <hr>
    
@endif
</section>

<section class="col-sm-11">

{!! Form::open( ['method'=>'patch', 'url'=> action('Pages@update', $page->id), 'enctype'=>'multipart/form-data' ]) !!}

    
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', $page->name , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('details', 'Details: ') !!}
                {!! Form::textarea('details', $page->details , ['class'=>'summernote']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('meta_tag_title', 'Meta tag title: ') !!}
                {!! Form::text('meta_tag_title', $page->meta_tag_title , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('meta_tag_description', 'Meta tag description: ') !!}
                {!! Form::text('meta_tag_description', $page->meta_tag_description , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('meta_tag_keywords', 'Meta tag keywords: ') !!}
                {!! Form::text('meta_tag_keywords', $page->meta_tag_keywords , ['class'=>'form-control']) !!}
            </div>
                
    <div class="form-group">
        {!! Form::submit('Update Page', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        