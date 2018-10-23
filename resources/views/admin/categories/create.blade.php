
@extends('admin.layout')

@section('title') Create new Category @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Categories</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

<h3>Create Category</h3>


{!! Form::open( ['url'=> action('Categories@store'), 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('search_index', 'Search index: ') !!}
            {!! Form::text('search_index', old('search_index') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('is_active', 'Is active: ') !!}
            {!! Form::select('is_active', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], old('is_active') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('is_at_homepage', 'Is at homepage: ') !!}
            {!! Form::select('is_at_homepage', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], old('is_at_homepage') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('amazon_node', 'Amazon node: ') !!}
            {!! Form::text('amazon_node', old('amazon_node') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('category_photos', 'Category Thubnail Image (Suggested size: 500px * 500px): ') !!}
            {!! Form::file('category_photos', ['class'=>'form-control file']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Category', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        