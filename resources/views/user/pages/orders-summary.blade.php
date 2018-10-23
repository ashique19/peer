@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav-order')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        <div class="row">
            <div class="col-sm-3 col-md-2 col-xs-12 no-padding">
                <ul class="user-action-ul">
                    <li class="user-actions"><a href="{{action('BuyOrders@newOrder')}}" >Order</a></li>
                    <li class="user-actions active"><a href="{{action('BuyOrders@history')}}" >History</a></li>
                </ul>
            </div>
        
            <div class="col-sm-9 col-md-10 col-xs-12">
                
                <h1 class="section-heading blue-text">Order Detail</h1>
                
                {!! errors($errors) !!}
            
                @if($order)
                
                @if($order->status == 3)
                <div class="col-xs-12 no-padding">
                    <a href="#" class="btn btn-sm btn-rounded green-bg white-text pull-right" data-html="true" data-trigger="focus" data-container="body" data-toggle="popover" data-placement="bottom" data-content="<p><a href='{{action('Payments@payNowPaypal', $order->payment_id)}}' class='btn btn-block btn-rounded orange-bg white-text'>PayPal</a></p><p><a href='{{action('Payments@stripePaymentPage', $order->payment_id)}}' class='btn btn-block btn-rounded blue-bg white-text'>Debit/Credit card</a></p>">Pay for Product</a>
                </div>
                @elseif($order->status == 6)
                <div class="col-xs-12 no-padding">
                    <a href="#" class="btn btn-sm btn-rounded green-bg white-text pull-right"  data-html="true" data-trigger="focus" data-container="body" data-toggle="popover" data-placement="bottom" data-content="<p><a href='{{action('Payments@payNowPaypal', $order->payment_id)}}' class='btn btn-block btn-rounded orange-bg white-text'>PayPal</a></p><p><a href='{{action('Payments@stripePaymentPage', $order->payment_id)}}' class='btn btn-block btn-rounded blue-bg white-text'>Debit/Credit card</a></p>">Pay for Shipping</a>
                </div>
                @endif
                
                
                <section class="col-sm-8 col-xs-12">
                    
                    <div class="col-xs-12">
                        
                        <h2 class="section-heading">
                            Summary
                            <span class="btn orange-bg white-text btn-rounded">Status: {{order_status($order->status)}}</span>
                        </h2>
                        
                        
                        
                        <div class="col-sm-6 col-xs-12">
                            <h2 class="section-heading green-text">Buyer</h2>
                            <p>Name: {{$label->buyer_name}}</p>
                            <p>Email: {{$label->buyer_email}}</p>
                            <p>Phone: {{$label->buyer_phone}}</p>
                            <p>Address: {{$label->buyer_addressLines}}</p>
                            <p>City: {{$label->buyer_cityTown}}</p>
                            <p>State: {{$label->buyer_stateProvince}}</p>
                            <p>Postcode: {{$label->buyer_postalCode}}</p>
                            <p>Country: {{$label->buyer_countryCode}}</p>
                        </div>
                        
                        <div class="col-sm-6 col-xs-12">
                            <h2 class="section-heading green-text">Receiver</h2>
                            <p>Name: {{$label->receiver_name}}</p>
                            <p>Email: {{$label->receiver_email}}</p>
                            <p>Phone: {{$label->receiver_phone}}</p>
                            <p>Address: {{$label->receiver_addressLines}}</p>
                            <p>City: {{$label->receiver_cityTown}}</p>
                            <p>State: {{$label->receiver_stateProvince}}</p>
                            <p>Postcode: {{$label->receiver_postalCode}}</p>
                            <p>Country: {{$label->receiver_countryCode}}</p>
                        </div>
                        
                    </div>
                    
                    
                    <div class="col-xs-12">
                        
                        <h2 class="section-heading">Payment</h2>
                        <p class="small green-text">
                            @if($order->status == 3)
                            <div class="col-xs-12 no-padding">
                                <a href="#" class="btn btn-sm btn-rounded green-bg white-text pull-right" data-html="true" data-trigger="focus" data-container="body" data-toggle="popover" data-placement="bottom" data-content="<p><a href='{{action('Payments@payNowPaypal', $order->payment_id)}}' class='btn btn-block btn-rounded orange-bg white-text'>PayPal</a></p><p><a href='{{action('Payments@stripePaymentPage', $order->payment_id)}}' class='btn btn-block btn-rounded blue-bg white-text'>Debit/Credit card</a></p>">Pay for Product</a>
                            </div>
                            @elseif($order->status == 6)
                            <div class="col-xs-12 no-padding">
                                <a href="#" class="btn btn-sm btn-rounded green-bg white-text pull-right" data-html="true" data-trigger="focus" data-container="body" data-toggle="popover" data-placement="bottom" data-content="<p><a href='{{action('Payments@payNowPaypal', $order->payment_id)}}' class='btn btn-block btn-rounded orange-bg white-text'>PayPal</a></p><p><a href='{{action('Payments@stripePaymentPage', $order->payment_id)}}' class='btn btn-block btn-rounded blue-bg white-text'>Debit/Credit card</a></p>">Pay for Shipping</a>
                            </div>
                            @elseif($order->status == 9)
                            <div class="col-xs-12 no-padding">
                                <a  href="#" 
                                    class="btn btn-sm btn-rounded green-bg white-text pull-right" 
                                    data-html="true" 
                                    data-trigger="focus" 
                                    data-container="body" 
                                    data-toggle="popover" 
                                    data-placement="bottom" 
                                    data-content="
                                        <p>
                                            <a href='{{action('Payments@payNowPaypal', $order->payment_id)}}' class='btn btn-block btn-rounded orange-bg white-text'>PayPal</a>
                                        </p>
                                        <p>
                                            <a href='{{action('Payments@stripePaymentPage', $order->payment_id)}}' class='btn btn-block btn-rounded blue-bg white-text'>Debit/Credit card</a>
                                        </p>
                                    ">Pay now</a>
                            </div>
                            @else
                                Payment link will be active once Admin opens it for you
                            @endif
                            
                        </p>
                        
                        <table class="table table-responsive table-theme-1 table-condensed">
                            <thead>
                                <tr>
                                    <th>Total</th>
                                    <th>Paid Amount</th>
                                    <th>Due Amount</th>
                                    <th>Paid for Product</th>
                                    <th>Paid for Shipping</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$payment->payment}}</td>
                                    <td>{{$order->paid_amount}}</td>
                                    <td>{{$payment->payment - $order->paid_amount}}</td>
                                    <td>{{yn($order->paid_for_product)}}</td>
                                    <td>{{yn($order->paid_for_shipping)}}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                    
                    
                    <div class="col-xs-12 scrollable">
                        <h2 class="section-heading green-text text-center">Products</h2>
                        <ul class="summary-products no-padding">
                            @if( count($products) > 0 )
                            @foreach( $products as $product )
                            <li>
                                <span class="cart-summary-img">
                                    <img src="{{$product->product_image}}" class="img-responsive"></img>
                                </span>
                                
                                <span class="row">
                                    <div class="no-margin">{{$product->name}}: <span class="pull-right">${{$product->price}} * {{$product->quantity}} = ${{ $product->price * $product->quantity }}</span></div>
                                    <div class="no-margin">Size: <span class="pull-right">{{$product->length}} * {{$product->width}} * {{$product->height}} Inches * {{$product->quantity}}</span></div>
                                    <div class="no-margin">Weight: <span class="pull-right">{{ $product->weight }} Gm * {{$product->quantity}}</span></div>
                                </span>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                
                </section>
                
                <section class="col-sm-4 col-xs-12">
                    <h2 class="section-heading">Log</h2>
                    
                    @if($order->order_logs()->count() > 0)
                    @foreach($order->order_logs as $log)
                    <div class="col-xs-12 no-padding push-up-10">
                        <p>
                            <span class="pull-right small darkGray-text">{{$log->createdBy->name}} | {{$log->created_at->format('M-d-Y')}}</span>
                            <span class="blue-text">{{$log->name}}</span>
                        </p>
                        <p>{{$log->log_detail}}</p>
                    </div>
                    @endforeach
                    @endif
                    
                </section>
                
                @else
                
                <h2 class="section-heading green-text">Sorry, We did not find your requested order.</h2>
                
                @endif
                
            </div>
        </div>
        
        
    </div>
</section>


@stop