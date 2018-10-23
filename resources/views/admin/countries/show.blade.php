
@extends('admin.layout')

@section('title') Country @stop

@section('main')

<h1 class="page-title"><center>Country</center></h1>

{!! errors($errors) !!}

@if($country)
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
                    <td>{{$country->id}}</td>
                </tr>
                
                <tr>
                    <td>Code</td>
                    <td>{{$country->code}}</td>
                </tr>
                
                <tr>
                    <td>Name</td>
                    <td>{{$country->name}}</td>
                </tr>
                
                <tr>
                    <td>Created at</td>
                    <td>{{$country->created_at}}</td>
                </tr>
                
                <tr>
                    <td>Updated at</td>
                    <td>{{$country->updated_at}}</td>
                </tr>
                
            <tr>
                <td>
                    {!! edits('Countries', $country->id, 'edit', ['class'=>'btn btn-warning btn-rounded']) !!}
                            
                </td>
                <td>
                    {!! deletes('Countries', $country->id, '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                </td>
            </tr>
        </tbody>
    </table>
</section>

@else

    <h3>No data found.</h3>

@endif

@stop
        