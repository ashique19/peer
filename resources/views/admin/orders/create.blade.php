
@extends('admin.layout')

@section('title') Create new Order @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Orders</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

<h3>Create Order</h3>


{!! Form::open( ['url'=> action('Orders@store'), 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('user_id', 'User: ') !!}
            {!! Form::select('user_id', \App\User::lists('name', 'id'), old('user_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('status', 'Status: ') !!}
            {!! Form::text('status', old('status') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('no_of_products', 'No of products: ') !!}
            {!! Form::text('no_of_products', old('no_of_products') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('product_cost', 'Product cost: ') !!}
            {!! Form::text('product_cost', old('product_cost') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('shipping_cost', 'Shipping cost: ') !!}
            {!! Form::text('shipping_cost', old('shipping_cost') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('airposted_margin', 'Airposted margin: ') !!}
            {!! Form::text('airposted_margin', old('airposted_margin') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('order_total', 'Order total: ') !!}
            {!! Form::text('order_total', old('order_total') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('label_id', 'Label: ') !!}
            {!! Form::select('label_id', \App\Label::lists('name', 'id'), old('label_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('payment_id', 'Payment: ') !!}
            {!! Form::select('payment_id', \App\Payment::lists('name', 'id'), old('payment_id') , ['class'=>'form-control select2']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Order', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        