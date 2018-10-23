
@extends('admin.layout')

@section('title') Label product @stop

@section('main')

<h1><center>Label products @if($label_products) : {{$label_products->total()}} @endif</center></h1>

<section class="col-sm-10 col-sm-offset-1">
    
    {!! Form::open(['class'=>'form form-inline', 'method' =>'post', 'url'=> action('Label_products@searchIndex')]) !!} 
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
    
    <a href="{{action('Label_products@create')}}" class="btn btn-default pull-right btn-lg blue-border blue-text">Add new</a>
    
    <table class="table table-responsive">
        <thead>
            <tr>
				<th class="blue-bg white-text">Id</th>
				<th class="blue-bg white-text">Label</th>
				<th class="blue-bg white-text">Name</th>
				<th class="blue-bg white-text">Quantity</th>
				<th class="blue-bg white-text">Weight</th>
				<th class="blue-bg white-text">Value</th>
				<th class="blue-bg white-text">Country</th>
				<th class="blue-bg white-text">Hs tarrif</th>
				<th class="blue-bg white-text">Created at</th>
				<th class="blue-bg white-text">Updated at</th>
                <th class="blue-bg white-text" width="50">Show</th>
                <th class="blue-bg white-text" width="50">Modify</th>
                <th class="blue-bg white-text" width="50">Delete</th>
            </tr>
        </thead>
        <tbody>
            @if($label_products)
                @foreach($label_products as $label_product)
                    <tr>
						<td>{{$label_product->id}}</td>
						<td>@if($label_product->label) {{$label_product->label->name}} @endif</td>
						<td>{{$label_product->name}}</td>
						<td>{{$label_product->quantity}}</td>
						<td>{{$label_product->weight}}</td>
						<td>{{$label_product->value}}</td>
						<td>@if($label_product->country) {{$label_product->country->name}} @endif</td>
						<td>{{$label_product->hs_tarrif}}</td>
						<td>{{$label_product->created_at}}</td>
						<td>{{$label_product->updated_at}}</td>
                        <td>
                            {!! views('Label_products', $label_product->id, '<span class=\'fa fa-expand\'></span>', ['class'=>'btn btn-success btn-rounded']) !!}
                        </td>
                        <td>
                            {!! edits('Label_products', $label_product['id'], '<span class=\'fa fa-pencil\'></span>', ['class'=>'btn btn-warning btn-rounded']) !!}
                        </td>
                        <td>
                            {!! deletes('Label_products', $label_product['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {!! $label_products->render() !!}
</section>


@stop
        