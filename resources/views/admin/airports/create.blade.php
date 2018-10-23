
@extends('admin.layout')

@section('title') Create new Airport @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Airports</center></h1>


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

<h3>Create Airport</h3>


{!! Form::open( ['url'=> action('Airports@store'), 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('country_id', 'Country: ') !!}
            {!! Form::select('country_id', \App\Country::lists('name', 'id'), old('country_id') , ['class'=>'form-control select2']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Airport', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        