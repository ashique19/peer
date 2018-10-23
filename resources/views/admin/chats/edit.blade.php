
@extends('admin.layout')

@section('title') Edit Chats @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Modify Chat</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

{!! Form::open( ['method'=>'patch', 'url'=> action('Chats@update', $chat->id), 'enctype'=>'multipart/form-data' ]) !!}

    
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', $chat->name , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('chat_image', 'Chat image: ') !!}
                {!! Form::text('chat_image', $chat->chat_image , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('message_from', 'Message from: ') !!}
                {!! Form::text('message_from', $chat->message_from , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('message_to', 'Message to: ') !!}
                {!! Form::text('message_to', $chat->message_to , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('is_read_by_from', 'Is read by from: ') !!}
                {!! Form::select('is_read_by_from', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], $chat->is_read_by_from , ['class'=>'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('is_read_by_to', 'Is read by to: ') !!}
                {!! Form::select('is_read_by_to', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], $chat->is_read_by_to , ['class'=>'form-control']) !!}
            </div>
            
    <div class="form-group">
        {!! Form::submit('Update Chat', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        