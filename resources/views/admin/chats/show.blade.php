
@extends('admin.layout')

@section('title') Chat @stop

@section('main')

<h1 class="page-title"><center>Chat</center></h1>

{!! errors($errors) !!}

@if($chat)
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
                    <td>{{$chat->id}}</td>
                </tr>
                
                <tr>
                    <td>Name</td>
                    <td>{{$chat->name}}</td>
                </tr>
                
                <tr>
                    <td>Chat image</td>
                    <td>{{$chat->chat_image}}</td>
                </tr>
                
                <tr>
                    <td>Message from</td>
                    <td>{{$chat->message_from}}</td>
                </tr>
                
                <tr>
                    <td>Message to</td>
                    <td>{{$chat->message_to}}</td>
                </tr>
                
                <tr>
                    <td>Is read by from</td>
                    <td>{{$chat->is_read_by_from}}</td>
                </tr>
                
                <tr>
                    <td>Is read by to</td>
                    <td>{{$chat->is_read_by_to}}</td>
                </tr>
                
                <tr>
                    <td>Created at</td>
                    <td>{{$chat->created_at}}</td>
                </tr>
                
                <tr>
                    <td>Updated at</td>
                    <td>{{$chat->updated_at}}</td>
                </tr>
                
            <tr>
                <td>
                    {!! edits('Chats', $chat->id, 'edit', ['class'=>'btn btn-warning btn-rounded']) !!}
                            
                </td>
                <td>
                    {!! deletes('Chats', $chat->id, '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                </td>
            </tr>
        </tbody>
    </table>
</section>

@else

    <h3>No data found.</h3>

@endif

@stop
        