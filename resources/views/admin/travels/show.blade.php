
@extends('admin.layout')

@section('title') Travel @stop

@section('main')

<h1 class="page-title"><center>Travel</center></h1>


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


@if($travel)
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
                    <td>{{$travel->id}}</td>
                </tr>
                
                <tr>
                    <td>Arrival date</td>
                    <td>{{$travel->arrival_date->format('Y-M-d')}}</td>
                </tr>
                
                <tr>
                    <td>Departure date</td>
                    <td>{{$travel->departure_date->format('Y-M-d')}}</td>
                </tr>
                
                <tr>
                    <td>Country from</td>
                    <td>@if($travel->countryFrom){{$travel->countryFrom->name}}@endif</td>
                </tr>
                
                <tr>
                    <td>Country to</td>
                    <td>@if($travel->countryTo){{$travel->countryTo->name}}@endif</td>
                </tr>
                
                <tr>
                    <td>Airport from</td>
                    <td>@if($travel->airportFrom){{$travel->airportFrom->name}}@endif</td>
                </tr>
                
                <tr>
                    <td>Airport to</td>
                    <td>@if($travel->airportTo){{$travel->airportTo->name}}@endif</td>
                </tr>
                
                <tr>
                    <td>User</td>
                    <td>@if($travel->user) {{$travel->user->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Is active</td>
                    <td>@if($travel->is_active == 1)Yes @else No @endif</td>
                </tr>
                
                <tr>
                    <td>Created at</td>
                    <td>{{$travel->created_at}}</td>
                </tr>
                
                <tr>
                    <td>Updated at</td>
                    <td>{{$travel->updated_at}}</td>
                </tr>
                
            <tr>
                <td>
                    {!! edits('Travels', $travel->id, 'edit', ['class'=>'btn btn-warning btn-rounded']) !!}
                            
                </td>
                <td>
                    {!! deletes('Travels', $travel->id, '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                </td>
            </tr>
        </tbody>
    </table>
</section>

@else

    <h3>No data found.</h3>

@endif

@stop
        