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
                    <li class="user-actions"><a href="{{action('Payments@buyer')}}" >All Transactions</a></li>
                    <li class="user-actions active"><a href="{{action('Payments@paidByBuyer')}}" >Paid</a></li>
                    <li class="user-actions"><a href="{{action('Payments@unpaidByBuyer')}}" >Unpaid</a></li>
                </ul>
            </div>
            
            <div class="col-sm-9 col-md-10">
                <section class="row push-up-20 pull-left-20 scrollable">
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
                                <th><center>Delivery<br />Status</center></th>
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
                                    @if($payment->status == 1)Unpaid 
                                    <a href="{{action('Payments@payNowPaypal', $payment->id)}}" class="btn btn-xs white-bg green-border green-text">Pay Now</a> 
                                    
                                    <form class="hidden" method="post" action="https://secure.payza.com/checkout" >
                                        <input type="hidden" name="ap_merchant" value="airpostedus@gmail.com"/>
                                        <input type="hidden" name="ap_purchasetype" value="item-goods"/>
                                        <input type="hidden" name="ap_itemname" value="{{$payment->name}}"/>
                                        <input type="hidden" name="ap_amount" value="{{$payment->payment}}"/>
                                        <input type="hidden" name="ap_currency" value="USD"/>
                                    
                                        <input type="hidden" name="ap_quantity" value="1"/>
                                        <input type="hidden" name="ap_itemcode" value="{{$payment->id}}"/>
                                        <input type="hidden" name="ap_returnurl" value="{{action('Payments@payzaSuccess', $payment->id)}}"/>
                                        <input type="hidden" name="ap_cancelurl" value="{{action('Payments@getCancel')}}"/>
                                    
                                        <input type="hidden" name="apc_1" value="Blue"/>
                                        
                                        <button type="submit" class="badge green-bg white-text push-up-5">Pay via Payza</button>
                                    </form>
                                    
                                    
                                    @elseif($payment->status == 2)Paid & Unverified 
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
                </section>
        </div>
        
        </div>
        
    </div>
    
</section>


@stop