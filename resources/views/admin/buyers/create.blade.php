
@extends('admin.layout')

@section('title') Create new Buy @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Buy</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

<h3>Create Buy</h3>


{!! Form::open( ['url'=> action('Buyers@store'), 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('name', 'Product: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control', 'placeholder'=> 'e.g. iPhone 6s, Galaxy 2016']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('amazon_url', 'Amazon url: ') !!}
            {!! Form::text('amazon_url', old('amazon_url') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('other_url', 'Other url: ') !!}
            {!! Form::text('other_url', old('other_url') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('price', 'Price: ') !!}
            {!! Form::text('price', old('price') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('country_id', 'Country: ') !!}
            {!! Form::select('country_id', \App\Country::lists('name', 'id'), old('country_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('user_id', 'Buyer: ') !!}
            {!! Form::select('user_id', [], old('user_id') , ['class'=>'form-control user-search', 'placeholder'=> '-Search Buyer-']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('category_id', 'Category: ') !!}
            {!! Form::select('category_id', \App\Category::lists('name', 'id'), old('category_id') , ['class'=>'form-control select2']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Buyer', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        