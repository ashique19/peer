
@extends('admin.layout')

@section('title') Message @stop

@section('main')

<h1 class="page-title"><center>Message</center></h1>


@if($errors->any())
<section class="row panel-body">
    <h4>Please check:</h4>
    
    <ul>
        @foreach($errors->all() as $error)
        
            <li>{{$error}}</li>
        
        @endforeach
    </ul>
    <hr>
</section>  
@endif


@if($message)
<section class="row panel-body">
    <table class="table table-bordered table-striped table-actions">
        <tdead>
            <tr>
                <td width="200">Title</td>
                <td>Details</td>
            </tr>
        </tdead>
        <tbody>
                <tr>
                    <td>Id</td>
                    <td>{{$message->id}}</td>
                </tr>
                
                <tr>
                    <td>Name</td>
                    <td>{{$message->name}}</td>
                </tr>
                
                <tr>
                    <td>Message from</td>
                    <td>@if($message->from){{$message->from->name}}@endif</td>
                </tr>
                
                <tr>
                    <td>Message to</td>
                    <td>@if($message->to){{$message->to->name}}@endif</td>
                </tr>
                
                <tr>
                    <td>Is reply</td>
                    <td>@if($message->is_reply == 1)Yes @else No @endif</td>
                </tr>
                
                <tr>
                    <td>Is read</td>
                    <td>@if($message->is_read == 1)Yes @else No @endif</td>
                </tr>
                
                <tr>
                    <td>Reply of:</td>
                    <td>@if($message->message) {{$message->message->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Details</td>
                    <td>{!! $message->details !!}</td>
                </tr>
                
                <tr>
                    <td>Created at</td>
                    <td>{{$message->created_at}}</td>
                </tr>
                
                <tr>
                    <td>Updated at</td>
                    <td>{{$message->updated_at}}</td>
                </tr>
                
            <tr>
                <td>
                    {!! edits('Messages', $message->id, 'edit', ['class'=>'btn btn-warning btn-rounded']) !!}
                    <button type="button" class="btn btn-success btn-rounded" data-toggle="modal" data-target="#edit-message">Reply</button>
                </td>
                <td>
                    {!! deletes('Messages', $message->id, '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                </td>
            </tr>
        </tbody>
    </table>
    
<!-- Modal -->
<div class="modal fade" id="edit-message" tabindex="-1" role="dialog" aria-labelledby="edit-message">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    {!! Form::open( ['method'=>'patch', 'url'=> action('Messages@update', $message->id), 'enctype'=>'multipart/form-data' ]) !!}

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Reply the message</h4>
      </div>
      <div class="modal-body">
            
            {!! Form::hidden('name', 'Re: '.$message->name ) !!}
                
            {!! Form::hidden('message_from', auth()->user()->id ) !!}
                
            {!! Form::hidden('message_to', $message->message_from) !!}
                
            {!! Form::hidden('is_reply', 1) !!}
            
            {!! Form::hidden('is_read', 0) !!}
            
            {!! Form::hidden('message_id', $message->id ) !!}
                
            <div class="form-group">
                {!! Form::label('details', 'Message: ') !!}
                {!! Form::textarea('details', null , ['class'=>'form-control']) !!}
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send Reply</button>
      </div>
    
    {!! Form::close() !!}
    </div>
  </div>
</div>
    
</section>

@else

    <h3>No data found.</h3>

@endif

@stop
        