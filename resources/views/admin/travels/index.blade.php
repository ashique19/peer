
@extends('admin.layout')

@section('title') Travel @stop

@section('main')

<h1><center>Travels @if($travels) : {{$travels->total()}} @endif</center></h1>

<section class="col-sm-10 col-sm-offset-1">
    
    {!! Form::open(['class'=>'form form-inline', 'method' =>'post', 'url'=> action('Travels@searchIndex')]) !!} 
            
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
            {!! Form::text('country_from', old('country_from') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('country_to', 'Country to: ') !!}
            {!! Form::text('country_to', old('country_to') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('airport_from', 'Airport from: ') !!}
            {!! Form::select('airport_from', [], old('airport_from') , ['class'=>'form-control airport-search', 'placeholder'=> 'Airport-From']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('airport_to', 'Airport to: ') !!}
            {!! Form::select('airport_to', [], old('airport_to') , ['class'=>'form-control airport-search', 'placeholder'=> 'Airport-To']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('is_active', 'Is active: ') !!}
            {!! Form::select('is_active', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], old('is_active') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('from', 'From (Posting date): ') !!}
            {!! Form::text('from', old('from') , ['class'=>'form-control datepicker']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('to', 'To (Posting date): ') !!}
            {!! Form::text('to', old('to') , ['class'=>'form-control datepicker']) !!}
        </div>

        {!! Form::submit('search', ['class'=>'btn btn-info']) !!}
        
    {!! Form::close() !!}
    
    <hr>
</section>



@if($errors->any())
<section class="col-sm-10 col-sm-offset-1 panel-body">
    <h4>Please check:</h4>
    
    <ul>
        @foreach($errors->all() as $error)
        
            <li>{{$error}}</li>
        
        @endforeach
    </ul>
    <hr>
</section>  
@endif

<section class="col-sm-10 col-sm-offset-1">
    
    <a href="{{action('Travels@create')}}" class="btn btn-default pull-right btn-lg blue-border blue-text">Add new</a>
    
    <table class="table table-responsive">
        <thead>
            <tr>
				<th class="blue-bg white-text">Id</th>
				<th class="blue-bg white-text">Departure date</th>
				<th class="blue-bg white-text">Arrival date</th>
				<th class="blue-bg white-text">Country from</th>
				<th class="blue-bg white-text">Country to</th>
				<th class="blue-bg white-text">User</th>
                <th class="blue-bg white-text" width="50">Show</th>
                <th class="blue-bg white-text" width="50">Modify</th>
                <th class="blue-bg white-text" width="50">Delete</th>
            </tr>
        </thead>
        <tbody>
            @if($travels)
                @foreach($travels as $travel)
                    <tr>
						<td>{{$travel->id}}</td>
						<td>{{$travel->departure_date->format("Y-M-d")}}</td>
						<td>{{$travel->arrival_date->format("Y-M-d")}}</td>
						<td>@if($travel->countryFrom){{$travel->countryFrom->name}}@endif</td>
						<td>@if($travel->countryTo){{$travel->countryTo->name}}@endif</td>
						<td>@if($travel->user) <a href="{{action('Users@show', $travel->user_id)}}" class="link">{{$travel->user->name}}</a> @endif</td>
                        <td>
                            {!! views('Travels', $travel->id, '<span class=\'fa fa-expand\'></span>', ['class'=>'btn btn-success btn-rounded']) !!}
                        </td>
                        <td>
                            {!! edits('Travels', $travel['id'], '<span class=\'fa fa-pencil\'></span>', ['class'=>'btn btn-warning btn-rounded']) !!}
                        </td>
                        <td>
                            {!! deletes('Travels', $travel['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {!! $travels->render() !!}
</section>


@stop
        