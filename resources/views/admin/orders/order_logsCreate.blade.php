
@extends('admin.layout')

@section('title') Create new Order log @stop

@section('main')

<h1><center>Order logs</center></h1>


{!! errors($errors) !!}


<section class="col-sm-11">

<h3>Create Order log</h3>


{!! Form::open( ['url'=> action('Orders@order_logsStore', $order->id), 'class'=>'form form-horizontal', 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('user_id', 'User: ') !!}
            {!! Form::select('user_id', \App\User::lists('name', 'id'), old('user_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('created_by', 'Created by: ') !!}
            {!! Form::text('created_by', old('created_by') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('updated_by', 'Updated by: ') !!}
            {!! Form::text('updated_by', old('updated_by') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('log_detail', 'Log detail: ') !!}
            {!! Form::text('log_detail', old('log_detail') , ['class'=>'form-control']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Order log', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        