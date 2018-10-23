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
        {!! Form::label('description','Description : ') !!}
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
        {!! Form::label('url','Product URL : ') !!}
        {!! Form::text('url', $link->url , ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">	
        {!! Form::label('Note','User Note on Custom Link : ') !!}	
        {!! Form::text('custom_link_note', $link->custom_link_note , ['class'=>'form-control']) !!}	
    </div>	
    <div class="form-group">	
        {!! Form::label('image','Image URL : ') !!}	
        {!! Form::text('image', $link->image , ['class'=>'form-control']) !!}	
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
