
@extends('admin.layout')

@section('title') Edit Order logs @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Modify Order log</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

{!! Form::open( ['method'=>'patch', 'url'=> action('Order_logs@update', $order_log->id), 'enctype'=>'multipart/form-data' ]) !!}

    
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', $order_log->name , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('order_id', 'Order: ') !!}
                {!! Form::select('order_id', \App\Order::lists('name', 'id'), $order_log->order_id , ['class'=>'form-control select2']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('user_id', 'User: ') !!}
                {!! Form::select('user_id', \App\User::lists('name', 'id'), $order_log->user_id , ['class'=>'form-control select2']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('log_detail', 'Log detail: ') !!}
                {!! Form::text('log_detail', $order_log->log_detail , ['class'=>'form-control']) !!}
            </div>
                
    <div class="form-group">
        {!! Form::submit('Update Order log', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        