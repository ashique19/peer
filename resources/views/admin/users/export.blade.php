@extends('admin.layout')

@section('main')
<section class="panel-body">
    <h1 class="page-title text-center">Export Travelers/Buyers</h1>
    <small class="alert alert-warning">Max 10,000 data will be downloaded at a time.</small>
</section>

{!! errors($errors) !!}

<section class="panel-body">
    {!! Form::open([ 'url'=> action('Users@postExport'), 'method'=> 'post' ]) !!}
    
    <div class="form-group col-sm-6">
        {!! Form::label('joined_after', 'Joined After') !!}
        {!! Form::text('joined_after', old('joined_after') , ['class'=> 'form-control datepicker'] ) !!}
    </div>
    
    <div class="form-group col-sm-6">
        {!! Form::label('joined_before', 'Joined Before') !!}
        {!! Form::text('joined_before', old('joined_before') , ['class'=> 'form-control datepicker'] ) !!}
    </div>
    
    <div class="form-group col-sm-6">
        {!! Form::label('format', 'Format') !!}
        <input type="radio" name="format" value="xlsx"/> Excel (xlsx)
        <input type="radio" name="format" value="xls"/> Excel (xls)
        <input type="radio" name="format" value="csv" checked /> CSV
    </div>
    
    {!! Form::submit('Download', ['class'=> 'btn btn-info btn-block']) !!}
    
    {!! Form::close() !!}
</section>

@stop