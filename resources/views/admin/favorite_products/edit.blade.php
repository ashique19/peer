
@extends('admin.layout')

@section('title') Edit Favorite products @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Modify Favorite product</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

{!! Form::open( ['method'=>'patch', 'url'=> action('Favorite_products@update', $favorite_product->id), 'enctype'=>'multipart/form-data' ]) !!}

    
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', $favorite_product->name , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('amazon_url', 'Amazon url: ') !!}
                {!! Form::text('amazon_url', $favorite_product->amazon_url , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('image_url', 'Image url: ') !!}
                {!! Form::text('image_url', $favorite_product->image_url , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('price', 'Price: ') !!}
                {!! Form::text('price', $favorite_product->price , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('user_id', 'User: ') !!}
                {!! Form::select('user_id', \App\User::lists('name', 'id'), $favorite_product->user_id , ['class'=>'form-control select2']) !!}
            </div>
                
    <div class="form-group">
        {!! Form::submit('Update Favorite product', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        