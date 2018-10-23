
@extends('admin.layout')

@section('title') Payment @stop

@section('main')

<h1><center>Payments @if($payments) : {{$payments->total()}} @endif</center></h1>

<section class="col-sm-10 col-sm-offset-1">
    
    {!! Form::open(['class'=>'form form-inline', 'method' =>'post', 'url'=> action('Payments@searchIndex')]) !!} 

        <div class="form-group">
            {!! Form::label('buyer_id', 'Buyer: ') !!}
            {!! Form::select('buyer_id', [], old('buyer_id') , ['class'=>'form-control user-search', 'placeholder'=> '-Search User-']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('traveller_id', 'Traveller: ') !!}
            {!! Form::select('traveller_id', [], old('traveller_id') , ['class'=>'form-control user-search', 'placeholder'=> '-Search User-']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('from_country_id', 'From country: ') !!}
            {!! Form::select('from_country_id', \App\Country::lists('name', 'id'), old('from_country_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('to_country_id', 'To country: ') !!}
            {!! Form::select('to_country_id', \App\Country::lists('name', 'id'), old('to_country_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('payment', 'Payment: ') !!}
            {!! Form::text('payment', old('payment') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('status', 'Status: ') !!}
            {!! Form::select('status', [1 => 'unpaid', 2 => 'paid but not verified', 3 => 'payment verified', 4 => 'money given to traveller'], old('status') , ['class'=>'form-control', 'placeholder'=> '-Select-']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('is_delivered', 'Delivered: ') !!}
            {!! Form::select('is_delivered', [ 0 => 'No', 1 => 'traveller delivered to buyer', 2 => 'Buyer confirmed delivery'], null , ['class'=>'form-control', 'placeholder'=> '-Select-']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('gateway_payment_id', 'Gateway payment ID: ') !!}
            {!! Form::text('gateway_payment_id', old('gateway_payment_id') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('gateway_payer_id', 'Gateway payer ID: ') !!}
            {!! Form::text('gateway_payer_id', old('gateway_payer_id') , ['class'=>'form-control']) !!}
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
    
    <a href="{{action('Payments@create')}}" class="btn btn-default pull-right btn-lg blue-border blue-text">Add new</a>
    
    <table class="table table-responsive">
        <thead>
            <tr>
				<th class="blue-bg white-text">Id</th>
				<th class="blue-bg white-text">Name</th>
				<th class="blue-bg white-text">From country</th>
				<th class="blue-bg white-text">To country</th>
				<th class="blue-bg white-text">Amount</th>
				<th class="blue-bg white-text">Status</th>
                <th class="blue-bg white-text" width="50">Show</th>
                <th class="blue-bg white-text" width="50">Modify</th>
                <th class="blue-bg white-text" width="50">Delete</th>
            </tr>
        </thead>
        <tbody>
            @if($payments)
                @foreach($payments as $payment)
                    <tr>
						<td>{{$payment->id}}</td>
						<td>{{$payment->name}}</td>
						<td>@if($payment->from_country) {{$payment->from_country->name}} @endif</td>
						<td>@if($payment->to_country) {{$payment->to_country->name}} @endif</td>
						<td>{{$payment->payment}}</td>
						<td>
    					    @if($payment->status == 1)Unpaid
    					    @elseif($payment->status == 2)Paid and Unverified
    					    @elseif($payment->status == 3)Verified
    					    @elseif($payment->status == 4)Withdrawn by Traveler
    					    @endif
    					</td>
                        <td>
                            {!! views('Payments', $payment->id, '<span class=\'fa fa-expand\'></span>', ['class'=>'btn btn-success btn-rounded']) !!}
                        </td>
                        <td>
                            {!! edits('Payments', $payment['id'], '<span class=\'fa fa-pencil\'></span>', ['class'=>'btn btn-warning btn-rounded']) !!}
                        </td>
                        <td>
                            {!! deletes('Payments', $payment['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {!! $payments->render() !!}
</section>


@stop
        