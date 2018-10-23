
@extends('admin.layout')

@section('title') Create new Payment @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Payments</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

<h3>Create Payment</h3>


{!! Form::open( ['url'=> action('Payments@store'), 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('offer_id', 'Offer: ') !!}
            {!! Form::select('offer_id', \App\Offer::lists('name', 'id'), old('offer_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('buyer_id', 'Buyer: ') !!}
            {!! Form::select('buyer_id', \App\User::lists('name', 'id'), old('buyer_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('traveller_id', 'Traveller: ') !!}
            {!! Form::select('traveller_id', \App\User::lists('name', 'id'), old('traveller_id') , ['class'=>'form-control select2']) !!}
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
            {!! Form::label('product_price', 'Product price: ') !!}
            {!! Form::text('product_price', old('product_price') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('airposted_commission', 'Airposted commission: ') !!}
            {!! Form::text('airposted_commission', old('airposted_commission') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('transaction_charge', 'Transaction charge: ') !!}
            {!! Form::text('transaction_charge', old('transaction_charge') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('payment', 'Payment: ') !!}
            {!! Form::text('payment', old('payment') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('gateway_id', 'Gateway: ') !!}
            {!! Form::select('gateway_id', \App\Gateway::lists('name', 'id'), old('gateway_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('status', 'Status: ') !!}
            {!! Form::select('status', [1=> 'Unpaid', 2=> 'Paid and Unverified', 3=> 'Paid and Verified', 4=> 'Withdrawn by Traveler'], old('status') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('is_delivered', 'Is delivered: ') !!}
            {!! Form::select('is_delivered', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], old('is_delivered') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('gateway_payment_id', 'Gateway payment: ') !!}
            {!! Form::text('gateway_payment_id', old('gateway_payment_id') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('gateway_payer_id', 'Gateway payer: ') !!}
            {!! Form::test('gateway_payer_id', old('gateway_payer_id') , ['class'=>'form-control']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Payment', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        