
@extends('admin.layout')

@section('title') Blogtag @stop

@section('main')

<h1 class="page-title"><center>Blogtag</center></h1>

{!! errors($errors) !!}

@if($blogtag)
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
                    <td>{{$blogtag->id}}</td>
                </tr>
                
                <tr>
                    <td>Name</td>
                    <td>{{$blogtag->name}}</td>
                </tr>
                
                <tr>
                    <td>Link</td>
                    <td>{{$blogtag->link}}</td>
                </tr>
                
                <tr>
                    <td>Banner photo</td>
                    <td><a href="{{$blogtag->banner_photo}}" class="btn btn-default btn-rounded btn-xs"><span class="fa fa-download"></span></a></td>
                </tr>
                
                <tr>
                    <td>Created at</td>
                    <td>{{$blogtag->created_at}}</td>
                </tr>
                
                <tr>
                    <td>Updated at</td>
                    <td>{{$blogtag->updated_at}}</td>
                </tr>
                
            <tr>
                <td>
                    <a href="{{action('Blogtags@blogs', $blogtag->id)}}" class="btn btn-success btn-rounded">All Blogs with this Tag</a>
                    {!! edits('Blogtags', $blogtag->id, 'edit', ['class'=>'btn btn-warning btn-rounded']) !!}
                            
                </td>
                <td>
                    {!! deletes('Blogtags', $blogtag->id, '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                </td>
            </tr>
        </tbody>
    </table>
</section>

@else

    <h3>No data found.</h3>

@endif

@stop
        