
@extends('admin.layout')

@section('title') Create new Page @stop

@section('main')

<h1><center>Pages</center></h1>


@if($errors->any())
<section class="col-sm-11">
    <h4>Please check:</h4>
    
    <ul>
        @foreach($errors->all() as $error)
        
            <li>{{$error}}</li>
        
        @endforeach
    </ul>
    <hr>
</section>    
@endif


<section class="col-sm-11">

<h3>Create Page</h3>


{!! Form::open( ['url'=> action('Pages@store'), 'class'=>'form form-horizontal', 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('details', 'Details: ') !!}
            {!! Form::textarea('details', old('details') , ['class'=>'summernote']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('meta_tag_title', 'Meta tag title: ') !!}
            {!! Form::text('meta_tag_title', old('meta_tag_title') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('meta_tag_description', 'Meta tag description: ') !!}
            {!! Form::text('meta_tag_description', old('meta_tag_description') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('meta_tag_keywords', 'Meta tag keywords: ') !!}
            {!! Form::text('meta_tag_keywords', old('meta_tag_keywords') , ['class'=>'form-control']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Page', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        