@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified | Home @stop

@section('meta')
    <meta name="title" content="Airposted - Shipping Simplified | Home">
    <meta name="description" content="Airposted is an open platform that allows buyers to shop for goods from anywhere in the world and have it delivered to them by a traveler who is already heading that way, without the cost and hassle of international shipping.">
    <meta name="keywords" content="Airposted, open platform, buyers, shop, anywhere in the world, delivered, traveler, without cost, without hassle, international shipping.">
@stop

@section('header-menu') white @stop

@section('main')

<section class="row home-top-slider">
    
    <div class="slick" slick-options='{ "centerMode": false, "autoplay": true, "autoplaySpeed": 3000, "speed": 7000 }'>
        
        @if(count($slides) > 0)
        @foreach($slides as $slide)
        <div class="row slide">
            <div class="background">
                <img src="{{$slide->slide_photo}}" alt="{{$slide->name}}" class="img-responsive">
            </div>
            <div class="foreground text-center">
                <h1 class="text-center">{{$slide->name}}</h1>
            </div>
        </div>
        @endforeach
        @endif

    </div>
    
    <div class="foreground text-center">
        <ul class="list-inline links">
            <li><a href="#signup-modal"  type="button" data-toggle="modal" class="btn btn-lg green-bg white-text push-20">Become a <strong>Buyer</strong></a></li>
            <li><a href="#signup-modal"  type="button" data-toggle="modal" class="btn btn-lg blue-bg white-text push-20">Become a <strong>Traveler</strong></a></li>
        </ul>
    </div>
</section>

<section class="row how-it-works homepage">
    
    <div class="col-sm-10 col-sm-offset-1 push-up-30 pull-down-50">
        
        <div class="row no-padding">
            
            <div class="col-sm-6">
                <h1 class="push-up-7-percent">
                    so here's<br> how it works.
                </h1>
                <p class="pull-up-20">
                Airposted is an open platform that allows buyers to shop for goods from anywhere in the world
                and have it delivered to them by a traveler who is already heading that way,
                without the cost and hassle of international shipping.
                </p>
            </div>
            
            <div class="col-sm-5 col-sm-offset-1 pull-up-50">
                <iframe src="https://www.youtube.com/embed/KM7VRR0C5sY?autoplay=0&showinfo=0&controls=0&color=white&loop=1&playlist=KM7VRR0C5sY" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
        
        
        <div class="row push-up-7-percent services" id="services">
            
            <div class="col-sm-4 col-xs-12">
                <p class="text-center" balance-height="2">
                    <img src="/public/img/settings/travel.png" alt="Travel and explore">
                </p>
                <h4 class="push-up-10 push-down-10 text-center blue-text" balance-height="1">Travel and Earn</h4>
                <p balance-height="10">
                    Become a traveler, carry products and make money while traveling the world.
                    Be a verified traveler and get paid upfront before traveling, for now US citizens only.
                </p>
                <p class="text-center">
                    <a href="{{action('StaticPageController@howItWorksTravelers')}}" class="btn blue-bg white-text">Learn More</a>
                </p>
            </div>
            
            <div class="col-sm-4 col-xs-12">
                <p class="text-center" balance-height="2">
                    <img src="/public/img/settings/p2p.png" alt="Travel and explore">
                </p>
                <h4 class="push-up-10 push-down-10 text-center blue-text" balance-height="1">Order through Traveler</h4>
                <p balance-height="10">
                    Shop for goods from anywhere in the world – where they are the cheapest or uniquely available. 
                    An Airposted traveler will deliver it for a carrying fee.
                </p>
                <p class="text-center">
                    <a href="{{action('StaticPageController@howItWorksBuyers')}}" class="btn blue-bg white-text">Learn More</a>
                </p>
            </div>
            
            <div class="col-sm-4 col-xs-12">
                <p class="text-center" balance-height="2">
                    <img src="/public/img/settings/buy.png" alt="Travel and explore">
                </p>
                <h4 class="push-up-10 push-down-10 text-center blue-text" balance-height="1">Order through Airposted</h4>
                <p balance-height="10">
                    Shop for goods from the US. Get them delivered to you via Airposted Express Mail. 
                    Add multiple products from same or different stores to save on shipping.
                </p>
                <p class="text-center">
                    <a href="{{action('StaticPageController@howItWorksAirexpress')}}" class="btn blue-bg white-text">Learn More</a>
                </p>
            </div>
            
        </div>
        
        
        <div class="row push-up-50">
            <div class="col-sm-3 col-xs-12 text-left">
                <img src="public/img/how-it-works/2_search.svg" class="img-responsive"></img>
            </div>
            <div class="col-sm-3 col-xs-12">
                <div class="negotiate push-up-40">
                    <h3 class="blue-text text-right push-right-20"><span class="green-text">20+</span><br />Countries</h3>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12">
                <div class="negotiate push-up-40">
                    <h3 class="blue-text text-right push-right-20"><span class="green-text">$2M+</span><br />Posted</h3>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12">
                <div class="negotiate push-up-40">
                    <h3 class="blue-text text-right push-right-20"><span class="green-text">1000+</span><br />Travelers</h3>
                </div>
            </div>
        </div>
        
        
    </div>
