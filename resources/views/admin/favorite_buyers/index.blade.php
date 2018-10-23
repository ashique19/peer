
@extends('admin.layout')

@section('title') Favorite buyer @stop

@section('main')

<h1><center>Favorite buyers @if($favorite_buyers) : {{$favorite_buyers->total()}} @endif</center></h1>

 <section class="col-md-10 col-md-offset-1 push-down-20">
    
    <h4 class="page-title btn-info">Create New</h4>
 
    {!! Form::open( ['url'=> action('Favorite_buyers@store'), 'class'=> 'form form-inline', 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('user_id', 'User: ') !!}
            {!! Form::select('user_id', \App\User::lists('name', 'id'), old('user_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('buyer_id', 'Buyer: ') !!}
            {!! Form::select('buyer_id', \App\Buyer::lists('name', 'id'), old('buyer_id') , ['class'=>'form-control select2']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Favorite buyer', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}

</section>

<section class="col-md-10 col-md-offset-1 push-down-20">
    
    <h4 class="page-title btn-info">List of All:</h4>
    
    <div class="col-xs-12">
        
        <ul class="list-group">
        
    @if($favorite_buyers)
        @foreach($favorite_buyers as $favorite_buyer)
            <li class="list-group-item">
                <ul class="list-inline">
					<li>{{$favorite_buyer->id}}</li>
					<li>@if($favorite_buyer->user) {{$favorite_buyer->user->name}} @endif</li>
					<li>@if($favorite_buyer->buyer) {{$favorite_buyer->buyer->name}} @endif</li>  
                    <li class="pull-right">
                            <a class="btn btn-default btn-xs" data-toggle="collapse" data-target="#openme{{$favorite_buyer->id}}"><i class="fa fa-caret-down"></i></a>
                            <a class="btn btn-default btn-xs" data-toggle="collapse" data-target="#editme{{$favorite_buyer->id}}"><i class="fa fa-pencil"></i></a>
                            <span class="btn btn-link btn-xs">
                                {!! deletes('Favorite_buyers', $favorite_buyer['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-xs']) !!}
                            </span>
                    </li>
                </ul>
                <ul class="list-inline collapse" id="editme{{$favorite_buyer->id}}">
                    
                {!! Form::open( ['class'=> 'form form-inline','method'=>'patch', 'url'=> action('Favorite_buyers@update', $favorite_buyer->id), 'enctype'=>'multipart/form-data' ]) !!}
                
                    
                            <div class="form-group">
                                {!! Form::label('user_id', 'User: ') !!}
                                {!! Form::select('user_id', \App\User::lists('name', 'id'), $favorite_buyer->user_id , ['class'=>'form-control select2']) !!}
                            </div>
                                
                            <div class="form-group">
                                {!! Form::label('buyer_id', 'Buyer: ') !!}
                                {!! Form::select('buyer_id', \App\Buyer::lists('name', 'id'), $favorite_buyer->buyer_id , ['class'=>'form-control select2']) !!}
                            </div>
                                
                    <div class="form-group">
                        {!! Form::submit('Update Favorite buyer', ['class'=>'form-control btn btn-info']) !!}
                    </div>
                
                {!! Form::close() !!}

                
        
                </ul>
                <div class="row collapse" id="openme{{$favorite_buyer->id}}">
                </div>
            </li>
        @endforeach
    @endif
                
            <ul>
    </div>
</section>
{!! errors($errors) !!}

@stop
        