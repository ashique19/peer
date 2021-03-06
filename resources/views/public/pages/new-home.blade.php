<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="author" content="John Doe">
    <meta name="description" content="">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>PeerPosted</title>
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="shortcut icon" type="image/ico" href="images/favicon.ico" />
    <!-- Plugin-CSS -->
    <link rel="stylesheet" href="{{asset('public/product/home/css/pp-style.css')}}">
    <link rel="stylesheet" href="{{asset('public/product/home/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/product/home/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/product/home/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/product/home/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('public/product/home/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('public/product/home/css/animate.css')}}">
    <!-- Main-Stylesheets -->
    <link rel="stylesheet" href="{{asset('public/product/home/css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('public/product/home/css/responsive.css')}}">
    <style type="text/css">
        
        .how-it-works .title {
          margin: 0px auto 80px;
        }
        
    </style>
    
    <script src="{{asset('public/product/home/js/vendor/modernizr-2.8.3.min.js')}}"></script>

    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-target="#primary-menu">

<div class="preloader">
    <div class="sk-folding-cube">
        <div class="sk-cube1 sk-cube"></div>
        <div class="sk-cube2 sk-cube"></div>
        <div class="sk-cube4 sk-cube"></div>
        <div class="sk-cube3 sk-cube"></div>
    </div>
</div>
<!--Mainmenu-area-->
<div class="mainmenu-area" data-spy="affix" data-offset-top="100">
    <div class="container">
        <!--Logo-->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#primary-menu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand logo">
                <img src="{{asset('public/product/home/images/pp/logo.png')}}">
            </a>
        </div>
        <!--Logo/-->
        <nav class="collapse navbar-collapse" id="primary-menu">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#home">Home</a></li>
                <li><a href="#trendy">Trendy</a></li>
{{--                <li><a href="{{route('amazon')}}" >Iphone Accessories</a></li>--}}
{{--                <li><a href="{{route('amazon1')}}" >Electronics Accessories</a></li>--}}
                
                <li><a href="#how-it-works">How It Works</a></li>
                {{--<li><a href="#why-us-2">Why us 2</a></li>--}}
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#why-us">About Us</a></li>
                <li><a href="#testimonial">Testimonial</a></li>
                <li><a href="#contact-page">Contact</a></li>
                @if (Auth::guest())
                    <li><a href="#login" class="lets-start-menu">Let's Start</a></li>
                @else
                    <li><a href="{{route('user-dashboard')}}" class="lets-start-menu">Let's Start</a></li>
                @endif
            </ul>
        </nav>
    </div>
</div>
<!--Mainmenu-area/-->


<!--Header-area-->
<header class="full-height relative v-center" id="home">
    <div class="absolute"></div>
    <div class="container">
        <div class="row v-center">
            <div class="col-md-12">
                <div class="screen-slider-">
                    <div class="item row">
                        <div class="v-center">
                            <div class="col-xs-12 col-md-6">
                                <div class="screen-slider">
                                    <div class="item">
                                        <div class="caption-title" data-animation="animated fadeInUp">
                                            <p class="title-lg bold">Overseas Shopping Made Easy</p>
                                        </div>
                                        <div class="caption-title caption-desc" data-animation="animated fadeInUp">
                                            <p class="bold text_color_1">Shop around the world from the comfort of your home.</p>
                                            <!--<p class="title-sm bold text_color_1">of Your Home</p>-->
                                        </div>
                                        <div class="caption-button" data-animation="animated fadeInUp">
                                            <a href="{{route('product-lists')}}" class="button pp-bg btn-big">See Available Products</a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="caption-title" data-animation="animated fadeInUp">
                                            <p class="title-lg bold">Earn Money as you Travel</p>
                                        </div>
                                        <div class="caption-title caption-desc" data-animation="animated fadeInUp">
                                            <p class="bold text_color_1">Pack a few items in your bag and earn extra cash every time you travel home.</p>
                                            <!--<p class="title-sm bold text_color_1">of Your Home</p>-->
                                        </div>
                                        <div class="caption-button" data-animation="animated fadeInUp">
                                            <a href="{{route('product-lists')}}" class="button pp-bg btn-big">See Available Products</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-4 col-md-offset-2">
                                <div class="caption-photo two" data-animation="animated fadeInRight">
                                    <img src="{{asset('public/product/home/images/slider/Banner1.png')}}" alt=""  style="height:350px;width: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="col-md-12 header-bottom header-text">-->
            <!--    <div class="col-md-6">-->
            <!--        <div class="left-icon">-->
            <!--            <a href="{{route('product-lists')}}"><img src="{{asset('public/product/home/images/pp/search.svg')}}" /></a>-->
            <!--        </div>-->
            <!--        <h1>Click to search your desire</h1>-->
            <!--    </div>-->
            <!--    {{--<div class="col-md-6 text-right">--}}-->
            <!--        {{--<img src="{{asset('public/product/home/images/pp/search.svg')}}">--}}-->
            <!--    {{--</div>--}}-->
            <!--</div>-->
        </div>
    </div>
