@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified - My Travel Info @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        {!! errors($errors) !!}
        
        <div class="col-xs-12 no-padding">
            
            <div class="col-sm-3 col-md-2 no-padding">
                <ul class="user-action-ul">
                    <li class="user-actions active"><a href="{{action('Payments@traveller')}}" >All Transactions</a></li>
                    <li class="user-actions"><a href="{{action('Payments@paidForTraveller')}}" >Paid</a></li>
                    <li class="user-actions"><a href="{{action('Payments@unpaidForTraveller')}}" >Unpaid</a></li>
                    <li class="user-actions"><a href="{{action('Payments@earningHistory')}}" >Earning History</a></li>
                </ul>
            </div>
            
            <div class="col-sm-9 col-md-10 col-xs-12">
                <section class="row push-up-20 pull-left-20 scrollable">
                    <h1 class="section-heading black-text">Payments</h1>
                    
                    <table class="table table-responsive table-theme-1 table-condensed">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Buyer</th>
                                <th>My Earning</th>
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
                                <td><a href="{{action('Buyers@details', $payment->buyer_id)}}">{{$payment->buyer->name}}</a></td>
                                <td>${{$payment->traveller_commission}}</td>
                                <td>${{$payment->payment}}</td>
                                <td>
                                    <span class="green-text">
                                    @if($payment->status == 1)Unpaid 
                                    @elseif($payment->status == 2)Unverified 
                                    @elseif($payment->status == 3)Verified
                                    @elseif($payment->status == 4)Credited 
                                    @endif
                                    </span>
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
                                                        <p><a href="{{action('Payments@TravellerGaveProductToBuyer', $payment->id)}}">Delivered</a></p>
                                                    </div>
                                                '
                                            @endif 
                                            >Not Delivered @if($payment->status == 3) <i class="fa fa-caret-down"></i> @endif</button>
                                    
                                    @elseif($payment->is_delivered == 1) 
                                        <button class="btn white-bg">Delivered</button>
                                    @else
                                        <button class="btn white-bg">Received</button>
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