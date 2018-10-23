@extends('public.layouts.layout')
@section('title')
@section('title')Airposted - Shipping Simplified - How it works @stop
@stop

@section('meta')
    <meta name="title" content="How it works">
    <meta name="description" content="Airposted - How it works">
    <meta name="keywords" content="Airposted, how it works">
@stop

@section('main')

<section class="row how-it-works-page">
    <div class="col-sm-10 col-sm-offset-1 no-padding">
        
        <h1>Order through a Traveler</h1>
        
        <div class="row">
            <div class="col-xs-12 no-padding">
                <h2 class="green-text">Post, Pay, Receive</h2>
            </div>
            
            <div class="col-sm-7 col-sm-push-5">
                <iframe src="https://www.youtube.com/embed/k-80mihVN1E?autoplay=0&showinfo=0&controls=0&color=white&loop=1&playlist=k-80mihVN1E" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="col-sm-5 col-sm-pull-7 no-padding">
                
                <div class="list row">
                    <span class="number pull-left">1</span>
                    <p class="green-text">Post your Buying details</p>
                    <p class="small">The name and link of the product you’re looking for.</p>
                </div>
                
                <div class="list row">
                    <span class="number pull-left">2</span>
                    <p class="green-text">Search for a Traveler</p>
                    <p class="small">Send them a message or let them contact you.</p>
                </div>
                
                <!--<div class="list row">-->
                <!--    <span class="number pull-left">3</span>-->
                <!--    <p class="green-text">Select a Traveler</p>-->
                <!--    <p class="small">Send your selected traveler an offer. Wait to get an offer from him, with the tax/duty if applicable.</p>-->
                <!--</div>-->
                
                <div class="list row">
                    <span class="number pull-left">3</span>
                    <p class="green-text">Pay us for your Item and Carrying fee</p>
                    <p class="small">Please pay for the product and carrying fee.</p>
                </div>
                
                <div class="list row">
                    <span class="number pull-left">4</span>
                    <p class="green-text">Taxes</p>
                    <p class="small">
                        We do not charge you for tax/duty/sales tax, but your traveler may need to pay them at the 
                        customs depending on the product and quantity. Please ask your traveler to save the tax 
                        receipt and pay it when they deliver your product. You are responsible for the tax/duty/sales 
                        tax. Unsure about the tax rates? Shoot us an email.
                    </p>
                </div>
                
                <div class="list row">
                    <span class="number pull-left">5</span>
                    <p class="green-text">Fix a date & pick up spot</p>
                    <p class="small">Receive the product from your traveler.</p>
                </div>
                
                <div class="list row">
                    <span class="number pull-left">6</span>
                    <p class="green-text">Leave feedback</p>
                    <p class="small">Please, leave a feedback when you receive the product. It is after your feedback that they get paid.*</p>
                    <p class="small">*In most cases unless traveler is verified.</p>
                </div>
                
            </div>
        </div>
        
        <div class="row">
            
            <div class="col-sm-6 col-xs-12 no-padding">
                <div class="list row push-down-20 pull-right-20">
                    <h2 class="blue-text push-down-20">
                        Fee(s)
                    </h2>
                    
                    <div class="col-xs-12 no-padding">
                        <p class="medium">
                            Just pay Product price (as mentioned on the listing you provided and Traveler’s 
                            carrying fee and 2.5% of total transaction amount).
                        </p>
                        <p class="medium">
                            You may need to pay local tax/duty when you receive the product, depending on the product. 
                            Please check with your country’s custom and duty website(s) and office(s) for fee(s) and rates.
                        </p>
                    </div>
                    
                </div>
                
                <div class="list row push-down-20">
                    <h2 class="blue-text push-down-20">
                        Customs and Duties
                    </h2>
                    
                    <div class="col-xs-12 no-padding">
                        <p class="medium">
                            You may need to pay local tax/duty when you receive the product, depending on the 
                            product and quantity. Please check with the country’s (where you are receiving the package) 
                            custom and duty website(s) and office(s) for fee(s)/taxes/duty and sales tax rates.
                        </p>
                        <p class="medium">Still unsure about taxes and other rates? Shoot us an email, <a href="mailto:support@airposted.com">support@airposted.com</a> & we will reply within 24 hours.</p>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
        <div class="row">
            
            <h2 class="blue-text push-up-20 push-down-40">FAQ</h2>
            
            <div class="list row push-down-20">
                <p class="blue-text">
                    <button class="blue-text push-down-20 btn transparent-bg no-padding" data-toggle="collapse" href="#faq-1" aria-expanded="false" aria-controls="faq-1">How do I buy Something? <i class="fa fa-plus"></i></button>
                </p>
                
                <div class="col-xs-12 collapse no-padding" id="faq-1">
                    <p class="medium">
                    Upload the link of the item(s) you want on the Dashboard page. After uploading a link, search for a 
                    traveler or wait to get contacted by one. Once you have found a traveler, send a request. Use our 
                    messaging feature to talk details, such as determine a meeting location. Once your traveler has 
                    accepted the request, parties have agreed on a deal!
                    </p>
                </div>
                
            </div>
            
            <div class="list row push-down-20">
                <p class="blue-text">
                    <button class="blue-text push-down-20 btn transparent-bg no-padding" data-toggle="collapse" href="#faq-2" aria-expanded="false" aria-controls="faq-2">Is Airposted safe? <i class="fa fa-plus"></i></button>
                </p>
                
                <div class="col-xs-12 collapse no-padding" id="faq-2">
                    <p class="medium">
                    Yes, buyers and travelers should preferably meet at public locations.
                    </p>
                </div>
                
            </div>
            
            <div class="list row push-down-20">
                <p class="blue-text">
                    <button class="blue-text push-down-20 btn transparent-bg no-padding" data-toggle="collapse" href="#faq-4" aria-expanded="false" aria-controls="faq-4">How do you pay? <i class="fa fa-plus"></i></button>
                </p>
                
                <div class="col-xs-12 collapse no-padding" id="faq-4">
                    <p class="medium">
                    PayPal and all major international debit and credit cards. If you don’t have an international 
                    debit/credit card, please pay using PayPal.
                    </p>
                </div>
                
            </div>
            
            <div class="list row push-down-20">
                <p class="blue-text">
                    <button class="blue-text push-down-20 btn transparent-bg no-padding" data-toggle="collapse" href="#faq-5" aria-expanded="false" aria-controls="faq-5">When do you pay? <i class="fa fa-plus"></i></button>
                </p>
                
                <div class="col-xs-12 collapse no-padding" id="faq-5">
                    <p class="medium">
                    You pay for the item(s) once a request has been accepted between you and the traveler. Travelers 
                    only purchase the item(s) once you make payment.
                    </p>
                </div>
                
            </div>
            
            <div class="list row push-down-20">
                <p class="blue-text">
                    <button class="blue-text push-down-20 btn transparent-bg no-padding" data-toggle="collapse" href="#faq-6" aria-expanded="false" aria-controls="faq-6">How much do you pay? Fee(s). <i class="fa fa-plus"></i></button>
                </p>
                
                <div class="col-xs-12 collapse no-padding" id="faq-6">
                    <p class="medium">
                    Just pay Product price (as mentioned on the listing you provided and Traveler’s carrying fee on total 
                    amount). You may need to pay local tax/duty when you receive the product, depending on the 
                    product. Please check with your country’s custom and duty website(s) and office(s) for fee(s) and rates.
                    </p>
                </div>
                
            </div>
            
            <div class="list row push-down-20">
                <p class="blue-text">
                    <button class="blue-text push-down-20 btn transparent-bg no-padding" data-toggle="collapse" href="#faq-7" aria-expanded="false" aria-controls="faq-7">What is a carrying fee? <i class="fa fa-plus"></i></button>
                </p>
                
                <div class="col-xs-12 collapse no-padding" id="faq-7">
                    <p class="medium">
                    A carrying fee is the amount of money a buyer pays a traveler for buying and delivering product(s) to them.
                    </p>
                </div>
                
            </div>
            
            <div class="list row push-down-20">
                <p class="blue-text">
                    <button class="blue-text push-down-20 btn transparent-bg no-padding" data-toggle="collapse" href="#faq-8" aria-expanded="false" aria-controls="faq-8">How is a carrying fee determined? <i class="fa fa-plus"></i></button>
                </p>
                
                <div class="col-xs-12 collapse no-padding" id="faq-8">
                    <p class="medium">
                    We take shipping distance, product price, weight, volume, density and a lot of other factors into 
                    consideration, to provide you the best shipping fee; a shipping fee that works for both you and the traveler.
                    </p>
                </div>
                
            </div>
            
            <div class="list row push-down-20">
                <p class="blue-text">
                    <button class="blue-text push-down-20 btn transparent-bg no-padding" data-toggle="collapse" href="#faq-9" aria-expanded="false" aria-controls="faq-9">What is the exchange rate? <i class="fa fa-plus"></i></button>
                </p>
                
                <div class="col-xs-12 collapse no-padding" id="faq-9">
                    <p class="medium">
                    Our exchange rate is simple and there are no hidden costs. We use the current exchange rate 
                    found in PayPal or the ones used by your bank (depending on how you pay). If you are using your 
                    debit/credit card please contact with your bank to know the exchange rate.
                    </p>
                </div>
                
            </div>
            
            <div class="list row push-down-20">
                <p class="blue-text">
                    <button class="blue-text push-down-20 btn transparent-bg no-padding" data-toggle="collapse" href="#faq-10" aria-expanded="false" aria-controls="faq-10">Can you return items? <i class="fa fa-plus"></i></button>
                </p>
                
                <div class="col-xs-12 collapse no-padding" id="faq-10">
                    <p class="medium">
                    We want to ensure you receive the best product and don’t have any complaints. If the product was 
                    damaged, broken, fake or replica or did not meet your expectations, please contact Airposted 
                    support and we will try to do our best to fix the issue.*
                    </p>
                    <p class="medium">
                        *We are currently working to get a $500 insurance per traveler per trip in case of lost or damaged items.
                    </p>
                    <p class="medium">
                        *Airposted’s decision will be considered final in cases of claims made.
                    </p>
                </div>
                
            </div>
            
        </div>
        
    </div>
</section>

@stop
        