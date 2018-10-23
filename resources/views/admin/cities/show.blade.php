
@extends('admin.layout')

@section('title') City @stop

@section('main')

<h1 class="page-title"><center>City</center></h1>

{!! errors($errors) !!}

@if($city)
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
                    <td>{{$city->id}}</td>
                </tr>
                
                <tr>
                    <td>Name</td>
                    <td>{{$city->name}}</td>
                </tr>
                
                <tr>
                    <td>Country</td>
                    <td>@if($city->country) {{$city->country->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Created at</td>
                    <td>{{$city->created_at}}</td>
                </tr>
                
                <tr>
                    <td>Updated at</td>
                    <td>{{$city->updated_at}}</td>
                </tr>
                
            <tr>
                <td>
                    {!! edits('Cities', $city->id, 'edit', ['class'=>'btn btn-warning btn-rounded']) !!}
                            
                </td>
                <td>
                    {!! deletes('Cities', $city->id, '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                </td>
            </tr>
        </tbody>
    </table>
</section>

@else

    <h3>No data found.</h3>

@endif

@stop
        