</section>

<section class="row why-us homepage lightGray-bg">
    <div class="col-sm-10 col-sm-offset-1">
        
        <h1 class="row">Why us?</h1>
        
        <div class="pull-up-30 row">
            
            <div class="col-xs-12 col-sm-6 col-md-4 push-up-20" balance-height="4">
                <h3 class="blue-text">Fast</h3>
                <p>
                    Receive your items in as little as 48 hours depending on the travelers trip itinerary.
                </p>
            </div>
            
            <div class="col-xs-12 col-sm-6 col-md-4 push-up-20" balance-height="4">
            
                <h3 class="blue-text">Safe</h3>
                <p>
                    Your money is secure with us. No cash handling and PayPal takes care of the payment process.
                </p>
            </div>
            
            <div class="col-xs-12 col-sm-6 col-md-4 push-up-20" balance-height="4">
                <h3 class="blue-text">Affordable</h3>
                <p>
                    International shipping is expensive. Through Airposted you set the price you want to pay.
                </p>
            </div>
            
            <div class="col-xs-12 col-sm-6 col-md-4 push-up-20" balance-height="5">
                <h3 class="blue-text">Shop securely</h3>
                <p>
                    When you pay we hold your money securely in our escrow.
                </p>
                <p>
                    Received fake, replica or damaged product? Contact us!
                </p>
            </div>
            
            <div class="col-xs-12 col-sm-6 col-md-4 push-up-20" balance-height="5">
                <h3 class="blue-text">Carry &amp; earn</h3>
                <p>
                    Carry products that you receive requests for &amp; buy them yourself. 
                    You know what is inside &amp; your carrying limit -Safe!
                </p>
            </div>
            
            <div class="col-xs-12 col-sm-6 col-md-4 push-up-20" balance-height="5">
                <h3 class="blue-text">Payment</h3>
                <p>
                    Worldwide Acceptance, anytime – anywhere! 
                    <br>
                    <img src="/public/img/settings/visa-master-paypal.png" alt="Visa, Master, Paypal" width="80%" class="img-responsive">
                </p>
            </div>

            
            <div class="col-xs-12 col-sm-6 col-md-4 push-up-20" balance-height="5">
                <h3 class="blue-text">Tax &amp; Duty</h3>
                <p>
                    Travelers pay the tax/duty at airport customs and save the receipt to get reimbursed by your shopper when making delivery.
                </p>
            </div>
            
            <div class="col-xs-12 col-sm-6 col-md-4 push-up-20" balance-height="6">
                <h3 class="blue-text">Product Insured</h3>
                <p>
                    Airposted provides insurance of up to $100 per shipment – shipped via Airposted Express Mail.
                </p>
            </div>
            
            <div class="col-xs-12 col-sm-6 col-md-4 push-up-20" balance-height="6">
                <h3 class="blue-text">Get Verified</h3>
                <p>
                    Verified? Get paid upfront before traveling. Open to US residents &amp; citizens only.
                </p>
                <p>
                    Unverified? Get paid in 3 days of making product delivery.
                </p>
            </div>
            
            <!--<div class="col-xs-12 col-sm-6 col-md-4 push-up-20" balance-height="6">-->
            <!--    <h3 class="blue-text">Customs, Tax &amp; Duty</h3>-->
            <!--    <p>-->
            <!--        Shoppers use our Local tax/duty calculator to know how much your duty is. Travelers pay the tax/duty at airport (paid already by your buyer).-->
            <!--    </p>-->
            <!--</div>-->
            
            
            
        </div>
        
    </div>
</section>

<section class="row how-it-works">
    <div class="col-sm-10 col-sm-offset-1">
        
        <div class="pull-up-50 row references">
            <h2>Press</h2>
            <ul class="list-inline">
                <li><a target="_blank" rel="nofollow" href="https://goo.gl/Bn99wJ"><img src="/public/img/references/1.png" class="img-responsive"></img></a></li>
                <li><a target="_blank" rel="nofollow" href="https://goo.gl/afrh8o"><img src="/public/img/references/2.png" class="img-responsive"></img></a></li>
                <li><a target="_blank" rel="nofollow" href="https://www.youtube.com/watch?v=bcF0bBQQKC8"><img src="/public/img/references/3.png" class="img-responsive"></img></a></li>
                <li><a target="_blank" rel="nofollow" href="https://goo.gl/OpQyn7"><img src="/public/img/references/4.png" class="img-responsive"></img></a></li>
                <li><a target="_blank" rel="nofollow" href="https://goo.gl/Zgjqdi"><img src="/public/img/references/5.png" class="img-responsive"></img></a></li>
            </ul>
        </div>
        
    </div>
</section>

@section('bodyScope')
@include('public.partials.v2-launch-buyer-message')
@stop

@stop
