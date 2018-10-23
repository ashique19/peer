@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

@section('bodyScope') @include('user.partials.tour-traveler-search') @stop

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        <h1 class="section-heading black-text">Travelers</h1>
        
        <div class="col-sm-6 col-sm-offset-3">
            @if($errors->any())
            
            <div class="alert alert-warning">
                @foreach($errors->all() as $error)
                <p class="black-text">{{$error}}</p>
                @endforeach
            </div>
            @endif
        </div>
        
        <div class="col-xs-12 push-up-20 no-padding">
            
            <div class="row search-area" id="traveler-search">
                {!! Form::open([ 'url'=> action('Travels@postTravellerSearchByBuyer'), 'method'=>'POST', 'class'=> 'form-inline text-center' ]) !!}
                
                <div class="col-xs-12 col-sm-4 no-padding text-left">
                    <h4 class="">Departure</h4>
                    <p>Coming from</p>
                    {!! Form::select('country_from', \App\Country::lists('name', 'id'), null, ['class'=>'form-control select2', 'placeholder'=> 'Country From']) !!}
                </div>
                
                <div class="col-xs-12 col-sm-4 no-padding text-left">
                    <h4 class="">Arrival</h4>
                    <p>Coming to</p>
                    {!! Form::select('airport_to[]', [], null, ['class'=>'form-control airport-search', 'placeholder'=> 'Airport To']) !!}
                </div>
                
                <div class="col-xs-12 col-sm-2 no-padding text-left">
                    <h4> &nbsp;&nbsp;&nbsp;</h4>
                    <p>Date</p>
                    {!! Form::text('date_to', null, ['class'=> 'form-control text-center datepicker', 'placeholder'=> 'Date to']) !!}
                </div>
                
                <div class="col-xs-12 col-sm-2 text-right">
                    <h4 class="push-down-20"> &nbsp;&nbsp;&nbsp;</h4>
                    
                    {!! Form::submit('Search', ['class'=>'btn btn-lg orange-bg white-text']) !!}
                </div>
                
                
                {!! Form::close() !!}
            </div>
            
            <div class="col-sm-12 search-result-area" transaction_rate="{{$app->transaction_charge}}" commission_rate="{{$app->commission}}">
                @if(count($travellers) > 0)
                    @foreach($travellers as $traveller)
                    <div class="col-sm-3 panel-body text-center push-up-20 push-down-20 search-item">
                        <div class="row">
                            <div class="img-holder square" @if( strlen($traveller->user->user_photo)>0 ) style="background: url('{{trim($traveller->user->user_photo)}}')" @else style="background: url('/public/img/settings/no-image-available-3.png')" @endif>
                                <a href="{{action('Travels@travellerDetails', $traveller->user_id)}}">
                                    <span class="profile btn">Profile</span>
                                </a>
                            </div>
                            <h4><a href="{{action('Travels@travellerDetails', $traveller->user_id)}}">{{$traveller->user->name}}</a></h4>
                            <div class="col-xs-12 col-sm-6 message-request pull-right-5">
                                @if($traveller->user_id != auth()->user()->id)
                                <a href="#" class="pull-left btn btn-block btn-xs black-bg white-text offer-traveler" data-toggle="modal" data-target="#traveller{{$traveller->id}}">Send Request <img src="/public/img/settings/offer-icon.png" alt="proceed"></a>
                                @endif
                                <p>
                                    <b>Departing</b>
                                    {{$traveller->departure_date->format('m/d/Y')}}
                                </p>
                                <p>
                                    <b>From</b>
                                    @if($traveller->airportFrom){{$traveller->airportFrom->name}} @endif
                                </p>
                            </div>
                            <div class="col-xs-12 col-sm-6 message-request pull-left-5">
                                @if($traveller->user_id != auth()->user()->id)
                                <a href="#" class="pull-right btn btn-block btn-xs blue-bg white-text message-traveler" data-toggle="modal" data-target="#message{{$traveller->id}}">Message <img src="/public/img/settings/chat-icon.png" alt="proceed"></a>
                                @endif
                                <p>
                                    <b>Arriving</b>
                                    {{$traveller->arrival_date->format('m/d/Y')}}
                                </p>
                                <p>
                                    <b>To</b>
                                    @if($traveller->airportTo){{$traveller->airportTo->name}} @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    @if($traveller->user_id != auth()->user()->id)
                    
                        @include('user.partials.buyer-offers-traveler-modal')
                        
                        @include('user.partials.buyer-messages-traveler-modal')
                    
                    @endif
                    
                    @endforeach
                    
                    {!! $travellers->render() !!}
                    
                @else
                <h4>No Traveler was found.</h4>
                @endif
                
            </div>
            
        </div>
        
    </div>
</section>


@stop