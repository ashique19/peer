@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified - How it works for Travelers @stop

@section('meta')
    <meta name="title" content="How it works for Travelers - Airposted">
    <meta name="description" content="Airposted - Shipping Simplified - How it works for Travelers">
    <meta name="keywords" content="Airposted, how it works, traveler">
@stop

@section('main')

<section class="row how-it-works-page">
    <div class="col-sm-10 col-sm-offset-1 no-padding">
        
        <h1>How it Works for Travelers</h1>
        
        <div class="row">
            <div class="col-sm-5 col-sm-offset-7 col-xs-12 no-padding">
                <h2 class="blue-text">Travel, Carry, Earn</h2>
            </div>
            <div class="col-sm-7">
                <iframe src="https://www.youtube.com/embed/JupvtS3iQkA?autoplay=0&showinfo=0&controls=0&color=white&loop=1&playlist=JupvtS3iQkA" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="col-sm-5 no-padding">
                
                <div class="list row">
                    <span class="number pull-left">1</span>
                    <p class="blue-text"><a class="blue-text" href="{{ route('signup') }}" target="_blank">Register</a> as Traveler</p>
                    <p class="small"><span class="b">Verified:</span> Get paid (product price + carrying fee) upfront before traveling. Open to US residents & citizens only.</p>
                    <p class="small"><span class="b">Unverified:</span> Get paid (product price + carrying fee) in 3 days after making successful product delivery.</p>
                </div>
                
                <div class="list row">
                    <span class="number pull-left">2</span>
                    <p class="blue-text">Post your Travel details</p>
                    <p class="small">So buyers know when and where you’re headed.</p>
                </div>
                
                <div class="list row">
                    <span class="number pull-left">3</span>
                    <p class="blue-text">Search for a buyer</p>
                    <p class="small">Send request to the buyer whose product you want to carry or get contacted by one.</p>
                </div>
                
                <div class="list row">
                    <span class="number pull-left">4</span>
                    <p class="blue-text">Wait for your Buyer to pay us</p>
                    <p class="small">We will send you a confirmation email, once your buyer accepts the offer and makes payment.</p>
                </div>
                
                <div class="list row">
                    <span class="number pull-left">5</span>
                    <p class="blue-text">Buy the product</p>
                    <p class="small">From the link provided by your buyer and carry them.</p>
                </div>
                
                <div class="list row">
                    <span class="number pull-left">6</span>
                    <p class="blue-text">Taxes</p>
                    <p class="small">
                        When you need to pay tax/duty/sales tax, save your receipt and show it to your buyer 
                        when making delivery. They should reimburse you. If they do not, DO NOT deliver the 
                        product and let us know. We’ll open a case. Unsure about the tax rates? Shoot us an email.
                    </p>
                </div>
                
                <div class="list row">
                    <span class="number pull-left">7</span>
                    <p class="blue-text">Deliver the product</p>
                    <p class="small">Fix a meetup spot or drop it off at our drop off location(Bangladesh only)</p>
                </div>
                
            </div>
            
        </div>
        
        <div class="row">
            
            <div class="col-sm-6 col-xs-12 no-padding">
                <div class="list row push-down-20">
                    <h2 class="blue-text push-down-20">Fee(s)</h2>
                    
                    <div class="col-xs-12 no-padding">
                        <p class="medium">As a traveler, you incur no fee(s). Just carry and earn money!</p>
                    </div>
                    
                </div>
                
                <div class="list row push-down-20">
                    <h2 class="blue-text push-down-20">Customs and Duties</h2>
                    
                    <div class="col-xs-12 no-padding">
                        <p class="medium">
                            You may need to pay local tax/duty when you carry the product, depending on the 
                            product and quantity. Please check with the country’s (where you are headed with the package) 
                            custom and duty website(s) and office(s) for fee(s)/taxes/duty and sales tax rates.
                        </p>
                        <p class="medium">Still unsure about taxes and other rates? Shoot us an email, <a href="mailto:support@airposted.com">support@airposted.com</a> & we will reply within 24 hours.</p>
                    </div>
                    
                </div>
                
            </div>
            <div class="col-sm-6 col-xs-12 no-padding">
                <div class="list row push-down-20">
                    <h2 class="blue-text push-down-20">Safety and product Insurance</h2>
                    
                    <div class="col-xs-12 no-padding">
                        <p class="medium">
                        We do not have an insurance policy now. The product is not insured now, so please keep the product safe and take extra care so it does not break or get damaged. If product is broken or damaged, you will be responsible for the price and the carrying fee you would have received will be issued to your buyer*.
                        <br>
                        Got questions: <a href="mailto:support@airposted.com">support@airposted.com</a>
                        </p>
                        <p class="medium">*Airposted’s decision will be considered final in cases of claims made.</p>
                    </div>
                    
                </div>
            </div>
            
            
        </div>
        
        <div class="row">
            
            <h2 class="blue-text push-up-20 push-down-40">FAQ</h2>
            
            <div class="list row push-down-20">
                <p class="blue-text">
                    <button class="no-padding push-down-20 blue-text btn transparent-bg" data-toggle="collapse" href="#faq-1" aria-expanded="false" aria-controls="faq-1">How do I deliver an item and make money while traveling? <i class="fa fa-plus"></i></button>
                </p>
                
                <div class="col-xs-12 collapse no-padding" id="faq-1">
                    <p class="medium">
                    You will post your trip details: travel date and location on the Dashboard page. After uploading trip 
                    details, you can search for a buyer or wait to get contacted by one. Once you have found an item 
                    you want to carry, send a carry request to the buyer. Use our messaging feature to talk details, such 
                    as determine a meeting location. Once your buyer has accepted your request, parties have agreed 
                    on a deal, buyers pay for the item, you buy and deliver the item and get paid after making a 
                    successful delivery!
                    </p>
                </div>
                
            </div>
            
            <div class="list row push-down-20">
                <p class="blue-text">
                    <button class="no-padding push-down-20 blue-text btn transparent-bg" data-toggle="collapse" href="#faq-2" aria-expanded="false" aria-controls="faq-2">Where should you meet? <i class="fa fa-plus"></i></button>
                </p>
                
                <div class="col-xs-12 collapse no-padding" id="faq-2">
                    <p class="medium">
                    Airposted leaves determining a meeting location up to the buyer and traveler but strongly 
                    recommend choosing a busy public place such as a coffee shop or airport.
                    </p>
                </div>
                
            </div>
            
            <div class="list row push-down-20">
                <p class="blue-text">
                    <button class="no-padding push-down-20 blue-text btn transparent-bg" data-toggle="collapse" href="#faq-3" aria-expanded="false" aria-controls="faq-3">How do you get paid? <i class="fa fa-plus"></i></button>
                </p>
                
                <div class="col-xs-12 collapse no-padding" id="faq-3">
                    <p class="medium">
                    You get paid in your associated PayPal account once you have made successful delivery of the 
                    product. Travelers, don’t hesitate to remind your buyer to mark their item(s) as received. Once your 
                    buyer has marked the item you delivered as ‘delivered’, we will release the money into your PayPal 
                    account within 3 business days.
                    </p>
                </div>
                
            </div>
            
            <div class="list row push-down-20">
                <p class="blue-text">
                    <button class="no-padding push-down-20 blue-text btn transparent-bg" data-toggle="collapse" href="#faq-4" aria-expanded="false" aria-controls="faq-4">What do you do after accepting to deliver an item(s)? <i class="fa fa-plus"></i></button>
                </p>
                
                <div class="col-xs-12 collapse no-padding" id="faq-4">
                    <p class="medium">
                    After you accept a request and your buyer pays for the item(s), the first thing you 
                    should do is purchase the item(s). You can sign up to be a VERIFIED Traveler to get 
                    pre-paid funding (only open to US residents and citizens and we will be conducting a 
                    background check to verify you which shall take 5-10 business days). If you do not 
                    sign up to be a VERIFIED Traveler you must use your own money to purchase the item. 
                    Don’t worry about not getting paid. Your buyer has already paid but we simply hold 
                    their money for security reasons. As soon as you deliver the product, we release the 
                    payment within 3-5 business days.
                    </p>
                </div>
                
            </div>
            
            <div class="list row push-down-20">
                <p class="blue-text">
                    <button class="no-padding push-down-20 blue-text btn transparent-bg" data-toggle="collapse" href="#faq-5" aria-expanded="false" aria-controls="faq-5">Can buyers cancel a request after paying for the product? <i class="fa fa-plus"></i></button>
                </p>
                
                <div class="col-xs-12 collapse no-padding" id="faq-5">
                    <p class="medium">
                    Once your buyer has already paid for the product and your carrying fee, they cannot. Buyers can 
                    cancel and delete any requests that haven't been already paid for.
                    </p>
                </div>
                
            </div>
            
            <div class="list row push-down-20">
                <p class="blue-text">
                    <button class="no-padding push-down-20 blue-text btn transparent-bg" data-toggle="collapse" href="#faq-6" aria-expanded="false" aria-controls="faq-6">What is a carrying fee? <i class="fa fa-plus"></i></button>
                </p>
                
                <div class="col-xs-12 collapse no-padding" id="faq-6">
                    <p class="medium">
                    A carrying fee is the amount of money a buyer pays a traveler for buying and delivering product(s) to them.
                    </p>
                </div>
                
            </div>
            
            <div class="list row push-down-20">
                <p class="blue-text">
                    <button class="no-padding push-down-20 blue-text btn transparent-bg" data-toggle="collapse" href="#faq-7" aria-expanded="false" aria-controls="faq-7">How is a carrying fee determined? <i class="fa fa-plus"></i></button>
                </p>
                
                <div class="col-xs-12 collapse no-padding" id="faq-7">
                    <p class="medium">
                    We take shipping distance, product price, weight, volume, density and a lot of other factors into 
                    consideration, to provide you the best shipping fee; a shipping fee that works for both you and the 
                    traveler.
                    </p>
                </div>
                
            </div>
            
            <div class="list row push-down-20">
                <p class="blue-text">
                    <button class="no-padding push-down-20 blue-text btn transparent-bg" data-toggle="collapse" href="#faq-8" aria-expanded="false" aria-controls="faq-8">Can your buyer return items? <i class="fa fa-plus"></i></button>
                </p>
                
                <div class="col-xs-12 collapse no-padding" id="faq-8">
                    <p class="medium">
                    If the product was damaged, broken, fake or replica, YES!* And we will charge you for the entire 
                    transaction. So NEVER buy fake or replicas and be sure to carry item(s) safely so they are not damaged.
                    <br>
                    *We are currently working to get a $500 insurance per traveler per trip in case of lost or damaged items.
                    <br>
                    *Airposted’s decision will be considered final in cases of claims made.
                    </p>
                </div>
                
            </div>
            
        </div>
        
    </div>
</section>

@stop
        