</header>
<!--Header-area/-->

<!--Login-area-->
<section class="sky-bg section-padding full-height v-center login" id="login" style="display: none">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-12 col-md-6">
                    <div class="caption-title" data-animation="animated fadeInUp">
                        <p class="title-sm bold">I have Account</p>
                        <p class="title-lg bold">Wow! Let's Login</p>
                    </div>
                    <div class="caption-button" data-animation="animated fadeInUp">
                        <a href="{{route('login')}}" class="button white btn-big">Log in</a>
                        {{--<a href="#" data-toggle="modal" data-target="#loginModal" class="button white btn-big">Log in</a>--}}
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 login-right">
                    <div class="pull-right">
                        <div class="caption-title" data-animation="animated fadeInUp">
                            <p class="title-sm bold">I don't have Account</p>
                            <p class="title-lg bold">Let's Start</p>
                        </div>
                        <div class="caption-button" data-animation="animated fadeInUp">
                            <a href="{{route('login')}}" class="button bg_color_1 btn-big">As a Traveller</a>
                        </div>
                        <div class="caption-button" data-animation="animated fadeInUp">
                            <a href="{{route('login')}}" class="button white btn-big">As a Buyer</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Login-area/-->

<!--trendy-area-->
<section class="section-padding  relative v-center trendy" id="trendy">
    <div class="container">
        <h3 class="title-trendy text_color_1">Trendy Now</h3>
    </div>
    <div class="container">
        <div class="row text-center">
            <div class="col-xs-12">
                <div class="clients">
                    @if(count($trendyProducts))
                        @foreach($trendyProducts as $product)
                            <div class="item">
                                <div class="item-top">
                                    <span>-34%</span>
                                    <img src="{{asset($product->image)}}" alt="">
                                </div>
                                <div class="item-bottom text-left">
                                    <h4><b>{{$product->title}}</b></h4>
                                    <p>BDT {{$product->price}}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-success">No Products found</div>
                    @endif
                </div>
                <!--<h3 class="text-right"><a href="{{route('product-lists')}}"><b>All Products</b></a></h3>-->
            </div>
        </div>
    </div>
</section>
<!--trendy-area/-->


