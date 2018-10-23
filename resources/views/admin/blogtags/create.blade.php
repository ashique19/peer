
@extends('admin.layout')

@section('title') Create new Blogtag @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Blogtags</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

<h3>Create Blogtag</h3>


{!! Form::open( ['url'=> action('Blogtags@store'), 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('link', 'Link: ') !!}
            {!! Form::text('link', old('link') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('banner_photos', 'Banner photo: ') !!}
            {!! Form::file('banner_photos', ['class'=>'form-control file']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Blogtag', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        