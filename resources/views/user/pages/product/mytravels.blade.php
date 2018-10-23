@extends('public.layouts.layout')
@section('title')Peerposted - Shipping Simplified - My Travels @stop
@section('main')

    <div class="wrapper payment-confirmation">
        @include('user.pages.product.sidebar')

        <div id="content">
            @include('user.pages.product.header')
            <div class="container-fluid travel">
                <div class="col-md-12">
                    <div class="row layer-1">
                        <a href="#" class="pull-left">My Travels</a>
                        <a href="{{route('travel-add')}}" class="pull-right">Add New Travels</a>
                    </div>
                    <div class="row layer-2">
                        <ul class="nav navbar-nav">
                            <li><a href="{{route('my-travels')}}" class="{{ ($tab == 'active') ?  'active' : ''}}">Active Travels</a></li>
                            <li><a href="{{route('my-upcoming-travels')}}" class="{{ ($tab == 'upcoming') ?  'active' : ''}}">Upcoming Travels</a></li>
                            {{--<li><a href="#" class="{{ ($tab == 'successful') ?  'active' : ''}}">Successful Travels</a></li>--}}
                            {{--<li><a href="#" class="{{ ($tab == 'canceled') ?  'active' : ''}}">Cancelled Travels</a></li>--}}
{{--                            <li><a href="#" class="{{ ($tab == 'archived') ?  'active' : ''}}">Archived Travels</a></li>--}}
                        </ul>
                    </div>
                    {{--<div class="row layer-3">--}}
                        {{--<div class="details">--}}
                            {{--<span>19-05-2018</span> | <span>DHK-FLR</span>--}}
                            {{--<a href="#" class="active pull-right">Cancel</a>--}}
                            {{--<a href="#" class="active pull-right">Edit</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="row layer-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-responsive left-table" >
                                            @if(count($travel) > 0)
                                                @foreach( $travel as $myTravel)
                                                <tr>
                                                    <td rowspan="5"><img src="{{asset('public/img/peerposted/images/destination.svg')}}"></td>
                                                    <td>Departure</td>
                                                    <td>{{$myTravel->airportFrom->name}}, {{$myTravel->countryFrom->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Date</td>
                                                    <td>{{$myTravel->departure_date->format('d-m-Y')}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    {{--<td rowspan="5"><img src="{{asset('public/img/peerposted/images/destination.svg')}}"></td>--}}
                                                    <td>Destination</td>
                                                    <td>{{$myTravel->airportTo->name}}, {{$myTravel->countryTo->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Date</td>
                                                    <td>{{$myTravel->departure_date->format('d-m-Y')}}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td rowspan="5"><div class="alert alert-default">No Travel found</div></td>
                                                </tr>
                                            @endif

                                        </table>
                                    </div><!-- /.row -->
                                    <div class="col-md-6">
                                        {{--<table class="table table-responsive">--}}
                                            {{--<tr>--}}
                                                {{--<td rowspan="5"><img src="{{asset('public/img/peerposted/images/departure.svg')}}"></td>--}}
                                                {{--<td>Departure</td>--}}
                                                {{--<td>Dhaka, Bangladesh</td>--}}
                                            {{--</tr>--}}
                                            {{--<tr>--}}
                                                {{--<td>Date</td>--}}
                                                {{--<td>19-05-2018</td>--}}
                                            {{--</tr>--}}
                                            {{--<tr>--}}
                                                {{--<td colspan="3">&nbsp;</td>--}}
                                            {{--</tr>--}}
                                            {{--<tr>--}}
                                                {{--<td>Destination</td>--}}
                                                {{--<td>Florida, USA</td>--}}
                                            {{--</tr>--}}
                                            {{--<tr>--}}
                                                {{--<td>Date</td>--}}
                                                {{--<td>20-05-2018</td>--}}
                                            {{--</tr>--}}
                                        {{--</table>--}}
                                    </div><!-- /.row -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
@section('js')
    <script >
        $(document).ready(function(){

        })
    </script>
    <script type="text/javascript" src="{{ asset('public/product/sidebar.js') }}"></script>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/product/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/product/travel.css') }}">
@endsection
