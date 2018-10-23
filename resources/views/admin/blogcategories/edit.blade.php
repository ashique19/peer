
@extends('admin.layout')

@section('title') Edit Blogcategories @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Modify Blogcategory</center></h1>


@if($errors->any())
<section class="col-sm-6 col-sm-offset-3">
    <h4>Please check:</h4>
    
    <ul>
        @foreach($errors->all() as $error)
        
            <li>{{$error}}</li>
        
        @endforeach
    </ul>
    <hr>
</section>  
@endif


<section class="col-sm-6 col-sm-offset-3">

{!! Form::open( ['method'=>'patch', 'url'=> action('Blogcategories@update', $blogcategory->id), 'enctype'=>'multipart/form-data' ]) !!}

    
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', $blogcategory->name , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('link', 'Link: ') !!}
                {!! Form::text('link', $blogcategory->link , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                <label for="banner_photos">Banner photo: <span class="badge badge-primary"><input type="checkbox" value="1" name="banner_photo_delete" /> remove</span></label>
                {!! Form::file('banner_photos' , ['class'=>'form-control file']) !!}
            </div>
                
    <div class="form-group">
        {!! Form::submit('Update Blogcategory', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        