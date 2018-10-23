
@extends('admin.layout')

@section('title') Edit Buy @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Modify Buy</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

{!! Form::open( ['method'=>'patch', 'url'=> action('Buyers@update', $buyer->id), 'enctype'=>'multipart/form-data' ]) !!}

    
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', $buyer->name , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('amazon_url', 'Amazon url: ') !!}
                {!! Form::text('amazon_url', $buyer->amazon_url , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('other_url', 'Other url: ') !!}
                {!! Form::text('other_url', $buyer->other_url , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('price', 'Price: ') !!}
                {!! Form::text('price', $buyer->price , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('country_id', 'Country: ') !!}
                {!! Form::select('country_id', \App\Country::lists('name', 'id'), $buyer->country_id , ['class'=>'form-control select2']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('user_id', 'User: ') !!}
                {!! Form::select('user_id', \App\User::where('id',$buyer->user_id)->lists('name','id'), $buyer->user_id , ['class'=>'form-control user-search', 'placeholder'=>'-Search Buyer-']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('category_id', 'Category: ') !!}
                {!! Form::select('category_id', \App\Category::lists('name', 'id'), $buyer->category_id , ['class'=>'form-control select2']) !!}
            </div>
                
    <div class="form-group">
        {!! Form::submit('Update Buyer', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        