<!--How it Works-area-->
<section class="section-padding how-it-works" id="how-it-works">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="row balance-height-group">
                    <div class="col-xs-12 col-md-12">
                        <h5 class="title">
                            <span  class="title-why-us text_color_1">Traveler</span>
                        </h5>
                    </div>
                    
                    <div class="col-sm-3 col-xs-6">
                        <h3 class="bullte-title text-center balance-height">Add your travel to calender</h3>
                        <figure class="text-center">
                            <img width="75%" src="/public/img/icon/t1.png"></img>
                        </figure>
                        <p class="text-center">Becoming a Traveler is as easy as Signing up on our website and uploading your travel schedule to our calendar.
                        </p>
                    </div>
                    
                    <div class="col-sm-3 col-xs-6">
                        <h3 class="bullte-title text-center balance-height">Choose which product to buy</h3>
                        <figure class="text-center">
                            <img width="75%" src="/public/img/icon/t2.png"></img>
                        </figure>
                        <p class="text-center">You can choose which items to buy based around your travel schedule and personal convenience.
                        </p>
                    </div>
                    
                    <div class="col-sm-3 col-xs-6">
                        <h3 class="bullte-title text-center balance-height">Deliver to Us</h3>
                        <figure class="text-center">
                            <img width="75%" src="/public/img/icon/t3.png"></img>
                        </figure>
                        <p class="text-center">Upon your return, you may deliver the packages to the designated location, or one of our agents can pick them up from you.
                        </p>
                    </div>
                    
                    <div class="col-sm-3 col-xs-6">
                        <h3 class="bullte-title text-center balance-height">Collect your fee</h3>
                        <figure class="text-center">
                            <img width="75%" src="/public/img/icon/t4.png"></img>
                        </figure>
                        <p class="text-center">Once the buyer has confirmed delivery of the product, you will receive your fee within three working days. 
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!--How it Works-area/-->

<!--How it Works-area-->
<section class="section-padding how-it-works" id="search-product">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="row balance-height-group">
                    <div class="col-xs-12 col-md-12">
                        <h5 class="title">
                            <span  class="title-why-us text_color_1">Buyer</span>
                        </h5>
                    </div>
                    
                    <div class="col-sm-3 col-xs-6">
                        <h3 class="bullte-title text-center balance-height">Find your product</h3>
                        <figure class="text-center">
                            <img width="75%" src="/public/img/icon/b1.png"></img>
                        </figure>
                        <p class="text-center">Our partnership with eBay means their entire catalog is available to our Buyers, simply click on an eBay item and it goes to your shopping. You can also browse through some of the biggest online retailers (like Amazon) and post the link for the product on Peerposted.
                        </p>
                    </div>
                    
                   
                    
                    <div class="col-sm-3 col-xs-6">
                        <h3 class="bullte-title text-center balance-height">Make your payment</h3>
                        <figure class="text-center">
                            <img width="75%" src="/public/img/icon/b2.png"></img>
                        </figure>
                        <p class="text-center">Our secure payment gateway lets you  purchase any product you desire using your local credit/debit card, bKash or direct bank transfer.
                        </p>
                    </div>
                    
                    <div class="col-sm-3 col-xs-6">
                        <h3 class="bullte-title text-center balance-height">Get your product</h3>
                        <figure class="text-center">
                            <img width="75%" src="/public/img/icon/b3.png"></img>
                        </figure>
                        <p class="text-center">Our agents will deliver your packages right to your door. 
                        </p>
                    </div>
                     <div class="col-sm-3 col-xs-6">
                        <h3 class="bullte-title text-center balance-height">Buy from Peerposted</h3>
                        <figure class="text-center">
                            <img width="75%" src="https://cdn4.iconfinder.com/data/icons/world-travel-guide/512/travel-13-512.png"></img>
                        </figure>
                        <p class="text-center">Just click on a desired product, regardless of which site you were browsing, and it will be added to your shopping cart where you can finalize your purchase.
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
</section>
<!--How it Works-area/-->


