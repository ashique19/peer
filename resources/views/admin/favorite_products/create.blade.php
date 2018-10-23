
@extends('admin.layout')

@section('title') Create new Favorite product @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Favorite products</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

<h3>Create Favorite product</h3>


{!! Form::open( ['url'=> action('Favorite_products@store'), 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('amazon_url', 'Amazon url: ') !!}
            {!! Form::text('amazon_url', old('amazon_url') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('image_url', 'Image url: ') !!}
            {!! Form::text('image_url', old('image_url') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('price', 'Price: ') !!}
            {!! Form::text('price', old('price') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('user_id', 'User: ') !!}
            {!! Form::select('user_id', \App\User::lists('name', 'id'), old('user_id') , ['class'=>'form-control select2']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Favorite product', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        