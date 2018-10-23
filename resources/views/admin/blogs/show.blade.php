
@extends('admin.layout')

@section('title') Blog @stop

@section('main')

<h1 class="page-title"><center>@if($blog){{$blog->name}} @else Blog not found. @endif</center></h1>


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


@if($blog)
<section class="row panel-default tabs">
    
    <ul class="nav nav-tabs nav-justified">
        <li class="active"><a href="#Summary" data-toggle="tab" aria-expanded="true">Summary</a></li>
        <li class=""><a href="#Banner" data-toggle="tab" aria-expanded="false">Banner</a></li>
        <li class=""><a href="#Details" data-toggle="tab" aria-expanded="false">Details</a></li>
        <li class=""><a href="#Categories" data-toggle="tab" aria-expanded="false">Categories</a></li>
        <li class=""><a href="#Tags" data-toggle="tab" aria-expanded="false">Tags</a></li>
        <li class=""><a href="#Related" data-toggle="tab" aria-expanded="false">Related Blogs</a></li>
        <li class=""><a href="#Comments" data-toggle="tab" aria-expanded="false">Comments</a></li>
        <li class=""><a href="#Ratings" data-toggle="tab" aria-expanded="false">Ratings</a></li>
    </ul>
    
    <div class="panel-body tab-content">
        <div class="tab-pane active" id="Summary">
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
                            <td>{{$blog->id}}</td>
                        </tr>
                        
                        <tr>
                            <td>Name</td>
                            <td>{{$blog->name}}</td>
                        </tr>
                        
                        <tr>
                            <td>Link</td>
                            <td>{{$blog->link}}</td>
                        </tr>
                        
                        <tr>
                            <td>Created by</td>
                            <td>@if($blog->createdBy){{$blog->createdBy->name}} @endif</td>
                        </tr>
                        
                        <tr>
                            <td>Updated by</td>
                            <td>@if($blog->updatedBy){{$blog->updatedBy->name}} @endif</td>
                        </tr>
                        
                        <tr>
                            <td>Status</td>
                            <td>@if($blog->status == 0)Draft @elseif($blog->status == 1)Waiting for Review @elseif($blog->status == 2)Published @elseif($blog->status == 3)Trash @endif</td>
                        </tr>
                        
                        <tr>
                            <td>Is popular</td>
                            <td>@if($blog->is_popular == 1)Yes @else No @endif</td>
                        </tr>
                        
                        <tr>
                            <td>Created at</td>
                            <td>{{$blog->created_at}}</td>
                        </tr>
                        
                        <tr>
                            <td>Updated at</td>
                            <td>{{$blog->updated_at}}</td>
                        </tr>
                        
                </tbody>
            </table>
        </div>
        <div class="tab-pane" id="Banner">
            <a href="{{$blog->banner_photo}}" class="btn btn-default btn-rounded btn-xs">{!! md($blog->banner_photo) !!}</a>
        </div>
        <div class="tab-pane" id="Details">
            {!! $blog->details !!}
        </div>                        
        <div class="tab-pane" id="Categories">
            @if(count($categories) > 0)
            <ul class="list-group">
                @foreach($categories as $category)
                <li class="list-group-item"><a href="{{action('Blogcategories@show', $category->id)}}">{{$category->name}}</a></li>
                @endforeach
            </ul>
            @endif
        </div>                        
        <div class="tab-pane" id="Tags">
            @if(count($tags) > 0)
            <ul class="list-group">
                @foreach($tags as $tag)
                <li class="list-group-item"><a href="{{action('Blogtags@show', $tag->id)}}">{{$tag->name}}</a></li>
                @endforeach
            </ul>
            @endif
        </div>                        
        <div class="tab-pane" id="Related">
            @if(count($relatedBlogs) > 0)
            <ul class="list-group">
                @foreach($relatedBlogs as $relatedBlog)
                <li class="list-group-item"><a href="{{action('Blogs@show', $relatedBlog->id)}}">{{$relatedBlog->name}}</a></li>
                @endforeach
            </ul>
            @endif
        </div>                        
        <div class="tab-pane" id="Comments">
            @if(count($comments) > 0)
            <table class="table table-responsive">
                <thead>
                    <tr>
        				<th>Id</th>
        				<th>Name</th>
        				<th>User</th>
        				<th>Blog</th>
        				<th>Published</th>
        				<th>Reply</th>
        				<th>Parent</th>
        				<th>Commenter</th>
        				<th>Commenter email</th>
        				<th>Created at</th>
        				<th>Updated at</th>
                        <th>Show</th>
                        <th>Modify</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                    <tr>
						<td>{{$comment->id}}</td>
						<td>{{$comment->name}}</td>
						<td>@if($comment->user) {{$comment->user->name}} @endif</td>
						<td>@if($comment->blog) {{$comment->blog->name}} @endif</td>
						<td>
						    @if($comment->is_published == 1)
						    <a href="{{action('Comments@unpublish', $comment->id)}}" class="btn btn-success btn-rounded">Yes</a>
						    @else
						    <a href="{{action('Comments@publish', $comment->id)}}" class="btn btn-warning btn-rounded">No</a>
						    @endif
						</td>
						<td>@if($comment->is_reply == 1) Yes @elseif($comment->is_reply == 0) No @else $comment->is_reply @endif</td>
						<td>@if($comment->comment) {{$comment->comment->name}} @endif</td>
						<td>{{$comment->commenter_name}}</td>
						<td>{{$comment->commenter_email}}</td>
						<td>{{$comment->created_at}}</td>
						<td>{{$comment->updated_at}}</td>
                        <td>
                            <a href="{{action('Comments@show', $comment->id)}}" class="btn btn-default btn-sm btn-rounded" title="Edit role"><span class="fa fa-pencil"></span></a>
                        </td>
                        <td>
                            <a href="{{action('Comments@edit', $comment['id'])}}" class="btn btn-default btn-sm btn-rounded" title="Edit role"><span class="fa fa-pencil"></span></a>
                        </td>
                        <td>
                            {!! Form::open(['method'=>'delete', 'url'=> action('Comments@destroy', $comment->id) ]) !!}
                            {!! Form::hidden('id', $comment->id ) !!}
                            <button href="{{action('Comments@edit',[$comment->id])}}" class="btn btn-danger btn-sm btn-rounded" title="Delete comment ">
                                <span class="fa fa-times"></span>
                            </button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
        </div>                        
        <div class="tab-pane" id="Ratings">
            <ul class="list-group">
                <li class="list-group-item">Average Rating: <span class="badge badge-primary">{{$blog->votes()->avg('name')}}</span></li>
                <li class="list-group-item"><h4>Rating List:</h4></li>
                @if(count($votes) > 0)
                @foreach($votes as $vote)
                <li class="list-group-item">{{$vote->name}} @ {{$vote->created_at}} @if($vote->user)by {{$vote->user->name}} @endif <span class="pull-right">{!! deletes('Blogvotes', $vote->id, '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}</span></li>
                @endforeach
                @endif
            </ul>
        </div>                        
    </div>
    
    <div class="panel-body">
        <ul class="list-inline">
            <li>{!! edits('Blogs', $blog->id, 'edit', ['class'=>'btn btn-warning btn-rounded']) !!}</li>
            <li>{!! deletes('Blogs', $blog->id, '<span class=\'fa fa-times\'></span> Delete', ['class'=>'btn btn-danger btn-rounded']) !!}</li>
        </ul>
    </div>
    
    
    
    
</section>

@else

    <h3>No data found.</h3>

@endif

@stop
        