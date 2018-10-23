
@extends('admin.layout')

@section('title') Edit Blogtags @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Modify Blogtag</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

{!! Form::open( ['method'=>'patch', 'url'=> action('Blogtags@update', $blogtag->id), 'enctype'=>'multipart/form-data' ]) !!}

    
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', $blogtag->name , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('link', 'Link: ') !!}
                {!! Form::text('link', $blogtag->link , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                <label for="banner_photos">Banner photo: <span class="badge badge-primary"><input type="checkbox" value="1" name="banner_photo_delete" /> remove</span></label>
                {!! Form::file('banner_photos' , ['class'=>'form-control file']) !!}
            </div>
                
    <div class="form-group">
        {!! Form::submit('Update Blogtag', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        