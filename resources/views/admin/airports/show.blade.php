
@extends('admin.layout')

@section('title') Airport @stop

@section('main')

<h1 class="page-title"><center>Airport</center></h1>


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


@if($airport)
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
                    <td>{{$airport->id}}</td>
                </tr>
                
                <tr>
                    <td>Name</td>
                    <td>{{$airport->name}}</td>
                </tr>
                
                <tr>
                    <td>Country</td>
                    <td>@if($airport->country) {{$airport->country->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Created at</td>
                    <td>{{$airport->created_at}}</td>
                </tr>
                
                <tr>
                    <td>Updated at</td>
                    <td>{{$airport->updated_at}}</td>
                </tr>
                
            <tr>
                <td>
                    {!! edits('Airports', $airport->id, 'edit', ['class'=>'btn btn-warning btn-rounded']) !!}
                            
                </td>
                <td>
                    {!! deletes('Airports', $airport->id, '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                </td>
            </tr>
        </tbody>
    </table>
</section>

@else

    <h3>No data found.</h3>

@endif

@stop
        