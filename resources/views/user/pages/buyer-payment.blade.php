@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        {!! errors($errors) !!}
        
        <div class="col-xs-12 no-padding">
            
            <div class="col-sm-3 col-md-2 no-padding">
                <ul class="user-action-ul">
                    <li class="user-actions active"><a href="{{action('Payments@buyer')}}" >All Transactions</a></li>
                    <li class="user-actions"><a href="{{action('Payments@paidByBuyer')}}" >Paid</a></li>
                    <li class="user-actions"><a href="{{action('Payments@unpaidByBuyer')}}" >Unpaid</a></li>
                </ul>
            </div>
            
            <div class="col-sm-9 col-md-10">
                <section class="row push-up-20 pull-left-20 scrollable" style="padding-bottom: 140px;" >
                    <h1 class="section-heading black-text">Payments</h1>
                    <table class="table table-responsive table-theme-1 table-condensed">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Traveler</th>
                                <th>Shipping<br />Fee</th>
                                <th>Total</th>
                                <th>Payment<br />Status</th>
                                <th><center>Status</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @if(count($payments) > 0)
                            @foreach($payments as $payment)
                            <tr>
                                <td><a @if($payment->offer) href="{{$payment->offer->link}}" @endif>{{$payment->name}}</a></td>
                                <td>${{$payment->product_price}}</td>
                                <td>@if($payment->traveller) <a href="{{ action( 'Travels@travellerDetails', $payment->traveller->id ) }}" class="link">{{ $payment->traveller->name }}</a> @endif</td>
                                <td>${{ round( $payment->payment - $payment->product_price - $payment->traveller_commission , 2) }}</td>
                                <td>${{ round( $payment->payment , 2) }}</td>
                                <td>
                                    @if( $payment->order )
                                    
                                        @if( $payment->order->status == 3 || $payment->order->status == 6 || $payment->order->status == 9 )
                                        
                                            @include('user.partials.pay-now-button')
                                        
                                        @endif
                                    
                                    @endif
                                    
                                    
                                    
                                    @if( $payment->offer )
                                    
                                        @if( $payment->status == 1 )
                                        
                                            @include('user.partials.pay-now-button')
                                            
                                        @endif
                                        
                                    @endif
                                        
                                    @if($payment->status == 2)Paid & Unverified 
                                    @elseif($payment->status == 3)Payment Verified 
                                    @elseif($payment->status == 4)Payment Delivered to Traveler  
                                    @endif
                                </td>
                                <td>
                                    @if($payment->is_delivered == 0)
                                        <button  class="btn white-bg"
                                        @if($payment->status == 3)
                                            data-container="body" 
                                            data-toggle="popover" 
                                            data-placement="bottom" 
                                            data-content='
                                                <div class="row delivery-status">
                                                    <p><a href="{{action('Payments@buyerReceivedProductFromTraveller', $payment->id)}}">Delivered</a></p>
                                                </div>
                                            '
                                        @endif 
                                        >UnDelivered @if($payment->status == 3) <i class="fa fa-caret-down"></i> @endif</button>
                                    @elseif($payment->is_delivered == 1) 
                                        <button  class="btn white-bg"
                                            @if($payment->status == 3 && $payment->is_delivered != 1)
                                                data-container="body" 
                                                data-toggle="popover" 
                                                data-placement="bottom" 
                                                data-content='
                                                    <div class="row delivery-status">
                                                        <p><a href="{{action('Payments@buyerReceivedProductFromTraveller', $payment->id)}}">Delivered</a></p>
                                                    </div>
                                                '
                                            @endif 
                                        >UnDelivered <i class="fa fa-caret-down"></i></button>
                                    @else 
                                        <button class="btn white-bg">Delivered</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            
                        </tbody>
                    </table>
                    {!! $payments->render() !!}
                </section>
            </div>
            
        </div>
        
        
        
    </div>
</section>


@stop