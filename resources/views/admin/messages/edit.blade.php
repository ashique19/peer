
@extends('admin.layout')

@section('title') Edit Messages @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Modify Message</center></h1>


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

{!! Form::open( ['method'=>'patch', 'url'=> action('Messages@update', $message->id), 'enctype'=>'multipart/form-data' ]) !!}

    
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', $message->name , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('is_reply', 'Is reply: ') !!}
                {!! Form::select('is_reply', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], $message->is_reply , ['class'=>'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('is_read', 'Is read: ') !!}
                {!! Form::select('is_read', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], $message->is_read , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('details', 'Details: ') !!}
                {!! Form::text('details', $message->details , ['class'=>'form-control']) !!}
            </div>
                
    <div class="form-group">
        {!! Form::submit('Update Message', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        