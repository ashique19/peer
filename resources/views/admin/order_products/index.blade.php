
@extends('admin.layout')

@section('title') Order product @stop

@section('main')

<h1><center>Order products @if($order_products) : {{$order_products->total()}} @endif</center></h1>

<section class="col-sm-10 col-sm-offset-1">
    
    {!! Form::open(['class'=>'form form-inline', 'method' =>'post', 'url'=> action('Order_products@searchIndex')]) !!} 
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
            {!! Form::label('from', 'From: ') !!}
            {!! Form::text('from', old('from') , ['class'=>'form-control datepicker']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('to', 'To: ') !!}
            {!! Form::text('to', old('to') , ['class'=>'form-control datepicker']) !!}
        </div>

        {!! Form::submit('search', ['class'=>'btn btn-info']) !!}
        
    {!! Form::close() !!}
    
    <hr>
</section>

{!! errors($errors) !!}

<section class="col-sm-10 col-sm-offset-1">
    
    <a href="{{action('Order_products@create')}}" class="btn btn-default pull-right btn-lg blue-border blue-text">Add new</a>
    
    <table class="table table-responsive">
        <thead>
            <tr>
				<th class="blue-bg white-text">Id</th>
				<th class="blue-bg white-text">Name</th>
				<th class="blue-bg white-text">Order</th>
				<th class="blue-bg white-text">Source</th>
				<th class="blue-bg white-text">Product url</th>
				<th class="blue-bg white-text">Category</th>
				<th class="blue-bg white-text">Price</th>
				<th class="blue-bg white-text">Height</th>
				<th class="blue-bg white-text">Width</th>
				<th class="blue-bg white-text">Length</th>
				<th class="blue-bg white-text">Weight</th>
				<th class="blue-bg white-text">Dimension unit</th>
				<th class="blue-bg white-text">Weight unit</th>
				<th class="blue-bg white-text">Product image</th>
				<th class="blue-bg white-text">Quantity</th>
				<th class="blue-bg white-text">Note</th>
				<th class="blue-bg white-text">Created at</th>
				<th class="blue-bg white-text">Updated at</th>
                <th class="blue-bg white-text" width="50">Show</th>
                <th class="blue-bg white-text" width="50">Modify</th>
                <th class="blue-bg white-text" width="50">Delete</th>
            </tr>
        </thead>
        <tbody>
            @if($order_products)
                @foreach($order_products as $order_product)
                    <tr>
						<td>{{$order_product->id}}</td>
						<td>{{$order_product->name}}</td>
						<td>@if($order_product->order) {{$order_product->order->name}} @endif</td>
						<td>{{$order_product->source}}</td>
						<td>{{$order_product->product_url}}</td>
						<td>@if($order_product->category) {{$order_product->category->name}} @endif</td>
						<td>{{$order_product->price}}</td>
						<td>{{$order_product->height}}</td>
						<td>{{$order_product->width}}</td>
						<td>{{$order_product->length}}</td>
						<td>{{$order_product->weight}}</td>
						<td>{{$order_product->dimension_unit}}</td>
						<td>{{$order_product->weight_unit}}</td>
						<td>{{$order_product->product_image}}</td>
						<td>{{$order_product->quantity}}</td>
						<td>{{$order_product->note}}</td>
						<td>{{$order_product->created_at}}</td>
						<td>{{$order_product->updated_at}}</td>
                        <td>
                            {!! views('Order_products', $order_product->id, '<span class=\'fa fa-expand\'></span>', ['class'=>'btn btn-success btn-rounded']) !!}
                        </td>
                        <td>
                            {!! edits('Order_products', $order_product['id'], '<span class=\'fa fa-pencil\'></span>', ['class'=>'btn btn-warning btn-rounded']) !!}
                        </td>
                        <td>
                            {!! deletes('Order_products', $order_product['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {!! $order_products->render() !!}
</section>


@stop
        