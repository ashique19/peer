@extends('admin.layout')

@section('main')

<section class="container">

<h3>Add all incomplete products link</h3>


{!! Form::open( ['method'=>'patch', 'url'=> action('LinksController@update', ['id' => $link->id]) ]) !!}

    <div class="form-group">
        {!! Form::label('product_id','Product ID : ') !!}
        {!! Form::text('product_id', $link->product_id , ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('title','Title : ') !!}
        {!! Form::text('title', $link->title , ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('description','Title : ') !!}
        {!! Form::text('description', $link->description , ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('price','Price : ') !!}
        {!! Form::text('price', $link->price , ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('currency','Currency : ') !!}
        {!! Form::text('currency', $link->currency , ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('category','Category : ') !!}
        {!! Form::text('category', $link->category , ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('url','URL : ') !!}
        {!! Form::text('url', $link->url , ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Update Product', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}

@if($errors->any())
    <hr>
    <ul class="container">
        @foreach($errors->all() as $error)
        
            <li>{{$error}}</li>
        
        @endforeach
    </ul>

@endif

</section>

@stop
