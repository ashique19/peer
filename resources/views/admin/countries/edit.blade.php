
@extends('admin.layout')

@section('title') Edit Countries @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Modify Country</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

{!! Form::open( ['method'=>'patch', 'url'=> action('Countries@update', $country->id), 'enctype'=>'multipart/form-data' ]) !!}

    
            <div class="form-group">
                {!! Form::label('code', 'Code: ') !!}
                {!! Form::text('code', $country->code , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', $country->name , ['class'=>'form-control']) !!}
            </div>
                
    <div class="form-group">
        {!! Form::submit('Update Country', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        