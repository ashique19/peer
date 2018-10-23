@extends('admin.layout')

@section('title') Order log @stop

@section('main')

<h1><center>Order logs @if($order_logs) : {{$order_logs->total()}} @endif</center></h1>

<section class="col-xs-12">
    
    {!! Form::open(['class'=>'form form-inline', 'method' =>'post', 'url'=> action('Order_logs@searchIndex')]) !!} 
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
        <a class="btn btn-warning pull-right" href="{{action('Orders@order_logsCreate', $order->id)}}">Create new order_log</a>
        <br>
    </h2>
    
    <table class="table table-responsive">
        <thead>
            <tr>
				<th>Id</th>
				<th>Name</th>
				<th>User</th>
				<th>Created by</th>
				<th>Updated by</th>
				<th>Log detail</th>
				<th>Created at</th>
				<th>Updated at</th>
                <th>Show</th>
                <th>Modify</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @if($order_logs)
                @foreach($order_logs as $order_log)
                    <tr>
						<td>{{$order_log->id}}</td>
						<td>{{$order_log->name}}</td>
						<td>@if($order_log->user) {{$order_log->user->name}} @endif</td>
						<td>{{$order_log->created_by}}</td>
						<td>{{$order_log->updated_by}}</td>
						<td>{{$order_log->log_detail}}</td>
						<td>{{$order_log->created_at}}</td>
						<td>{{$order_log->updated_at}}</td>
                        <td>
                            <a href="{{action('Order_logs@show', $order_log->id)}}" class="btn btn-default btn-sm btn-rounded" title="Edit role"><span class="fa fa-pencil"></span></a>
                        </td>
                        <td>
                            <a href="{{action('Order_logs@edit', $order_log['id'])}}" class="btn btn-default btn-sm btn-rounded" title="Edit role"><span class="fa fa-pencil"></span></a>
                        </td>
                        <td>
                            {!! Form::open(['method'=>'delete', 'url'=> action('Order_logs@destroy', $order_log->id) ]) !!}
                            {!! Form::hidden('id', $order_log->id ) !!}
                            <button href="{{action('Order_logs@edit',[$order_log->id])}}" class="btn btn-danger btn-sm btn-rounded" title="Delete order_log ">
                                <span class="fa fa-times"></span>
                            </button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {!! $order_logs->render() !!}
</section>

@stop
        