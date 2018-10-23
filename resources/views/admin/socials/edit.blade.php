
@extends('admin.layout')

@section('title') Edit Socials @stop

@section('main')

<h1><center>Modify Social</center></h1>

<section class="col-xs-12">
@if($errors->any())

    <h4>Please check:</h4>
    
    <ul>
        @foreach($errors->all() as $error)
        
            <li>{{$error}}</li>
        
        @endforeach
    </ul>
    <hr>
    
@endif
</section>

<section class="col-sm-11">

{!! Form::open( ['method'=>'patch', 'url'=> action('Socials@update', $social->id), 'enctype'=>'multipart/form-data' ]) !!}

    
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', $social->name , ['class'=>'form-control']) !!}
            </div>
                
    <div class="form-group">
        {!! Form::submit('Update Social', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        