
@extends('admin.layout')

@section('title') Airport @stop

@section('main')

<h1><center>Airports @if($airports) : {{$airports->total()}} @endif</center></h1>

 <section class="col-md-10 col-md-offset-1 push-down-20">
    
    <h4 class="page-title btn-info">Create New</h4>
 
    {!! Form::open( ['url'=> action('Airports@store'), 'class'=> 'form form-inline', 'enctype'=>'multipart/form-data' ]) !!}

    
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

<section class="col-md-10 col-md-offset-1 push-down-20">
    
    <h4 class="page-title btn-info">List of All:</h4>
    
    <div class="col-xs-12">
        
        <ul class="list-group">
        
    @if($airports)
        @foreach($airports as $airport)
            <li class="list-group-item">
                <ul class="list-inline">
					<li>{{$airport->id}}</li>
					<li>{{$airport->name}}</li>
					<li>@if($airport->country) {{$airport->country->name}} @endif</li>  
                    <li class="pull-right">
                            <a class="btn btn-default btn-xs" data-toggle="collapse" data-target="#editme{{$airport->id}}"><i class="fa fa-pencil"></i></a>
                            <span class="btn btn-link btn-xs">
                                {!! deletes('Airports', $airport['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-xs']) !!}
                            </span>
                    </li>
                </ul>
                <ul class="list-inline collapse" id="editme{{$airport->id}}">
                    
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

                
        
                </ul>
                <div class="row collapse" id="openme{{$airport->id}}">
                </div>
            </li>
        @endforeach
    @endif
                
            <ul>
    </div>
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

@stop
        