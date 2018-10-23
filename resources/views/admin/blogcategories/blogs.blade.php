
@extends('admin.layout')

@section('title') Blogcategory @stop

@section('main')

@if($category)
<h1>Blogs of <i>{{$category->name}}</i></h1>
@endif

{!! errors($errors) !!}

@if(count($blogs) > 0)

<table class="table table-responsive">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Banner</th>
            <th>Status</th>
            <th>Popular</th>
            <th>Public link</th>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($blogs as $blog)
        <tr>
			<td>{{$blog->id}}</td>
			<td>{{$blog->name}}</td>
			<td><center>{!! thumb($blog->banner_photo) !!}</center></td>
			<td>@if($blog->status == 0)Draft @elseif($blog->status == 1)Published @elseif($blog->status == 2)Trash @endif</td>
			<td>{{yn($blog->is_popular)}}</td>
			<td><a target="_blank" href="{{action('BlogPublic@singleBlog', $blog->link)}}" class="btn btn-success btn-rounded">Public view</a></td>
            <td>
                {!! views('Blogs', $blog->id, '<span class=\'fa fa-expand\'></span>', ['class'=>'btn btn-success btn-rounded']) !!}
            </td>
            <td>
                {!! edits('Blogs', $blog['id'], '<span class=\'fa fa-pencil\'></span>', ['class'=>'btn btn-warning btn-rounded']) !!}
            </td>
            <td>
                {!! deletes('Blogs', $blog['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endif


@stop
        