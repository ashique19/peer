
@extends('admin.layout')

@section('title') Edit Travels @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Modify Travel</center></h1>


@if($errors->any())
<section class="col-sm-6 col-sm-offset-3">
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

{!! Form::open( ['method'=>'patch', 'url'=> action('Travels@update', $travel->id), 'enctype'=>'multipart/form-data' ]) !!}

                
            <div class="form-group">
                {!! Form::label('arrival_date', 'Arrival date: ') !!}
                {!! Form::text('arrival_date', $travel->arrival_date , ['class'=>'form-control datepicker']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('departure_date', 'Departure date: ') !!}
                {!! Form::text('departure_date', $travel->departure_date , ['class'=>'form-control datepicker']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('country_from', 'Country from: ') !!}
                {!! Form::select('country_from', \App\Country::lists('name','id'), $travel->country_from , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('country_to', 'Country to: ') !!}
                {!! Form::select('country_to', \App\Country::lists('name','id'), $travel->country_to , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('airport_from', 'Airport from: ') !!}
                {!! Form::select('airport_from', \App\Airport::lists('name', 'id'), $travel->airport_from , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('airport_to', 'Airport to: ') !!}
                {!! Form::select('airport_to', \App\Airport::lists('name', 'id'), $travel->airport_to , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('user_id', 'User: ') !!}
                {!! Form::select('user_id', \App\User::where('id', $travel->user_id)->lists('name', 'id'), $travel->user_id , ['class'=>'form-control user-search']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('is_active', 'Is active: ') !!}
                {!! Form::select('is_active', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], $travel->is_active , ['class'=>'form-control']) !!}
            </div>
            
    <div class="form-group">
        {!! Form::submit('Update Travel', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        