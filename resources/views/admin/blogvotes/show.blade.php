
@extends('admin.layout')

@section('title') Blogvote @stop

@section('main')

<h1 class="page-title"><center>Blogvote</center></h1>

{!! errors($errors) !!}

@if($blogvote)
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
                    <td>{{$blogvote->id}}</td>
                </tr>
                
                <tr>
                    <td>Name</td>
                    <td>{{$blogvote->name}}</td>
                </tr>
                
                <tr>
                    <td>Blog</td>
                    <td>@if($blogvote->blog) {{$blogvote->blog->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>User</td>
                    <td>@if($blogvote->user) {{$blogvote->user->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Created at</td>
                    <td>{{$blogvote->created_at}}</td>
                </tr>
                
                <tr>
                    <td>Updated at</td>
                    <td>{{$blogvote->updated_at}}</td>
                </tr>
                
            <tr>
                <td>
                    {!! edits('Blogvotes', $blogvote->id, 'edit', ['class'=>'btn btn-warning btn-rounded']) !!}
                            
                </td>
                <td>
                    {!! deletes('Blogvotes', $blogvote->id, '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                </td>
            </tr>
        </tbody>
    </table>
</section>

@else

    <h3>No data found.</h3>

@endif

@stop
        