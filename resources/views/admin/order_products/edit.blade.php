
@extends('admin.layout')

@section('title') Edit Order products @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Modify Order product</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

{!! Form::open( ['method'=>'patch', 'url'=> action('Order_products@update', $order_product->id), 'enctype'=>'multipart/form-data' ]) !!}

    
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', $order_product->name , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('order_id', 'Order: ') !!}
                {!! Form::select('order_id', \App\Order::lists('name', 'id'), $order_product->order_id , ['class'=>'form-control select2']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('source', 'Source: ') !!}
                {!! Form::text('source', $order_product->source , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('product_url', 'Product url: ') !!}
                {!! Form::text('product_url', $order_product->product_url , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('category_id', 'Category: ') !!}
                {!! Form::select('category_id', \App\Category::lists('name', 'id'), $order_product->category_id , ['class'=>'form-control select2']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('price', 'Price: ') !!}
                {!! Form::text('price', $order_product->price , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('height', 'Height: ') !!}
                {!! Form::text('height', $order_product->height , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('width', 'Width: ') !!}
                {!! Form::text('width', $order_product->width , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('length', 'Length: ') !!}
                {!! Form::text('length', $order_product->length , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('weight', 'Weight: ') !!}
                {!! Form::text('weight', $order_product->weight , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('dimension_unit', 'Dimension unit: ') !!}
                {!! Form::text('dimension_unit', $order_product->dimension_unit , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('weight_unit', 'Weight unit: ') !!}
                {!! Form::text('weight_unit', $order_product->weight_unit , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('product_image', 'Product image: ') !!}
                {!! Form::text('product_image', $order_product->product_image , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('quantity', 'Quantity: ') !!}
                {!! Form::text('quantity', $order_product->quantity , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('note', 'Note: ') !!}
                {!! Form::text('note', $order_product->note , ['class'=>'form-control']) !!}
            </div>
                
    <div class="form-group">
        {!! Form::submit('Update Order product', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        