
@extends('admin.layout')

@section('title') Create new City @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Cities</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

<h3>Create City</h3>


{!! Form::open( ['url'=> action('Cities@store'), 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('country_id', 'Country: ') !!}
            {!! Form::select('country_id', \App\Country::lists('name', 'id'), old('country_id') , ['class'=>'form-control select2']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save City', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        