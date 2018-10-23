
@extends('admin.layout')

@section('title') Create new Order product @stop

@section('main')

<h1><center>Order products</center></h1>


{!! errors($errors) !!}


<section class="col-sm-11">

<h3>Create Order product</h3>


{!! Form::open( ['url'=> action('Orders@order_productsStore', $order->id), 'class'=>'form form-horizontal', 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('label_id', 'Label: ') !!}
            {!! Form::select('label_id', \App\Label::lists('name', 'id'), old('label_id') , ['class'=>'form-control select2']) !!}
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
        