<!--FAQ area-->
<section class="section-padding faq" id="faq">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="title-contact-us text_color_1">Got Interest? Know More</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-12 col-md-5">
                        <div class="content">
                            <h4><b>FAQ</b></h4>
                            <!--<ol>-->
                                
                                <h4><b>Is Peerposted Safe?</b></h4>
                                <p class="text_color_1">
                                    Our payment gateway is secure and we guarantee delivery of your desired product.
                                </p>
                                
                                <h4><b>How Do I pay for my Products?</b></h4>
                                <p class="text_color_1">
                                    Pay using your local credit/debit card, bKash or direct bank transfer, whichever is convenient for you.
                                </p>
                                
                                <h4><b>Is there a carrying fee?</b></h4>
                                <p class="text_color_1">
                                   All Travellers will be paid accordingly for their services. 
                                </p>
                                
                                <h4><b>What is the estimated time of delivery?</b></h4>
                                <p class="text_color_1">
                                    Upto 15 days for estimated delivery. Time could vary depending on several factors, and in such cases, buyers will be notified. 
                                </p>
                                
                                
                                <h4><b>What is the exchange rate?</b></h4>
                                <p class="text_color_1">
                                    Exchange rate will be as per international rates.
                                </p>
                                <!--<li><b>Is Peerposted Safe?</b> <br>Ans: Our payment gateway is secure and we guarantee delivery of your desired product.</li>-->
                                <!--<li><b>How Do I pay for my Products?</b> <br>Ans: Pay using your local credit/debit card, bKash or direct bank transfer, whichever is-->
                                <!--    convenient for you.</li>-->
                                <!--<li><b>Is there a carrying fee?</b><br> Ans: All Travellers will be paid accordingly for their services.</li>-->
                                <!--<li><b>What is the estimated time of delivery?</b><br>Ans: Upto 15 days for estimated delivery. Time could vary depending on several factors, and-->
                                <!--    in such cases, buyers will be notified.</li>-->
                                <!--<li><b>Can I cancel my order?</b> Ans: (TBD we might charge a Cancellation Fee, or a time frame within when they can-->
                                <!--    cancel)*</li>-->
                                <!--<li><b>What is the exchange rate?</b><br>Exchange rate will be as per international rates.</li>-->
                            <!--</ol>-->
                        </div>
                        
                        <div class="content">
                            <h4><b>Can I return items?</b></h4>
                            <p class="text_color_1">
                                We carry insurance on all items, so if your order is damaged we will definitely reimburse you or you can place the order again. If you received the wrong item, or your order was otherwise not as expected, please contact our Customer Service department and we will do our best to resolve the issue.
                            </p>
                        </div>

                    </div>
                    <div class="col-xs-12 col-md-offset-2 col-md-5">
                        <div class="content">
                            <h4><b>Can orders be cancelled after payment?</b></h4>
                            <p class="text_color_1">
                                Once an order has been paid for, we can no longer cancel it as a Traveller would most likely have already made the purchase. Any orders which haven’t been paid for may be cancelled at any time.
                            </p>
                        </div>
                        <div class="content">
                            <h4><b>Is my information safe?</b></h4>
                            <p class="text_color_1">As a company registered in both the US and Bangladesh we comply with all consumer privacy rules. We will never share any information about our Buyers or Travellers without their explicit authorization. 

                            </p>
                        </div>
                        
                        <div class="content">
                            <h4><b>Which websites can I request products from?</b></h4>
                            <p class="text_color_1">Currently we offer products from Amazon and eBay (US). Connected sites will be displayed on our website as they are added.
                            </p>
                        </div>
                        
                        <div class="content">
                            <h4><b>Can I pay in cash?</b></h4>
                            <p class="text_color_1">Currently we are only accepting payments via Credit/Debit card, bKash and Direct Transaction.</p>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
</section>
<!--FAQ area/-->

<!--Why Us-area-->
<section class="section-padding full-height v-center why-us" id="why-us">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="title-why-us text_color_1">It's Peerposted</h1>
                <p class="text_color_1">
                    To put it in simple terms, Peerposted is a service which allows buyers to shop for items from around the world and have them delivered to their doorstep without incurring the traditional costs of international shipping. This is possible due to the help of our Travellers, individuals who are headed to the buyers destination and have agreed to carry said items for a fee.
