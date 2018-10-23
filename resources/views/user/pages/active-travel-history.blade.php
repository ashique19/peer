@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-dashboard user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        <div class="row">
            <div class="col-sm-3 col-md-2">
                <ul class="user-action-ul">
                    <li class="user-actions"><a href="{{route('userDashboard')}}" >Post</a></li>
                    <li class="user-actions active"><a href="{{action('Travels@myActiveTravels')}}" >Active</a></li>
                    <li class="user-actions"><a href="{{action('Travels@myTravels')}}" >History</a></li>
                </ul>
            </div>
            
            <div class="col-sm-9 col-md-10">
                
                <div class="row">
                
                    <h1 class="section-heading black-text">Active Trips</h1>
                    
                    {!! errors($errors) !!}
                    
                    <div class="col-xs-12 scrollable">
                        <table class="table table-responsive text-center">
                            <thead>
                                <tr>
                                    <th>Edit</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Arrival date</th>
                                    <th>Departure date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if( count($myTravels) > 0 )
                                @foreach( $myTravels as $myTravel)
                                <tr>
                                    <td>
                                        @if($myTravel->departure_date < \Carbon::now()->addDay(1))Date Expired 
                                        @else 
                                            @if($myTravel->is_active == 1)
                                            {!! Form::open(['url'=> action('Travels@deactivateTravel', $myTravel->id), 'method'=> 'POST']) !!}
                                            {!! Form::hidden('id', $myTravel->id) !!}
                                            <button class="btn transparent-bg btn-xs" role="button" type="submit">Deactivate</button>
                                            {!! Form::close() !!}
                                            @endif 
                                        @endif
                                    </td>
                                    <td>
                                        @if($myTravel->airportFrom){{$myTravel->airportFrom->name}}@endif
                                    </td>
                                    <td>
                                        @if($myTravel->airportTo){{$myTravel->airportTo->name}}@endif
                                    </td>
                                    <td>{{$myTravel->arrival_date->format('Y-m-d')}}</td>
                                    <td>{{$myTravel->departure_date->format('Y-m-d')}}</td>
                                    
                                </tr>
                                @endforeach
                                
                                {!! $myTravels->render() !!}
                                @endif
                            </tbody>
                        </table>
                        
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
    </div>
</section>


@stop