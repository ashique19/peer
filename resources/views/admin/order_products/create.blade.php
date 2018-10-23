
@extends('admin.layout')

@section('title') Create new Order product @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Order products</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

<h3>Create Order product</h3>


{!! Form::open( ['url'=> action('Order_products@store'), 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('order_id', 'Order: ') !!}
            {!! Form::select('order_id', \App\Order::lists('name', 'id'), old('order_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('source', 'Source: ') !!}
            {!! Form::text('source', old('source') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('product_url', 'Product url: ') !!}
            {!! Form::text('product_url', old('product_url') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('category_id', 'Category: ') !!}
            {!! Form::select('category_id', \App\Category::lists('name', 'id'), old('category_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('price', 'Price: ') !!}
            {!! Form::text('price', old('price') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('height', 'Height: ') !!}
            {!! Form::text('height', old('height') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('width', 'Width: ') !!}
            {!! Form::text('width', old('width') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('length', 'Length: ') !!}
            {!! Form::text('length', old('length') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('weight', 'Weight: ') !!}
            {!! Form::text('weight', old('weight') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('dimension_unit', 'Dimension unit: ') !!}
            {!! Form::text('dimension_unit', old('dimension_unit') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('weight_unit', 'Weight unit: ') !!}
            {!! Form::text('weight_unit', old('weight_unit') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('product_image', 'Product image: ') !!}
            {!! Form::text('product_image', old('product_image') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('quantity', 'Quantity: ') !!}
            {!! Form::text('quantity', old('quantity') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('note', 'Note: ') !!}
            {!! Form::text('note', old('note') , ['class'=>'form-control']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Order product', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        