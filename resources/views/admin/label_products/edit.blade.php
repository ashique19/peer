
@extends('admin.layout')

@section('title') Edit Label products @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Modify Label product</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

{!! Form::open( ['method'=>'patch', 'url'=> action('Label_products@update', $label_product->id), 'enctype'=>'multipart/form-data' ]) !!}

    
            <div class="form-group">
                {!! Form::label('label_id', 'Label: ') !!}
                {!! Form::select('label_id', \App\Label::lists('name', 'id'), $label_product->label_id , ['class'=>'form-control select2']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', $label_product->name , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('quantity', 'Quantity: ') !!}
                {!! Form::text('quantity', $label_product->quantity , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('weight', 'Weight: ') !!}
                {!! Form::text('weight', $label_product->weight , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('value', 'Value: ') !!}
                {!! Form::text('value', $label_product->value , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('country_id', 'Country: ') !!}
                {!! Form::select('country_id', \App\Country::lists('name', 'id'), $label_product->country_id , ['class'=>'form-control select2']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('hs_tarrif', 'Hs tarrif: ') !!}
                {!! Form::text('hs_tarrif', $label_product->hs_tarrif , ['class'=>'form-control']) !!}
            </div>
                
    <div class="form-group">
        {!! Form::submit('Update Label product', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        