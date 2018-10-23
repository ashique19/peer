
@extends('admin.layout')

@section('title') Create new Label product @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Label products</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

<h3>Create Label product</h3>


{!! Form::open( ['url'=> action('Label_products@store'), 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('label_id', 'Label: ') !!}
            {!! Form::select('label_id', \App\Label::lists('name', 'id'), old('label_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('quantity', 'Quantity: ') !!}
            {!! Form::text('quantity', old('quantity') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('weight', 'Weight: ') !!}
            {!! Form::text('weight', old('weight') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('value', 'Value: ') !!}
            {!! Form::text('value', old('value') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('country_id', 'Country: ') !!}
            {!! Form::select('country_id', \App\Country::lists('name', 'id'), old('country_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('hs_tarrif', 'Hs tarrif: ') !!}
            {!! Form::text('hs_tarrif', old('hs_tarrif') , ['class'=>'form-control']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Label product', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        