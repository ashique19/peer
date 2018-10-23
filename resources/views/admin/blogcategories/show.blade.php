
@extends('admin.layout')

@section('title') Blogcategory @stop

@section('main')

<h1 class="page-title"><center>Blogcategory</center></h1>


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


@if($blogcategory)
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
                    <td>{{$blogcategory->id}}</td>
                </tr>
                
                <tr>
                    <td>Name</td>
                    <td>{{$blogcategory->name}}</td>
                </tr>
                
                <tr>
                    <td>Link</td>
                    <td>{{$blogcategory->link}}</td>
                </tr>
                
                <tr>
                    <td>Banner photo</td>
                    <td><a href="{{$blogcategory->banner_photo}}" class="btn btn-default btn-rounded btn-xs"><span class="fa fa-download"></span></a></td>
                </tr>
                
                <tr>
                    <td>Created at</td>
                    <td>{{$blogcategory->created_at}}</td>
                </tr>
                
                <tr>
                    <td>Updated at</td>
                    <td>{{$blogcategory->updated_at}}</td>
                </tr>
                
            <tr>
                <td>
                    <a href="{{action('Blogcategories@blogs', $blogcategory->id)}}" class="btn btn-success btn-rounded">All Blogs of this Category</a>
                    {!! edits('Blogcategories', $blogcategory->id, 'edit', ['class'=>'btn btn-warning btn-rounded']) !!}
                            
                </td>
                <td>
                    {!! deletes('Blogcategories', $blogcategory->id, '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                </td>
            </tr>
        </tbody>
    </table>
</section>

@else

    <h3>No data found.</h3>

@endif

@stop
        