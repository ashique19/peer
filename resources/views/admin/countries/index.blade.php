
@extends('admin.layout')

@section('title') Country @stop

@section('main')

<h1><center>Countries @if($countries) : {{$countries->total()}} @endif</center></h1>

 <section class="col-md-10 col-md-offset-1 push-down-20">
    
    <h4 class="page-title btn-info">Create New</h4>
 
    {!! Form::open( ['url'=> action('Countries@store'), 'class'=> 'form form-inline', 'enctype'=>'multipart/form-data' ]) !!}

    
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

<section class="col-md-10 col-md-offset-1 push-down-20">
    
    <h4 class="page-title btn-info">List of All:</h4>
    
    <div class="col-xs-12">
        
        <ul class="list-group">
        
    @if($countries)
        @foreach($countries as $country)
            <li class="list-group-item">
                <ul class="list-inline">
					<li>{{$country->id}}</li>
					<li>{{$country->code}}</li>
					<li>{{$country->name}}</li>  
                    <li class="pull-right">
                            <a class="btn btn-default btn-xs" data-toggle="collapse" data-target="#openme{{$country->id}}"><i class="fa fa-caret-down"></i></a>
                            <a class="btn btn-default btn-xs" data-toggle="collapse" data-target="#editme{{$country->id}}"><i class="fa fa-pencil"></i></a>
                            <span class="btn btn-link btn-xs">
                                {!! deletes('Countries', $country['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-xs']) !!}
                            </span>
                    </li>
                </ul>
                <ul class="list-inline collapse" id="editme{{$country->id}}">
                    
                {!! Form::open( ['class'=> 'form form-inline','method'=>'patch', 'url'=> action('Countries@update', $country->id), 'enctype'=>'multipart/form-data' ]) !!}
                
                    
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

                
        
                </ul>
                <div class="row collapse" id="openme{{$country->id}}">
                    <ul class="list-unstyled">
                            <h4 class="push-up-10 push-down-10 text-success">Airports</h4>
                        @if($country->airports)
                            @foreach($country->airports as $airport)
                            <li>
                                <div class="col-xs-12">
                                    {{$airport->id}} {{$airport->name}}
                                    <a class="btn btn-default btn-xs pull-right" data-toggle="collapse" data-target="#modifyme{{$airport->id}}"><i class="fa fa-pencil"></i></a>
                                    <span class="btn btn-link btn-xs pull-right">
                                        {!! deletes('Airports', $airport['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-xs']) !!}
                                    </span>
                                </div>
                                <div class="col-xs-12 collapse" id="modifyme{{$airport->id}}">
                                    {!! Form::open( ['class'=> 'form form-inline','method'=>'patch', 'url'=> action('Airports@update', $airport->id), 'enctype'=>'multipart/form-data' ]) !!}
                                            <div class="form-group">
                                                {!! Form::label('name', 'Name: ') !!}
                                                {!! Form::text('name', $airport->name , ['class'=>'form-control']) !!}
                                            </div>
                                                
                                            <div class="form-group">
                                                {!! Form::label('country_id', 'Country: ') !!}
                                                {!! Form::select('country_id', \App\Country::lists('name', 'id'), $airport->country_id , ['class'=>'form-control select2']) !!}
                                            </div>
                                                
                                            <div class="form-group">
                                                {!! Form::submit('Update Airport', ['class'=>'form-control btn btn-info']) !!}
                                            </div>
                                
                                    {!! Form::close() !!}
                                </div>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                            
                </div>
            </li>
        @endforeach
    @endif
                
            <ul>
    </div>
</section>
{!! errors($errors) !!}

@stop
        