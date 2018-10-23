
@extends('admin.layout')

@section('title') Create new Travel @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Travels</center></h1>


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

<h3>Create Travel</h3>


{!! Form::open( ['url'=> action('Travels@store'), 'enctype'=>'multipart/form-data' ]) !!}

            
        <div class="form-group">
            {!! Form::label('arrival_date', 'Arrival date: ') !!}
            {!! Form::text('arrival_date', old('arrival_date') , ['class'=>'form-control datepicker']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('departure_date', 'Departure date: ') !!}
            {!! Form::text('departure_date', old('departure_date') , ['class'=>'form-control datepicker']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('country_from', 'Country from: ') !!}
            {!! Form::select('country_from', \App\Country::lists('name', 'id'), old('country_from') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('country_to', 'Country to: ') !!}
            {!! Form::select('country_to', \App\Country::lists('name', 'id'), old('country_to') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('airport_from', 'Airport from: ') !!}
            {!! Form::select('airport_from', \App\Airport::lists('name', 'id') , old('airport_from') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('airport_to', 'Airport to: ') !!}
            {!! Form::select('airport_to', \App\Airport::lists('name', 'id') , old('airport_to') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('user_id', 'User: ') !!}
            {!! Form::select('user_id', [], null , ['class'=>'form-control user-search', 'placeholder'=> '--Search Users--']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('is_active', 'Is active: ') !!}
            {!! Form::select('is_active', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], old('is_active') , ['class'=>'form-control']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Travel', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        