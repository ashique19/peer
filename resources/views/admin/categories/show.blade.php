
@extends('admin.layout')

@section('title') Category @stop

@section('main')

<h1 class="page-title"><center>Category</center></h1>

{!! errors($errors) !!}

@if($category)
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
                    <td>{{$category->id}}</td>
                </tr>
                
                <tr>
                    <td>Name</td>
                    <td>{{$category->name}}</td>
                </tr>
                
                <tr>
                    <td>Search index</td>
                    <td>{{$category->search_index}}</td>
                </tr>
                
                <tr>
                    <td>Is active</td>
                    <td>{{$category->is_active}}</td>
                </tr>
                
                <tr>
                    <td>Is at homepage</td>
                    <td>{{$category->is_at_homepage}}</td>
                </tr>
                
                <tr>
                    <td>Amazon node</td>
                    <td>{{$category->amazon_node}}</td>
                </tr>
                
                <tr>
                    <td>Category photo</td>
                    <td><a href="{{$category->category_photo}}" class="btn btn-default btn-rounded btn-xs"><span class="fa fa-download"></span></a></td>
                </tr>
                
                <tr>
                    <td>Created at</td>
                    <td>{{$category->created_at}}</td>
                </tr>
                
                <tr>
                    <td>Updated at</td>
                    <td>{{$category->updated_at}}</td>
                </tr>
                
            <tr>
                <td>
                    {!! edits('Categories', $category->id, 'edit', ['class'=>'btn btn-warning btn-rounded']) !!}
                            
                </td>
                <td>
                    {!! deletes('Categories', $category->id, '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                </td>
            </tr>
        </tbody>
    </table>
</section>

@else

    <h3>No data found.</h3>

@endif

@stop
        