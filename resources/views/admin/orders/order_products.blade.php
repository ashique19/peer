@extends('admin.layout')

@section('title') Order product @stop

@section('main')

<h1><center>Order products @if($order_products) : {{$order_products->total()}} @endif</center></h1>

<section class="col-xs-12">
    
    {!! Form::open(['class'=>'form form-inline', 'method' =>'post', 'url'=> action('Order_products@searchIndex')]) !!} 
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

<section class="col-sm-11">
    <h2>
        <a class="btn btn-warning pull-right" href="{{action('Orders@order_productsCreate', $order->id)}}">Create new order_product</a>
        <br>
    </h2>
    
    <table class="table table-responsive">
        <thead>
            <tr>
				<th>Id</th>
				<th>Name</th>
				<th>Label</th>
				<th>Product url</th>
				<th>Category</th>
				<th>Price</th>
				<th>Height</th>
				<th>Width</th>
				<th>Length</th>
				<th>Weight</th>
				<th>Dimension unit</th>
				<th>Weight unit</th>
				<th>Product image</th>
				<th>Quantity</th>
				<th>Note</th>
				<th>Created at</th>
				<th>Updated at</th>
                <th>Show</th>
                <th>Modify</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @if($order_products)
                @foreach($order_products as $order_product)
                    <tr>
						<td>{{$order_product->id}}</td>
						<td>{{$order_product->name}}</td>
						<td>@if($order_product->label) {{$order_product->label->name}} @endif</td>
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
                            <a href="{{action('Order_products@show', $order_product->id)}}" class="btn btn-default btn-sm btn-rounded" title="Edit role"><span class="fa fa-pencil"></span></a>
                        </td>
                        <td>
                            <a href="{{action('Order_products@edit', $order_product['id'])}}" class="btn btn-default btn-sm btn-rounded" title="Edit role"><span class="fa fa-pencil"></span></a>
                        </td>
                        <td>
                            {!! Form::open(['method'=>'delete', 'url'=> action('Order_products@destroy', $order_product->id) ]) !!}
                            {!! Form::hidden('id', $order_product->id ) !!}
                            <button href="{{action('Order_products@edit',[$order_product->id])}}" class="btn btn-danger btn-sm btn-rounded" title="Delete order_product ">
                                <span class="fa fa-times"></span>
                            </button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {!! $order_products->render() !!}
</section>

@stop
        