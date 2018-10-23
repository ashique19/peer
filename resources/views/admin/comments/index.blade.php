
@extends('admin.layout')

@section('title') Comment @stop

@section('main')

<h1><center>Comments @if($comments) : {{$comments->total()}} @endif</center></h1>

<section class="col-sm-10 col-sm-offset-1">
    
    {!! Form::open(['class'=>'form form-inline', 'method' =>'post', 'url'=> action('Comments@searchIndex')]) !!} 
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('user_id', 'User: ') !!}
            {!! Form::select('user_id', \App\User::lists('name', 'id'), old('user_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('blog_id', 'Blog: ') !!}
            {!! Form::select('blog_id', \App\Blog::lists('name', 'id'), old('blog_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('is_published', 'Is published: ') !!}
            {!! Form::select('is_published', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], old('is_published') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('is_reply', 'Is reply: ') !!}
            {!! Form::select('is_reply', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], old('is_reply') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('comment_id', 'Comment: ') !!}
            {!! Form::select('comment_id', \App\Comment::lists('name', 'id'), old('comment_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('commenter_name', 'Commenter name: ') !!}
            {!! Form::text('commenter_name', old('commenter_name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('commenter_email', 'Commenter email: ') !!}
            {!! Form::text('commenter_email', old('commenter_email') , ['class'=>'form-control']) !!}
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



@if($errors->any())
<section class="col-sm-10 col-sm-offset-1 panel-body">
    <h4>Please check:</h4>
    
    <ul>
        @foreach($errors->all() as $error)
        
            <li>{{$error}}</li>
        
        @endforeach
    </ul>
    <hr>
</section>  
@endif

<section class="col-sm-10 col-sm-offset-1">
    
    <a href="{{action('Comments@create')}}" class="btn btn-default pull-right btn-lg blue-border blue-text">Add new</a>
    
    <table class="table table-responsive">
        <thead>
            <tr>
				<th class="blue-bg white-text">Id</th>
				<th class="blue-bg white-text">Name</th>
				<th class="blue-bg white-text">User</th>
				<th class="blue-bg white-text">Blog</th>
				<th class="blue-bg white-text">Is published</th>
				<th class="blue-bg white-text">Is reply</th>
				<th class="blue-bg white-text">Comment</th>
				<th class="blue-bg white-text">Commenter name</th>
				<th class="blue-bg white-text">Commenter email</th>
				<th class="blue-bg white-text">Created at</th>
				<th class="blue-bg white-text">Updated at</th>
                <th class="blue-bg white-text" width="50">Show</th>
                <th class="blue-bg white-text" width="50">Modify</th>
                <th class="blue-bg white-text" width="50">Delete</th>
            </tr>
        </thead>
        <tbody>
            @if($comments)
                @foreach($comments as $comment)
                    <tr>
						<td>{{$comment->id}}</td>
						<td>{{$comment->name}}</td>
						<td>@if($comment->user) {{$comment->user->name}} @endif</td>
						<td>@if($comment->blog) {{$comment->blog->name}} @endif</td>
						<td>@if($comment->is_published == 1) Yes @elseif($comment->is_published == 0) No @else $comment->is_published @endif</td>
						<td>@if($comment->is_reply == 1) Yes @elseif($comment->is_reply == 0) No @else $comment->is_reply @endif</td>
						<td>@if($comment->comment) {{$comment->comment->name}} @endif</td>
						<td>{{$comment->commenter_name}}</td>
						<td>{{$comment->commenter_email}}</td>
						<td>{{$comment->created_at}}</td>
						<td>{{$comment->updated_at}}</td>
                        <td>
                            {!! views('Comments', $comment->id, '<span class=\'fa fa-expand\'></span>', ['class'=>'btn btn-success btn-rounded']) !!}
                        </td>
                        <td>
                            {!! edits('Comments', $comment['id'], '<span class=\'fa fa-pencil\'></span>', ['class'=>'btn btn-warning btn-rounded']) !!}
                        </td>
                        <td>
                            {!! deletes('Comments', $comment['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {!! $comments->render() !!}
</section>


@stop
        