Think of us as a platform for creating partnerships, bringing different groups of people together to achieve something truly unique and beneficial for everyone. Our network of Travellers stretches across the globe giving our Buyers a selection of items unlike anything before. 
<br><br>
Whether you are a Buyer or a Traveller, working with us will be an easy and hassle free experience.


                </p>
                <a href="#contact-page" class="button pp-bg btn-why-us">Connect Us</a>

            </div>
        </div>
    </div>
</section>
<!--Why Us-area/-->


<section class="testimonial-area section-padding gray-bg overlay" id="testimonial">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 text-center">
                <div class="page-title">
                    <h2>Client says</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit voluptates, temporibus at, facere harum fugiat!</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <div class="testimonials">
                    <div class="testimonial">
                        <div class="testimonial-photo">
                            <img src="{{asset('public/product/home/images/avatar-small-1.png')}}" alt="">
                        </div>
                        <h3>AR Rahman</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel vero dolore officiis, velit id libero illum harum hic magni, quae repellendus adipisci possimus saepe nostrum doloribus repudiandae asperiores commodi voluptate.</p>
                    </div>
                    <div class="testimonial">
                        <div class="testimonial-photo">
                            <img src="{{asset('public/product/home/images/avatar-small-2.png')}}" alt="">
                        </div>
                        <h3>AR Rahman</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel vero dolore officiis, velit id libero illum harum hic magni, quae repellendus adipisci possimus saepe nostrum doloribus repudiandae asperiores commodi voluptate.</p>
                    </div>
                    <div class="testimonial">
                        <div class="testimonial-photo">
                            <img src="{{asset('public/product/home/images/avatar-small-3.png')}}" alt="">
                        </div>
                        <h3>AR Rahman</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel vero dolore officiis, velit id libero illum harum hic magni, quae repellendus adipisci possimus saepe nostrum doloribus repudiandae asperiores commodi voluptate.</p>
                    </div>
                    <div class="testimonial">
                        <div class="testimonial-photo">
                            <img src="{{asset('public/product/home/images/avatar-small-4.png')}}" alt="">
                        </div>
                        <h3>AR Rahman</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel vero dolore officiis, velit id libero illum harum hic magni, quae repellendus adipisci possimus saepe nostrum doloribus repudiandae asperiores commodi voluptate.</p>
                    </div>
                    <div class="testimonial">
                        <div class="testimonial-photo">
                            <img src="{{asset('public/product/home/images/avatar-small-5.png')}}" alt="">
                        </div>
                        <h3>AR Rahman</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel vero dolore officiis, velit id libero illum harum hic magni, quae repellendus adipisci possimus saepe nostrum doloribus repudiandae asperiores commodi voluptate.</p>
                    </div>
                    <div class="testimonial">
                        <div class="testimonial-photo">
                            <img src="{{asset('public/product/home/images/avatar-small-6.png')}}" alt="">
                        </div>
                        <h3>AR Rahman</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel vero dolore officiis, velit id libero illum harum hic magni, quae repellendus adipisci possimus saepe nostrum doloribus repudiandae asperiores commodi voluptate.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer-area relative contact-page" id="contact-page">
    <div class="absolute footer-bg"></div>
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="title-contact-us text_color_1">Connect Us</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link" id="mail-us-tab" data-toggle="tab" href="#mail-us">Mail Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="visit-us-tab" data-toggle="tab" href="#visit-us" role="tab" aria-controls="visit-us" aria-selected="false">Visit Us</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="row tab-pane fade active in" id="mail-us" role="tabpanel" aria-labelledby="mail-us-tab">
                            <form action="#" id="contact-form" method="post">
                                <div class="col-xs-12">
                                    <h4><b>I want to talk about you</b></h4>
                                </div>
                                <div class="col-xs-12 col-md-6 left-input">
                                    <input type="text" id="form-name" name="name" placeholder="Name" class="form-control" required="required">
                                    <input type="email" id="form-email" name="email" class="form-control" placeholder="Email" required="required">
                                </div>
                                <div class="col-xs-12 col-md-6 right-input">
                                    <textarea name="message" id="form-message" name="form-message" rows="5" class="form-control" placeholder="Message" required="required"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-12">
                                        <div class="col-xs-12 col-md-6">
                                            <div class="checkbox">
                                                <input class="styled-checkbox" id="styled-checkbox-1" type="checkbox" value="value1">
                                                <label for="styled-checkbox-1">Send me a copy</label>

                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6 text-right">
                                            <button type="sibmit" class="button pp-bg btn-send ">Send</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="row tab-pane fade" id="visit-us" role="tabpanel" aria-labelledby="visit-us-tab">
                            <div class="col-xs-12 col-md-4">
                                <h4><b>Corporate Office</b></h4>
                                <p>58/A, Lane Road, Ashanamile</p>
                                <p>Uttara, Dhaka, Bangladesh.</p><br>
                                <p>co@peerposted.com</p>
                                <br><br>
                                <h4><b>Corporate Office</b></h4>
                                <p>58/A, Lane Road, Ashanamile</p>
                                <p>Uttara, Dhaka, Bangladesh.</p><br>
                                <p>co@peerposted.com</p>
                            </div>
                            <div class="col-xs-12 col-md-offset-3 col-md-4">
                                <h4><b>Local Office</b></h4>
                                <p><i>Select Country &nbsp; &nbsp; &nbsp; Germany</i></p>
                                <p><i>Select Country &nbsp; &nbsp; &nbsp; Berlin</i></p>
                                <br><br>

                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{asset('public/product/home/images/pp/demo.jpg')}}" class="img-responsive">
                                    </div>
                                    <div class="col-md-8">
                                        <h4 class="german-office-title"><b>Germany Office</b></h4>
                                        <p>Wilane street, Berlin,</p>
                                        <p>AA32 Germany</p>
                                        <p>+52489766545-7</p>
                                        <p>germany@peerposted.com</p>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 left">
                    <!--<li><a href="#">About Us</a></li>-->
                    <!--<li><a href="#">Career</a></li>-->
                    <li><a href="#">Terms</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </div>
                <div class="col-xs-12 col-sm-4 middle text-right">
                    <img src="{{asset('public/product/home/images/pp/demo.jpg')}}" class="img-responsive">
                    <img src="{{asset('public/product/home/images/pp/demo.jpg')}}" class="img-responsive">
                </div>
                <!--<div class="col-xs-12 col-sm-4 right">-->
                <!--    <p>Subscribe Us</p>-->
                <!--    <input type="text" name="" class="form-control">-->
                <!--    <button class="button">Subscribe</button>-->
                <!--</div>-->
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="content">
                    <p>Company Number 548975654 VAT Number 54897</p>
                    <p class="pull-right">&copy; PEERPOSTED 2018-2020</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--Vendor-JS-->
<script src="{{asset('public/product/home/js/vendor/jquery-1.12.4.min.js')}}"></script>
<script src="{{asset('public/product/home/js/vendor/bootstrap.min.js')}}"></script>
<!--Plugin-JS-->
<script src="{{asset('public/product/home/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('public/product/home/js/contact-form.js')}}"></script>
<script src="{{asset('public/product/home/js/jquery.parallax-1.1.3.js')}}"></script>
<script src="{{asset('public/product/home/js/scrollUp.min.js')}}"></script>
<script src="{{asset('public/product/home/js/magnific-popup.min.js')}}"></script>
<script src="{{asset('public/product/home/js/wow.min.js')}}"></script>
<!--Main-active-JS-->
<script src="{{asset('public/product/home/js/main.js')}}"></script>
<script>

$(document).ready(function(){
    
    $(".lets-start-menu").on('click', function(e){
       $('#login').show('slow');
    });
    
    $('.balance-height-group').each(function(i,v){
		max_height = Math.max.apply(null, $(v).find('.balance-height').map(function ()
        {
            return $(this).height();
        }).get());
		
		$(v).find('.balance-height').height( max_height )
    })
    
})
    
    
</script>
</body>

</html>

