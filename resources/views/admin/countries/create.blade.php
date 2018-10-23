
@extends('admin.layout')

@section('title') Create new Country @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Countries</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

<h3>Create Country</h3>


{!! Form::open( ['url'=> action('Countries@store'), 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('code', 'Code: ') !!}
            {!! Form::text('code', old('code') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Country', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        