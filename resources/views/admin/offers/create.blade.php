
@extends('admin.layout')

@section('title') Create new Offer @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Offers</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

<h3>Create Offer</h3>


{!! Form::open( ['url'=> action('Offers@store'), 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('link', 'Link: ') !!}
            {!! Form::text('link', old('link') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('image_url', 'Image url: ') !!}
            {!! Form::text('image_url', old('image_url') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('product_price', 'Product price: ') !!}
            {!! Form::text('product_price', old('product_price') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('offer_price', 'Offer price: ') !!}
            {!! Form::text('offer_price', old('offer_price') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('is_reply', 'Is reply: ') !!}
            {!! Form::select('is_reply', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], old('is_reply') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('reply_of', 'Reply of: ') !!}
            {!! Form::text('reply_of', old('reply_of') , ['class'=>'form-control']) !!}
        </div>
            
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
            {!! Form::label('traveller_id', 'Traveller: ') !!}
            {!! Form::select('traveller_id', [], old('traveller_id') , ['class'=>'form-control user-search', 'placeholder'=> 'Search User']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('buyer_id', 'Buyer: ') !!}
            {!! Form::select('buyer_id', [], old('buyer_id') , ['class'=>'form-control user-search', 'placeholder'=> 'Search User']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('note', 'Note: ') !!}
            {!! Form::text('note', old('note') , ['class'=>'form-control']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Offer', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        