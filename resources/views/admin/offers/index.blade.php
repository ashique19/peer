
@extends('admin.layout')

@section('title') Offer @stop

@section('main')

<h1><center>Offers @if($offers) : {{$offers->total()}} @endif</center></h1>

<section class="col-sm-10 col-sm-offset-1">
    
    {!! Form::open(['class'=>'form form-inline', 'method' =>'post', 'url'=> action('Offers@searchIndex')]) !!} 
            
        {!! Form::hidden('is_reply', 0) !!}
            
        <div class="form-group">
            {!! Form::label('is_agreed', 'Is agreed: ') !!}
            {!! Form::select('is_agreed', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], old('is_agreed') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('is_offer_from_buyer', 'Is offer from buyer: ') !!}
            {!! Form::select('is_offer_from_buyer', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], old('is_offer_from_buyer') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('is_offer_from_traveller', 'Is offer from traveller: ') !!}
            {!! Form::select('is_offer_from_traveller', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], old('is_offer_from_traveller') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('traveller_id', 'Traveler: ') !!}
            {!! Form::select('traveller_id', [], old('traveller_id') , ['class'=>'form-control user-search', 'placeholder'=>'-Search Traveler-']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('buyer_id', 'Buyer: ') !!}
            {!! Form::select('buyer_id', [], old('buyer_id') , ['class'=>'form-control user-search', 'placeholder'=> '-Search Buyer-']) !!}
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

<section class="col-sm-10 col-sm-offset-1">
    
    <a href="{{action('Offers@create')}}" class="btn btn-default pull-right btn-lg blue-border blue-text">Add new</a>
    
    <table class="table table-responsive">
        <thead>
            <tr>
				<th class="blue-bg white-text">Id</th>
				<th class="blue-bg white-text">Product</th>
				<th class="blue-bg white-text">Buyer</th>
				<th class="blue-bg white-text">Traveler</th>
				<th class="blue-bg white-text">Reply</th>
				<th class="blue-bg white-text">Price</th>
				<th class="blue-bg white-text">Trav</th>
				<th class="blue-bg white-text">Trans</th>
				<th class="blue-bg white-text">Airp</th>
				<th class="blue-bg white-text">Total</th>
                <th class="blue-bg white-text" width="50">Show</th>
                <th class="blue-bg white-text" width="50">Modify</th>
                <th class="blue-bg white-text" width="50">Delete</th>
            </tr>
        </thead>
        <tbody>
            @if($offers)
                @foreach($offers as $offer)
                    <tr>
						<td>{{$offer->id}}</td>
						<td><a href="{{$offer->link}}" class="btn btn-default btn-rounded btn-xs" target="_blank">{{$offer->name}}</a></td>
                        <td>@if($offer->buyer){{$offer->buyer->name}} @endif</td>
                        <td>@if($offer->traveller){{$offer->traveller->name}} @endif</td>
                        <td>{{yn($offer->is_reply)}}</td>
                        <td>{{$offer->product_price}}</td>
                        <td>{{$offer->offer_price - $offer->product_price}}</td>
                        <td>{{$offer->transaction_charge}}</td>
                        <td>{{$offer->airposted_commission}}</td>
                        <td>{{$offer->total_price}}</td>
                        <td>
                            {!! views('Offers', $offer->id, '<span class=\'fa fa-expand\'></span>', ['class'=>'btn btn-success btn-rounded']) !!}
                        </td>
                        <td>
                            {!! edits('Offers', $offer['id'], '<span class=\'fa fa-pencil\'></span>', ['class'=>'btn btn-warning btn-rounded']) !!}
                        </td>
                        <td>
                            {!! deletes('Offers', $offer['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {!! $offers->render() !!}
</section>


@stop
        