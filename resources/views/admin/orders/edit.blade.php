
@extends('admin.layout')

@section('title') Edit Orders @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Modify Order</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

{!! Form::open( ['method'=>'patch', 'url'=> action('Orders@update', $order->id), 'enctype'=>'multipart/form-data' ]) !!}

    
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', $order->name , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('user_id', 'User: ') !!}
                {!! Form::select('user_id', \App\User::lists('name', 'id'), $order->user_id , ['class'=>'form-control select2']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('status', 'Status: ') !!}
                {!! Form::text('status', $order->status , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('no_of_products', 'No of products: ') !!}
                {!! Form::text('no_of_products', $order->no_of_products , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('product_cost', 'Product cost: ') !!}
                {!! Form::text('product_cost', $order->product_cost , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('shipping_cost', 'Shipping cost: ') !!}
                {!! Form::text('shipping_cost', $order->shipping_cost , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('airposted_margin', 'Airposted margin: ') !!}
                {!! Form::text('airposted_margin', $order->airposted_margin , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('order_total', 'Order total: ') !!}
                {!! Form::text('order_total', $order->order_total , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('label_id', 'Label: ') !!}
                {!! Form::select('label_id', \App\Label::lists('name', 'id'), $order->label_id , ['class'=>'form-control select2']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('payment_id', 'Payment: ') !!}
                {!! Form::select('payment_id', \App\Payment::lists('name', 'id'), $order->payment_id , ['class'=>'form-control select2']) !!}
            </div>
                
    <div class="form-group">
        {!! Form::submit('Update Order', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        