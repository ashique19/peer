@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

@if(session('user_type') == 'buyer')

@include('user.partials.buyer-dashboard-report')

@elseif(session('user_type') == 'traveller')

@include('user.partials.traveller-dashboard-report')

@else

<section class="row white-bg">
    
    <div class="what-do-want-to-do banner-margin">
    
        <div class="col-xs-12 no-padding">
            <h1 class="blue-text">
                What do you want to do?
            </h1>
        </div>
        
    </div>
</section>

<section>
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 white-bg choose-buyer-traveler">
        <div class="buyer_or_traveler">
            
            <!--<div class="col-xs-12 col-sm-6 no-padding push-down-50">-->
            <!--    <a class="buyer lightGray-bg text-left" href="{{action('Shippings@getLabel')}}">-->
            <!--        <h1>Ship</h1>-->
            <!--        <p>Get USPS Shipping Label for less to ship world wide</p>-->
            <!--    </a>-->
            <!--</div>-->
            
            <div class="col-xs-12 col-sm-4 no-padding push-down-50">
                <a class="buyer lightGray-bg text-left" href="{{action('Dashboard@setUserTypeToBuyer')}}">
                    <h1>Buy</h1>
                    <p>Get item delivered by a traveler heading your way</p>
                    
                    <h4 class="text-center read-more">
                        <i class="fa fa-angle-down"></i> read more
                    </h4>
                    
                    <ul>
                                                
                        <li><i class="fa fa-angle-right"></i> Post link of the product you want (from anywhere in the world)</li>
                        <li><i class="fa fa-angle-right"></i> Send request to a traveler.</li>
                        <li><i class="fa fa-angle-right"></i> Pay for the product and carrying fee.</li>
                        <li><i class="fa fa-angle-right"></i> Receive your product delivered by a traveler heading your way.</li>
                        <li><i class="fa fa-angle-right"></i> Pay ant tax/duty to the traveler if applicable</li>
                        <li><i class="fa fa-angle-right"></i> Delivery: depends on when traveler is traveling.</li>
                        <li><i class="fa fa-angle-right"></i> Shipping starts at: $9.99</li>
                                                
                    </ul>
                    <p>
                        After you post a product, contact a traveler and send him a request to 
                        carry your item. Carrying fee is fixed and depends on several factors 
                        such as- distance, weight, volume. You will need to write your tax fee 
                        (when sending a carrying request to your buyer).
                    </p>
                </a>
            </div>
            
            <div class="col-xs-12 col-sm-4 no-padding push-down-50">
                <a class="traveler lightGray-bg text-left" href="{{action('Dashboard@setUserTypeToTraveller')}}">
                    <h1>Travel</h1>
                    <p>Carry Products for a fee and get paid</p>
                    
                    <h4 class="text-center read-more">
                        <i class="fa fa-angle-down"></i> read more
                    </h4>
                    
                    <ul>
                        
                        <li><i class="fa fa-angle-right"></i> Post your trip details</li>
                        <li><i class="fa fa-angle-right"></i> Be a courier and carry products</li>
                        <li><i class="fa fa-angle-right"></i> Send carrying request to a buyer</li>
                        <li><i class="fa fa-angle-right"></i> Wait for your buyer to Pay</li>
                        <li><i class="fa fa-angle-right"></i> You buy the product and carry it – Safe</li>
                        <li><i class="fa fa-angle-right"></i> Pay any tax/duty at airport and show your buyer the receipt to get reimbursed</li>
                        <li><i class="fa fa-angle-right"></i> Carrying fee starts at: $9.99</li>
                        
                    </ul>
                    <p>
                        Your carrying fee is fixed and depends on several factors such as- 
                        distance, weight, volume. You will need to write your tax fee 
                        (when sending a carrying request to your buyer). Your buyer will pay 
                        product price + taxes. Then purchase the product and make delivery.
                    </p>
                </a>
            </div>
            
            <div class="col-xs-12 col-sm-4 no-padding push-down-50">
                <a class="buyer lightGray-bg text-left" href="{{action('BuyOrders@newOrder')}}">
                    <h1>Order</h1>
                    <p>Get item delivered by Airposted Express Mail</p>
                    <ul>
                        <li><i class="fa fa-angle-right"></i> Post link of the product you want (from only US websites).</li>
                        <li><i class="fa fa-angle-right"></i> Place an order, hear back within 36 hours with exact shipping rates.</li>
                        <li><i class="fa fa-angle-right"></i> Pay for the product and shipping (tax/duty if applicable will be collected when you receive product).</li>
                        <li><i class="fa fa-angle-right"></i> Receive your product delivered by Airposted Express Mail to your address.</li>
                        <li><i class="fa fa-angle-right"></i> Delivery: 12-18 days</li>
                        <li><i class="fa fa-angle-right"></i> Shipping starts: $44.99</li>
                    </ul>
                    
                    <h4 class="text-center read-more">
                        <i class="fa fa-angle-down"></i> read more
                    </h4>
                    
                    <p>
                        After you post a product request, Airposted will review and send you the most 
                        affordable shipping rates within 36 hours, curated only for you! Include multiple 
                        products in one package to save on shipping. Please check your email and Airposted 
                        inbox for the rates.
                    </p>
                </a>
            </div>
            
            
        </div>
    </div>
</section>

@endif


@stop
