
@extends('admin.layout')

@section('title') Chat @stop

@section('main')

<h1><center>Chats @if($chats) : {{$chats->total()}} @endif</center></h1>

<section class="col-sm-10 col-sm-offset-1">
    
    {!! Form::open(['class'=>'form form-inline', 'method' =>'post', 'url'=> action('Chats@searchIndex')]) !!} 
            
        <div class="form-group">
            {!! Form::label('message_from', 'Message from: ') !!}
            {!! Form::text('message_from', old('message_from') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('message_to', 'Message to: ') !!}
            {!! Form::text('message_to', old('message_to') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('is_read_by_from', 'Is read by from: ') !!}
            {!! Form::select('is_read_by_from', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], old('is_read_by_from') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('is_read_by_to', 'Is read by to: ') !!}
            {!! Form::select('is_read_by_to', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], old('is_read_by_to') , ['class'=>'form-control']) !!}
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
    
    <a href="{{action('Chats@create')}}" class="btn btn-default pull-right btn-lg blue-border blue-text">Add new</a>
    
    <table class="table table-responsive">
        <thead>
            <tr>
				<th class="blue-bg white-text">Id</th>
				<th class="blue-bg white-text">Chat</th>
				<th class="blue-bg white-text">Message from</th>
				<th class="blue-bg white-text">Message to</th>
				<th class="blue-bg white-text">Is read by from</th>
				<th class="blue-bg white-text">Is read by to</th>
                <th class="blue-bg white-text" width="50">Delete</th>
            </tr>
        </thead>
        <tbody>
            @if($chats)
                @foreach($chats as $chat)
                    <tr>
						<td>{{$chat->id}}</td>
						<td>@if(strlen($chat->chat_image) > 5)<img src="{{$chat->chat_image}}" width="40" /> @endif {{$chat->name}}</td>
						<td>@if($chat->from){{$chat->from->name}} @endif</td>
						<td>@if($chat->to){{$chat->to->name}} @endif</td>
						<td>{{yn($chat->is_read_by_from)}}</td>
						<td>{{yn($chat->is_read_by_to)}}</td>
                        <td>
                            {!! deletes('Chats', $chat['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {!! $chats->render() !!}
</section>


@stop
        