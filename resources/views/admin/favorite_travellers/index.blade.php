
@extends('admin.layout')

@section('title') Favorite traveller @stop

@section('main')

<h1><center>Favorite travellers @if($favorite_travellers) : {{$favorite_travellers->total()}} @endif</center></h1>

 <section class="col-md-10 col-md-offset-1 push-down-20">
    
    <h4 class="page-title btn-info">Create New</h4>
 
    {!! Form::open( ['url'=> action('Favorite_travellers@store'), 'class'=> 'form form-inline', 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('user_id', 'User: ') !!}
            {!! Form::select('user_id', \App\User::lists('name', 'id'), old('user_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('traveller_id', 'Traveller: ') !!}
            {!! Form::select('traveller_id', \App\Traveller::lists('name', 'id'), old('traveller_id') , ['class'=>'form-control select2']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Favorite traveller', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}

</section>

<section class="col-md-10 col-md-offset-1 push-down-20">
    
    <h4 class="page-title btn-info">List of All:</h4>
    
    <div class="col-xs-12">
        
        <ul class="list-group">
        
    @if($favorite_travellers)
        @foreach($favorite_travellers as $favorite_traveller)
            <li class="list-group-item">
                <ul class="list-inline">
					<li>{{$favorite_traveller->id}}</li>
					<li>@if($favorite_traveller->user) {{$favorite_traveller->user->name}} @endif</li>
					<li>@if($favorite_traveller->traveller) {{$favorite_traveller->traveller->name}} @endif</li>  
                    <li class="pull-right">
                            <a class="btn btn-default btn-xs" data-toggle="collapse" data-target="#openme{{$favorite_traveller->id}}"><i class="fa fa-caret-down"></i></a>
                            <a class="btn btn-default btn-xs" data-toggle="collapse" data-target="#editme{{$favorite_traveller->id}}"><i class="fa fa-pencil"></i></a>
                            <span class="btn btn-link btn-xs">
                                {!! deletes('Favorite_travellers', $favorite_traveller['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-xs']) !!}
                            </span>
                    </li>
                </ul>
                <ul class="list-inline collapse" id="editme{{$favorite_traveller->id}}">
                    
                {!! Form::open( ['class'=> 'form form-inline','method'=>'patch', 'url'=> action('Favorite_travellers@update', $favorite_traveller->id), 'enctype'=>'multipart/form-data' ]) !!}
                
                    
                            <div class="form-group">
                                {!! Form::label('user_id', 'User: ') !!}
                                {!! Form::select('user_id', \App\User::lists('name', 'id'), $favorite_traveller->user_id , ['class'=>'form-control select2']) !!}
                            </div>
                                
                            <div class="form-group">
                                {!! Form::label('traveller_id', 'Traveller: ') !!}
                                {!! Form::select('traveller_id', \App\Traveller::lists('name', 'id'), $favorite_traveller->traveller_id , ['class'=>'form-control select2']) !!}
                            </div>
                                
                    <div class="form-group">
                        {!! Form::submit('Update Favorite traveller', ['class'=>'form-control btn btn-info']) !!}
                    </div>
                
                {!! Form::close() !!}

                
        
                </ul>
                <div class="row collapse" id="openme{{$favorite_traveller->id}}">
                </div>
            </li>
        @endforeach
    @endif
                
            <ul>
    </div>
</section>
{!! errors($errors) !!}

@stop
        