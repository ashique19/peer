
@extends('admin.layout')

@section('title') Order log @stop

@section('main')

<h1><center>Order logs @if($order_logs) : {{$order_logs->total()}} @endif</center></h1>

<section class="col-sm-10 col-sm-offset-1">
    
    {!! Form::open(['class'=>'form form-inline', 'method' =>'post', 'url'=> action('Order_logs@searchIndex')]) !!} 
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('order_id', 'Order: ') !!}
            {!! Form::select('order_id', \App\Order::lists('name', 'id'), old('order_id') , ['class'=>'form-control select2']) !!}
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
    
    <a href="{{action('Order_logs@create')}}" class="btn btn-default pull-right btn-lg blue-border blue-text">Add new</a>
    
    <table class="table table-responsive">
        <thead>
            <tr>
				<th class="blue-bg white-text">Id</th>
				<th class="blue-bg white-text">Name</th>
				<th class="blue-bg white-text">Order</th>
				<th class="blue-bg white-text">User</th>
				<th class="blue-bg white-text">Log detail</th>
				<th class="blue-bg white-text">Created at</th>
				<th class="blue-bg white-text">Updated at</th>
                <th class="blue-bg white-text" width="50">Show</th>
                <th class="blue-bg white-text" width="50">Modify</th>
                <th class="blue-bg white-text" width="50">Delete</th>
            </tr>
        </thead>
        <tbody>
            @if($order_logs)
                @foreach($order_logs as $order_log)
                    <tr>
						<td>{{$order_log->id}}</td>
						<td>{{$order_log->name}}</td>
						<td>@if($order_log->order) {{$order_log->order->name}} @endif</td>
						<td>@if($order_log->user) {{$order_log->user->name}} @endif</td>
						<td>{{$order_log->log_detail}}</td>
						<td>{{$order_log->created_at}}</td>
						<td>{{$order_log->updated_at}}</td>
                        <td>
                            {!! views('Order_logs', $order_log->id, '<span class=\'fa fa-expand\'></span>', ['class'=>'btn btn-success btn-rounded']) !!}
                        </td>
                        <td>
                            {!! edits('Order_logs', $order_log['id'], '<span class=\'fa fa-pencil\'></span>', ['class'=>'btn btn-warning btn-rounded']) !!}
                        </td>
                        <td>
                            {!! deletes('Order_logs', $order_log['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {!! $order_logs->render() !!}
</section>


@stop
        