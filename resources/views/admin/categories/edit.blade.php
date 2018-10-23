
@extends('admin.layout')

@section('title') Edit Categories @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Modify Category</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

{!! Form::open( ['method'=>'patch', 'url'=> action('Categories@update', $category->id), 'enctype'=>'multipart/form-data' ]) !!}

    
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', $category->name , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('search_index', 'Search index: ') !!}
                {!! Form::text('search_index', $category->search_index , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('is_active', 'Is active: ') !!}
                {!! Form::select('is_active', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], $category->is_active , ['class'=>'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('is_at_homepage', 'Is at homepage: ') !!}
                {!! Form::select('is_at_homepage', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], $category->is_at_homepage , ['class'=>'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('amazon_node', 'Amazon node: ') !!}
                {!! Form::text('amazon_node', $category->amazon_node , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                <label for="category_photos">Category Thumbnail Image (Suggested size: 500px * 500px): <span class="badge badge-primary"><input type="checkbox" value="1" name="category_photo_delete" /> remove</span></label>
                {!! Form::file('category_photos' , ['class'=>'form-control file']) !!}
            </div>
                
    <div class="form-group">
        {!! Form::submit('Update Category', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        