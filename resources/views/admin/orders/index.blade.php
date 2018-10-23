
@extends('admin.layout')

@section('title') Order @stop

@section('main')

<h1><center>Orders @if($orders) : {{$orders->total()}} @endif</center></h1>

<section class="col-sm-10 col-sm-offset-1">
    
    {!! Form::open(['class'=>'form form-inline', 'method' =>'post', 'url'=> action('Orders@searchIndex')]) !!} 
        <div class="form-group col-sm-3 col-xs-12">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group col-sm-3 col-xs-12">
            {!! Form::label('user_id', 'User: ') !!}
            {!! Form::select('user_id', [], old('user_id') , ['class'=>'form-control select2 user-search']) !!}
        </div>
            
        <div class="form-group col-sm-3 col-xs-12">
            {!! Form::label('from', 'From: ') !!}
            {!! Form::text('from', old('from') , ['class'=>'form-control datepicker']) !!}
        </div>
        
        <div class="form-group col-sm-3 col-xs-12">
            {!! Form::label('to', 'To: ') !!}
            {!! Form::text('to', old('to') , ['class'=>'form-control datepicker']) !!}
        </div>

        {!! Form::submit('search', ['class'=>'btn btn-info']) !!}
        
    {!! Form::close() !!}
    
    <hr>
</section>

{!! errors($errors) !!}

<section class="col-sm-10 col-sm-offset-1 scrollable">
    
    <a href="{{action('Orders@create')}}" class="btn btn-default pull-right btn-lg blue-border blue-text">Add new</a>
    
    <table class="table table-responsive">
        <thead>
            <tr>
				<th class="blue-bg white-text">Id</th>
				<th class="blue-bg white-text">Name</th>
				<th class="blue-bg white-text">Status</th>
				<th class="blue-bg white-text">No of products</th>
				<th class="blue-bg white-text">Product cost</th>
				<th class="blue-bg white-text">Shipping cost</th>
				<th class="blue-bg white-text">Airposted margin</th>
				<th class="blue-bg white-text">Order total</th>
				<th class="blue-bg white-text">Created at</th>
				<th class="blue-bg white-text">Updated at</th>
                <th class="blue-bg white-text" width="50">Show</th>
            </tr>
        </thead>
        <tbody>
            @if($orders)
                @foreach($orders as $order)
                    <tr>
						<td>{{$order->id}}</td>
						<td>{{$order->name}}</td>
						<td>{{order_status($order->status)}}</td>
						<td>{{$order->no_of_products}}</td>
						<td>{{$order->product_cost}}</td>
						<td>{{$order->shipping_cost}}</td>
						<td>{{$order->airposted_margin}}</td>
						<td>{{$order->order_total}}</td>
						<td>{{$order->created_at}}</td>
						<td>{{$order->updated_at}}</td>
                        <td>
                            {!! views('Orders', $order->id, '<span class=\'fa fa-expand\'></span>', ['class'=>'btn btn-success btn-rounded']) !!}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {!! $orders->render() !!}
</section>


@stop
        