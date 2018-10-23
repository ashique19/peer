
@extends('admin.layout')

@section('title') Favorite product @stop

@section('main')

<h1><center>Favorite products @if($favorite_products) : {{$favorite_products->total()}} @endif</center></h1>

 <section class="col-md-10 col-md-offset-1 push-down-20">
    
    <h4 class="page-title btn-info">Create New</h4>
 
    {!! Form::open( ['url'=> action('Favorite_products@store'), 'class'=> 'form form-inline', 'enctype'=>'multipart/form-data' ]) !!}

    
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

<section class="col-md-10 col-md-offset-1 push-down-20">
    
    <h4 class="page-title btn-info">List of All:</h4>
    
    <div class="col-xs-12">
        
        <ul class="list-group">
        
    @if($favorite_products)
        @foreach($favorite_products as $favorite_product)
            <li class="list-group-item">
                <ul class="list-inline">
					<li>{{$favorite_product->id}}</li>
					<li>{{$favorite_product->name}}</li>
					<li>{{$favorite_product->amazon_url}}</li>
					<li>{{$favorite_product->image_url}}</li>
					<li>{{$favorite_product->price}}</li>
					<li>@if($favorite_product->user) {{$favorite_product->user->name}} @endif</li>  
                    <li class="pull-right">
                            <a class="btn btn-default btn-xs" data-toggle="collapse" data-target="#openme{{$favorite_product->id}}"><i class="fa fa-caret-down"></i></a>
                            <a class="btn btn-default btn-xs" data-toggle="collapse" data-target="#editme{{$favorite_product->id}}"><i class="fa fa-pencil"></i></a>
                            <span class="btn btn-link btn-xs">
                                {!! deletes('Favorite_products', $favorite_product['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-xs']) !!}
                            </span>
                    </li>
                </ul>
                <ul class="list-inline collapse" id="editme{{$favorite_product->id}}">
                    
                {!! Form::open( ['class'=> 'form form-inline','method'=>'patch', 'url'=> action('Favorite_products@update', $favorite_product->id), 'enctype'=>'multipart/form-data' ]) !!}
                
                    
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

                
        
                </ul>
                <div class="row collapse" id="openme{{$favorite_product->id}}">
                </div>
            </li>
        @endforeach
    @endif
                
            <ul>
    </div>
</section>
{!! errors($errors) !!}

@stop
        