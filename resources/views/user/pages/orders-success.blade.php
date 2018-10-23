@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav-order')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        <div class="row">
            <div class="col-sm-3 col-md-2 no-padding">
                <ul class="user-action-ul">
                    <li class="user-actions active"><a href="{{action('BuyOrders@newOrder')}}" >Order</a></li>
                    <li class="user-actions"><a href="{{action('BuyOrders@history')}}" >History</a></li>
                </ul>
            </div>
        
            <div class="col-sm-9 col-md-10">
                
                <h1 class="section-heading blue-text">Success!</h1>
                <!--<h2 class="section-heading black-text small-heading">Your purchase order has been placed successfully.</h2>-->
            
                <section class="pull-10">
                    <p>
                        Thank you for the product post. 
                        Airposted will review your order and let you know within 36 hours the Shipping Rate. 
                        We know every customer’s need is different so we take the time (36 hours) to give 
                        you the best shipping rates in the world. 
                        Please check your email and Airposted inbox for the rates. 
                        
                        <br />
                        
                        Shop and Ship with Airposted to save money! 
                        
                        <br />
                        <br />
                        
                        Got questions? <a href="mailto:support@airposted.com">support@airposted.com</a>
                    </p>
                </section>
            
                <!--<section class="row pull-10">-->
                <!--    <b class="boldest">What Next?</b>-->
                <!--    <ul class="list-unstyled">-->
                <!--        <li><i class="fa fa-angle-right"></i> &nbsp; Next, we will review your order and determine shipping cost. You will be notified via email.</li>-->
                <!--        <li><i class="fa fa-angle-right"></i> &nbsp; You will make the payment via PayPal or debit/credit card.</li>-->
                <!--        <li><i class="fa fa-angle-right"></i> &nbsp; We will process your order.</li>-->
                <!--    </ul>-->
                <!--</section>-->
            
                <!--<section class="row pull-10">-->
                <!--    <b class="boldest">How to check preview or track status of my order?</b>-->
                <!--    <ul class="list-unstyled">-->
                <!--        <li><i class="fa fa-angle-right"></i> &nbsp; From left menu <i>"Order"</i> at <i>"History"</i> page, you can preview and track progress status of the orders you placed.</li>-->
                <!--    </ul>-->
                <!--</section>-->
                
            </div>
        </div>
        
        
    </div>
</section>


@stop