
@extends('admin.layout')

@section('title') Create new Social @stop

@section('main')

<h1><center>Socials</center></h1>


@if($errors->any())
<section class="col-sm-11">
    <h4>Please check:</h4>
    
    <ul>
        @foreach($errors->all() as $error)
        
            <li>{{$error}}</li>
        
        @endforeach
    </ul>
    <hr>
</section>    
@endif


<section class="col-sm-11">

<h3>Create Social</h3>


{!! Form::open( ['url'=> action('Socials@store'), 'class'=>'form form-horizontal', 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Social', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        